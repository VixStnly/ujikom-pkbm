@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Kelas User</h1>
        <form action="{{ route('kelas_user.update', $kelas_user->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="id_kelas">Kelas</label>
                <select name="id_kelas" id="id_kelas" class="form-control" required>
                    @foreach ($kelas as $kelas_item)
                        <option value="{{ $kelas_item->id }}" {{ $kelas_item->id == $kelas_user->id_kelas ? 'selected' : '' }}>
                            {{ $kelas_item->nama }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="user_id">Guru</label>
                <select name="user_id" id="user_id" class="form-control" required>
                    @foreach ($guru as $user)
                        <option value="{{ $user->id }}" {{ $user->id == $kelas_user->user_id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
