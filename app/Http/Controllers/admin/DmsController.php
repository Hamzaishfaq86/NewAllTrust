<?php


namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Dms;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DmsController extends Controller
{
    public function index()
    {
        if(auth()->user()->role == 'admin'){
             $dms = Dms::all();
        }else{
             $dms = Dms::where('user_id',auth()->user()->id)->get();
        }
       
        return view('dashboard.dms.index', compact('dms'));
    }

    public function create()
    {
    
        return view('dashboard.dms.create');
    }
    
    public function edit($id)
    {
         $dms = Dms::find($id);
        return view('dashboard.dms.edit',compact('dms'));
    }
    
 
     public function store(Request $request)
    {
      

        $dms = new Dms();

        $dms->user_id = auth()->user()->id;
        $dms->name = $request->name;
        $dms->reference_link = $request->reference_link;
 
        $jsonUrls = Null;
            
        if ($request->hasFile('dropzone_multifiles')) {
            $urls = [];  
            foreach ($request->file('dropzone_multifiles') as $file) {
                $fileName = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('documents', $fileName, 'public');
                $url = url('/storage/app/public/' . $path);
                $urls[] = $url;
            }
            $jsonUrls = json_encode($urls);
        }
        
        $dms->dropzone_multifiles = $jsonUrls; 


        $dms->save();

        $message = 'DMS Added Successfully...';

        return redirect()->back()->with('success', $message);
    }
 
public function update(Request $request, $id) {
    
        $dms = Dms::find($id);
        if ($dms) {
            $dms->name = $request->reference_link;
            $dms->reference_link = $request->reference_link;
            
            // Handle file upload
    
             $jsonUrls = $request->old;
            
          if ($request->hasFile('dropzone_multifiles')) {
            $urls = [];  
            foreach ($request->file('dropzone_multifiles') as $file) {
                $fileName = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('documents', $fileName, 'public');
                $url = url('/storage/app/public/' . $path);
                $urls[] = $url;
            }
            $jsonUrls = json_encode($urls);
            
            $dms->save();
            return redirect()->back()->with('success', 'Record updated successfully!');
        }
        return redirect()->back()->with('error', 'Failed to update the record!');
    }
}
 

    public function delete($id)
    {
      $delete = Dms::find($id);
      if($delete){
          $delete->delete();
      }
      return redirect()->back()->with('DMS Deleted Successfully...');
    }
}
