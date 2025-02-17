<?php

namespace App\Http\Controllers;

use App\Models\Document;

use App\Models\Member;
use Illuminate\Http\Request;


class DocumentController extends Controller
{
    public function index($id)
    {
        $memberDetailsView = Member::find($id);

    // Retrieve all documents
    $documents = Document::all();

    // Pass both member and documents to the view
    return view('dashboard.member.memberDetailsView', compact('memberDetailsView', 'documents'));
}

    public function store(Request $request)
{
    
    $request->validate([
        'reference' => 'required|string',
        'status' => 'required|string',
    ]);

   
    $path = $request->file('file')->store('documents', 'public');

   
    $document = Document::create([
        'file_path' => $path,
        'reference' => $request->reference,
        'status' => $request->status,
        'member_id' => $request->input('member_id'),
    ]);

   
  

    // Redirect back with a success message
    return redirect()->back()->with('success', 'Document created successfully.');
}




    public function update(Request $request)
    {
        $request->validate([
            'reference' => 'required|string',
            'status' => 'required|string',
        ]);


        $document = Document::findOrFail($request->document_id);
        $document->reference = $request->reference;
        $document->status = $request->status;

        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('documents');
            $document->file_path = $path;
        }else{
            $document->file_path = $request->old_path;
        }

        $document->save();

        return redirect()->back()->with('success', 'Document updated successfully.');
    }

    public function destroy($id)
    {
        $document = Document::findOrFail($id);
        $document->delete();

        return redirect()->back()->with('success', 'Document deleted successfully.');
    }
}
