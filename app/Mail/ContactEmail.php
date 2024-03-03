<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Contact;

class ContactEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $id;
    public $contact;
    public function __construct($id)
    {
        $this->id = $id;
    }


    public function build()
    {
        $obj = Contact::find($this->id);
        if ($obj) {
            $this->contact = $obj;
            return $this->subject("abvtool - Inquiry")
            ->to('alka.phpdots@gmail.com')
            ->markdown('emails.contactEmail');
        }
    }
    
}
