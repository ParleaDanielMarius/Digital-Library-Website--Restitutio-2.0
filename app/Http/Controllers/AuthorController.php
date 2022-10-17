<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Mockery\Exception;

class AuthorController extends Controller {

    // Gets Author List For Ajax Multiselect
    public function authorsSelect($search) {
        $authors = Author::query()->select('id', 'fullname')->where('fullname', 'LIKE', '%'. $search . '%')->get();
        return response($authors->toJson());
    }

    // Authors Index
    public function index() {
        // Some arrays for validation of sorting, ordering and pagination
        $validationSort = ['asc', 'desc', 'latest'];
        $validationPage = ['10', '15', '20', '25', '30'];
        // Gets the pagination, sorting and ordering from the request
        $pages = request('orderBy', 25);
        $sort = request('sortBy', 'asc');
        $sortField = 'fullname';
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
        // Author Query with Item Count
        // ordered and paginated with $sort, $sortField, $pages
        // and filtered by 'search' (found in Author Model)
        $authors = Author::query()->withCount('items')
            ->filter(request(['search']))
            ->orderBy($sortField, $sort)->paginate($pages)->withQueryString()
        ;
        // Returns the authors index view along with queried authors as $authors
        return view('authors.index', [
            'authors' => $authors,
        ]);
    }
    // Author Show with Items
    public function show(Author $author) {
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
        // Queries for Author's items that are active
        // paginates, sorts and filters by 'search' (found in Item Model)
        $items = $author->items()->with(['authors:slug,fullname', 'subjects:id,title', 'collections:slug,title'])
            ->where('status', Item::STATUS_ACTIVE)
            ->filter(request(['search']))
            ->orderBy($sortField, $sort)->paginate($pages)->withQueryString();
        // Returns the authors show view along with queried items as $items
        return view('authors.show' , [
            'author' =>$author->loadCount('items'),
            'items' => $items,
        ]);
    }

    // Authors Create
    public function create() {
        return view('authors.create');
    }

    // Authors Store
    public function store(Request $request) {
        // Validates required fields
        $formFields = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
        ]);

        // Appends first_name and last_name since Authors Table has a fullname column
        // Used in case first_name or last_name are needed separately
        $formFields['fullname'] = $formFields['first_name'] . ' ' . $formFields['last_name'];
        $formFields['created_by'] = auth()->id();

        // Creates a slug
        $formFields['slug'] = Str::slug($formFields['fullname']);

        // DB Transaction
        try {
            DB::beginTransaction();
            $author = Author::create($formFields);
            DB::commit();
        } catch(Exception $e){
            // Rollback changes and log the errors
            DB::rollBack();
            Log::error('Store (Author) - Failed:', [
                'form' => $formFields,
                'user' => auth()->id(),
                'message' => $e,
            ]);
            // Redirects to Home with message
            return redirect(route('home'))->with('message', "Author couldn't be created!");
        }
        // Logs Success
        Log::notice('Store (Author):', [
            'id' => $author->id,
            'fullname' => $author->fullname,
            'user' => auth()->id(),
        ]);
        // Redirects to newly created author
        return redirect(route('authors.show', $author))->with('message', "Author successfully created!");
    }

    // Author Edit
    public function edit(Author $author) {
        return view('authors.edit', ['author' => $author]);
    }

    // Author Update
    public function update(Request $request, Author $author) {
        // Validates required fields
        $formFields = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
        ]);
        // Appends first_name and last_name since Authors Table has a fullname column
        // Used in case first_name or last_name are needed separately
        $formFields['fullname'] = $formFields['first_name'] . ' ' . $formFields['last_name'];

        $formFields['updated_by'] = auth()->id();

        // Creates a slug
        $formFields['slug'] = Str::slug($formFields['fullname']);

        // DB Transaction
        try {
            DB::beginTransaction();
            $author->update($formFields);
            DB::commit();
        }catch (Exception $e) {
            // Rollback changes and log the errors
            DB::rollBack();
            Log::error('Update (Author) - Failed:', [
                'id' => $author->id,
                'fullame' => $author->fullname,
                'form' => $formFields,
                'user' => auth()->id(),
                'message' => $e,
            ]);
            return redirect(route('authors.show', $author))->with('warning', "Author couldn't be updated!");
        }
        // Logs Success
        Log::notice('Update (Author):', [
            'id' => $author->id,
            'fullame' => $author->fullname,
            'user' => auth()->id(),
        ]);
        return redirect(route('authors.show', $author));
    }

    // Author Destroy
    public function destroy(Author $author) {
        // Stops if author has items. This check can be safely removed in case you don't care if some items remain without authors
        if(!$author->items->isEmpty()) {
            return redirect(route('authors.show', $author))->with('warning', "Author has items. Cannot delete!");
        }
        // DB Transaction
        try {
            DB::beginTransaction();
            $author->delete();
            // Detaches items !Warning! Some items might remain with absolutely no author, hence the check above
            $author->items()->detach();
            DB::commit();
        } catch (Exception $e) {
            Log::error('Destroy (Author) - Failed:', [
                'id' => $author->id,
                'fullame' => $author->fullname,
                'user' => auth()->id(),
                'message' => $e,
            ]);
            DB::rollBack();
            return redirect(route('authors.show', $author))->with('warning', "Author couldn't be deleted!");
        }

        Log::notice('Destroy (Author)', [
            'id' => $author->id,
            'fullame' => $author->fullname,
            'user' => auth()->id(),
        ]);
        return redirect('/')->with('message', 'Author deleted successfully');
    }
}
