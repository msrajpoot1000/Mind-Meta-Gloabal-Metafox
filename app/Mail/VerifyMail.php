<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerifyMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $url;

    public function __construct($userData, $verificationUrl)
    {
        $this->user = $userData;
        $this->url = $verificationUrl;
    }

    public function build()
    {
        return $this->subject('Verify Your Email Address')
                    ->view('admin.emails.verify-email-templete');
    }
}
