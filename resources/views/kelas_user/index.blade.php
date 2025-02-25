<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelas User Index</title>
</head>
<body>
    <h1>Kelas User Index</h1>
    <a href="{{ route('kelas_user.create') }}">Assign User to Kelas</a>
    <table border="1">
        <thead>
            <tr>
                <th>Kelas</th>
                <th>Grade</th>
                <th>Users</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($kelasUsers as $kelas)
                <tr>
                    <td>{{ $kelas->name }}</td>
                    <td>{{ $kelas->grade }}</td>
                    <td>
                        @foreach($kelas->users as $user)
                            {{ $user->name }}<br>
                        @endforeach
                    </td>
                    
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
