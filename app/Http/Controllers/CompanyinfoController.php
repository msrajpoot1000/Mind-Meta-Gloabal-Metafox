<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Companyinfo;

class CompanyinfoController extends Controller
{
    
   public function edit_companyinfo()
   {
       $companyinfos = Companyinfo::first();
        return view('admin.pages.companyinfo', compact('companyinfos'));   
    }
    
    

    public function store(Request $request)
    {
        // ✅ Step 1: Validate inputs
        $request->validate([
            'companyname' => 'required|string|max:255',
            'email'       => 'required|email',
            'phone'       => 'required|string|max:15',
            'phone2'      => 'nullable|string|max:15',
            'phone3'      => 'nullable|string|max:15',
            'address'     => 'required|string|max:500',
            'facebook'    => 'nullable|url',
            'instagram'   => 'nullable|url',
            'linkedin'    => 'nullable|url',
            'pinterest'   => 'nullable|url',
            'logo'        => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'favicon'     => 'nullable|mimes:png,svg,ico|max:2048',
        ]);
    
        // ✅ Step 2: Get or create the company record
        $company = Companyinfo::first() ?? new Companyinfo;
    
        // ✅ Step 3: Handle logo upload
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $destination = public_path('assets/images/logo');
            $file->move($destination, $filename);
    
            // Delete old logo if it exists
            if ($company->logo && file_exists(public_path($company->logo))) {
                unlink(public_path($company->logo));
            }
    
            $company->logo = 'assets/images/logo/' . $filename;
        }
    
        // ✅ Step 4: Handle favicon upload
        if ($request->hasFile('favicon')) {
            $file = $request->file('favicon');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $destination = public_path('default/image/favicon');
            $file->move($destination, $filename);
    
            // Delete old favicon if it exists
            if ($company->favicon && file_exists(public_path($company->favicon))) {
                unlink(public_path($company->favicon));
            }
    
            $company->favicon = 'upload/favicon/' . $filename;
        }
    
        // ✅ Step 5: Update other fields
        $company->companyname = $request->companyname;
        $company->email       = $request->email;
        $company->phone       = $request->phone;
        $company->phone2      = $request->phone2;
        $company->phone3      = $request->phone3;
        $company->address     = $request->address;
        $company->facebook    = $request->facebook;
        $company->instagram   = $request->instagram;
        $company->linkedin    = $request->linkedin;
        $company->pinterest   = $request->pinterest;
    
        // ✅ Step 6: Save and redirect
        $company->save();
    
        return redirect()->route('dashboard')->with('message', 'Company information saved successfully!');
    }

    

    
        public function destroy($id)
        {
            $company = Companyinfo::findOrFail($id);
            $logoPath = public_path('assets/images/logo/' . $company->logo);
            $faviconPath = public_path('upload/favicon/' . $company->favicon);
            
            if ($company->logo && file_exists($logoPath)) {
                unlink($logoPath);
            }

            if ($company->favicon && file_exists($faviconPath)) {
                unlink($faviconPath);
            }
    
            $company->delete();
    
            return redirect()->route('dashboard')->with('message', 'Company information deleted successfully!');
        }
    
 }
