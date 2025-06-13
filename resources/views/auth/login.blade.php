<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk ke GANDENG</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Gaya dasar untuk layout halaman login */
        body {
            background-color: #f8f9fa; /* Warna latar belakang umum */
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }
        .login-container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px; /* Batasi lebar container */
        }
        .btn-gandeng {
            background-color: #28a745; /* Warna hijau untuk tombol 'Masuk' */
            color: white;
            border: none;
        }
        .btn-gandeng:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <a href="{{ route('landing') }}" class="text-decoration-none text-dark mb-3 d-block">
            &leftarrow;
        </a>
        <h4 class="mb-4 text-center">Masuk ke GANDENG</h4>

        <form method="POST" action="{{ route('login') }}">
            @csrf <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required autofocus>
                @error('email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
                @error('password')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                <label class="form-check-label" for="remember">Ingat saya</label>
            </div>

            <button type="submit" class="btn btn-gandeng w-100 mb-3">Masuk</button>

            <p class="text-center">Belum punya akun? <a href="{{ route('register') }}">Daftar Sekarang</a></p>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>