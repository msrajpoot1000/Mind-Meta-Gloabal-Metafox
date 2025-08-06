<?php

namespace App\Exports;

use App\Models\Contact;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ContactExport implements FromCollection, WithHeadings
{
    protected $date;

    public function __construct($date = null)
    {
        $this->date = $date;
    }

   public function collection()
{
    if ($this->date) {
        return Contact::whereDate('created_at', '>=', $this->date)->get([
            'id', 'name', 'email', 'phone', 'subject', 'message', 'created_at'
        ]);
    } else {
        return Contact::all(['id', 'name', 'email', 'phone', 'subject', 'message', 'created_at']);
    }
}


    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Email',
            'Phone',
            'Subject',
            'Message',
            'Submitted At',
        ];
    }
}
