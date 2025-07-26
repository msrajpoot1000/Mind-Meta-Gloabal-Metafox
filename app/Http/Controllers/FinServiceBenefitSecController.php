<?php

namespace App\Http\Controllers;

use App\Models\FinServiceBenefitSec;
use Illuminate\Http\Request;

class FinServiceBenefitSecController extends Controller
{
    public function indexF()
    {
        return view('user.pages.fin_service_benefit_secs');
    }

    public function index()
    {
        $items = FinServiceBenefitSec::latest()->get();
  return view('admin.pages.fin-service-benefit-sec', compact('items'));



    }

    public function create() {}

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
        'description' => 'nullable|string',
        'is_active' => 'required|boolean'
        ]);
        

        FinServiceBenefitSec::create($data);
        return redirect()->route('admin-fin-service-benefit-sec.index')->with('success', 'FinServiceBenefitSec created successfully.');
    }

    public function edit(string $id)
    {
        $item = FinServiceBenefitSec::findOrFail($id);
   return view("admin.pages.fin-service-benefit-sec-edit", compact('item'));



    }

    public function update(Request $request, string $id)
    {
        $item = FinServiceBenefitSec::findOrFail($id);

        $request->validate([
            'name' => 'required|string',
        'description' => 'nullable|string',
        'is_active' => 'required|boolean'
        ]);

        $data = $request->only(['name', 'description', 'is_active']);

                $photoFields = [''];

        foreach ($photoFields as $field) {
            $statusField = 'status_' . $field;

            if ($request->input($statusField)) {
                if ($request->hasFile($field)) {
                    if (!empty($item->$field) && file_exists(public_path($item->$field))) {
                        unlink(public_path($item->$field));
                    }

                    $folder = 'upload/fin_service_benefit_secs';
                    $path = public_path($folder);
                    if (!file_exists($path)) {
                        mkdir($path, 0777, true);
                    }

                    $file = $request->file($field);
                    $filename = uniqid() . '.' . $file->getClientOriginalExtension();
                    $file->move($path, $filename);

                    $data[$field] = $folder . '/' . $filename;
                } else {
                    $data[$field] = $item->$field;
                }
            } else {
                if (!empty($item->$field) && file_exists(public_path($item->$field))) {
                    unlink(public_path($item->$field));
                }

                $data[$field] = null;
            }
        }

        $item->update($data);

        return redirect()->route('admin-fin-service-benefit-sec.index')->with('success', 'FinServiceBenefitSec updated successfully.');
    }

   public function destroy(string $id)
{
    $item = FinServiceBenefitSec::findOrFail($id);


    $item->delete();

    return redirect()->route('admin-fin-service-benefit-sec.index')->with('success', 'FinServiceBenefitSec deleted successfully.');
}

}