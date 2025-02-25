<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $data['subject'] }}</title>
</head>
<body>

<h1>{{ $data['subject'] }}</h1>
<p>Anda menerima pesan baru dari: {{ $data['name'] }} ({{ $data['email'] }})</p>
<p>Pesan:</p>
<p>{{ $data['message'] }}</p>


</body>
</html>