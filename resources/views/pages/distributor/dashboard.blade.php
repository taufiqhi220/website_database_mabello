@extends('layouts.maindistributor')

@section('header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Dashboard Distributor</h1>
        </div>
    </div>
@endsection

@section('content')
    <div class="row mb-4">
        <div class="col-md-6">
            <h2>Hello, {{ $user->nama }}!</h2>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body d-flex align-items-center">
                    <!-- Foto Profil -->
                    <div style="margin-right: 20px;">
                        <img src="{{ asset('templates/dist/img/user.jpg') }}" alt="Foto Profil" class="rounded-circle" width="100" height="100">
                    </div>

                    <!-- Informasi User -->
                    <div>
                        <h5 class="mb-1">Nama: {{ $user->nama }}</h5>
                        <p class="mb-1">Username: {{ $user->id_user }}</p>
                        <p class="mb-1">Password: {{ $maskedPassword }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
