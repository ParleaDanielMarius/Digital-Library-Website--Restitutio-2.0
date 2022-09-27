<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Collection;
use App\Models\Deletion;
use App\Models\Item;
use App\Models\Subject;
use Exception;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;



class DeletionController extends Controller
{
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
        $deletions = Deletion::query()
            ->filter(request(['search']))
            ->orderBy($sortField, $sort)->get()
        ;
        return view('deletions.manage', [
            'deletions' => $deletions->paginate($pages)->withQueryString()
        ]);
    }

    public function show(Deletion $deletion) {
        $subjects = array();
        $authors = array();
        $collections = array();
        if($deletion->had_subjects) {
            $subjects = explode(', ', $deletion->had_subjects);
        }

        if($deletion->had_authors) {
            $authors = explode(', ', $deletion->had_authors);
        }

        if($deletion->was_partOf) {
            $collections = explode(', ', $deletion->was_partOf);
        }

        return view('deletions.show', [
            'deletion' => $deletion,
            'subjects'=> $subjects,
            'authors' => $authors,
            'collections' => $collections,
        ]);
    }


    public function restore(Deletion $deletion) {
        if (!Item::where('id', $deletion->original_id)->exists($deletion->original_id)) {
            $itemToRestore = $deletion->attributesToArray();
            try {
                DB::beginTransaction();
                if ($itemToRestore['had_subjects'] != null) {
                    $subjectsToRestore[] = array();
                    $subjects = explode(', ', $itemToRestore['had_subjects']);
                    foreach ($subjects as $subject) {
                        $toAdd = Subject::firstWhere('title', $subject);
                        if ($toAdd != null) {
                            $subjectsToRestore[] = $toAdd->id;
                        }
                    }
                }

                if ($itemToRestore['had_authors'] != null) {
                    $authorsToRestore[] = array();
                    $authors = explode(', ', $itemToRestore['had_authors']);
                    foreach ($authors as $author) {
                        $toAdd = Author::firstWhere('fullname', $author);
                        if ($toAdd != null) {
                            $authorsToRestore[] = $toAdd->id;
                        }
                    }
                }

                if ($itemToRestore['was_partOf'] != null) {
                    $collectionsToRestore[] = array();
                    $collections = explode(', ', $itemToRestore['was_partOf']);
                    foreach ($collections as $collection) {
                        $toAdd = Collection::firstWhere('title', $collection);
                        if ($toAdd != null) {
                            $collectionsToRestore[] = $toAdd->id;
                        }

                    }
                }

                $item = Item::create($itemToRestore);
                $item->id = $deletion->original_id;
                $item->save();

                if (!empty($subjectsToRestore)) {
                    $item->subjects()->attach($subjectsToRestore);
                }
                if (!empty($authorsToRestore)) {
                    $item->authors()->attach($authorsToRestore);
                }
                if (!empty($collectionsToRestore)) {
                    $item->collections()->attach($collectionsToRestore);
                }
                $deletion->restored_at = Carbon::now()->toDateTimeString();
                $deletion->save();

                DB::commit();
            } catch (Exception $e) {
                DB::rollBack();
                Log::error('Restore (Deletion) - Failed:', [
                    'id' => $deletion->id,
                    'original_id' => $deletion->original_id,
                    'title' => $deletion->title,
                    'user' => auth()->id(),
                    'message' => $e,
                ]);

                return redirect(route('deletions.manage'))->with('warning', "Item couldn't be restored!");

            }
            Log::notice('Restore (Deletion):', [
                'id' => $deletion->id,
                'original_id' => $deletion->original_id,
                'title' => $deletion->title,
                'user' => auth()->id(),
            ]);
            return redirect(route('items.show', $item))->with('message', 'Item restored successfully!');
        } else {
            return redirect(route('deletions.manage'))->with('warning', "Item already exists! You cannot restore an existing item.");
        }
    }

    public function destroy(Deletion $deletion) {

        try {
            DB::beginTransaction();
            $deletion->delete();
            DB::commit();
        } catch(Exception $e) {
            DB::rollBack();
            Log::error('Delete (Deletion) - Failed:', [
                'id' => $deletion->id,
                'original_id' => $deletion->original_id,
                'title' => $deletion->title,
                'user' => auth()->id(),
                'message' => $e,
            ]);
            return redirect(route('deletions.show', $deletion))->with('warning', "Item couldn't be deleted!");
        }
        Log::notice('Destroy (Deletion):', [
            'id' => $deletion->id,
            'original_id' => $deletion->original_id,
            'title' => $deletion->title,
            'user' => auth()->id(),
        ]);
        return redirect(route('deletions.manage'))->with('message', "Item deleted successfully!");
    }

    public function fullDestroy(Deletion $deletion) {

        if (!fileDestroy($deletion->cover_path, true)) {
            fileDestroy($deletion->pdf_path, true);
        }

        try {
            DB::beginTransaction();
            $deletion->delete();
            DB::commit();
        } catch(Exception $e) {
            DB::rollBack();
            Log::error('Full Destroy (Deletion) - Failed:', [
                'id' => $deletion->id,
                'original_id' => $deletion->original_id,
                'title' => $deletion->title,
                'user' => auth()->id(),
                'message' => $e,
            ]);
            return redirect(route('deletions.show', $deletion))->with('warning', "Item couldn't be deleted!");
        }
        Log::notice('Full Destroy (Deletion):', [
            'id' => $deletion->id,
            'original_id' => $deletion->original_id,
            'title' => $deletion->title,
            'user' => auth()->id(),
        ]);
        return redirect(route('deletions.manage'))->with('message', "Item deleted successfully!");


    }
}
