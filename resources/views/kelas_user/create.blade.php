<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assign Users to Kelas</title>
</head>
<body>
    <h1>Assign Users to Kelas</h1>
    <form action="{{ route('kelas_user.store') }}" method="POST">
        @csrf
        <label for="grade">Grade:</label>
        <select name="grade" id="grade" onchange="handleGradeChange(event)">
            <option value="">Select Grade</option>
            @foreach($grades as $grade)
                <option value="{{ $grade->grade }}">{{ $grade->grade }}</option>
            @endforeach
        </select>
        
        <label for="kelas_id">Kelas:</label>
        <select name="kelas_id" id="kelas_id">
            <option value="">Select Kelas</option>
        </select>
        
        <label for="user_id">Users:</label>
        <select name="user_id[]" id="user_id" multiple>
            @foreach($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
        </select>
        
        <button type="submit">Assign</button>
    </form>
</body>
</html>
