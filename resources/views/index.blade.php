<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PayGal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .sidebar {
            height: 100vh;
            width: 280px;
            background: linear-gradient(135deg, #2c3e50 0%, #3498db 100%);
            position: fixed;
            top: 0;
            left: 0;
            padding: 1.5rem;
            box-shadow: 4px 0 10px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            z-index: 1000;
        }

        .sidebar-header {
            padding-bottom: 1.5rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            margin-bottom: 1.5rem;
        }

        .sidebar-header h4 {
            color: white;
            font-weight: 600;
            margin: 0;
            font-size: 1.4rem;
        }

        .nav-item {
            margin-bottom: 0.5rem;
        }

        .sidebar a {
            color: rgba(255, 255, 255, 0.9);
            text-decoration: none;
            display: block;
            padding: 0.8rem 1rem;
            border-radius: 8px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .sidebar a:hover {
            background-color: rgba(255, 255, 255, 0.1);
            transform: translateX(5px);
        }

        .sidebar a.active {
            background-color: rgba(255, 255, 255, 0.2);
            font-weight: 600;
        }

        .btn-custom {
            background-color: #e74c3c;
            color: white;
            border: none;
            padding: 0.8rem;
            border-radius: 8px;
            width: 100%;
            margin-top: 2rem;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-custom:hover {
            background-color: #c0392b;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .btn-login {
            background-color: #27ae60;
        }

        .btn-login:hover {
            background-color: #219a52;
        }

        .content {
            margin-left: 300px;
            padding: 2rem;
            transition: all 0.3s ease;
        }

        .welcome-card {
            background-color: white;
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        }

        .user-info {
            margin-bottom: 10px;
        }

        .user-name {
            font-size: 18px;
            font-weight: bold;
            color: #333;
        }

        .user-id {
            font-size: 14px;
            color: #777;
        }

        .user-id span {
            font-weight: bold;
        }

        .guest-message {
            font-size: 16px;
            color: #ff6347;
        }


        @media (max-width: 768px) {
            .sidebar {
                width: 80px;
                padding: 1rem;
            }

            .sidebar-header h4,
            .nav-text {
                display: none;
            }

            .content {
                margin-left: 100px;
            }
        }
    </style>
</head>

<body>
    <div class="sidebar">
        <div class="sidebar-header">
            @if (auth()->check())
                <h4>{{ auth()->user()->name }}</h4>
                @if (auth()->user()->role_id == 3)
                    <p class="user-id">User ID: <span>{{ auth()->user()->id }}</span></p>
                @endif
            @else
                <h4>Belum Masuk</h4>
            @endif
        </div>

        <nav>
            <div class="nav-item">
                <a href="#" class="active">
                    <i class="bi bi-house-fill"></i>
                    <span class="nav-text">Halaman Utama</span>
                </a>
            </div>
            @if (auth()->check())
                @if (auth()->user()->role_id == 1)
                    <div class="nav-item">
                        <a href="{{ route('user') }}">
                            <i class="bi bi-person-circle"></i>
                            <span class="nav-text">Buat User</span>
                        </a>
                    </div>
                    <div class="nav-item">
                        <a href="{{ route('transaction') }}">
                            <i class="bi bi-clock-history"></i>
                            <span class="nav-text">Laporan Transaksi</span>
                        </a>
                    </div>
                @elseif(auth()->user()->role_id == 2)
                    <div class="nav-item">
                        <a href="{{ route('wallet.approvals') }}">
                            <i class="bi bi-bank2"></i>
                            <span class="nav-text">Bank Mini</span>
                        </a>
                    </div>
                    <div class="nav-item">
                        <a href="{{ route('user') }}">
                            <i class="bi bi-person-circle"></i>
                            <span class="nav-text">Buat User</span>
                        </a>
                    </div>
                    <div class="nav-item">
                        <a href="{{ route('transaction') }}">
                            <i class="bi bi-clock-history"></i>
                            <span class="nav-text">Laporan Transaksi</span>
                        </a>
                    </div>
                @elseif(auth()->user()->role_id == 3)
                    <div class="nav-item">
                        <a href="{{ route('wallet') }}">
                            <i class="bi bi-wallet2"></i>
                            <span class="nav-text">Wallet</span>
                        </a>
                    </div>
                    <div class="nav-item">
                        <a href="{{ route('transaction') }}">
                            <i class="bi bi-clock-history"></i>
                            <span class="nav-text">Laporan Transaksi</span>
                        </a>
                    </div>
                @endif
            @endif

            @if (auth()->check())
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-custom">
                        <i class="bi bi-box-arrow-right"></i>
                        <span class="nav-text">Keluar</span>
                    </button>
                </form>
            @else
                <form action="{{ route('login') }}" method="GET">
                    @csrf
                    <button type="submit" class="btn btn-custom btn-login">
                        <i class="bi bi-box-arrow-in-right"></i>
                        <span class="nav-text">Masuk</span>
                    </button>
                </form>
            @endif
        </nav>
    </div>

    <div class="content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="welcome-card text-center mb-4">
                        @if (auth()->check())
                            <h1>Selamat Datang, {{ auth()->user()->name }}!</h1>
                            <p class="text-muted">
                                Anda adalah
                                <strong>
                                    @if (auth()->user()->role_id == 1)
                                        Admin
                                    @elseif(auth()->user()->role_id == 2)
                                        Pengguna Bank Mini
                                    @elseif(auth()->user()->role_id == 3)
                                        Pengguna Biasa
                                    @else
                                        Tidak Diketahui
                                    @endif
                                </strong>
                            </p>
                            @if (auth()->user()->role_id == 3)
                                <p class="text-success">
                                    Saldo Anda:
                                    <strong>Rp{{ number_format(auth()->user()->saldo, 2, ',', '.') }}</strong>
                                </p>
                            @endif
                        @else
                            <h1 class="text-danger">PayGal</h1>
                            <p class="text-muted">Inspired by <strong>PayPal</strong></p>
                        @endif
                    </div>


                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <div class="card text-center shadow-sm">
                                <div class="card-body">
                                    <h5 class="card-title"><i class="bi bi-person-badge"></i> Admin</h5>
                                    <p class="card-text">
                                        <span class="badge bg-primary">
                                            {{ $users->filter(fn($user) => $user->role_id == 1)->count() }}
                                        </span> Pengguna
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="card text-center shadow-sm">
                                <div class="card-body">
                                    <h5 class="card-title"><i class="bi bi-bank"></i> Bank Mini</h5>
                                    <p class="card-text">
                                        <span class="badge bg-info">
                                            {{ $users->filter(fn($user) => $user->role_id == 2)->count() }}
                                        </span> Pengguna
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="card text-center shadow-sm">
                                <div class="card-body">
                                    <h5 class="card-title"><i class="bi bi-people"></i> User Aktif</h5>
                                    <p class="card-text">
                                        <span class="badge bg-secondary">
                                            {{ $users->filter(fn($user) => $user->role_id == 3)->count() }}
                                        </span> Pengguna
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
