<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Memanggil file CSS yang telah disimpan di public/css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>
    <div class="container-fluid login-container">
        <div class="login-box text-center">
            <!-- Logo -->
            <img src="templates/dist/img/Mabello logo.png" alt="Logo" class="login-logo d-block mx-auto">

            <h3 class="text-center mb-4">LOGIN</h3>

            <!-- Menampilkan pesan sukses atau error -->
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Form Login -->
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="id_user" class="form-label">ID Username</label>
                    <input type="text" id="id_user" name="id_user" class="form-control" value="{{ old('id_user') }}" required>
                </div>
                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" id="password" name="password" class="form-control" required>
                </div>
                <div class="button-group">
                    <button type="submit" class="btn btn-primary">Login</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
