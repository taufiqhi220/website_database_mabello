@extends('layouts.mainadmin')

@section('header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Tambah Produk Keluar</h1>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="mb-3">Form Tambah Produk Keluar</h5>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('produkkeluar.store') }}" method="POST">
                        @csrf

                        {{-- Dropdown Nama Produk --}}
                        <div class="mb-3">
                            <label for="nama_produk" class="form-label">Nama Produk</label>
                            <select class="form-control" id="nama_produk" name="nama_produk" required>
                                <option value="" disabled selected>Pilih Produk</option>
                                @foreach ($produk as $item)
                                    <option value="{{ $item->nama_produk }}" {{ old('nama_produk') == $item->nama_produk ? 'selected' : '' }}>
                                        {{ $item->nama_produk }} <!-- Menampilkan nama produk -->
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Input Tanggal Keluar --}}
                        <div class="mb-3">
                            <label for="tanggal_keluar" class="form-label">Tanggal Keluar</label>
                            <input type="date" class="form-control" id="tanggal_keluar" name="tanggal_keluar"
                                   value="{{ old('tanggal_keluar') }}" required>
                        </div>

                        {{-- Input Nomor Batch/Exp --}}
                        <div class="mb-3">
                            <label for="nomor_batch_exp" class="form-label">Nomor Batch/Exp</label>
                            <input type="text" class="form-control" id="nomor_batch_exp" name="nomor_batch_exp"
                                   value="{{ old('nomor_batch_exp') }}" required>
                        </div>

                        {{-- Dropdown Distribution Center --}}
                        <div class="mb-3">
                            <label for="distribution_center" class="form-label">Distribution Center</label>
                            <select class="form-control" id="distribution_center" name="distribution_center" required>
                                <option value="" disabled selected>Pilih Distributor</option>
                                @foreach ($distributors as $distributor)
                                    <option value="{{ $distributor->id_user }}" {{ old('distribution_center') == $distributor->id_user ? 'selected' : '' }}>
                                        {{ $distributor->nama }} <!-- Menampilkan nama distributor -->
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Input Jumlah (PCS) --}}
                        <div class="mb-3">
                            <label for="jumlah" class="form-label">Jumlah (PCS)</label>
                            <input type="number" class="form-control" id="jumlah" name="jumlah" min="1"
                                   value="{{ old('jumlah') }}" required>
                        </div>

                        {{-- Tombol Aksi --}}
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('produkkeluar.index') }}" class="btn btn-secondary">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
