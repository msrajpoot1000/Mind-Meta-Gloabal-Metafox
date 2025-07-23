<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Contact;

use App\Models\Companyinfo;

class ContactController extends Controller
{
    public function contactF()
    {   
         $company = Companyinfo::first();
        return view('user.pages.contact', compact('company'));
    }

    public function storeContact(Request $request)
    {
       
        // Validation
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'phone'   => 'nullable|string|max:20',
            'country_code' => 'required|string|max:20',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);
        // dd($request->country_code);


        Contact::create([
    'name'         => $request->name,
    'email'        => $request->email,
    'phone'        => $request->phone,
    'country_code' => $request->country_code, // map this correctly
    'subject'      => $request->subject,
    'message'      => $request->message,
]);


        return back()->with('success', 'Message sent successfully!');
    }
    
    
    public function index()
    {   
        $contacts = Contact::latest()->get();
        return view('admin.pages.contact', compact('contacts'));
    }
    
  
    public function destroy($id)
    {
        $contact = Contact::findOrFail($id); // ID se record find karo
        $contact->delete(); // Record delete karo
    
        return redirect()->back()->with('success', 'Contact deleted successfully!');
    }
}
