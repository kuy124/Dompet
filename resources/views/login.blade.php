<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f5f5f5;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-container {
            background-color: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        .login-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .login-header h1 {
            font-size: 2rem;
            color: #333;
            margin-bottom: 0.5rem;
        }

        .form-control {
            padding: 0.8rem;
            border-radius: 5px;
            border: 1px solid #ddd;
            margin-bottom: 1rem;
        }

        .form-control:focus {
            border-color: #666;
            box-shadow: 0 0 0 0.2rem rgba(0, 0, 0, 0.1);
        }

        .password-wrapper {
            position: relative;
        }

        .btn-custom {
            width: 100%;
            padding: 0.8rem;
            font-size: 1.1rem;
            margin-top: 1rem;
            background-color: #333;
            border: none;
            transition: background-color 0.3s ease;
        }

        .btn-custom:hover {
            background-color: #555;
        }

        .form-check {
            margin-top: -0.5rem;
            margin-bottom: 1rem;
        }

        .form-check-label {
            color: #666;
            font-size: 0.9rem;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="login-header">
            <h1>Login</h1>
            <p class="text-muted">Silakan masuk ke akun Anda</p>
        </div>

        <form method="POST" action="{{ route('login') }}">
            @csrf
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="form-group mb-3">
                <input type="email" class="form-control" id="email" name="email" placeholder="Email Address"
                    required autofocus>
            </div>
            <div class="form-group mb-3 password-wrapper">
                <input type="password" class="form-control" id="password" name="password" placeholder="Password"
                    required>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" role="switch" id="showPassword"
                        onclick="togglePassword()">
                    <label class="form-check-label" for="showPassword">Lihat Password</label>
                </div>
            </div>

            <button type="submit" class="btn btn-dark btn-custom">Login</button>
        </form>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const showPasswordCheckbox = document.getElementById('showPassword');
            passwordInput.type = showPasswordCheckbox.checked ? 'text' : 'password';
        }
    </script>
</body>

</html>
