<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class AccountApprovedNotification extends Notification
{
    use Queueable;

    public function __construct()
    {
        //
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'title' => 'Account Approved',
            'message' => 'Your account has been successfully approved by the admin. You now have full access to resident services.',
            'type' => 'account',
            'icon' => '✅',
            'color' => 'green',
        ];
    }
}
