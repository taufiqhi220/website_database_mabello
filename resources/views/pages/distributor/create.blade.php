@extends('layouts.main')

@section('header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Tambah Distributor</h1>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="mb-3">Form Tambah Distributor</h5>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('distributors.store') }}" method="POST">
                        @csrf

                        {{-- Input Username --}}
                        <div class="mb-3">
                            <label for="id_user" class="form-label">Username</label>
                            <input type="text" class="form-control" id="id_user" name="id_user" value="{{ old('id_user') }}" required>
                        </div>

                        {{-- Input Nama Distributor --}}
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Distributor</label>
                            <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama') }}" required>
                        </div>

                        {{-- Input Password --}}
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>

                        {{-- Dropdown Posisi --}}
                        <div class="mb-3">
                            <label for="posisi" class="form-label">Posisi</label>
                            <select class="form-control" id="posisi" name="posisi" required>
                                <option value="distributor" selected>Distributor</option>
                                <!-- Anda bisa menambahkan opsi lainnya jika diperlukan -->
                            </select>
                        </div>

                        {{-- Tombol Aksi --}}
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('distributors.index') }}" class="btn btn-secondary">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
