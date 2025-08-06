<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BookAppointment;
use App\Exports\BookAppointmentExport;
use App\Mail\BookAppointmentMail;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;


class BookAppointmentController extends Controller
{

 public function exportBookAppointment(Request $request)
{
    // dd($request);
    
    $date=$request->input('export_date');
    return Excel::download(new BookAppointmentExport($date), 'appointments.xlsx');
}


   

public function bookAppointmentStore(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email',
        'country_code' => 'required|string|max:10',
        'phone' => 'required|string|max:20',
        'user_date_time' => 'required|date_format:d/m/Y H:i',
        'timezone' => 'nullable|string|max:100',
        'message' => 'required|string',
    ]);

    // Convert user_date_time to DateTime (User's timezone)
    $dateTime = \DateTime::createFromFormat('d/m/Y H:i', $request->user_date_time);

    // Extract only timezone identifier
    $userTimezone = $request->timezone;
    preg_match('/^(.*?)\s\(/', $userTimezone, $matches);
    $userTimezone = $matches[1] ?? $userTimezone;

    $adminTimezone = 'Asia/Dubai'; // Admin's Timezone

    // Convert user's date_time to admin timezone using Carbon
    $userDateTimeCarbon = Carbon::createFromFormat('d/m/Y H:i', $request->user_date_time, $userTimezone);
    $adminDateTimeCarbon = $userDateTimeCarbon->setTimezone($adminTimezone);

    // Store appointment with admin_date_time
    $appointment = BookAppointment::create([
        'name' => $request->name,
        'email' => $request->email,
        'country_code' => $request->country_code,
        'phone' => $request->phone,
        'user_date_time' => $dateTime->format('Y-m-d H:i:s'),                   // User's Original Date Time
        'timezone' => $userTimezone,                                            // User's Timezone
        'admin_date_time' => $adminDateTimeCarbon->format('Y-m-d H:i:s'),       // Admin's Date Time
        'message' => $request->message,
    ]);

    // $fromEmail = config('mail.from.address');
    $fromEmail="msrajpoot1000@gmail.com";

    // Send Email to Admin
    Mail::to($fromEmail)->send(new BookAppointmentMail($appointment));

    return redirect()->back()->with('success', 'Appointment Booked Successfully!');
}





    public function bookAppointmentIndex(){
        $appointment = BookAppointment::latest()->get();
        
        return view('admin.pages.appointment',compact('appointment'));
    }
}
