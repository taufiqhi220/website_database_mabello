@extends('layouts.main')

@section('header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Manajemen Admin</h1>
        </div>
    </div> 
@endsection

@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="m-0">Daftar Admin</h5>
                        <a href="{{ route('admins.create') }}" class="btn btn-primary btn-sm">Tambah Admin</a>
                    </div>
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Username</th>
                                <th>Nama</th>
                                <th>Password</th> <!-- Menambahkan kolom password -->
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($admins as $index => $admin)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $admin->id_user }}</td> <!-- Gunakan id_user sebagai username -->
                                    <td>{{ $admin->nama }}</td> <!-- Gunakan nama admin sesuai model -->
                                    <td>********</td> <!-- Password di-mask untuk keamanan -->
                                    <td>
                                        <a href="{{ route('admins.edit', $admin->id_user) }}" class="btn btn-sm btn-warning">Edit</a>
                                        <form action="{{ route('admins.destroy', $admin->id_user) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus admin ini?')">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">Tidak ada data admin.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
