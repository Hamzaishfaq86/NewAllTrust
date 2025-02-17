<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Hash;
use App\Models\Fpt;
use App\Models\Member;
use App\Models\User;
use Illuminate\Http\Request;


class FptController extends Controller
{
    public function fptCreate()
    {
        $fpts = User::where('role','fpt')->get();
//        Fpt::where('role', 'fpt')->get()
        $role_member = 'fpt';
        return view('dashboard.fpt.createFpt',compact('fpts','role_member'));
    }

    public function showFpt()
    {
        if(auth()->user()->role == 'admin'){
            $fptView = Fpt::all();
        }else{
            $fptView = Fpt::where('creater_id', auth()->user()->id)->get();
        }
        
        return view('dashboard.fpt.viewFpt',compact('fptView'));
    }

    public function fptView()
    {
        if(auth()->user()->role == 'admin'){
            $fptShow = Fpt::all();
        }else{
            $fptShow = Fpt::where('creater_id', auth()->user()->id)->get();
        }
        
        return view('dashboard.fpt.showFpt',compact('fptShow'));
    }

public function fptStore(Request $request)
{
    // Create and save the User in the 'users' table
    $userMember = new User();
    $userMember->name = $request->input('user_name');
    $userMember->creator_id = auth()->user()->id;   
    $userMember->email = $request->input('user_email');
    $userMember->password = Hash::make('12345678');
    $userMember->role = $request->input('role_member'); // Ensure this column exists in 'users' table
    
    $userMember->member_details_check = 'member_details_check';
    $userMember->tickets_check = 'tickets_check';
    $userMember->support_check = 'support_check';
    $userMember->faq_check = 'faq_check';
    
    $userMember->save();
    
    // Prepare data for 'fpt' table and include 'user_id'
    $data = $request->except(['user_name', 'user_email', 'role_member']); // Remove user-specific data
    $data['user_id'] = $userMember->id;
    $data['creater_id'] = auth()->user()->id; 
    // Save data in the 'fpt' table
    Fpt::create($data);
    
    // Redirect with success message
    return redirect()->back();
}




     public function getFptList(Request $request)
    {
        $data = Fpt::select('id', 'scheme_name', 'contact_name', 'company_name', 'country', 'post_code')->get();
        return view('dashboard.fpt.fpt_list', compact('data'));
    }
    
    public function deleteFPT($id)
    {
        $fpt = Fpt::findOrFail($id);
        $fpt->delete();
        return redirect()->back()->with('success', 'FPT deleted successfully');
    }
    
    public function viewFPT($id)
    {
        $fpt = Fpt::findOrFail($id);
        $fptUser=User::where('role','fpt')->get();
        return view('dashboard.fpt.show_fpt', compact('fpt','fptUser'));
    }
    
     public function editFPT($id)
    {
        $fpt = Fpt::findOrFail($id);
        $fptUser=User::where('role','fpt')->get();
        
         $editFpt = Fpt::with('user')->find($id);
         $user = User::find($editFpt->user_id);
       
          $role_member = 'fpt';
         
        return view('dashboard.fpt.edit_fpt', compact('fpt','fptUser','user','role_member'));
    }

     public function fptUpdate(Request $request, $id)
    {

        // Find the record by ID
        $fpt = Fpt::find($id);
        // Update the record
        // $fpt->update($request->all());
         $fpt->update($request->except(['user_name', 'user_email', 'user_id']));
        
            
       $user = User::find($request->user_id);
        
      
            $user->name = $request->user_name;
            $user->email = $request->user_email;
            $user->save();

        // Redirect back with success message
        return redirect('/pending-members')->with('success', 'FTP updated successfully!');
    }
    
    // ======= soft delete ==========
    
    
        public function destroy($id)
    {
        $fpt = Fpt::find($id);
        if ($fpt) {
            $fpt->delete(); // Soft delete
            return redirect()->back()->with('success', 'Fpt deleted successfully.');
    }

        return redirect()->back()->with('error', 'Fpt not found.');
    }

        public function deleted()
    {
        // Fetch all deleted advisers
        $deletedFpt = Fpt::onlyTrashed()->get();
         return view('dashboard.fpt.deletedfpt', compact('deletedFpt'));
    }

public function pendingftp($id,$status)
{
    $offfpt = Fpt::find($id);

    $offfpt->status = $status;

    $offfpt->save();
    return redirect()->back();
}
// FptController.php

public function restoreFpt($id)
{
    // Find the soft-deleted Fpt record
    $fpt = Fpt::withTrashed()->find($id);

    if ($fpt) {
        // Restore the Fpt
        $fpt->restore();

        // Redirect with success message
        return redirect()->back()->with('success', 'FPT member restored successfully');
    }

    // If FPT not found, return an error message
    return redirect()->back()->with('error', 'FPT member not found');
}



}
