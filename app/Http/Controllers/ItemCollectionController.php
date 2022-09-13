<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use App\Models\Item;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ItemCollectionController extends Controller
{


    //  --  Show All Collection  --  \\
    public function index() {
        return view('collections.index', [
            'collections' => Collection::withCount(['items' => function ($query) {
                $query->where('status', Item::STATUS_ACTIVE);
            } ])->where('status', Collection::STATUS_ACTIVE)->filter(request(['search']))->latest()->paginate(12),
        ]);
    }


    //  --  Show Single Collection  --  \\
    public function show(Collection $collection) {
        if($collection->status == Collection::STATUS_INACTIVE && !auth()->user()) {
            abort(404);
        }
        return view('collections.show', [
            'collection' => $collection->loadCount(['items' => function ($query) {
                $query->where('status', Item::STATUS_ACTIVE);
            }]),
            'items' => $collection->items()->where('status', Item::STATUS_ACTIVE)->filter(request(['subject', 'search']))->latest()->paginate(12),
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
        return view('collections.manage', [
            'collections' => Collection::where('status', Collection::STATUS_INACTIVE)->withCount('items')->filter(request(['search']))->paginate(12)
        ]);
    }


    //  --  Destroy Collection  --  \\
    public function destroy(Collection $collection) {
        try {
            DB::beginTransaction();
            $collectionItems = $collection->items;
            $collection->delete();
            $collectionItems->each(function($item)use($collection) {
                $item->collections($collection)->detach();
                if($item->collections()->doesntExist()) {
                    $item->status=Item::STATUS_INACTIVE;
                    $item->save();
                }
            });
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Destroy (Collection) - Failed:', [
                'id' => $collection->id,
                'title' => $collection->title,
                'user' => auth()->id(),
                'message' => $e,
            ]);
            return redirect('/')->with('warning', "Collection couldn't be deleted!");
        }
        Log::notice('Destroy (Collection):', [
            'id' => $collection->id,
            'title' => $collection->title,
            'user' => auth()->id(),
        ]);
        return redirect('/')->with('message', 'Collection Deleted Successfully');
    }

    // Change Collection's Status
    public function changeStatus(Collection $collection) {
        try {
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
        $formFields = $request->validate([
            'title' => 'required | max:76',
            'description' => '',
            'status' => 'required',
            'cover_path' => 'image',
        ]);

        if($request->hasFile('cover_path')) {
            $formFields['cover_path'] = fileStorage('collection' ,$formFields['title'], $request, 'cover_path');
            if($formFields['cover_path'] == false) {
                return back()->withErrors('cover_path', "Something went wrong with the file upload. Please check the file's name and extension");
            }

        }

        $formFields['updated_by'] = auth()->id();

        try {
            DB::beginTransaction();

            $collection->update($formFields);

            DB::commit();
        } catch(Exception $e) {
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
        $formFields = $request->validate([
            'title' => 'required | max:76',
            'description' => '',
            'status' => 'required',
            'cover_path' => 'image',
        ]);

        if ($request->hasFile('cover_path')) {
            $formFields['cover_path'] = fileStorage('collection', $formFields['title'], $request, 'cover_path');
            if ($formFields['cover_path'] == false) {
                return back()->withErrors('cover_path', "Something went wrong with the file upload. Please check the file's name and extension");
            }
        }

        $formFields['created_by'] = auth()->id();
        $formFields['updated_by'] = null;

        try {
            DB::beginTransaction();
            $collection = Collection::create($formFields)->id;
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('store (Collection) - Failed:', [
                'form' => $formFields,
                'user' => auth()->id(),
                'message' => $e,
            ]);
            return redirect('/')->with('warning', "Collection Couldn't be created!");
        }
        Log::notice('store (Collection):', [
            'id' => $collection->id,
            'title' => $collection->title,
            'user' => auth()->id(),
        ]);
        return redirect(route('collections.show', $collection))->with('message', 'Collection Created Successfully');
    }




}
