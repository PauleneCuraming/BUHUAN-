<!DOCTYPE html>
<html>
<head>
    <title>New Appointment Request</title>
</head>
<body>
    <h2>New Appointment Request</h2>
    <p><strong>Resident:</strong> {{ $resident->name }} ({{ $resident->email }})</p>
    <p><strong>Scheduled Date/Time:</strong> {{ $appt->scheduled_at->format('F j, Y g:i A') }}</p>
    <p><strong>Purpose:</strong> {{ $appt->purpose }}</p>
    <p><strong>Notes:</strong> {{ $appt->notes ?? '—' }}</p>
    <p>Please log into the admin dashboard to manage this appointment.</p>
</body>
</html>