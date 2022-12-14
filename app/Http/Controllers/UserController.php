<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Exception;

class UserController extends Controller
{



    // Show Register/Create Form
    public function create() {
        return view('users.create');
    }

    // Create User
    public function store(Request $request) {
        // Validate fields
        $formFields = $request->validate([
            'username'=>['required', 'min:5', Rule::unique('users', 'username')],
            'first_name'=>'required',
            'last_name'=>'required',
            'email'=>['nullable', 'email', Rule::unique('users', 'email')],
            'password'=>['required', 'confirmed', 'min:6'],
            'location'=>'required',
            'role'=>'required',
            'status' =>'required',
        ]);

        // Hash Password
        $formFields['password'] = bcrypt($formFields['password']);

        // DB Transaction
        try {
            DB::beginTransaction();

            $user = User::create($formFields);

            DB::commit();
        } catch(Exception $e) {
            // Rollback and log errors
            DB::rollBack();
            Log::error('store (User) - Failed:', [
                'user' => auth()->id(),
                'message' => $e,
            ]);
            return redirect('/')->with('warning', "User couldn't be created!");
        }
        // Log success
        Log::notice('store (User):', [
            'id' => $user->id,
            'user' => auth()->id(),
        ]);
        return redirect(route('users.show', $user))->with('message', 'User Created Successfully');
    }

    // Show Edit User Form
    public function edit(User $user) {
        return view('users.edit', ['user' => $user]);
    }

    // Update User
    public function update(Request $request, User $user) {
        // Validate Fields
        $formFields = $request->validate([
            'username'=>['required', 'min:5', Rule::unique('users', 'username')->ignore($user)],
            'first_name'=>'required',
            'last_name'=>'required',
            'email'=>['nullable', 'email', Rule::unique('users', 'email')->ignore($user)],
            'password'=>['confirmed', 'min:6', 'nullable'],
            'location'=>'required',
            'role'=>'required',
            'status'=>'required',
        ]);

        // Hash Password
        if($formFields['password'] != null)
            $formFields['password'] = bcrypt($formFields['password']);
        else
            unset($formFields['password']);


        $formFields['updated_by'] = auth()->id();

        // DB Transaction
        try {
            DB::beginTransaction();

            $user->update($formFields);

            DB::commit();
        } catch(Exception $e) {
            // Rollback and log errors
            DB::rollBack();
            Log::error('update (User) - Failed:', [
                'id' => $user->id,
                'user' => auth()->id(),
                'message' => $e,
            ]);
            return redirect(route('users.show', $user))->with('warning', "User couldn't be updated!");
        }
        // Log success
        Log::notice('update (User):', [
            'id' => $user->id,
            'user' => auth()->id(),
        ]);
        return redirect(route('users.show', $user))->with('message', "User updated successfully!");

    }

    // Manage User
    public function manage() {
        // Some arrays for validation of sorting, ordering and pagination
        $validationSort = ['asc', 'desc', 'latest'];
        $validationPage = ['10', '15', '20', '25', '30'];
        // Gets the pagination, sorting and ordering from the request
        $pages = request('orderBy', 25);
        $sort = request('sortBy', 'asc');
        $sortField = 'username';
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
        // Query Users, order, sort, paginate
        // and filter using 'username' (found in User Model)
        $users = User::query()
            ->filter(request(['username']))
            ->orderBy($sortField, $sort)->get()
        ;
        return view('users.manage' , [
            'users' => $users->paginate($pages)->withQueryString(),
        ]);
    }

    // Show User
    public function show(User $user) {
        return view('users.show', [
            'user' => $user->loadCount('items', 'authors', 'collections'),
        ]);
    }

    //  --  Change User's Status  --  \\
    public function changeStatus(User $user) {
        // DB Transaction
        try {
            // Check user status and change to opposite
            if ($user->status == User::STATUS_ACTIVE) {
                $user->status = User::STATUS_INACTIVE;
                DB::beginTransaction();
                $user->update();
                DB::commit();
                $redirect = 1;

            } else {
                $user->status = User::STATUS_ACTIVE;
                DB::beginTransaction();
                $user->update();
                DB::commit();
                $redirect = 2;
            }
        }catch(Exception $e) {
            // Rollback and log errors
            DB::rollBack();
            Log::error('update (User):', [
                'id' => $user->id,
                'user' => auth()->id(),
                'message' => $e,
            ]);
            return redirect(route('users.show', $user))->with('warning', 'An error has occurred! ' . $e);
        }
        // Log success
        Log::notice('update (User):', [
            'id' => $user->id,
            'user' => auth()->id(),
        ]);

        return match($redirect) {
            1 => redirect(route('users.show', $user))->with('warning', 'User Disabled'),
            2 => redirect(route('users.show', $user))->with('message', 'User Enabled'),
            default => redirect(route('items.index')),
        };
    }

}
