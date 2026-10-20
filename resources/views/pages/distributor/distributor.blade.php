@extends('layouts.main')

@section('header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Manajemen Distributor</h1>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="m-0">Daftar Distributor</h5>
                        <a href="{{ route('distributors.create') }}" class="btn btn-primary btn-sm">Tambah Distributor</a>
                    </div>
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Username</th>
                                <th>Nama</th>
                                <th>Password</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($distributors as $index => $distributor)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $distributor->id_user }}</td>
                                    <td>{{ $distributor->nama }}</td>
                                    <td>********</td> <!-- Password di-mask untuk keamanan -->
                                    <td>
                                        <a href="{{ route('distributors.edit', $distributor->id_user) }} " class="btn btn-sm btn-warning">Edit</a>
                                        <form action="{{ route('distributors.destroy', $distributor->id_user) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus distributor ini?')">Hapus</button>
                                        </form>                                        
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">Tidak ada data distributor.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
