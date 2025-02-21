<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PayGal | Wallet</title>
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

        .wallet-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            margin-bottom: 2rem;
            transition: all 0.3s ease;
        }

        .balance-display {
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            color: white;
            padding: 1.5rem;
            border-radius: 10px;
            text-align: center;
            margin-bottom: 1.5rem;
        }

        .wallet-actions {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
        }

        .wallet-form {
            background-color: #f4f6f7;
            border-radius: 10px;
            padding: 1.5rem;
            transition: all 0.3s ease;
        }

        .wallet-form:hover {
            background-color: #ecf0f1;
        }

        .form-input {
            width: 100%;
            padding: 0.75rem;
            margin-bottom: 1rem;
            border: 1px solid #e0e0e0;
            border-radius: 6px;
            transition: all 0.3s ease;
        }

        .form-input:focus {
            outline: none;
            border-color: #3498db;
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.2);
        }

        .form-button {
            width: 100%;
            padding: 0.75rem;
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 6px;
            transition: all 0.3s ease;
        }

        .form-button:hover {
            background-color: #2980b9;
            transform: translateY(-2px);
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

            .wallet-actions {
                grid-template-columns: 1fr;
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
                @if (auth()->user()->role_id == 3)
                    <div class="nav-item">
                        <a href="#" class="active">
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
    @if (auth()->user()->role_id == 3)
        <div class="content">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-10">
                        <div class="wallet-card">
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
                            @if (auth()->check())
                                <div class="balance-display">
                                    <h2>Saldo Anda</h2>
                                    <h1 class="display-4">
                                        Rp{{ number_format(auth()->user()->saldo, 2, ',', '.') }}
                                    </h1>
                                </div>
                            @else
                                <div class="text-center mb-4">
                                    <h1 class="text-danger">PayGal</h1>
                                    <p class="text-muted">Inspired by <strong>PayPal</strong></p>
                                </div>
                            @endif

                            <div class="wallet-actions">
                                <form action="{{ route('wallet.topup') }}" method="POST" class="wallet-form">
                                    @csrf
                                    <h3 class="mb-3 text-center">Top Up</h3>
                                    <input type="number" name="saldo" placeholder="Masukkan Jumlah" required
                                        class="form-input">
                                    <button type="submit" class="form-button">
                                        <i class="bi bi-plus-circle me-2"></i>Top Up
                                    </button>
                                </form>

                                <form action="{{ route('wallet.transfer') }}" method="POST" class="wallet-form">
                                    @csrf
                                    <h3 class="mb-3 text-center">Transfer</h3>

                                    <input type="number" name="saldo" placeholder="Jumlah Transfer" required
                                        class="form-input">

                                    <input type="number" id="recipient_id" name="recipient_id"
                                        placeholder="ID Penerima" required class="form-input">

                                    <div id="recipient_name" class="form-input" style="display:none;"></div>

                                    <button type="submit" class="form-button">
                                        <i class="bi bi-arrow-right-circle me-2"></i>Transfer
                                    </button>
                                </form>


                                <form action="{{ route('wallet.withdraw') }}" method="POST" class="wallet-form">
                                    @csrf
                                    <h3 class="mb-3 text-center">Tarik Dana</h3>
                                    <input type="number" name="saldo" placeholder="Jumlah Penarikan" required
                                        class="form-input">
                                    <button type="submit" class="form-button">
                                        <i class="bi bi-cash me-2"></i>Tarik Dana
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="content">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-10">
                        <div>
                            <h2>ACCESS DENIED</h2>
                            <h1 class="display-4">
                                ANDA BUKAN USER
                            </h1>
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
        document.getElementById('recipient_id').addEventListener('input', function() {
            var recipientId = this.value;

            if (recipientId) {
                if (recipientId === currentUserId.toString()) {
                    document.getElementById('recipient_name').textContent = "Tidak ada User";
                    document.getElementById('recipient_name').style.display = 'block';
                } else {
                    fetchRecipientName(recipientId);
                }
            } else {
                document.getElementById('recipient_name').style.display = 'none';
            }
        });

        function fetchRecipientName(recipientId) {
            fetch(`/get-recipient-name/${recipientId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.name === 'Tidak ada User') {
                        document.getElementById('recipient_name').textContent = "Tidak ada User";
                        document.getElementById('recipient_name').style.display = 'block';
                    } else if (data.name) {
                        document.getElementById('recipient_name').textContent = "Penerima: " + data.name;
                        document.getElementById('recipient_name').style.display = 'block';
                    } else {
                        document.getElementById('recipient_name').textContent = "Tidak ada user";
                        document.getElementById('recipient_name').style.display = 'block';
                    }
                })
                .catch(error => console.log('Error fetching recipient name:', error));
        }
    </script>

</body>

</html>
