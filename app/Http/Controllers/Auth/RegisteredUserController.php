<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    public function create(): View
    {
        return view('auth.register');
    }

    public function emailAvailability(Request $request)
    {
        $validator = Validator::make($request->query(), [
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Enter a valid email address.'], 422);
        }

        return response()->json([
            'available' => ! User::where('email', $request->query('email'))->exists(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name'  => ['required', 'string', 'max:255'],
            'email'      => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'contact_number' => ['required', 'string', 'max:20'],
            'address'    => ['required', 'string', 'max:500'],
            'password'   => [
                'required', 'confirmed', 'string', 'min:8',
                'regex:/[A-Z]/',
                'regex:/[a-z]/',
                'regex:/[0-9]/',
                'regex:/[!@#$%^&*]/',
            ],
            'id_type'    => ['required', 'string', 'max:100'],
            'valid_id'   => ['required', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:5120'],
        ], [
            'password.min' => 'Password must contain at least 8 characters.',
            'password.regex' => 'Password must include uppercase and lowercase letters, a number, and at least one special character (!@#$%^&*).',
            'password.confirmed' => 'Passwords do not match.',
        ]);

        // Store valid ID
        $path = $request->file('valid_id')->store('valid_ids', 'public');

        $user = User::create([
            'first_name'    => $request->first_name,
            'last_name'     => $request->last_name,
            'name'          => $request->first_name . ' ' . $request->last_name,
            'email'         => $request->email,
            'contact_number'=> $request->contact_number,
            'address'       => $request->address,
            'password'      => Hash::make($request->password),
            'id_type'       => $request->id_type,
            'valid_id_path' => $path,
            'is_approved'   => false,
        ]);

        // Redirect to pending approval page
        return redirect()->route('register.pending');
    }
}
