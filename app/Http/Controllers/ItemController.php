<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Collection;
use App\Models\Deletion;
use App\Models\Item;
use App\Models\Subject;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ItemController extends Controller
{

    //  --  Show Home  --  \\
    public function home() {
        // Takes only 500 to not tank performance
        /*
        $items = Item::query()
            ->with(['authors:id,fullname', 'collections:id,title'])
            ->where('status', Item::STATUS_ACTIVE)->latest()->limit(500)
            ->get();
        $latestItems = $items->take(12);
        $latestManuscripts = $items->where('type', Item::type_Manuscript)->take(12);
        $latestPeriodics = $items->where('type', Item::type_Periodic)->take(12);
        */

        $latestItems = Item::query()
            ->with(['authors:id,fullname', 'collections:id,title'])
            ->where('status', Item::STATUS_ACTIVE)->latest()->limit(12)
            ->get();

        $latestManuscripts = Item::query()
            ->with(['authors:id,fullname', 'collections:id,title'])
            ->where('status', Item::STATUS_ACTIVE)
            ->where('type', Item::type_Manuscript)
            ->latest()->limit(12)
            ->get();
        $latestPeriodics = Item::query()
            ->with(['authors:id,fullname', 'collections:id,title'])
            ->where('status', Item::STATUS_ACTIVE)
            ->where('type', Item::type_Periodic)
            ->latest()->limit(12)
            ->get();

        return view('home', [
            'latestItems' => $latestItems,
            'latestPeriodics' => $latestPeriodics,
            'latestManuscripts' => $latestManuscripts,
        ]);
    }

    //  --  Show all items  --  \\
    public function index() {
        $validationSort = ['asc', 'desc', 'latest'];
        $validationPage = ['10', '15', '20', '25', '30'];
        $pages = request('orderBy', 25);
        $sort = request('sortBy', 'asc');
        $sortField = 'title';
        if(!in_array($pages, $validationPage, true)) {
            $pages = 25;
        }
        if(!in_array($sort, $validationSort, true)) {
            $sort = 'asc';
        }
        if($sort === 'latest') {
            $sort = 'desc';
            $sortField = 'created_at';
        }
        $items = Item::with(['authors:id,fullname', 'subjects:id,title', 'collections:id,title'])->where('status', Item::STATUS_ACTIVE)
            ->filter(request(['search']))
            ->orderBy($sortField, $sort)->paginate($pages)->withQueryString()
            ;
        return view('items.index' , [
            'items' => $items,

            /*  Was used for multiselect
            'authors' => $items->pluck('authors')->flatten()->sortBy('fullname', SORT_NATURAL),
            'collections' => $items->pluck('collections')->flatten()->sortBy('title', SORT_NATURAL),
            'subjects' => $items->pluck('subjects')->flatten()->sortBy('title', SORT_NATURAL),
            */
        ]);
    }


    // --  Show single item  --  \\
    public function show(Item $item) {
        if($item->status == Item::STATUS_INACTIVE && ! auth()->user()) {
            abort(404);
        }

        $subjectsID = array();
        foreach($item->subjects as $subject) {
            $subjectsID[] = $subject->id;
        }

        return view('items.show' , [
            'item' => $item,
            'similarItems' => Item::query()->with(['authors:id,fullname', 'collections:id,title'])
            ->where('status', Item::STATUS_ACTIVE)
            ->whereNot('id', $item->id)
            ->whereHas('subjects', function($query) use($subjectsID) {
                    $query->whereIn('subject_id', $subjectsID);
            })->limit(5)->get(),
        ]);
    }


    //  --  Show create form  --  \\
    public function create() {
        return view('items.create',[
            'authors' => Author::get(['id', 'fullname'])->sortBy('fullname', SORT_NATURAL),
            'collections' => Collection::get(['id', 'title'])->sortBy('title', SORT_NATURAL),
            'subjects' => Subject::get(['id', 'title'])->sortBy('title', SORT_NATURAL),
        ]);
    }


    //  --  Show Edit Form  --  \\
    public function edit(Item $item) {
        return view('items.edit', [
            'item' => $item->load(['authors', 'collections', 'subjects']),
            'authors' => Author::get(['id', 'fullname'])->sortBy('fullname', SORT_NATURAL),
            'collections' => Collection::get(['id', 'title'])->sortBy('title', SORT_NATURAL),
            'subjects' => Subject::get(['id', 'title'])->sortBy('title', SORT_NATURAL),
        ]);
    }


    //  --  Manage Item  --  \\
    public function manage() {
        $validationSort = ['asc', 'desc', 'latest'];
        $validationPage = ['10', '15', '20', '25', '30'];
        $pages = request('orderBy', 25);
        $sort = request('sortBy', 'asc');
        $sortField = 'title';
        if(!in_array($pages, $validationPage, true)) {
            $pages = 25;
        }
        if(!in_array($sort, $validationSort, true)) {
            $sort = 'asc';
        }
        if($sort === 'latest') {
            $sort = 'desc';
            $sortField = 'created_at';
        }
        $items = Item::with(['authors:id,fullname', 'subjects:id,title', 'collections:id,title'])->where('status', Item::STATUS_INACTIVE)
            ->filter(request(['search']))
            ->orderBy($sortField, $sort)->get()
        ;
        return view('items.manage' , [
            'items' => $items->paginate($pages)->withQueryString(),
            'authors' => $items->pluck('authors')->flatten()->sortBy('fullname', SORT_NATURAL),
            'collections' => $items->pluck('collections')->flatten()->sortBy('title', SORT_NATURAL),
            'subjects' => $items->pluck('subjects')->flatten()->sortBy('title', SORT_NATURAL),
        ]);
    }


    //  --  Advanced Search  --  \\
    public function advancedSearch() {
        return view('items.advanced_search', [
            'items' => Item::with(['authors:id,fullname', 'subjects:title'])->where('status', Item::STATUS_ACTIVE)->filter(request(['type', 'subject']))->latest()->paginate(12),
        ]);
    }


    //  --  Creates a backup of the to be deleted Item  --  \\
    public function deletion(Item $item) {
        $itemToDeletion = $item->attributesToArray();

        if($item->collections()->exists()) {
            foreach ($item->collections as $collection) {
                $was_partOf[] = $collection->title;
            }
            $itemToDeletion['was_partOf'] = implode(', ', $was_partOf);
        }

        if($item->authors()->exists()) {
            foreach ($item->authors as $author) {
                $had_authors[] = $author->fullname;
            }
            $itemToDeletion['had_authors'] = implode(', ', $had_authors);
        }

        if($item->subjects()->exists()) {
            foreach ($item->subjects as $subject) {
                $had_subjects[] = $subject->title;
            }
            $itemToDeletion['had_subjects'] = implode(', ', $had_subjects);
        }

        // Logging
        $itemToDeletion['deleted_by'] = auth()->id();
        $itemToDeletion['deleted_at'] = Carbon::now()->toDateTimeString();
        $itemToDeletion['original_id'] = $item->id;

        try {
            DB::beginTransaction();
            $deletion = Deletion::create($itemToDeletion);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Deletion (Item) - Failed:', [
                'id' => $item->id,
                'title' => $item->title,
                'user' => auth()->id(),
                'message' => $e,
            ]);
            return false;

        }
        Log::notice('Deletion (Item)', [
            'id' => $item->id,
            'deletion_id' => $deletion->id,
            'title' => $item->title,
            'user' => auth()->id(),
        ]);
        return true;
    }

    //  --  Destroy Item  --  \\
    public function destroy(Item $item) {
        if ($this->deletion($item)) {
            try {
                DB::beginTransaction();
                $item->delete();
                $item->subjects()->detach();
                $item->authors()->detach();
                $item->collections()->detach();
                DB::commit();
            } catch(Exception $e) {
                DB::rollBack();
                Log::error('Destroy (Item) - Failed:', [
                    'id' => $item->id,
                    'title' => $item->title,
                    'user' => auth()->id(),
                    'message' => $e,
                ]);
                return redirect(route('items.show', $item))->with('warning', "Item couldn't be deleted!");
            }
            Log::notice('Destroy (Item):', [
                'id' => $item->id,
                'title' => $item->title,
                'user' => auth()->id(),
            ]);
            return redirect('/')->with('message', 'Item Deleted Successfully');
        } else
            return redirect(route('items.show', $item))->with('warning', "Item couldn't be deleted. Mandatory Backup Failed!");
    }


    //  --  Change Item's Status  --  \\
    public function changeStatus(Item $item) {
        if($item->collections->isEmpty() || $item->authors->isEmpty()) {
            return redirect(route('items.show', $item))->with('warning', "Status couldn't be changed. No author or collection present for item!");
        }
        try {
            if($item->status == Item::STATUS_ACTIVE) {
                $item->status = Item::STATUS_INACTIVE;
                $item->updated_by = auth()->id();
                DB::beginTransaction();
                $item->update();
                DB::commit();
                $redirect = 1;  // Redirects to Show - Warning - Item Disabled
            } else {
                $item->status = ITEM::STATUS_ACTIVE;
                $item->updated_by = auth()->id();
                DB::beginTransaction();
                $item->update();
                DB::commit();
                $redirect = 2;  // Redirects to Show - message - Item Enabled
            }
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('changeStatus (Item) - Failed:', [
                'id' => $item->id,
                'title' => $item->title,
                'status' => $item->status,
                'user' => auth()->id(),
                'message' => $e,
            ]);
            return redirect(route('items.show', $item))->with('warning', 'An error has occurred! ' . $e);
        }
        Log::notice('changeStatus (Item):', [
            'id' => $item->id,
            'title' => $item->title,
            'status' => $item->status,
            'user' => auth()->id(),
        ]);

        return match ($redirect) {
            1 => redirect(route('items.show', $item))->with('warning', 'Item Disabled'),
            2 => redirect(route('items.show', $item))->with('message', 'Item Enabled'),
            default => redirect(route('items.index')),
        };
    }


    // --   Store item data  -- \\
    public function store(Request $request) {
        $formFields = $request->validate([
            'title' => 'required | max:76',
            'title_long' => 'nullable',
            'collections_id' => 'required | array',
            'authors_id' =>'array | nullable',
            'cover_path' => 'image',
            'pdf_path' => 'mimes:pdf',
            'publisher' => 'nullable',
            'publisher_when'=> 'nullable',
            'publisher_where' => 'nullable',
            'type' => 'required',
            'subjects' => 'nullable | array',
            'subjects_toAdd' => 'nullable',
            'language' => 'required',
            'description' => 'required',
            'provider' => 'required',
            'rights' => 'required',
            'ISBN' => 'nullable',
            'status' => 'required',

        ]);
        if ($formFields['subjects_toAdd'] == null && !array_key_exists('subjects', $formFields)) {
            return back()->withInput()->with('warning', "No subjects selected. Add the subjects if they do not exist in the list!");
        }


        // File Storage
        if($request->hasFile('cover_path')) {
            $formFields['cover_path'] = fileStorage('item' ,$formFields['title'], $request, 'cover_path');
            if($formFields['cover_path'] == false) {
                return back()->withInput()->with('warning', "Something went wrong with the file upload. Please check the file's name and extension");
            }
        }
        if($request->hasFile('pdf_path')) {
            $formFields['pdf_path'] = fileStorage('item' ,$formFields['title'], $request, 'pdf_path');
            if ($formFields['pdf_path'] == false) {
                return back()->withInput()->with('warning', "Something went wrong with the file upload. Please check the file's name and extension");
            }
        }
        //

        //  Logging
        $formFields['updated_by'] = null;
        $formFields['created_by'] = auth()->id();
        //
        try {
            DB::beginTransaction();

            if($formFields['publisher'] == null) {
                $formFields['publisher'] = Item::null_Unknown;
            }

            if($formFields['publisher_when'] == null) {
                $formFields['publisher_when'] = Item::null_Unknown;
            }

            if($formFields['publisher_where'] == null) {
                $formFields['publisher_where'] = Item::null_Unknown;
            }

            if(!array_key_exists('authors_id', $formFields)) {
                $formFields['authors_id'] = 1;
            }


            $item = Item::create($formFields);

            // Subject create if non-existent
            // TODO: Optimize or Replace this thing entirely
            if ($formFields['subjects_toAdd'] != null && array_key_exists('subjects', $formFields)) {
                $subjects = explode(', ', $formFields['subjects_toAdd']);
                foreach ($subjects as $subject) {
                    $toAdd = Subject::firstOrCreate([
                        'title' => $subject,
                    ]);
                    $newSubjects[] = $toAdd->id;
                }
                $formFields['subjects'] = array_diff($formFields['subjects'], $newSubjects);
                $formFields['subjects'] = array_merge_recursive($formFields['subjects'], $newSubjects);
                $item->subjects()->attach($formFields['subjects']);

            } elseif ($formFields['subjects_toAdd'] != null) {
                $subjects = explode(', ', $formFields['subjects_toAdd']);
                foreach ($subjects as $subject) {
                    $toAdd = Subject::firstOrCreate([
                        'title' => $subject,
                    ]);
                    $newSubjects[] = $toAdd->id;
                }
                $item->subjects()->attach($newSubjects);
            }


            // Relationships

            $item->authors()->attach($formFields['authors_id']);
            $item->collections()->attach($formFields['collections_id']);
            //

            DB::commit();

        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Store (Item) - Failed:', [
                'form' => $formFields,
                'user' => auth()->id(),
                'message' => $e,
            ]);
            return back()->withInput()->with('warning', 'Something went wrong. Please try again later.');
        }
        Log::notice('Store (Item)', [
            'id' => $item->id,
            'title' => $item->title,
            'user' => auth()->id(),
        ]);
        return redirect(route('items.show', $item))->with('message', 'Item Created Successfully');

    }


    //  --  Update Item  --  \\
    public function update(Request $request, Item $item)
    {
        $formFields = $request->validate([
            'title' => 'required | max:76',
            'title_long' => 'required',
            'collections_id' => 'required | array',
            'authors_id' =>'array',
            'cover_path' => 'image',
            'pdf_path' => 'mimes:pdf',
            'publisher' => 'required',
            'publisher_when'=> 'required',
            'publisher_where' => 'required',
            'type' => 'required',
            'subjects' => 'nullable | array',
            'subjects_toAdd' => 'nullable',
            'language' => 'required',
            'description' => 'required',
            'provider' => 'required',
            'rights' => 'required',
            'ISBN' => 'nullable',
            'status' => 'required'

        ]);

        if ($formFields['subjects_toAdd'] == null && !array_key_exists('subjects', $formFields)) {
            return back()->withInput()->with('warning', "No subjects selected. Add the subjects if they do not exist in the list!");
        }

        // File Storage
        if($request->hasFile('cover_path')) {
            $formFields['cover_path'] = fileStorage('item' ,$formFields['title'], $request, 'cover_path');
            if($formFields['cover_path'] == false) {
                return back()->withInput()->with('warning', "Something went wrong with the file upload. Please check the file's name and extension");
            }
        }
        if($request->hasFile('pdf_path')) {
            $formFields['pdf_path'] = fileStorage('item' ,$formFields['title'], $request, 'pdf_path');
            if ($formFields['pdf_path'] == false) {
                return back()->withInput()->with('warning', "Something went wrong with the file upload. Please check the file's name and extension");
            }
        }

        //  Logging
        $formFields['updated_by'] = auth()->id();
        //


        try {
            DB::beginTransaction();
            $item->authors()->detach();
            $item->collections()->detach();
            $item->subjects()->detach();

            if($formFields['publisher'] == null) {
                $formFields['publisher'] = Item::null_Unknown;
            }

            if($formFields['publisher_when'] == null) {
                $formFields['publisher_when'] = Item::null_Unknown;
            }

            if($formFields['publisher_where'] == null) {
                $formFields['publisher_where'] = Item::null_Unknown;
            }

            if(!array_key_exists('authors_id', $formFields)) {
                $formFields['authors_id'] = 1;
            }

            $item->update($formFields);

            // Subject create if non-existent
            // TODO: Optimize or Replace this thing entirely
            if ($formFields['subjects_toAdd'] != null && array_key_exists('subjects', $formFields)) {
                $subjects = explode(', ', $formFields['subjects_toAdd']);
                foreach ($subjects as $subject) {
                    $toAdd = Subject::firstOrCreate([
                        'title' => $subject,
                    ]);
                    $newSubjects[] = $toAdd->id;
                }

                $formFields['subjects'] = array_diff($formFields['subjects'], $newSubjects);

                $formFields['subjects'] = array_merge_recursive($formFields['subjects'], $newSubjects);
                $item->subjects()->attach($formFields['subjects']);

            } elseif ($formFields['subjects_toAdd'] != null) {
                $subjects = explode(', ', $formFields['subjects_toAdd']);
                foreach ($subjects as $subject) {
                    $toAdd = Subject::firstOrCreate([
                        'title' => $subject,
                    ]);
                    $newSubjects[] = $toAdd->id;
                }
                $item->subjects()->attach($newSubjects);
            } else {
                $item->subjects()->attach($formFields['subjects']);
            }

            $item->authors()->attach($formFields['authors_id']);
            $item->collections()->attach($formFields['collections_id']);


            DB::commit();
        } catch(Exception $e) {
            DB::rollBack();
            Log::error('Update (Item) - Failed:', [
                'id' => $item->id,
                'title' => $item->title,
                'form' => $formFields,
                'user' => auth()->id(),
                'message' => $e,
            ]);
            return redirect(route('items.show', $item))->with('warning', "Item couldn't be updated!");
        }
        Log::notice('Update (Item):', [
            'id' => $item->id,
            'title' => $item->title,
            'user' => auth()->id(),
        ]);
        return redirect(route('items.show', $item))->with('message', 'Item updated successfully!');
    }



}
