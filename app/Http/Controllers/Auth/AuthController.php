<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    use AuthenticatesUsers;

    // The maximum number of login attempts and the amount of minutes to deny attempts
    protected $maxAttempts = 5;
    protected $decayMinutes = 3;

    // Logout User
    public function logout(Request $request) {
        Auth::logout();
        // Invalidate session and regenerate token
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(route('home'))->with('message', 'Logged out successfully');
    }

    // Authenticate User
    public function authenticate(Request $request) {
        // Validate Fields
        $formFields = $request->validate([
            'username'=>'required',
            'password'=>'required',
        ]);

        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }

        // Attempt login
            if (Auth::attempt([
                'username' => $formFields['username'],
                'password' => $formFields['password'],
                'status' => USER::STATUS_ACTIVE,
            ])) {
                $this->clearLoginAttempts($request);
                $request->session()->regenerate();
                return redirect('/')->with('message', 'Logged In!');
            }

        $this->incrementLoginAttempts($request);
        return back()->withErrors(['username' => trans('Auth.failed')])->onlyInput('username');
    }

}
