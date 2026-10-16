<?php

namespace App\Notifications;

use App\Models\DocumentRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class DocumentStatusUpdated extends Notification
{
    use Queueable;

    protected $document;
    protected $oldStatus;
    protected $newStatus;

    public function __construct(DocumentRequest $document, $oldStatus, $newStatus)
    {
        $this->document = $document;
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
            'approved' => ['color' => 'green', 'icon' => '✅', 'label' => 'Approved'],
            'rejected' => ['color' => 'red',   'icon' => '❌', 'label' => 'Rejected'],
            'ready'    => ['color' => 'gold',  'icon' => '📄', 'label' => 'Ready for Pickup'],
            'pending'  => ['color' => 'gold',  'icon' => '⏳', 'label' => 'Pending'],
        ];

        $color = $statusMap[$this->newStatus]['color'] ?? 'gold';
        $icon  = $statusMap[$this->newStatus]['icon']  ?? '📄';
        $label = $statusMap[$this->newStatus]['label'] ?? ucfirst($this->newStatus);

        return [
            'title'   => "Document Request #{$this->document->id} – {$label}",
            'message' => "Your {$this->document->document_type} request has been updated from " . ucfirst($this->oldStatus) . " to {$label}.",
            'color'   => $color,
            'icon'    => $icon,
            'type'    => 'document',
            'document_id' => $this->document->id,
        ];
    }
}