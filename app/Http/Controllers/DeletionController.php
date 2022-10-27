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
        // Queries for deleted items
        // paginates, sorts and filters by 'search' (found in Deletion Model)
        $deletions = Deletion::query()
            ->filter(request(['search']))
            ->orderBy($sortField, $sort)->get()
        ;
        return view('deletions.manage', [
            'deletions' => $deletions->paginate($pages)->withQueryString()
        ]);
    }

    // Deletion Show
    public function show(Deletion $deletion) {
        // Variables Initialization
        $subjects = array();
        $authors = array();
        $collections = array();
        // Explodes and adds to array all subjects, authors and collections since they are saved as a string in the Table column
        if($deletion->had_subjects) {
            $subjects = explode(', ', $deletion->had_subjects);
        }

        if($deletion->had_authors) {
            $authors = explode(', ', $deletion->had_authors);
        }

        if($deletion->was_partOf) {
            $collections = explode(', ', $deletion->was_partOf);
        }

        if($deletion->contributions) {
            $contributions = explode(', ', $deletion->contributions);
        }

        // Check if deletion has a publishing day then append with month and year
        // (since it is not allowed to have a day without a month or a month without a year)
        if($deletion->publisher_day) {
            $deletion['publisher_when'] = ($deletion->publisher_day . '-' ?? '') . ($deletion->publisher_month . '-' ?? '') . ($deletion->publisher_year ?? '');
            $deletion['publisher_when'] = Carbon::createFromFormat('d-m-Y', $deletion['publisher_when']);
            $deletion['publisher_when'] = $deletion['publisher_when']->format('d-m-Y');
        }else {
            $deletion['publisher_when'] = $deletion->publisher_year;
        }
        // Returns view with all the above data
        return view('deletions.show', [
            'deletion' => $deletion,
            'subjects'=> $subjects,
            'authors' => $authors,
            'collections' => $collections,
            'contributions' => $contributions
        ]);
    }

    // Deletion Restore
    public function restore(Deletion $deletion) {
        // Checks if an exact Item exists
        if (!Item::where('id', $deletion->original_id)->exists($deletion->original_id)) {
            $itemToRestore = $deletion->attributesToArray();
            // DB Transaction
            try {
                DB::beginTransaction();
                // Check if the Item to be restored had any subjects
                if ($itemToRestore['had_subjects'] != null) {
                    // Initialize Final Array ($subjectsToRestore) and Explode subjects into another array ($subjects)
                    $subjectsToRestore[] = array();
                    $subjects = explode(', ', $itemToRestore['had_subjects']);
                    // Search for subjects or create if they do not exist
                    foreach ($subjects as $subject) {
                        $toAdd = Subject::firstWhere('title', $subject);
                        // If subject to be added is not null, add to final array
                        if ($toAdd != null) {
                            $subjectsToRestore[] = $toAdd->id;
                        }
                    }
                }
                // Same as above but with authors
                if ($itemToRestore['had_authors'] != null) {
                    $authorsToRestore[] = array();
                    $contributionsToRestore[] = array();
                    $authors = explode(', ', $itemToRestore['had_authors']);
                    $contributions = explode(', ', $itemToRestore['contributions']);
                    foreach ($authors as $key => $author) {
                        $toAdd = Author::firstWhere('fullname', $author);
                        if ($toAdd != null) {
                            $authorsToRestore[] = $toAdd->id;
                            $contributionsToRestore[] = $contributions[$key];
                        }
                    }
                }
                // Same as above but with collections
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


                // Create Item
                $item = Item::create($itemToRestore);
                $item->id = $deletion->original_id;
                $item->save();

                // Check if the final arrays are empty and attach their contents
                if (!empty($subjectsToRestore)) {
                    $item->subjects()->attach($subjectsToRestore);
                }
                if (!empty($authorsToRestore)) {
                    foreach ($authorsToRestore as $key => $author) {
                        $item->authors()->attach($author, ['contribution' => $contributionsToRestore[$key]]);
                    }
                }
                if (!empty($collectionsToRestore)) {
                    $item->collections()->attach($collectionsToRestore);
                }
                // Log the fact that the Deletion has been restored
                $deletion->restored_at = Carbon::now()->toDateTimeString();
                $deletion->save();

                DB::commit();
            } catch (Exception $e) {
                // Rollback and log errors
                DB::rollBack();
                Log::error('Restore (Deletion) - Failed:', [
                    'id' => $deletion->id,
                    'original_id' => $deletion->original_id,
                    'title' => $deletion->title,
                    'user' => auth()->id(),
                    'message' => $e,
                ]);

                return redirect(route('deletions.show', $deletion))->with('warning', "Item couldn't be restored!");

            }
            // Log success
            Log::notice('Restore (Deletion):', [
                'id' => $deletion->id,
                'original_id' => $deletion->original_id,
                'title' => $deletion->title,
                'user' => auth()->id(),
            ]);
            return redirect(route('items.show', $item))->with('message', 'Item restored successfully!');
        } else {
            // Redirects if an identical Item already exists
            return redirect(route('deletions.manage'))->with('warning', "Item already exists! You cannot restore an existing item.");
        }
    }

    // Deletion Destroy
    public function destroy(Deletion $deletion) {
        // DB Transaction
        try {
            DB::beginTransaction();
            $deletion->delete();
            DB::commit();
        } catch(Exception $e) {
            // Rollback and log errors
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
        // Log success
        Log::notice('Destroy (Deletion):', [
            'id' => $deletion->id,
            'original_id' => $deletion->original_id,
            'title' => $deletion->title,
            'user' => auth()->id(),
        ]);
        return redirect(route('deletions.manage'))->with('message', "Item deleted successfully!");
    }

    // Deletion Full Destroy
    public function fullDestroy(Deletion $deletion) {
        // Destroy any cover or pdf the Item had in storage (Helpers/fileDestroy)
        if (!fileDestroy($deletion->cover_path, true)) {
            fileDestroy($deletion->pdf_path, true);
        }
        // DB Transaction
        try {
            DB::beginTransaction();
            $deletion->delete();
            DB::commit();
        } catch(Exception $e) {
            // Rollback and log errors
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
        // Log success
        Log::notice('Full Destroy (Deletion):', [
            'id' => $deletion->id,
            'original_id' => $deletion->original_id,
            'title' => $deletion->title,
            'user' => auth()->id(),
        ]);
        return redirect(route('deletions.manage'))->with('message', "Item deleted successfully!");


    }
}
