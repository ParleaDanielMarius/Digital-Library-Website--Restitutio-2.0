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
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ItemController extends Controller
{
    //  --  Show all items  --  \\
    public function index() {
        // Some arrays for validation of sorting, ordering and pagination
        $validationSort = ['asc', 'desc', 'latest'];
        $validationPage = ['10', '15', '20', '25', '30'];
        // Gets the pagination, sorting and ordering from the request
        $pages = request('orderBy', 25);
        $sort = request('sortBy', 'asc');
        $sortField = 'title';
        // Pagination Validation, $pages gets a default value if validation fails
        if(!in_array($pages, $validationPage, true)) {
            $pages = 25;
        }
        // Sorting Validation, $sort gets a default value if validation fails
        if(!in_array($sort, $validationSort, true)) {
            $sort = 'asc';
        }
        // Sorts by 'created_at' field if sorting is done by latest
        if($sort === 'latest') {
            $sort = 'desc';
            $sortField = 'created_at';
        }
        // Query Active Items, sort, order, paginate and filter using 'search' (found in Item Model)
        // Might need to remove query for collections and subjects since they are not used at the moment and may never be
        $items = Item::with('authors:slug,fullname')
            ->select('slug','id','title', 'cover_path', 'title_long', 'type', 'status')
            ->where('status', Item::STATUS_ACTIVE)
            ->filter(request(['search']))
            ->orderBy($sortField, $sort)
            ->paginate($pages)->withQueryString();
        return view('items.index' , [
            'items' => $items,
        ]);
    }


    // --  Show single item  --  \\
    public function show(Item $item) {
        // If Item is Inactive and user is not logged in return 404
        if($item->status == Item::STATUS_INACTIVE && ! auth()->user()) {
            abort(404);
        }
        // Initialize array
        $subjectsID = array();
        // Add subject to an array to be used in finding similar items
        // Should be changed to something better
        foreach($item->subjects as $subject) {
            $subjectsID[] = $subject->id;
        }
        // If Item has a publishing day append publishing month and year else return just the year
        // (since a day without a month and a month without a year are not allowed)
        if($item->publisher_day) {
            $item['publisher_when'] = ($item->publisher_day . '-' ?? '') . ($item->publisher_month . '-' ?? '') . ($item->publisher_year ?? '');
            $item->publisher_when = Carbon::createFromFormat('d-m-Y', $item->publisher_when);
            $item->publisher_when = $item->publisher_when->format('d-m-Y');
        }else {
            $item['publisher_when'] = $item->publisher_year;
        }
        return view('items.show' , [
            'item' => $item,
            // Query for similar and active items based on subjects
            'similarItems' => Item::query()
                ->with(['authors:slug,fullname', 'collections:slug,title'])
                ->where('status', Item::STATUS_ACTIVE)
                ->whereNot('id', $item->id)
                ->whereHas('subjects', function($query) use($subjectsID) {
                    $query->whereIn('subject_id', $subjectsID);
                })->limit(5)->get(),
        ]);
    }


    // Item Create
    public function create() {
        return view('items.create', [
            'collections' => Collection::query()->orderBy('title')->get()->all(),
        ]);
    }


    //  --  Show Edit Form  --  \\
    public function edit(Item $item) {
        return view('items.edit', [
            'item' => $item->load(['authors', 'collections', 'subjects']),
            'collections' => Collection::get(['id', 'title'])->sortBy('title', SORT_NATURAL),
        ]);
    }


    //  --  Manage Item  --  \\
    public function manage() {
        // Some arrays for validation of sorting, ordering and pagination
        $validationSort = ['asc', 'desc', 'latest'];
        $validationPage = ['10', '15', '20', '25', '30'];
        // Gets the pagination, sorting and ordering from the request
        $pages = request('orderBy', 25);
        $sort = request('sortBy', 'asc');
        $sortField = 'title';
        // Pagination Validation, $pages gets a default value if validation fails
        if(!in_array($pages, $validationPage, true)) {
            $pages = 25;
        }
        // Sorting Validation, $sort gets a default value if validation fails
        if(!in_array($sort, $validationSort, true)) {
            $sort = 'asc';
        }
        // Sorts by 'created_at' field if sorting is done by latest
        if($sort === 'latest') {
            $sort = 'desc';
            $sortField = 'created_at';
        }
        // Query Inactive Items, sort, order, paginate and filter using 'search' (found in Item Model)
        // Might need to remove query for collections and subjects since they are not used at the moment and may never be
        $items = Item::with(['authors:slug,fullname', 'subjects:id,title', 'collections:slug,title'])
            ->where('status', Item::STATUS_INACTIVE)
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

    //  --  Creates a backup of the to be deleted Item  --  \\
    // Returns false if backup failed or true if it succeeded (Logs regardless of result)
    public function deletion(Item $item): bool
    {
        $itemToDeletion = $item->attributesToArray();
        // Check if Item had any collections and add each into an array
        if($item->collections()->exists()) {
            foreach ($item->collections as $collection) {
                $was_partOf[] = $collection->title;
            }
            // Implode as a string separated by ', ' to make display easier (Could be better)
            $itemToDeletion['was_partOf'] = implode(', ', $was_partOf);
        }

        // Same as above, but for authors
        if($item->authors()->exists()) {
            foreach ($item->authors as $author) {
                $had_authors[] = $author->fullname;
                $had_contributions[] = $author->pivot->contribution;
            }
            $itemToDeletion['had_authors'] = implode(', ', $had_authors);
            $itemToDeletion['contributions'] = implode(', ', $had_contributions);
        }

        // Same as above, but for subjects
        if($item->subjects()->exists()) {
            foreach ($item->subjects as $subject) {
                $had_subjects[] = $subject->title;
            }
            $itemToDeletion['had_subjects'] = implode(', ', $had_subjects);
        }

        // Basic Table Logging
        $itemToDeletion['deleted_by'] = auth()->id();
        $itemToDeletion['deleted_at'] = Carbon::now()->toDateTimeString();
        $itemToDeletion['original_id'] = $item->id;

        // DB Transaction - Creates a deletion which is a copy of the item
        try {
            DB::beginTransaction();
            $deletion = Deletion::create($itemToDeletion);
            DB::commit();
        } catch (Exception $e) {
            // Rollback and log errors
            DB::rollBack();
            Log::error('Deletion (Item) - Failed:', [
                'id' => $item->id,
                'title' => $item->title,
                'user' => auth()->id(),
                'message' => $e,
            ]);
            return false;

        }
        // Log Success
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
        // If backup creation returns false, fail
        if ($this->deletion($item)) {
            // DB Transaction
            try {
                DB::beginTransaction();
                $item->delete();
                $item->subjects()->detach();
                $item->authors()->detach();
                $item->collections()->detach();
                DB::commit();
            } catch(Exception $e) {
                // Rollback and log errors
                DB::rollBack();
                Log::error('Destroy (Item) - Failed:', [
                    'id' => $item->id,
                    'title' => $item->title,
                    'user' => auth()->id(),
                    'message' => $e,
                ]);
                return redirect(route('items.show', $item))->with('warning', "Item couldn't be deleted!");
            }
            // Log success
            Log::notice('Destroy (Item):', [
                'id' => $item->id,
                'title' => $item->title,
                'user' => auth()->id(),
            ]);
            return redirect(route('home'))->with('message', 'Item Deleted Successfully');
        } else
            return redirect(route('items.show', $item))->with('warning', "Item couldn't be deleted. Mandatory Backup Failed!");
    }


    //  --  Change Item's Status  --  \\
    public function changeStatus(Item $item) {
        // Check if item has any collections or authors to prevent activation of incomplete Items
        if($item->collections->isEmpty() || $item->authors->isEmpty()) {
            return redirect(route('items.show', $item))->with('warning', "Status couldn't be changed. No author or collection present for item!");
        }
        // DB Transaction
        try {
            // Check current status and change to the opposite
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
            // Rollback and log errors
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
        // Log success
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
        // Validate all fields
        $formFields = $request->validate([
            'title' => ['required', 'max:76', Rule::unique('items', 'title')],
            'title_long' => 'nullable',
            'collections_id' => 'required',
            'authors_id' =>'required',
            'contribution' => 'required',
            'cover_path' => 'image',
            'pdf_path' => 'mimes:pdf',
            'publisher' => 'nullable',
            'publisher_day'=> 'nullable|numeric|min:1|max:31 ',
            'publisher_month'=> ['nullable', 'required_with:publisher_day', 'numeric', 'min:1', 'max:12'],
            'publisher_year'=> ['nullable', 'required_with:publisher_month', 'numeric', 'min:1000', 'max:2500'],
            'publisher_where'=> 'nullable',
            'type' => 'required',
            'additionalType' => 'nullable|max:30',
            'subjects_id' => 'required',
            'language' => 'required',
            'description' => 'required',
            'provider' => 'required',
            'rights' => 'required',
            'ISBN' => 'nullable',
            'ISSN' => 'nullable',
            'status' => 'required',

        ]);
        // Creates a slug
        $formFields['slug'] = Str::slug($formFields['title']);

//        // Checks if one-digit month was entered and add 0 in front of it
//        if($formFields['publisher_month']) {
//            if(strlen($formFields['publisher_month']) == 1) {
//                $formFields['publisher_month'] = 0 . $formFields['publisher_month'];
//            }
//        }
//        // Same as above
//        if(strlen($formFields['publisher_day'])){
//            if(strlen($formFields['publisher_day']) == 1) {
//                $formFields['publisher_day'] = 0 . $formFields['publisher_day'];
//            }
//        }


        // Front-end returns values as strings, so we turn them into arrays
        $formFields['collections_id'] = explode(',', $formFields['collections_id']);


        if($formFields['additionalType']) {
            $formFields['type'] = $formFields['additionalType'];
        }

        // If request has files call fileStorage for each
        if($request->hasFile('cover_path')) {
            $formFields['cover_path'] = fileStorage('item' ,$formFields['slug'], $request, 'cover_path');
            if($formFields['cover_path'] == false) {
                return back()->withInput()->with('warning', "Something went wrong with the file upload. Please check the file's name and extension");
            }
        }
        if($request->hasFile('pdf_path')) {
            $formFields['pdf_path'] = fileStorage('item' ,$formFields['slug'], $request, 'pdf_path');
            if ($formFields['pdf_path'] == false) {
                return back()->withInput()->with('warning', "Something went wrong with the file upload. Please check the file's name and extension");
            }
        }
        //

        //  Basic Table Logging
        $formFields['updated_by'] = null;
        $formFields['created_by'] = auth()->id();

        // DB Transaction
        try {
            DB::beginTransaction();

            // In case null authors got past validation we assign Unknown Author
            $authors = array();
            $contributions = array();
            if(!array_key_exists('authors_id', $formFields)) {
                $authors = 1;
                $contributions = 'Autor';
            } else {
                foreach ($formFields['authors_id'] as $key=>$author) {
                    $toAdd = Author::query()->where('fullname', $author)->select('id')->first();
                    if($toAdd != null) {
                        $authors[] = $toAdd->id;
                        $contributions[] = $formFields['contribution'][$key];
                    }

                }
            }

            $item = Item::create($formFields);

            // Create subjects if they do not exist already and add them to array
                foreach ($formFields['subjects_id'] as $subject) {
                    $toAdd = Subject::firstOrCreate([
                        'title' => $subject,
                    ], ['title'=> $subject]);
                    $subjects[] = $toAdd->id;
                }


            // Relationships

            // If no author was found we assign Unknown Author
            if($authors == null || $contributions == null) {
                $item->authors()->attach(1, ['contribution' => 'Autor']);
            } else {
                foreach($authors as $key => $author) {
                    $item->authors()->attach($author, ['contribution' => $contributions[$key]]);
                }
            }

            $item->collections()->attach($formFields['collections_id']);
            $item->subjects()->attach($subjects);

            DB::commit();

        } catch (Exception $e) {
            // Rollback and log errors
            DB::rollBack();
            Log::error('Store (Item) - Failed:', [
                'form' => $formFields,
                'user' => auth()->id(),
                'message' => $e,
            ]);
            return back()->withInput()->with('warning', 'Something went wrong. Please try again later.');
        }
        // Log success
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
        // Validate all fields
        $formFields = $request->validate([
            'title' => ['required', 'max:76', Rule::unique('items', 'title')->ignore($item)],
            'title_long' => 'nullable',
            'collections_id' => 'required',
            'authors_id' =>'required',
            'contribution' => 'required',
            'cover_path' => 'image',
            'pdf_path' => 'mimes:pdf',
            'publisher' => 'nullable',
            'publisher_day'=> 'nullable | numeric',
            'publisher_month'=> ['nullable', 'required_with:publisher_day', 'numeric'],
            'publisher_year'=> ['nullable', 'required_with:publisher_month', 'numeric'],
            'publisher_where'=> 'nullable',
            'type' => 'required',
            'additionalType' =>'nullable|max:30',
            'subjects_id' => 'required',
            'language' => 'required',
            'description' => 'required',
            'provider' => 'required',
            'rights' => 'required',
            'ISBN' => 'nullable',
            'ISSN' => 'nullable',
            'status' => 'required',

        ]);

        // Creates a slug
        $formFields['slug'] = Str::slug($formFields['title']);

//        // Checks if one-digit month was entered and add 0 in front of it
//        if($formFields['publisher_month']) {
//            if(strlen($formFields['publisher_month']) == 1) {
//                $formFields['publisher_month'] = 0 . $formFields['publisher_month'];
//            }
//        }
//        // Same as above
//        if(strlen($formFields['publisher_day'])){
//            if(strlen($formFields['publisher_day']) == 1) {
//                $formFields['publisher_day'] = 0 . $formFields['publisher_day'];
//            }
//        }

        // Front-end returns values as strings, so we turn them into arrays
        $formFields['collections_id'] = explode(',', $formFields['collections_id']);

        if($formFields['additionalType']) {
            $formFields['type'] = $formFields['additionalType'];
        }


        // If request has files call fileStorage for each
        if($request->hasFile('cover_path')) {
            if($item->cover_path != null && Storage::disk('public')->exists($item->cover_path)) {
                $formFields['cover_path'] = fileUpdate($item->cover_path, $request, 'cover_path');
                if($formFields['cover_path'] == false) {
                    return back()->withInput()->with('warning', "Something went wrong with the file upload. Please check the file's name and extension");
                }
                fileDestroy($item->cover_path);
            } else {
                $formFields['cover_path'] = fileStorage('item' ,$formFields['slug'], $request, 'cover_path');
                if($formFields['cover_path'] == false) {
                    return back()->withInput()->with('warning', "Something went wrong with the file upload. Please check the file's name and extension");
                }
            }
        }

        if($request->hasFile('pdf_path')) {
            if($item->pdf_path != null && Storage::disk('public')->exists($item->pdf_path)) {
                $formFields['pdf_path'] = fileUpdate($item->pdf_path, $request, 'pdf_path');
                if ($formFields['pdf_path'] == false) {
                    return back()->withInput()->with('warning', "Something went wrong with the file upload. Please check the file's name and extension");
                }
                fileDestroy($item->pdf_path);
            } else {
                $formFields['pdf_path'] = fileStorage('item' ,$formFields['slug'], $request, 'pdf_path');
                if ($formFields['pdf_path'] == false) {
                    return back()->withInput()->with('warning', "Something went wrong with the file upload. Please check the file's name and extension");
                }
            }
        }

        //  Basic Table Log
        $formFields['updated_by'] = auth()->id();
        //

        // DB Transaction
        try {
            DB::beginTransaction();
            $item->authors()->detach();
            $item->collections()->detach();
            $item->subjects()->detach();


            // For User convenience we check if they entered any author and if they didn't we default to
            // the first author, which should be 'Unknown Author'
            // In case null authors got past validation we assign Unknown Author
            $authors = array();
            $contributions = array();
            if(!array_key_exists('authors_id', $formFields)) {
                $authors = 1;
                $contributions = 'Autor';
            } else {
                foreach ($formFields['authors_id'] as $key=>$author) {
                    $toAdd = Author::query()->where('fullname', $author)->select('id')->first();
                    if($toAdd != null) {
                        $authors[] = $toAdd->id;
                        $contributions[] = $formFields['contribution'][$key];
                    }

                }
            }

            $item->update($formFields);

            // Create subjects if they do not exist already and add them to array
            foreach ($formFields['subjects_id'] as $subject) {
                $toAdd = Subject::firstOrCreate([
                    'title' => $subject,
                ], ['title'=> $subject]);
                $subjects[] = $toAdd->id;
            }

            // Relationships
            // If no author was found we assign Unknown Author
            if($authors == null || $contributions == null) {
                $item->authors()->attach(1, ['contribution' => 'Autor']);
            } else {
                foreach($authors as $key => $author) {
                    $item->authors()->attach($author, ['contribution' => $contributions[$key]]);
                }
            }

            $item->collections()->attach($formFields['collections_id']);
            $item->subjects()->attach($subjects);


            DB::commit();
        } catch(Exception $e) {
            // Rollback and log errors
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
        // Log success
        Log::notice('Update (Item):', [
            'id' => $item->id,
            'title' => $item->title,
            'user' => auth()->id(),
        ]);
        return redirect(route('items.show', $item))->with('message', 'Item updated successfully!');
    }



}
