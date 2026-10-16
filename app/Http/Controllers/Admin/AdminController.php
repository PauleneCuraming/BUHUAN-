<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\DocumentRequest;
use App\Models\Appointment;
use App\Models\NotificationLog;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Notifications\ConcernStatusUpdated;
use App\Notifications\AppointmentStatusUpdated;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Statistics
        $totalApprovedResidents = User::where('role', 'resident')->where('is_approved', true)->count();
        $pendingVerifications = User::where('is_approved', false)
                                    ->whereNull('rejected_at')
                                    ->count();
        $totalRejectedResidents = User::where('role', 'resident')->whereNotNull('rejected_at')->count();
        $totalDocuments = DocumentRequest::count();
        $todayAppointments = Appointment::whereDate('scheduled_at', today())->count();

        // Pending users for verification
        $pendingUsers = User::where('is_approved', false)
                            ->whereNull('rejected_at')
                            ->latest()
                            ->get();

        // All residents (Approved & Rejected) for Manage Users
        $allResidents = User::where('role', 'resident')
                            ->where(function($query) {
                                $query->where('is_approved', true)
                                      ->orWhereNotNull('rejected_at');
                            })
                            ->latest()
                            ->get();

        // Document requests (with status)
        $documentRequests = DocumentRequest::with('user')
                            ->latest()
                            ->get();

        // Appointments (for Scheduling tab)
        $appointments = Appointment::with('user')
                            ->whereDate('scheduled_at', '>=', today())
                            ->orderBy('scheduled_at')
                            ->get();

        $apptCounts = [
            'all' => $appointments->count(),
            'pending' => $appointments->where('status', 'pending')->count(),
            'confirmed' => $appointments->where('status', 'confirmed')->count(),
            'review' => $appointments->where('status', 'review')->count(),
        ];

        // Concerns (for Concerns tab)
        $concerns = Appointment::with('user')
                            ->latest()
                            ->get();

        $concernCounts = [
            'all' => $concerns->count(),
            'pending' => $concerns->where('status', 'pending')->count(),
            'addressed' => $concerns->where('status', 'addressed')->count(),
        ];

        // Settings
        $systemName = Setting::where('key', 'system_name')->first()?->value ?? 'BUHUAN — Barangay Buhuan Online Service Management System';

        // Availability Settings
        $availabilityDays = Setting::where('key', 'availability_days')->first()?->value ?? '[0,1,2,3,4,5]';
        $availabilitySlots = Setting::where('key', 'availability_slots')->first()?->value ?? '["9:00 AM","10:00 AM","11:00 AM","2:00 PM","3:00 PM"]';
        $maxPerSlot = Setting::where('key', 'max_per_slot')->first()?->value ?? 3;

        // Get booked counts for future slots to show in the calendar
        $bookedSlots = Appointment::where('scheduled_at', '>=', today())
            ->whereIn('status', ['pending', 'confirmed', 'review'])
            ->get()
            ->groupBy(function($date) {
                return \Carbon\Carbon::parse($date->scheduled_at)->format('Y-m-d H:i:s');
            })
            ->map(function($group) {
                return $group->count();
            });

        // Notification logs 
        $notificationLogs = NotificationLog::latest()->limit(5)->get();

        return view('admin.dashboard', compact(
            'totalApprovedResidents', 'pendingVerifications', 'totalRejectedResidents', 'totalDocuments', 'todayAppointments',
            'pendingUsers', 'allResidents', 'documentRequests', 'appointments', 'notificationLogs',
            'concerns', 'systemName', 'apptCounts', 'concernCounts', 'availabilityDays', 'availabilitySlots', 'maxPerSlot', 'bookedSlots'
        ));
    }

    public function updateAvailability(Request $request)
    {
        $request->validate([
            'days' => 'required|string', 
            'slots' => 'required|string', 
            'max_per_slot' => 'required|integer|min:1',
        ]);

        Setting::updateOrCreate(['key' => 'availability_days'], ['value' => $request->days]);
        Setting::updateOrCreate(['key' => 'availability_slots'], ['value' => $request->slots]);
        Setting::updateOrCreate(['key' => 'max_per_slot'], ['value' => $request->max_per_slot]);

        return response()->json(['success' => true, 'message' => 'Availability updated successfully.']);
    }

    public function updateSystemName(Request $request)
    {
        $request->validate([
            'system_name' => 'required|string|max:255',
        ]);

        Setting::updateOrCreate(
            ['key' => 'system_name'],
            ['value' => $request->system_name]
        );

        return back()->with('success', 'System name updated successfully.');
    }

    public function updateAdminAccount(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return back()->with('success', 'Admin account updated successfully.');
    }

    public function updateConcernStatus(Request $request, $id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->status = $request->status;
        $appointment->save();

        if ($request->status === 'addressed') {
            $appointment->user->notify(new ConcernStatusUpdated($appointment));
        }

        return back()->with('success', 'Concern status updated successfully.');
    }

    public function updateAppointmentStatus(Request $request, $id)
    {
        $appointment = Appointment::findOrFail($id);
        $oldStatus = $appointment->status ?? 'pending';
        $newStatus = $request->status;

        $appointment->status = $newStatus;
        $appointment->save();

        // Notify the resident about the status update
        $appointment->user->notify(new AppointmentStatusUpdated($appointment, $oldStatus, $newStatus));

        return back()->with('success', 'Appointment status updated successfully.');
    }
}