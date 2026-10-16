<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DocumentRequest;
use App\Notifications\DocumentStatusUpdated;
use Illuminate\Http\Request;

class DocumentRequestController extends Controller
{
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,approved,rejected,ready'
        ]);

        $document = DocumentRequest::with('user')->findOrFail($id);
        $oldStatus = $document->status;
        $newStatus = $request->status;

        // Update status
        $document->status = $newStatus;
        $document->save();

        // Notify resident only if status changed
        if ($oldStatus !== $newStatus && $document->user) {
            $document->user->notify(new DocumentStatusUpdated($document, $oldStatus, $newStatus));
        }

        return redirect()->back()->with('success', "Document request #{$document->id} status updated to " . ucfirst($newStatus));
    }
}