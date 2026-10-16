<!DOCTYPE html>
<html>
<head>
    <title>New Document Request</title>
</head>
<body>
    <h2>New Document Request</h2>
    <p><strong>Resident:</strong> {{ $resident->name }} ({{ $resident->email }})</p>
    <p><strong>Document Type:</strong> {{ $doc->document_type }}</p>
    <p><strong>Purpose:</strong> {{ $doc->purpose }}</p>
    <p><strong>Notes:</strong> {{ $doc->notes ?? '—' }}</p>
    <p>Please log into the admin dashboard to review this request.</p>
</body>
</html>