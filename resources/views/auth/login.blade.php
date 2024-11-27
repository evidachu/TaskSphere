<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | LearnTogether</title>

    <!-- Bootstrap CSS (via CDN) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome (via CDN) untuk icon -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
        body {
            background: linear-gradient(135deg, #00c6ff, #0072ff);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Arial', sans-serif;
        }

        .login-container {
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        .login-container h1 {
            font-size: 3rem;
            color: #0072ff;
            margin-bottom: 30px;
            animation: fadeIn 2s ease-out;
        }

        .form-control {
            border-radius: 30px;
            margin-bottom: 15px;
        }

        .btn-custom {
            background-color: #0072ff;
            border: none;
            border-radius: 30px;
            padding: 10px 30px;
            color: white;
            font-weight: bold;
            width: 100%;
            transition: background-color 0.3s ease;
        }

        .btn-custom:hover {
            background-color: #005bb5;
        }

        .footer-text {
            margin-top: 20px;
            color: #333;
            font-size: 0.9rem;
        }

        /* Animasi fadeIn untuk judul */
        @keyframes fadeIn {
            0% { opacity: 0; }
            100% { opacity: 1; }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <!-- Judul -->
        <h1>LearnTogether</h1>
        
        <!-- Form Login -->
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Input -->
            <div class="mb-3">
                <input type="email" name="email" class="form-control" placeholder="Email" required>
            </div>

            <!-- Password Input -->
            <div class="mb-3">
                <input type="password" name="password" class="form-control" placeholder="Password" required>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn-custom">Login</button>
        </form>

        <!-- Pesan Error -->
        @if ($errors->any())
            <div class="alert alert-danger mt-3">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Footer -->
        <p class="footer-text">Belum punya akun? <a href="{{ route('register') }}" class="text-primary">Daftar sekarang</a></p>
    </div>

    <!-- Bootstrap JS (via CDN) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
