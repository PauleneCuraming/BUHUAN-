@component('mail::message')
# Account Update

Dear {{ $user->first_name }},

We regret to inform you that your account registration was **not approved** at this time.

@if($reason)
**Reason:** {{ $reason }}
@endif

If you believe this is an error, please visit the Barangay Hall of Buhuan for assistance.

@endcomponent