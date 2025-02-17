<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Mail\SimpleMail;
use Illuminate\Support\Facades\Mail;



class UserController extends Controller
{
    public function toggleEmailNotification()
    {
        $user = Auth::user();
        
        if (!$user) {
            return redirect()->back()->with('error', 'User not authenticated.');
        }

        $user->email_notification = ($user->email_notification == 'yes') ? 'no' : 'yes';
        $user->save();

        return redirect()->back()->with('success', 'Email notification setting updated.');
    }
    
    public function index()
    {
        if(auth()->user()->role =='pre_approved_adviser_firm'){
    $users = User::whereIn('role', ['onshore_adviser', 'offshore_adviser'])->where('creator_id',auth()->user()->id)->get();
        }else{
            $users = User::all();
        }
        
        return view('dashboard.user.index', compact('users'));
    }

    // Store the new user data
    public function store(Request $request)
    {
       
        
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'role' => 'required'
        ]);
        
        // Create and store the user
       $user = new User();
       
       
$user->creator_id = auth()->user()->id;    
$user->name = $request->name;
$user->email = $request->email;
$user->firm_name = $request->firm_name;
$user->password = Hash::make($request->password); // Encrypt the password
$user->role = $request->role;
$user->email_notification = $request->email_notification;

// Setting other fields

$user->adviser_check = $request->adviser_check;
$user->adviser_pending = $request->adviser_pending;
$user->adviser_existing = $request->adviser_existing;
$user->adviser_declined = $request->adviser_declined;

$user->offshore_check = $request->offshore_check;
$user->offshore_pending = $request->offshore_pending;
$user->offshore_existing = $request->offshore_existing;
$user->offshore_declined = $request->offshore_declined;

$user->oasis_sipp__check = $request->oasis_sipp__check;
$user->sipp_property_check = $request->sipp_property_check;
$user->full_sipp_check = $request->full_sipp_check;
$user->ftp_check = $request->ftp_check;
$user->pending_applications = $request->pending_applications;
$user->existing_applications = $request->existing_applications;
$user->decline_applications = $request->decline_applications;
$user->illustration_check = $request->illustration_check;
$user->member_details_check = $request->member_details_check;
$user->leads_check = $request->leads_check;
$user->user_management_check = $request->user_management_check;
$user->dms_check = $request->dms_check;
$user->reports_check = $request->reports_check;
$user->workflow_check = $request->workflow_check;
$user->tickets_check = $request->tickets_check;
$user->support_check = $request->support_check;
$user->faq_check = $request->faq_check;
$user->communication_check = $request->communication_check;

$user->adviser_applications_check = $request->adviser_applications_check;
$user->member_applications_check = $request->member_applications_check;


// Save the user to the database
$user->save();

 if ($user->email_notification === 'yes') {

        $username =$user->name;
        $userEmail = $user->email;
        $userpassword =$request->password;
        
       
        $messageContent = "
            <div style='font-family: Arial, sans-serif; line-height: 1.6; max-width: 600px; margin: 0 auto; padding: 20px; background-color: #f9f9f9; border: 1px solid #ddd; border-radius: 8px;'>
                <h2 style='color: #333;'>Staff Registration - Portal Access Details</h2>
                <p>Dear {$username},</p>
                <p>Welcome to Alltrust Online!</p>
                <p>To log in, please use the details below:</p>
                <p><strong>Portal Link:</strong> <a href='https://newalltrust.ilcorpdev.com/login' target='_blank' style='color: #007bff; text-decoration: none;'>Click Here</a></p>
                <p><strong>Username:</strong> {$userEmail}</p>
                <p><strong>Temporary Password:</strong> {$userpassword}</p>
                <p>For security purposes, please log in as soon as possible and update your password.</p>
                <p>If you encounter any issues or have questions, feel free to contact our IT support team at <a href='mailto:portalsupport@alltrust.co.uk' style='color: #007bff; text-decoration: none;'>portalsupport@alltrust.co.uk</a>.</p>
                <p>Best regards,<br>The Alltrust Team</p>
            </div>


        ";
        
        Mail::to($userEmail)->send(new SimpleMail($messageContent));
 }


        // dd( $request->applications_check);
        // Redirect back with success message
        return redirect()->route('user')->with('success', 'User created successfully.');
    }

    public function delete($id)
    {
        // Find the user by ID and delete
        $user = User::findOrFail($id);
        $user->delete();

        // Redirect back with a success message
        return redirect()->route('user')->with('error', 'User deleted successfully.');
    }
   public function update(Request $request, $id)
{ 
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $id, // Ignore the current user's email
        'password' => 'nullable|string|min:8', // Password is optional during update
        'role' => 'required',  
    ]);
 
    $user = User::find($id);
    $user->name = $request->name;
    $user->email = $request->email;
    $user->firm_name = $request->firm_name;
    $user->email_notification = $request->email_notification;
 
    if ($request->filled('password')) {
        $user->password = Hash::make($request->password); 
    }
 
    $user->role = $request->role;
    $user->adviser_check = $request->adviser_check;
    $user->adviser_pending = $request->adviser_pending;
    $user->adviser_existing = $request->adviser_existing;
    $user->adviser_declined = $request->adviser_declined;
    
    $user->offshore_check = $request->offshore_check;
    $user->offshore_pending = $request->offshore_pending;
    $user->offshore_existing = $request->offshore_existing;
    $user->offshore_declined = $request->offshore_declined;
    
    $user->oasis_sipp__check = $request->oasis_sipp__check;
    $user->sipp_property_check = $request->sipp_property_check;
    $user->full_sipp_check = $request->full_sipp_check;
    $user->ftp_check = $request->ftp_check;
    $user->pending_applications = $request->pending_applications;
    $user->existing_applications = $request->existing_applications;
    $user->decline_applications = $request->decline_applications;
    $user->illustration_check = $request->illustration_check;
    $user->member_details_check = $request->member_details_check;
    $user->leads_check = $request->leads_check;
    $user->user_management_check = $request->user_management_check;
    $user->dms_check = $request->dms_check;
    $user->reports_check = $request->reports_check;
    $user->workflow_check = $request->workflow_check;
    $user->tickets_check = $request->tickets_check;
    $user->support_check = $request->support_check;
    $user->faq_check = $request->faq_check;
    $user->communication_check = $request->communication_check;
    $user->adviser_applications_check = $request->adviser_applications_check;
    $user->member_applications_check = $request->member_applications_check;

    // Save the updated user
    $user->save();

    // Redirect back with a success message
    return redirect()->route('user')->with('success', 'User updated successfully.');
}


    // Optional: Update user logic for 'update' if needed
}

