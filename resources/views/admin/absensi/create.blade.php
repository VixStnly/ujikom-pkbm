@extends('layouts.admin')

@section('content')
    <div class="container">
        <h2>Add New Absensi</h2>

        <form action="{{ route('admin.absensi.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="user_id">User</label>
                <select name="user_id" class="form-control" required>
                    <option value="">Select User</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="meeting_id">Meeting</label>
                <select name="meeting_id" class="form-control" required>
                    <option value="">Select Meeting</option>
                    @foreach ($meetings as $meeting)
                        <option value="{{ $meeting->id }}">{{ $meeting->title }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="tanggal_absen">Tanggal Absen</label>
                <input type="date" name="tanggal_absen" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" class="form-control" required>
                    <option value="Hadir">Hadir</option>
                    <option value="Tidak Hadir">Tidak Hadir</option>
                    <option value="Izin">Izin</option>
                </select>
            </div>

            <button type="submit" class="btn btn-success">Submit</button>
        </form>
    </div>
@endsection
