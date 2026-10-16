<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function update(Request $request)
    {
        $request->validate([
            'first_name'     => 'sometimes|required|string|max:255',
            'last_name'      => 'sometimes|required|string|max:255',
            'contact_number' => 'nullable|string|max:20',
            'address'        => 'nullable|string|max:500',
        ]);

        $user = auth()->user();
        if ($request->has('first_name')) $user->first_name = $request->first_name;
        if ($request->has('last_name'))  $user->last_name  = $request->last_name;
        if ($request->has('contact_number')) $user->contact_number = $request->contact_number;
        if ($request->has('address')) $user->address = $request->address;
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Profile updated successfully.'
        ]);
    }

    public function markNotificationsRead(Request $request)
    {
        auth()->user()->unreadNotifications->markAsRead();
        return response()->json(['success' => true]);
    }
}