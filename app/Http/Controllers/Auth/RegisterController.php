<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Mail\VerificationCodeMail;
use App\Mail\SimpleMail;

class RegisterController extends Controller
{
    use RegistersUsers;
    protected $redirectTo = '/dashboard';   
    public function __construct()
    {
        $this->middleware('guest');
    }
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);
    }
    protected function create(array $data)
    { 
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'adviser_check' => 'adviser_check',
            'offshore_check' => 'offshore_check',
            'tickets_check' => 'tickets_check',
            'user_management_check' => 'user_management_check',
            'support_check' => 'support_check',
            'faq_check' => 'faq_check',
            'password' => Hash::make($data['password']),
        ]);

        $username =$data['name'];
        $link = 'http.com';
       $userEmail = $data['email'];
       
$messageContent = "
    <div style='font-family: Arial, sans-serif; line-height: 1.6; max-width: 600px; margin: 0 auto; padding: 20px; background-color: #f9f9f9; border: 1px solid #ddd; border-radius: 8px;'>
        <h2 style='color: #333;'>Welcome to Alltrust Services Limited – Verify Your Email Address</h2>
        <p>Dear {$username},</p>
        <p>Thank you for registering with Alltrust. We are excited to have you onboard and look forward to supporting your financial advisory needs.</p>
        <p>To complete your registration and access your account, please verify your email address by clicking the link below:</p>
        <p><a href='{$link}' target='_blank' style='color: #007bff; text-decoration: none;'>Verify Email Address</a></p>
        <p>Once your email is verified, you will be asked to log in using the password you chose during registration.</p>
        <p>If you encounter any issues or have questions, please contact us at <a href='mailto:portalsupport@alltrust.co.uk' style='color: #007bff; text-decoration: none;'>portalsupport@alltrust.co.uk</a>.</p>
        <p>Thank you for choosing Alltrust Services Limited.</p>
        <p>Best regards,<br>The Alltrust Team</p>
    </div>
";

Mail::to($userEmail)->send(new SimpleMail($messageContent));
       
        return $user;
    }


}
