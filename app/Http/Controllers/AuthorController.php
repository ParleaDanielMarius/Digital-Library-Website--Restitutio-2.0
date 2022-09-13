<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Mockery\Exception;

class AuthorController extends Controller
{
    public function index() {
        return view('authors.index', [
            'authors' => Author::withCount('items')->filter(request(['search']))->paginate(12)
        ]);
    }

    public function show(Author $author) {
        return view('authors.show', [
            'author' => $author->loadCount('items'),
            'items' => Author::find($author->id)->items()->latest()->filter(request(['subject', 'search']))->paginate(12),
        ]);
    }

    public function create() {
        return view('authors.create');
    }

    public function store(Request $request) {
        $formFields = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
        ]);
        $formFields['fullname'] = $formFields['first_name'] . ' ' . $formFields['last_name'];
        $formFields['created_by'] = auth()->id();

        try {
            DB::beginTransaction();
            $author = Author::create($formFields);
            DB::commit();
        } catch(Exception $e){
            DB::rollBack();
            Log::error('Store (Author) - Failed:', [
                'form' => $formFields,
                'user' => auth()->id(),
                'message' => $e,
            ]);
            return redirect('/')->with('message', "Author couldn't be created!");
        }
        Log::notice('Store (Author):', [
            'id' => $author->id,
            'fullname' => $author->fullname,
            'user' => auth()->id(),
        ]);
        return redirect(route('authors.show', $author));
    }

    public function edit(Author $author) {
        return view('authors.edit', ['author' => $author]);
    }

    public function update(Request $request, Author $author) {
        $formFields = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
        ]);
        $formFields['fullname'] = $formFields['first_name'] . ' ' . $formFields['last_name'];
        $formFields['updated_by'] = auth()->id();

        try {
            DB::beginTransaction();
            $author->update($formFields);
            DB::commit();
        }catch (Exception $e) {
            DB::rollBack();
            Log::error('Update (Author) - Failed:', [
                'id' => $author->id,
                'fullame' => $author->fullname,
                'form' => $formFields,
                'user' => auth()->id(),
                'message' => $e,
            ]);
            Log::notice('Update (Author):', [
                'id' => $author->id,
                'fullame' => $author->fullname,
                'user' => auth()->id(),
            ]);
            return redirect(route('authors.show', $author))->with('warning', "Author couldn't be updated!");
        }

        return redirect(route('authors.show', $author));
    }

    public function destroy(Author $author) {
        try {
            DB::beginTransaction();
            $author->delete();
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
        }

        Log::notice('Destroy (Author)', [
            'id' => $author->id,
            'fullame' => $author->fullname,
            'user' => auth()->id(),
        ]);
        return redirect('/')->with('message', 'Author deleted successfully');
    }
}
