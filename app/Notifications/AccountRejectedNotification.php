<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class AccountRejectedNotification extends Notification
{
    use Queueable;

    public $reason;

    public function __construct($reason = null)
    {
        $this->reason = $reason;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'title' => 'Account Rejected',
            'message' => 'Your account registration was not approved.' . ($this->reason ? ' Reason: ' . $this->reason : ''),
            'type' => 'account',
            'icon' => '❌',
            'color' => 'red',
        ];
    }
}
