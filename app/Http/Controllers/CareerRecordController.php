<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CareerRecord;

class CareerRecordController extends Controller
{

   

    public function index(){
         $records = CareerRecord::latest()->get();
        return view('admin.pages.career-record',compact('records'));
    }


    public function store(Request $request)
{
    // dd($request);
    $request->validate([
        'name'         => 'required|string|max:255',
        'email'        => 'required|email|max:255',
        'country_code' => 'nullable|string|max:10',
        'phone'        => 'required|string|max:20',
        'resume'       => 'required|file|mimes:pdf,doc,docx|max:2048',
        'job_type'     => 'nullable|string|max:255',
        'message'      => 'required|string',
    ]);

    // Store file in public/upload/career-record with a timestamp name
    $resume      = $request->file('resume');
    $fileName    = time() . '.' . $resume->getClientOriginalExtension();
    $resumePath  = 'upload/career-record/' . $fileName;
    $resume->move(public_path('upload/career-record'), $fileName);

    // Save contact
    CareerRecord::create([
        'name'         => $request->name,
        'email'        => $request->email,
        'country_code' => $request->country_code,
        'phone'        => $request->phone,
        'resume_path'  => $resumePath,
        'job_type'     => $request->job_type,
        'message'      => $request->message,
    ]);

    return back()->with('success', 'Your application has been submitted.');
}



public function destroy($id)
{
    $record = CareerRecord::findOrFail($id);

    // Delete the resume file
    if ($record->resume_path && file_exists(public_path($record->resume_path))) {
        unlink(public_path($record->resume_path));
    }

    // Delete record
    $record->delete();

    return redirect()->back()->with('success', 'Record and file deleted.');
}




public function show($id)
{
    $record = CareerRecord::findOrFail($id);
    return view('admin.pages.career-record-show', compact('record'));
}




}
