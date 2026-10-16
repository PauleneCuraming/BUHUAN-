<?php

namespace App\Http\Controllers\Resident;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    public function update(Request $request)
    {
        $user = auth()->user();
        $field = array_key_first($request->all());
        $value = $request->input($field);

        if (in_array($field, ['first_name', 'last_name', 'contact_number', 'address'])) {
            $user->{$field} = $value;
            
            if ($field === 'first_name' || $field === 'last_name') {
                $user->name = trim(($user->first_name ?? '') . ' ' . ($user->last_name ?? ''));
            }
            
            $user->save();

            return response()->json([
                'success' => true,
                'message' => 'Profile updated successfully.'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Invalid field.'
        ], 400);
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        $request->user()->update([
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Password changed successfully.'
        ]);
    }

    public function markNotificationsRead()
    {
        auth()->user()->unreadNotifications->markAsRead();
        return response()->json(['success' => true]);
    }
}
