<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Mail\TwoStepCodeMail; 

class LoginController extends Controller
{
    use AuthenticatesUsers;
 
    protected $redirectTo = '/dashboard';
 
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }
 
public function authenticated(Request $request, $user)
{
    $user->two_step_code = rand(100000, 999999);
    $user->two_step_expires_at = now()->addMinutes(10);
    $user->save();

    // Store user ID in the session for two-step verification
    session(['two_step_user_id' => $user->id]);

    // Send the code via email
    Mail::to($user->email)->send(new TwoStepCodeMail($user->two_step_code));

    // Log out the user temporarily
    Auth::logout();

    return redirect()->route('two-step.verify');
}

}
