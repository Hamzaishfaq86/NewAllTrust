<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Support;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    public function index()
    {
        if(auth()->user()->role == 'admin' || auth()->user()->role == 'it_admin'){
            $supports = Support::all();
        }else{
            $supports = Support::where('user_id',auth()->user()->id)->get();
        }
        
        return view('dashboard.support.index', compact('supports'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string', // Changed from integer to string
            'details' => 'required|string',
        ]);

        Support::create($request->all()); // More concise

        return redirect()->back()->with('success', 'Support Added Successfully...');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string', // Changed from integer to string
            'details' => 'required|string',
        ]);

        $support = Support::findOrFail($id);
        $support->update($request->all()); // More concise

        return redirect()->back()->with('success', 'Support Updated Successfully...');
    }

    public function delete($id)
    {
        $support = Support::findOrFail($id);
        $support->delete();

        return redirect()->back()->with('success', 'Support Deleted Successfully...');
    }
}
