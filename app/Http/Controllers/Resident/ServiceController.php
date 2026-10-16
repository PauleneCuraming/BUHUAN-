<?php

namespace App\Http\Controllers\Resident;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DocumentRequest;
use App\Models\Appointment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewDocumentRequest;
use App\Mail\NewAppointment;

class ServiceController extends Controller
{
    public function submitDocument(Request $request)
    {
        $request->validate([
            'document_type' => 'required|string',
            'purpose' => 'required|string',
            'notes' => 'nullable|string',
        ]);

        $doc = DocumentRequest::create([
            'user_id' => auth()->id(),
            'document_type' => $request->document_type,
            'purpose' => $request->purpose,
            'notes' => $request->notes,
            'status' => 'pending',
        ]);

        // Notify all admins
        $admins = \App\Models\User::where('role', 'admin')->get();
        foreach ($admins as $admin) {
            Mail::to($admin->email)->send(new NewDocumentRequest($doc, auth()->user()));
        }

        return response()->json(['success' => true, 'message' => 'Document request submitted.']);
    }

    public function submitAppointment(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'time' => 'required|string',
            'purpose' => 'required|string',
            'notes' => 'nullable|string',
        ]);

        $scheduled_at = Carbon::parse($request->date . ' ' . $request->time);

        // Enforce appointment limit per slot
        $maxPerSlot = \App\Models\Setting::where('key', 'max_per_slot')->first()?->value ?? 3;
        $bookedCount = Appointment::where('scheduled_at', $scheduled_at)
            ->whereIn('status', ['pending', 'confirmed', 'review'])
            ->count();

        if ($bookedCount >= $maxPerSlot) {
            return response()->json([
                'success' => false, 
                'message' => 'This time slot is already fully booked. Please choose another time.'
            ], 422);
        }

        $appt = Appointment::create([
            'user_id' => auth()->id(),
            'purpose' => $request->purpose,
            'notes' => $request->notes,
            'scheduled_at' => $scheduled_at,
            'status' => 'pending',
        ]);

        $admins = \App\Models\User::where('role', 'admin')->get();
        foreach ($admins as $admin) {
            Mail::to($admin->email)->send(new NewAppointment($appt, auth()->user()));
        }

        return response()->json(['success' => true, 'message' => 'Appointment request submitted.']);
    }
}