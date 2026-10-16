<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\AccountApproved;
use App\Mail\AccountRejected;
use App\Notifications\AccountApprovedNotification;
use App\Notifications\AccountRejectedNotification;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display pending users (is_approved = false and not rejected)
     */
    public function pending()
    {
        $pendingUsers = User::where('is_approved', false)
                            ->whereNull('rejected_at')
                            ->latest()
                            ->paginate(10);
        return view('admin.users.pending', compact('pendingUsers'));
    }

    /**
     * Approve a user account
     */
    public function approve(User $user)
    {
        $user->update([
            'is_approved' => true,
            'rejected_at' => null,
            'rejection_reason' => null,
            'approved_at' => now(),
        ]);

        // Send email notification
        Mail::to($user->email)->send(new AccountApproved($user));
        
        // Send dashboard notification
        $user->notify(new AccountApprovedNotification());

        return redirect()->back()->with('success', 'User account approved successfully. Notifications sent.');
    }

    /**
     * Reject a user account with optional reason
     */
    public function reject(Request $request, User $user)
    {
        $request->validate([
            'reason' => 'nullable|string|max:500',
        ]);

        $user->update([
            'is_approved' => false,
            'rejected_at' => now(),
            'rejection_reason' => $request->reason,
        ]);

        // Send email notification
        Mail::to($user->email)->send(new AccountRejected($user, $request->reason));

        // Send dashboard notification
        $user->notify(new AccountRejectedNotification($request->reason));

        return redirect()->back()->with('success', 'User account rejected. Notifications sent.');
    }

    /**
     * Show edit form (returning JSON for modal)
     */
    public function edit(User $user)
    {
        return response()->json($user);
    }

    /**
     * Update user details
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'address' => 'nullable|string|max:500',
            'contact_number' => 'nullable|string|max:20',
        ]);

        $user->update($request->only(['first_name', 'last_name', 'email', 'address', 'contact_number']));

        return redirect()->back()->with('success', 'User updated successfully.');
    }

    /**
     * Delete user account
     */
    public function destroy(User $user)
    {
        // Optional: Delete physical ID file
        if ($user->valid_id_path) {
            Storage::disk('public')->delete($user->valid_id_path);
        }

        $user->delete();

        return redirect()->back()->with('success', 'User account deleted successfully.');
    }
}