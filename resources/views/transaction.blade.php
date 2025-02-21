<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PayGal | Riwayat Transaksi</title>
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

        .transactions-container {
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            padding: 2rem;
        }

        .table {
            margin-bottom: 0;
        }

        .table thead {
            background-color: #3498db;
            color: white;
        }

        .table-hover tbody tr:hover {
            background-color: rgba(52, 152, 219, 0.1);
            transition: background-color 0.3s ease;
        }

        .status-badge {
            display: inline-block;
            padding: 0.25rem 0.5rem;
            border-radius: 4px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .status-pending {
            background-color: #f39c12;
            color: white;
        }

        .status-success {
            background-color: #22b55f;
            color: white;
        }

        .status-rejected {
            background-color: #e74c3c;
            color: white;
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
                padding: 1rem;
            }

            .table-responsive {
                font-size: 0.9rem;
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
                @if (auth()->user()->role_id == 1)
                    <div class="nav-item">
                        <a href="{{ route('user') }}">
                            <i class="bi bi-person-circle"></i>
                            <span class="nav-text">Buat User</span>
                        </a>
                    </div>
                    <div class="nav-item">
                        <a href="#" class="active">
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
                        <a href="#" class="active">
                            <i class="bi bi-clock-history"></i>
                            <span class="nav-text">Laporan Transaksi</span>
                        </a>
                    </div>
                @elseif (auth()->user()->role_id == 3)
                    <div class="nav-item">
                        <a href="{{ route('wallet') }}">
                            <i class="bi bi-wallet2"></i>
                            <span class="nav-text">Wallet</span>
                        </a>
                    </div>
                    <div class="nav-item">
                        <a href="{{ route('transaction') }}" class="active">
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
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="transactions-container">
                        <h2 class="mb-4">
                            <i class="bi bi-clock-history me-2"></i>
                            Riwayat Transaksi
                            @if (auth()->user()->role_id == 3)
                                {{ auth()->user()->name }}
                            @endif
                        </h2>
                        <div class="table-responsive">
                            @if (auth()->user()->role_id != 3)
                                <table class="table table-bordered table-hover shadow-sm">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>ID</th>
                                            <th>Pengguna</th>
                                            <th>Tipe</th>
                                            <th>Jumlah</th>
                                            <th>Status</th>
                                            <th>Penerima</th>
                                            <th>Tanggal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($transactions as $transaction)
                                            <tr>
                                                <td>{{ $transaction->id }}</td>
                                                <td>{{ $transaction->user->name }}</td>
                                                <td>
                                                    @if ($transaction->type == 'top_up')
                                                        <span class="badge bg-primary">Top Up</span>
                                                    @elseif ($transaction->type == 'transfer')
                                                        <span class="badge bg-success">Transfer</span>
                                                    @else
                                                        <span class="badge bg-warning">Tarik Tunai</span>
                                                    @endif
                                                </td>
                                                <td class="text-success">
                                                    Rp {{ number_format($transaction->saldo, 2, ',', '.') }}
                                                </td>
                                                <td>
                                                    <span
                                                        class="status-badge 
                                                        @if ($transaction->status == 'Pending') status-pending
                                                        @elseif($transaction->status == 'Approved') status-success
                                                        @else status-rejected @endif">
                                                        {{ $transaction->status }}
                                                    </span>
                                                </td>
                                                <td>
                                                    @if ($transaction->type == 'transfer')
                                                        {{ $transaction->recipient->name ?? '-' }}
                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                                <td>{{ $transaction->created_at->format('d-m-Y H:i') }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center text-muted">
                                                    <i class="bi bi-inbox-fill fs-1"></i>
                                                    <p>Tidak ada data transaksi.</p>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            @else
                                <table class="table table-bordered table-hover shadow-sm">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>ID</th>
                                            <th>Tipe</th>
                                            <th>Jumlah</th>
                                            <th>Status</th>
                                            <th>Penerima</th>
                                            <th>Tanggal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($transactions as $transaction)
                                            @if ($transaction->recipient_id == auth()->user()->id || $transaction->user_id == auth()->user()->id)
                                                <tr>
                                                    <td>{{ $transaction->id }}</td>
                                                    <td>
                                                        @if ($transaction->type == 'top_up')
                                                            <span class="badge bg-primary">Top Up</span>
                                                        @elseif ($transaction->type == 'transfer')
                                                            <span class="badge bg-success">Transfer</span>
                                                        @else
                                                            <span class="badge bg-warning">Tarik Tunai</span>
                                                        @endif
                                                    </td>
                                                    <td class="text-success">
                                                        Rp {{ number_format($transaction->saldo, 2, ',', '.') }}
                                                    </td>
                                                    <td>
                                                        <span
                                                            class="status-badge 
                                                            @if ($transaction->status == 'Pending') status-pending
                                                            @elseif($transaction->status == 'Approved') status-success
                                                            @else status-rejected @endif">
                                                            {{ $transaction->status }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        @if ($transaction->type == 'transfer')
                                                            @if ($transaction->recipient_id == auth()->user()->id)
                                                                {{ $transaction->user->name ?? '' }}
                                                            @else
                                                                {{ $transaction->recipient->name ?? '' }}
                                                            @endif
                                                        @else
                                                            -
                                                        @endif
                                                    </td>
                                                    <td>{{ $transaction->created_at->format('d-m-Y H:i') }}</td>
                                                </tr>
                                            @endif
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center text-muted">
                                                    <i class="bi bi-inbox-fill fs-1"></i>
                                                    <p>Belum ada data transaksi.</p>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            @endif

                            <div class="d-flex justify-content-center mt-4">
                                {{ $transactions->links('pagination::bootstrap-4') }}
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
