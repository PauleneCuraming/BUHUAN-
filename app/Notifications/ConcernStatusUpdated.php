<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ConcernStatusUpdated extends Notification
{
    use Queueable;

    protected $appointment;

    public function __construct($appointment)
    {
        $this->appointment = $appointment;
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'type' => 'concern_status_updated',
            'title' => 'Concern Addressed',
            'message' => 'Your concern regarding "' . $this->appointment->purpose . '" has been marked as addressed.',
            'appointment_id' => $this->appointment->id,
            'status' => $this->appointment->status,
        ];
    }
}
