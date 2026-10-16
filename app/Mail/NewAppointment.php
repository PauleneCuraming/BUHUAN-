<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Appointment;
use App\Models\User;

class NewAppointment extends Mailable
{
    use Queueable, SerializesModels;

    public $appt;
    public $resident;

    public function __construct(Appointment $appt, User $resident)
    {
        $this->appt = $appt;
        $this->resident = $resident;
    }

    public function build()
    {
        return $this->subject('New Appointment Request from ' . $this->resident->name)
                    ->view('emails.new-appointment');
    }
}