@extends('layouts.mainadmin')

@section('header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Manajement Tambah Produk</h1>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="mb-3">Form Tambah Produk</h5>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('produk.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="kode_produk" class="form-label">Kode Produk</label>
                            <input type="text" class="form-control" id="kode_produk" name="kode_produk" 
                                   value="{{ old('kode_produk') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="nama_produk" class="form-label">Nama Produk</label>
                            <input type="text" class="form-control" id="nama_produk" name="nama_produk" 
                                   value="{{ old('nama_produk') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="sisa_pcs" class="form-label">Sisa PCS</label>
                            <input type="number" class="form-control" id="sisa_pcs" name="sisa_pcs" 
                                   value="{{ old('sisa_pcs', 0) }}" min="0" required>
                        </div>

                        <div class="mb-3">
                            <label for="sisa_dos" class="form-label">Sisa DOS</label>
                            <input type="number" class="form-control" id="sisa_dos" name="sisa_dos" 
                                   value="{{ old('sisa_dos', 0) }}" min="0" required>
                        </div>

                        <div class="mb-3">
                            <label for="pcs_per_dos" class="form-label">PCS per DOS</label>
                            <input type="number" class="form-control" id="pcs_per_dos" name="pcs_per_dos" 
                                   value="{{ old('pcs_per_dos') }}" min="1" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('produk.index') }}" class="btn btn-secondary">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
