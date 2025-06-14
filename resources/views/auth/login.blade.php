<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - GANDENG</title>
    <link href="https://fonts.googleapis.com/css?family=Poppins:400|Inter:400" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>
    <div class="login">
        <div class="container">
            <div class="login-card">
                <img class="arrow-left" alt="Arrow left" src="{{ asset('images/arrow-left.png') }}" />
                <h1 class="title">Masuk ke GANDENG</h1>
                <form>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" required>
                    </div>
                    <div class="remember-me">
                        <input type="checkbox" id="remember" name="remember">
                        <label for="remember">Ingat saya</label>
                    </div>
                    <button type="submit" class="login-button">Masuk</button>
                </form>
                <p class="register-link">Belum punya akun? <a href="#">Daftar Sekarang</a></p>
            </div>
        </div>
    </div>
</body>
</html>
