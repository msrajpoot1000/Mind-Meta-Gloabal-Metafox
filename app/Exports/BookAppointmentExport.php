<?php

namespace App\Exports;

use App\Models\BookAppointment;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class BookAppointmentExport implements FromCollection, WithHeadings, WithMapping
{
    protected $date;

    public function __construct($date = null)
    {
        $this->date = $date;
    }

 public function collection()
{
    if ($this->date) {
        return BookAppointment::whereDate('created_at', '>=', $this->date)->get([
            'id', 'name', 'email', 'country_code', 'phone', 'user_date_time','admin_date_time', 'timezone', 'message', 'created_at'
        ]);
    } else {
        return BookAppointment::all(['id', 'name', 'email', 'country_code', 'phone', 'user_date_time','admin_date_time', 'timezone', 'message', 'created_at']);
    }
}


    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Email',
            'Country Code',
            'Phone',
            'User (Date & Time)',
            'Admin (Date & Time)',
            'Timezone',
            'Message',
            'Submitted At',
        ];
    }

    public function map($appointment): array
    {
        return [
            $appointment->id,
            $appointment->name,
            $appointment->email,
            $appointment->country_code,
            $appointment->phone,
            \Carbon\Carbon::parse($appointment->user_date_time)->format('d-m-Y h:i A'),
             \Carbon\Carbon::parse($appointment->user_date_time)->format('d-m-Y h:i A'),
            $appointment->timezone,
            $appointment->message,
            \Carbon\Carbon::parse($appointment->created_at)->format('d-m-Y h:i A'),
        ];
    }
}
