<?php

namespace App\Http\Controllers\Resident;

use App\Http\Controllers\Controller;
use App\Models\DocumentRequest;
use App\Models\Appointment;
use App\Models\Setting;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $activeRequests = DocumentRequest::where('user_id', $user->id)
            ->where('status', 'pending')->count();
        $completedRequests = DocumentRequest::where('user_id', $user->id)
            ->where('status', 'approved')->count();
        $upcomingAppointments = Appointment::where('user_id', $user->id)
            ->where('scheduled_at', '>=', now())->count();

        $recentRequests = DocumentRequest::where('user_id', $user->id)
            ->latest()->limit(5)->get();
        $myRequests = DocumentRequest::where('user_id', $user->id)->get();
        $upcomingApptList = Appointment::where('user_id', $user->id)
            ->where('scheduled_at', '>=', now())
            ->orderBy('scheduled_at')->limit(5)->get();
        $myAppointments = Appointment::where('user_id', $user->id)->get();

        // Notifications
        $notifications = $user->notifications()->latest()->get();
        $notificationsCount = $user->unreadNotifications()->count();

        // Availability Settings
        $availabilityDays = Setting::where('key', 'availability_days')->first()?->value ?? '[0,1,2,3,4,5]';
        $availabilitySlots = Setting::where('key', 'availability_slots')->first()?->value ?? '["9:00 AM","10:00 AM","11:00 AM","2:00 PM","3:00 PM"]';
        $maxPerSlot = Setting::where('key', 'max_per_slot')->first()?->value ?? 3;

        // Get booked counts for future slots to prevent overbooking
        $bookedSlots = Appointment::where('scheduled_at', '>=', now())
            ->whereIn('status', ['pending', 'confirmed', 'review'])
            ->get()
            ->groupBy(function($date) {
                return \Carbon\Carbon::parse($date->scheduled_at)->format('Y-m-d H:i:s');
            })
            ->map(function($group) {
                return $group->count();
            });

        return view('resident.dashboard', compact(
            'activeRequests', 'completedRequests', 'upcomingAppointments',
            'recentRequests', 'myRequests', 'upcomingApptList',
            'myAppointments', 'notifications', 'notificationsCount',
            'availabilityDays', 'availabilitySlots', 'maxPerSlot', 'bookedSlots'
        ));
    }
}