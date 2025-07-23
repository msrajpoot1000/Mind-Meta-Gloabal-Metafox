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

    // dd($request);
    // ✅ Step 1: Validate inputs
    $request->validate([
        'companyname'     => 'nullable|string|max:255',
        'client_name'     => 'nullable|string',
        'title'           => 'nullable|string',
        'description'     => 'nullable|string',
        'email'           => 'required|email',
        'phone'           => 'nullable|string|max:20',
        'phone2'          => 'nullable|string|max:20',
        'phone3'          => 'nullable|string|max:20',
        'address'         => 'nullable|string|max:500',
        'facebook'        => 'nullable|url',
        'instagram'       => 'nullable|url',
        'twitter'         => 'nullable|url',
        'youtube'         => 'nullable|url',
        'linkedin'        => 'nullable|url',
        'pinterest'       => 'nullable|url',
        'logo'            => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'status_logo'     => 'nullable|in:0,1',
        'tax_guide_link'  => 'nullable|string',
       'favicon' => 'nullable|mimes:png,ico,svg|max:2048',
      'about_pdf' => 'nullable|mimes:pdf,doc,docx,xls,xlsx,png,jpg,jpeg,svg,ico|max:5120',


        'status_favicon'  => 'nullable|in:0,1',
    ]);

    // ✅ Step 2: Get or create the company record
    $company = Companyinfo::first() ?? new Companyinfo;




    $aboutPdfField = 'about_pdf';
if ($request->hasFile($aboutPdfField)) {
    if (!empty($company->$aboutPdfField) && file_exists(public_path($company->$aboutPdfField))) {
        unlink(public_path($company->$aboutPdfField));
    }

    $folder = 'upload/about_pdf';
    $path = public_path($folder);

    // dd($path);
    if (!file_exists($path)) {
        mkdir($path, 0777, true);
    }

    $file = $request->file($aboutPdfField);
    $filename = uniqid() . '.' . $file->getClientOriginalExtension();
    $file->move($path, $filename);

      $fullPath = $path . '/' . $filename;

    //   dd($folder . '/' . $filename);



    $company->about_pdf = $folder . '/' . $filename;

} elseif ($request->input('status_about_pdf') === '0') {
    if (!empty($company->about_pdf) && file_exists(public_path($company->about_pdf))) {
        unlink(public_path($company->about_pdf));
    }
    $company->about_pdf = null;
}





    // ✅ Step 3: Handle logo upload
    $logoField = 'logo';
    if ($request->hasFile($logoField)) {
        if (!empty($company->$logoField) && file_exists(public_path($company->$logoField))) {
            unlink(public_path($company->$logoField));
        }

        $folder = 'upload/logo';
        $path = public_path($folder);
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $file = $request->file($logoField);
        $filename = uniqid() . '.' . $file->getClientOriginalExtension();
        $file->move($path, $filename);
        

        $company->$logoField = $folder . '/' . $filename;

    } elseif ($request->input('status_logo') === '0') {
        if (!empty($company->$logoField) && file_exists(public_path($company->$logoField))) {
            unlink(public_path($company->$logoField));
        }
        $company->$logoField = null;
    }

    // ✅ Step 4: Handle favicon upload
    $faviconField = 'favicon';
    if ($request->hasFile($faviconField)) {
        if (!empty($company->$faviconField) && file_exists(public_path($company->$faviconField))) {
            unlink(public_path($company->$faviconField));
        }

        $folder = 'upload/favicon';
        $path = public_path($folder);
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $file = $request->file($faviconField);
        $filename = uniqid() . '.' . $file->getClientOriginalExtension();
        $file->move($path, $filename);

        $company->$faviconField = $folder . '/' . $filename;

    } elseif ($request->input('status_favicon') === '0') {
        if (!empty($company->$faviconField) && file_exists(public_path($company->$faviconField))) {
            unlink(public_path($company->$faviconField));
        }
        $company->$faviconField = null;
    }

    // ✅ Step 5: Update other fields
    $company->companyname = $request->companyname;
    $company->client_name = $request->client_name;
    $company->email       = $request->email;
    $company->title       = $request->title;
    $company->description = $request->description;
    $company->phone       = $request->phone;
    $company->phone2      = $request->phone2;
    $company->phone3      = $request->phone3;
    $company->address     = $request->address;
    $company->facebook    = $request->facebook;
    $company->instagram   = $request->instagram;
    $company->twitter     = $request->twitter;
    $company->youtube     = $request->youtube;
    $company->linkedin    = $request->linkedin;
    $company->pinterest   = $request->pinterest;

    $company->tax_guide_link    = $request->tax_guide_link;
    // $company->about_pdf   = $request->about_pdf;

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
