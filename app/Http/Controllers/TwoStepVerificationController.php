<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User; // Import the User model
use Carbon\Carbon;

class TwoStepVerificationController extends Controller
{
    public function showVerifyForm()
    {
        return view('auth.two-step-verify');
    }

  public function verify(Request $request)
{
    $request->validate([
        'two_step_code' => 'required|numeric',
    ]);

    // Retrieve the user ID from the session
    $userId = session('two_step_user_id');
    if (!$userId) {
        return back()->withErrors(['two_step_code' => 'Session expired or invalid. Please log in again.']);
    }

    // Find the user by ID
    $user = User::find($userId);
    if (
        $user &&
        $user->two_step_code === $request->two_step_code &&
        $user->two_step_expires_at &&
        $user->two_step_expires_at->isFuture() // Now works correctly because of the $casts
    ) {
        // Clear the two-step verification details
        $user->two_step_code = null;
        $user->two_step_expires_at = null;
        $user->save();

        // Log the user back in
        Auth::login($user);

        return redirect()->intended('/dashboard');
    }

    return back()->withErrors(['two_step_code' => 'The code is invalid or expired.']);
}

    public function resendCode()
    {
        $userId = session('two_step_user_id');
        $user = User::find($userId);

        if ($user) {
            $user->two_step_code = rand(100000, 999999);
            $user->two_step_expires_at = now()->addMinutes(10);
            $user->save();

            // Resend the code via email
            Mail::to($user->email)->send(new TwoStepCodeMail($user->two_step_code));
            return back()->with('status', 'A new verification code has been sent to your email.');
        }

        return back()->withErrors(['resend' => 'Unable to resend the verification code.']);
    }
}
