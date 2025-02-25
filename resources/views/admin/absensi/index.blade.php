@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Absensi List</h2>
        <a href="{{ route('admin.absensi.create') }}" class="btn btn-primary">Add New Absensi</a>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User</th>
                    <th>Meeting</th>
                    <th>Tanggal Absen</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($absensi as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->user->name }}</td>
                        <td>{{ $item->meeting->title }}</td>
                        <td>{{ $item->tanggal_absen }}</td>
                        <td>{{ $item->status }}</td>
                        <td>
                            <a href="{{ route('admin.absensi.edit', $item->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('admin.absensi.destroy', $item->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
