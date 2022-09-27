<?php

namespace App\Http\Controllers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Exception;

class UserController extends Controller
{
    protected $maxAttempts = 5; // Default is 5
    protected $decayMinutes = 1; // Default is 1


    // Show Register/Create Form
    public function create() {
        return view('users.create');
    }

    // Create User
    public function store(Request $request) {

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

        // Transactions
        try {
            DB::beginTransaction();

            $user = User::create($formFields);

            DB::commit();
        } catch(Exception $e) {
            Log::error('store (User) - Failed:', [
                'user' => auth()->id(),
                'message' => $e,
            ]);
            DB::rollBack();
            return redirect('/')->with('warning', "User couldn't be created!");
        }
        Log::notice('store (User):', [
            'id' => $user->id,
            'user' => auth()->id(),
        ]);
        return redirect(route('users.show', $user))->with('message', 'User Created Successfully');
    }

    // Logout User
    public function logout(Request $request) {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(route('home'))->with('message', 'Logged out successfully');
    }

    // Show Login Form
    public function login() {
        return view('users.login');
    }

    // Authenticate User
    public function authenticate(Request $request) {
        $formFields = $request->validate([
            'username'=>'required',
            'password'=>'required',
        ]);

        if(auth()->attempt([
            'username' => $formFields['username'],
            'password' => $formFields['password'],
            'status' => USER::STATUS_ACTIVE,
        ])) {
            $request->session()->regenerate();
            return redirect('/')->with('message', 'Logged In!');
        }
        return back()->withErrors(['username' => 'Invalid Credentials'])->onlyInput('username');
    }

    // Show Edit User Form
    public function edit(User $user) {
        return view('users.edit', ['user' => $user]);
    }

    // Update User
    public function update(Request $request, User $user) {

        $formFields = $request->validate([
            'username'=>['required', 'min:5', Rule::unique('users', 'username')->ignore($user)],
            'first_name'=>'required',
            'last_name'=>'required',
            'email'=>['nullable', 'email', Rule::unique('users', 'email')->ignore($user)],
            'password'=>['required', 'confirmed', 'min:6'],
            'location'=>'required',
            'role'=>'required',
            'status'=>'required',
        ]);

        // Hash Password
        $formFields['password'] = bcrypt($formFields['password']);
        $formFields['updated_by'] = auth()->id();

        // Transactions
        try {
            DB::beginTransaction();

            $user->update($formFields);

            DB::commit();
        } catch(Exception $e) {
            DB::rollBack();
            Log::error('update (User) - Failed:', [
                'id' => $user->id,
                'user' => auth()->id(),
                'message' => $e,
            ]);
            return redirect(route('users.show', $user))->with('warning', "User couldn't be updated!");
        }
        Log::notice('store (User):', [
            'id' => $user->id,
            'user' => auth()->id(),
        ]);
        return redirect(route('users.show', $user))->with('message', "User updated successfully!");

    }

    // Manage User
    public function manage() {
        $validationSort = ['asc', 'desc', 'latest'];
        $validationPage = ['10', '15', '20', '25', '30'];
        $pages = request('orderBy', 25);
        $sort = request('sortBy', 'asc');
        $sortField = 'username';
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
        try {
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
            DB::rollBack();
            Log::error('update (User):', [
                'id' => $user->id,
                'user' => auth()->id(),
                'message' => $e,
            ]);
            return redirect(route('users.show', $user))->with('warning', 'An error has occurred! ' . $e);
        }
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
