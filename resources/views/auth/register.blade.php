<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - MovieApp</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #284672;
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #1b2e4b, #284672);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-container,
        .register-container {
            max-width: 450px;
            width: 100%;
            padding: 2rem;
            background: #ffffff;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.25);
            animation: fadeIn 0.8s ease-in-out;
        }

        h3 {
            color: #0d6efd;
            font-weight: bold;
            text-align: center;
        }

        .form-label {
            font-weight: 500;
        }

        .btn-primary,
        .btn-success {
            padding: 10px;
            font-weight: 600;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .btn-primary:hover,
        .btn-success:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(13, 110, 253, 0.4);
        }

        .alert {
            border-radius: 8px;
            font-size: 0.9rem;
        }

        .text-white {
            color: #fff !important;
        }

        .text-warning {
            color: #ffc107 !important;
            font-weight: 500;
            text-decoration: underline;
        }

        .text-warning:hover {
            color: #e0a800 !important;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>

    <div class="register-container">
        <h3 class="text-center mb-4">Daftar ke MovieApp</h3>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('register') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Nama</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}"
                    required autofocus>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Alamat Email</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}"
                    required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Kata Sandi</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Konfirmasi Kata Sandi</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control"
                    required>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Daftar</button>
            </div>

            <p class="mt-3 text-center">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="text-primary">Login</a>
            </p>

        </form>
    </div>

</body>

</html>
