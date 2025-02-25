@extends('layouts.admin')

@section('content')
    <div class="container">
        <h2>Edit Absensi</h2>

        <form action="{{ route('admin.absensi.update', $absensi->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="user_id">User</label>
                <select name="user_id" class="form-control" required>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" {{ $absensi->user_id == $user->id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="meeting_id">Meeting</label>
                <select name="meeting_id" class="form-control" required>
                    @foreach ($meetings as $meeting)
                        <option value="{{ $meeting->id }}" {{ $absensi->meeting_id == $meeting->id ? 'selected' : '' }}>
                            {{ $meeting->title }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="tanggal_absen">Tanggal Absen</label>
                <input type="date" name="tanggal_absen" class="form-control" value="{{ $absensi->tanggal_absen }}" required>
            </div>

            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" class="form-control" required>
                    <option value="Hadir" {{ $absensi->status == 'Hadir' ? 'selected' : '' }}>Hadir</option>
                    <option value="Tidak Hadir" {{ $absensi->status == 'Tidak Hadir' ? 'selected' : '' }}>Tidak Hadir</option>
                    <option value="Izin" {{ $absensi->status == 'Izin' ? 'selected' : '' }}>Izin</option>
                </select>
            </div>

            <button type="submit" class="btn btn-success">Update</button>
        </form>
    </div>
@endsection
