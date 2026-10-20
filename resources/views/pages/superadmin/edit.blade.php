@extends('layouts.main')

@section('content')
    <div class="container">
        <h1>Edit Profile</h1>
        
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-warning">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('profile.update', $user->id) }}" method="POST" novalidate>
            @csrf
            @method('PUT') <!-- Memberitahu Laravel bahwa ini permintaan PUT -->
        
            <div class="mb-3">
                <label for="id_user" class="form-label">ID Pengguna</label>
                <input type="text" class="form-control" id="id_user" name="id_user" value="{{ old('id_user', $user->id_user) }}" required>
            </div>
        
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama', $user->nama) }}" required>
            </div>
        
            <div class="mb-3">
                <label for="password" class="form-label">Password Baru</label>
                <input type="password" class="form-control" id="password" name="password" minlength="6" placeholder="Password Baru">
            </div>            
        
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
