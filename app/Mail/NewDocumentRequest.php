<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\DocumentRequest;
use App\Models\User;

class NewDocumentRequest extends Mailable
{
    use Queueable, SerializesModels;

    public $doc;
    public $resident;

    public function __construct(DocumentRequest $doc, User $resident)
    {
        $this->doc = $doc;
        $this->resident = $resident;
    }

    public function build()
    {
        return $this->subject('New Document Request from ' . $this->resident->name)
                    ->view('emails.new-document-request');
    }
}