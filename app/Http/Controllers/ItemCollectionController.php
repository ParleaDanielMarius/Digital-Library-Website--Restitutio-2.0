<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Collection;
use App\Models\Item;
use App\Models\Subject;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ItemCollectionController extends Controller
{
    public function collectionsSelect($search) {
        $collections = Collection::query()->select('id', 'title')->where('title', 'LIKE', '%'. $search . '%')->get();
        return response($collections->toJson());
    }


    //  --  Show All Collection  --  \\
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
        // Query Collection with Items Count, paginate, order, sort and filter
        // using 'search' (found in Collection Model)
        $collections = Collection::query()->withCount('items')
            ->filter(request(['search']))
            ->orderBy($sortField, $sort)->paginate($pages)->withQueryString()
        ;
        return view('collections.index', [
            'collections' => $collections
        ]);
    }


    //  --  Show Single Collection  --  \\
    public function show(Collection $collection) {
        // Check if collection is inactive, return 404 if the user is not logged in
        if($collection->status == Collection::STATUS_INACTIVE && !auth()->user()) {
            abort(404);
        }
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
        // Query all Active items that belong to Collection,
        // order, sort, paginate and filter with 'search' (found in Item Model)
        $items = $collection->loadCount('items')->items()->with(['authors:id,fullname', 'subjects:title,id'])->where('status', Item::STATUS_ACTIVE)
            ->filter(request(['search']))
            ->orderBy($sortField, $sort)
            ->paginate($pages)->withQueryString();
        return view('collections.show', [
            'collection' => $collection,
            'items' => $items,

        ]);
    }


    //  --  Show Create Form  --  \\
    public function create() {
        return view('collections.create');
    }


    //  --  Show Edit Form  --  \\
    public function edit(Collection $collection) {
        return view('collections.edit', [
            'collection' => $collection,
        ]);
    }


    //  --  Manage Collection  --  \\
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
        // Query Inactive Collections, sort, order paginate and
        // filter using 'search' (found in Collection Model)
        $collections = Collection::query()->withCount('items')
            ->where('status', Collection::STATUS_INACTIVE)
            ->filter(request(['search']))
            ->orderBy($sortField, $sort)->paginate($pages)->withQueryString()
        ;
        return view('collections.manage', [
            'collections' => $collections
        ]);
    }


    //  --  Destroy Collection  --  \\
    public function destroy(Collection $collection) {
        // DB Transaction
        try {
            DB::beginTransaction();
            $collectionItems = $collection->items;
            $collection->delete();
            // Detach each of the items the collection had
            $collectionItems->each(function($item)use($collection) {
                $item->collections($collection)->detach();
                // Check if each item still has a remaining collection and if they don't mark item as inactive
                if($item->collections()->doesntExist()) {
                    $item->status = Item::STATUS_INACTIVE;
                    $item->save();
                }
            });
            DB::commit();
        } catch (Exception $e) {
            // Rollback and log errors
            DB::rollBack();
            Log::error('Destroy (Collection) - Failed:', [
                'id' => $collection->id,
                'title' => $collection->title,
                'user' => auth()->id(),
                'message' => $e,
            ]);
            return redirect(route('collections.show', $collection))->with('warning', "Collection couldn't be deleted!");
        }
        Log::notice('Destroy (Collection):', [
            // Log success
            'id' => $collection->id,
            'title' => $collection->title,
            'user' => auth()->id(),
        ]);
        return redirect(route('home'))->with('message', 'Collection Deleted Successfully');
    }

    // Change Collection's Status
    public function changeStatus(Collection $collection) {
        // DB Transaction
        try {
            // Check existent status and change to the opposite
            if ($collection->status == Collection::STATUS_ACTIVE) {
                $collection->status = Collection::STATUS_INACTIVE;
                $collection->updated_by = auth()->id();
                DB::beginTransaction();
                $collection->update();
                DB::commit();
                $redirect = 1;
            } else {
                $collection->status = Collection::STATUS_ACTIVE;
                $collection->updated_by = auth()->id();
                DB::beginTransaction();
                $collection->update();
                DB::commit();
                $redirect = 2;
            }
        } catch(Exception $e) {
            // Rollback and log errors
            DB::rollBack();
            Log::error('changeStatus (Collection) - Failed:', [
                'id' => $collection->id,
                'title' => $collection->title,
                'status' => $collection->status,
                'user' => auth()->id(),
                'message' => $e,
            ]);
            return redirect(route('collections.show', $collection))->with('warning', 'An error has occurred! ' . $e);
        }
        // Log success
        Log::notice('changeStatus (Collection):', [
            'id' => $collection->id,
            'title' => $collection->title,
            'status' =>$collection->status,
            'user' => auth()->id(),
        ]);

        return match($redirect) {
            1 => redirect(route('collections.show', $collection))->with('warning', 'Collection Disabled'),
            2 => redirect(route('collections.show', $collection))->with('message', 'Collection Enabled'),
            default => redirect(route('items.index')),
        };
    }

    //  --  Update Collection  --  \\
    public function update(Request $request, Collection $collection) {
        // Validate fields
        $formFields = $request->validate([
            'title' => 'required | max:76',
            'description' => '',
            'status' => 'required',
            'cover_path' => 'image',
        ]);
        // Check if request has files and call fileStorage (found in helpers)
        if($request->hasFile('cover_path')) {
            $formFields['cover_path'] = fileStorage('collection' ,$formFields['title'], $request, 'cover_path');
            if($formFields['cover_path'] == false) {
                return back()->withErrors('cover_path', "Something went wrong with the file upload. Please check the file's name and extension");
            }

        }
        // Basic Table Log
        $formFields['updated_by'] = auth()->id();

        // DB Transaction
        try {
            DB::beginTransaction();
            $collection->update($formFields);
            DB::commit();
        } catch(Exception $e) {
            // Rollback and log errors
            DB::rollBack();
            Log::error('update (Collection) - Failed:', [
                'id' => $collection->id,
                'title' => $collection->title,
                'form' => $formFields,
                'user' => auth()->id(),
                'message' => $e,
            ]);
            return redirect('/')->with('warning', "Collection couldn't be updated!");
        }
        // Log success
        Log::notice('update (Collection):', [
            'id' => $collection->id,
            'title' => $collection->title,
            'user' => auth()->id(),
        ]);
        return redirect(route('collections.show', $collection))->with('message', 'Collection Updated Successfully');

    }


    //  --  Store Collection Data  --  \\
    public function store(Request $request)
    {
        // Validate Fields
        $formFields = $request->validate([
            'title' => 'required | max:76',
            'description' => '',
            'status' => 'required',
            'cover_path' => 'image',
        ]);
        // Check if request has files and call fileStorage (found in helpers)
        if ($request->hasFile('cover_path')) {
            $formFields['cover_path'] = fileStorage('collection', $formFields['title'], $request, 'cover_path');
            if ($formFields['cover_path'] == false) {
                return back()->withErrors('cover_path', "Something went wrong with the file upload. Please check the file's name and extension");
            }
        }
        // Basic Table Log
        $formFields['created_by'] = auth()->id();
        $formFields['updated_by'] = null;

        // DB Transaction
        try {
            DB::beginTransaction();
            $collection = Collection::create($formFields);
            DB::commit();
        } catch (Exception $e) {
            // Rollback and log errors
            DB::rollBack();
            Log::error('store (Collection) - Failed:', [
                'form' => $formFields,
                'user' => auth()->id(),
                'message' => $e,
            ]);
            return redirect('/')->with('warning', "Collection Couldn't be created!");
        }
        // Log success
        Log::notice('store (Collection):', [
            'id' => $collection->id,
            'title' => $collection->title,
            'user' => auth()->id(),
        ]);
        return redirect(route('collections.show', $collection))->with('message', 'Collection Created Successfully');
    }




}
