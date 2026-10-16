@component('mail::message')
# Account Approved

Dear {{ $user->first_name }},

Your BUHUAN account has been **approved** by the barangay administrator.

You can now log in and access all barangay services online.

@component('mail::button', ['url' => route('login')])
Login to BUHUAN
@endcomponent

Thank you for registering.

Barangay Buhuan, Calapan City
@endcomponent