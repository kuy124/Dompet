<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PayGal | Bank Mini</title>
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

        .content {
            margin-left: 300px;
            padding: 2rem;
            transition: all 0.3s ease;
        }

        .approvals-container {
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            padding: 2rem;
        }

        .transaction-card {
            background-color: #f4f6f7;
            border-radius: 10px;
            padding: 1.5rem;
            margin-bottom: 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: all 0.3s ease;
        }

        .transaction-details {
            flex-grow: 1;
        }

        .transaction-actions {
            display: flex;
            gap: 0.5rem;
        }

        .btn-approve,
        .btn-reject {
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 6px;
            transition: all 0.3s ease;
        }

        .btn-approve {
            background-color: #27ae60;
            color: white;
        }

        .btn-approve:hover {
            background-color: #219a52;
        }

        .btn-reject {
            background-color: #e74c3c;
            color: white;
        }

        .btn-reject:hover {
            background-color: #c0392b;
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

            .transaction-card {
                flex-direction: column;
                align-items: flex-start;
            }

            .transaction-actions {
                width: 100%;
                margin-top: 1rem;
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
                <a href="{{ route('index') }}">
                    <i class="bi bi-house-fill"></i>
                    <span class="nav-text">Halaman Utama</span>
                </a>
            </div>
            @if (auth()->check())
                @if (auth()->user()->role_id == 2)
                    <div class="nav-item">
                        <a href="#" class="active">
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

    @if (auth()->user()->role_id == 2)
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="approvals-container mb-5">
                            <h2 class="mb-4">
                                <i class="bi bi-bank me-2"></i>Bank Mini
                            </h2>
                            <div class="row">
                                @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @elseif ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <div class="col-md-6">
                                    <form action="{{ route('wallet.bankMiniTopUp') }}" method="POST"
                                        class="card p-4 shadow-sm">
                                        @csrf
                                        <h4 class="mb-3">Top-Up Saldo</h4>
                                        <div class="mb-3">
                                            <label for="user_id_topup" class="form-label">Masukkan ID Pengguna</label>
                                            <input type="text" name="user_id" id="user_id_topup" class="form-control"
                                                required>
                                            <p id="user_name_topup" class="mt-2 text-muted" style="display: none;"></p>
                                        </div>
                                        <div class="mb-3">
                                            <label for="saldo" class="form-label">Jumlah Saldo</label>
                                            <input type="text" name="saldo" id="saldo" class="form-control"
                                                required>
                                        </div>
                                        <button type="submit" class="btn btn-success">
                                            <i class="bi bi-arrow-up-circle me-2"></i>Top-Up
                                        </button>
                                    </form>
                                </div>

                                <div class="col-md-6">
                                    <form action="{{ route('wallet.bankMiniWithdraw') }}" method="POST"
                                        class="card p-4 shadow-sm">
                                        @csrf
                                        <h4 class="mb-3">Penarikan Saldo</h4>
                                        <div class="mb-3">
                                            <label for="user_id_withdraw" class="form-label">Masukkan ID
                                                Pengguna</label>
                                            <input type="text" name="user_id" id="user_id_withdraw"
                                                class="form-control" required>
                                            <p id="user_name_withdraw" class="mt-2 text-muted" style="display: none;">
                                            </p>
                                        </div>
                                        <div class="mb-3">
                                            <label for="saldo_withdraw" class="form-label">Jumlah Saldo</label>
                                            <input type="text" name="saldo" id="saldo_withdraw"
                                                class="form-control" required>
                                        </div>
                                        <button type="submit" class="btn btn-danger">
                                            <i class="bi bi-arrow-down-circle me-2"></i>Withdraw
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="approvals-container">
                            <h2 class="mb-4">
                                <i class="bi bi-hourglass-split me-2"></i>Persetujuan Tertunda
                            </h2>
                            @forelse ($transactions as $transaction)
                                <div class="transaction-card">
                                    <div class="transaction-details">
                                        <h5>{{ $transaction->user->name }}</h5>
                                        <p class="text-muted mb-1">
                                            Tipe: @if ($transaction->type == 'top_up')
                                                Top Up
                                            @elseif($transaction->type == 'transfer')
                                                Transfer
                                            @else
                                                Tarik Tunai
                                            @endif |
                                            Status: {{ $transaction->status }}
                                        </p>
                                        <p class="fw-bold text-success">
                                            Jumlah: Rp{{ number_format($transaction->saldo, 2, ',', '.') }}
                                        </p>
                                    </div>
                                    <div class="transaction-actions">
                                        <form action="{{ route('wallet.approve', $transaction->id) }}" method="POST"
                                            class="m-0">
                                            @csrf
                                            <button type="submit" class="btn btn-approve">
                                                <i class="bi bi-check-lg me-1"></i>Setujui
                                            </button>
                                        </form>
                                        <form action="{{ route('wallet.reject', $transaction->id) }}" method="POST"
                                            class="m-0">
                                            @csrf
                                            <button type="submit" class="btn btn-reject">
                                                <i class="bi bi-x-lg me-1"></i>Tolak
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center text-muted py-4">
                                    <i class="bi bi-inbox-fill fs-1 mb-3 d-block"></i>
                                    <p>Tidak ada transaksi yang menunggu persetujuan</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        var currentUserId = @json(auth()->user()->id);
    </script>
    <script>
        // Setup event listener for 'user_id_topup' input
        document.getElementById('user_id_topup').addEventListener('input', function() {
            var userId = this.value;

            var userNameDisplay = document.getElementById('user_name_topup');

            if (userId) {
                if (userId === currentUserId.toString()) {
                    userNameDisplay.textContent = "Tidak ada User";
                    userNameDisplay.style.display = 'block';
                } else {
                    fetchUserName(userId, userNameDisplay);
                }
            } else {
                userNameDisplay.style.display = 'none';
            }
        });

        // Setup event listener for 'user_id_withdraw' input
        document.getElementById('user_id_withdraw').addEventListener('input', function() {
            var userId = this.value;

            var userNameDisplay = document.getElementById('user_name_withdraw');

            if (userId) {
                if (userId === currentUserId.toString()) {
                    userNameDisplay.textContent = "Tidak ada User";
                    userNameDisplay.style.display = 'block';
                } else {
                    fetchUserName(userId, userNameDisplay);
                }
            } else {
                userNameDisplay.style.display = 'none';
            }
        });

        // Function to fetch user name and display it
        function fetchUserName(userId, displayElement) {
            fetch(`/get-user-name/${userId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.name === 'Tidak ada User') {
                        displayElement.textContent = "Tidak ada User";
                        displayElement.style.display = 'block';
                    } else if (data.name) {
                        displayElement.textContent = "Pengguna: " + data.name;
                        displayElement.style.display = 'block';
                    } else {
                        displayElement.textContent = "Tidak ada user";
                        displayElement.style.display = 'block';
                    }
                })
                .catch(error => console.log('Error fetching user name:', error));
        }
    </script>


</body>

</html>
