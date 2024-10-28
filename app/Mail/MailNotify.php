<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MailNotify extends Mailable
{
    use Queueable, SerializesModels;

    private $data = [];

    public function __construct($data)
    {
        //
        $this->data = $data;
    }

    public function build()
    {
        return $this->from('admin123@gmail.com','admin')
        ->subject($this->data['subject'])
        ->view('mail_test')
        ->with('data', $this->data);
    }
}
