<?php

namespace App\Notifications;

use App\Models\Appointment;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class AppointmentStatusUpdated extends Notification
{
    use Queueable;

    protected $appointment;
    protected $oldStatus;
    protected $newStatus;

    public function __construct(Appointment $appointment, $oldStatus, $newStatus)
    {
        $this->appointment = $appointment;
        $this->oldStatus = $oldStatus;
        $this->newStatus = $newStatus;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        $statusMap = [
            'confirmed' => ['color' => 'green', 'icon' => '✅', 'label' => 'Confirmed'],
            'review'    => ['color' => 'gold',  'icon' => '📋', 'label' => 'Under Review'],
            'cancelled' => ['color' => 'red',   'icon' => '❌', 'label' => 'Cancelled'],
            'pending'   => ['color' => 'gold',  'icon' => '⏳', 'label' => 'Pending'],
        ];

        $color = $statusMap[$this->newStatus]['color'] ?? 'gold';
        $icon  = $statusMap[$this->newStatus]['icon']  ?? '📅';
        $label = $statusMap[$this->newStatus]['label'] ?? ucfirst($this->newStatus);

        $dateStr = $this->appointment->scheduled_at->format('M d, Y');

        return [
            'title'   => "Appointment Update – {$label}",
            'message' => "Your appointment for \"{$this->appointment->purpose}\" on {$dateStr} has been updated to {$label}.",
            'color'   => $color,
            'icon'    => $icon,
            'type'    => 'appointment',
            'appointment_id' => $this->appointment->id,
        ];
    }
}
