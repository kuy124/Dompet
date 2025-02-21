<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PayGal | User</title>
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
            <h4>{{ auth()->user()->name }}</h4>
            @if (auth()->user()->role_id == 3)
                <p class="user-id">User ID: <span>{{ auth()->user()->id }}</span></p>
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
                        <a href="{{ route('user') }}" class="active">
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
                        <a href="#" class="active">
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

    @if (auth()->user()->role_id != 3)
        <div class="content">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <form id="userForm"
                            action="{{ isset($user) ? route('user.update', $user->id) : route('user.store') }}"
                            method="POST" class="border p-4 rounded shadow-sm">
                            @csrf
                            @if (isset($user))
                                @method('PUT')
                            @endif

                            <h4 class="mb-4">{{ isset($user) ? 'Edit Pengguna' : 'Tambah Pengguna' }}</h4>

                            <div class="mb-3">
                                <label for="name" class="form-label">Nama:</label>
                                <input type="text" name="name" id="name" class="form-control"
                                    value="{{ $user->name ?? '' }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email:</label>
                                <input type="email" name="email" id="email" class="form-control"
                                    value="{{ $user->email ?? '' }}" required>
                            </div>

                            @if (auth()->user()->role_id == 2)
                                <div class="mb-3">
                                    <label for="roles" class="form-label">Peran:</label>
                                    <select name="role_id" id="roles" class="form-select" required>
                                        <option value="3" selected>User</option>
                                    </select>
                                </div>
                            @else
                            <div class="mb-3">
                                <label for="roles" class="form-label">Peran:</label>
                                <select name="role_id" id="roles" class="form-select" required>
                                    <option value="">Pilih Peran</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}"
                                            {{ isset($user) && $user->role_id == $role->id ? 'selected' : '' }}>
                                            {{ $role->name }}
                                        </option>
                                    @endforeach
                                </select> 
                            </div>
                            @endif

                            <div class="mb-3">
                                <label for="password" class="form-label">Kata Sandi:</label>
                                <input type="password" name="password" id="password" class="form-control"
                                    placeholder="Kosongkan jika tidak ingin mengubah kata sandi">
                            </div>

                            <button type="submit" class="btn btn-primary w-100">
                                {{ isset($user) ? 'Perbarui Pengguna' : 'Tambah Pengguna' }}
                            </button>
                            @if (isset($user))
                                <a href="{{ route('user') }}" class="btn btn-warning w-100 mt-2">Batalkan Edit</a>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-10">
                        <div class="table-responsive">
                            <form action="{{ route('user') }}" method="GET" class="mb-3">
                                <input type="text" name="search" class="form-control"
                                    placeholder="Cari pengguna..." value="{{ request()->get('search') }}">
                            </form>
                            <table class="table table-bordered table-striped table-hover mt-4">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>No.</th>
                                        <th>ID</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Saldo</th>
                                        <th>Peran</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($users as $index => $user)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $user->id }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>Rp{{ number_format($user->saldo, 2, ',', '.') }}</td>
                                            <td>
                                                @if ($user->role_id == 1)
                                                    <span class="badge" style="background-color: #007bff; color: white;">Admin</span>
                                                @elseif ($user->role_id == 2)
                                                    <span class="badge" style="background-color: #17a2b8; color: white;">Bank Mini</span>
                                                @elseif ($user->role_id == 3)
                                                    <span class="badge" style="background-color: #6c757d; color: white;">User</span>
                                                @else
                                                    <span class="badge" style="background-color: #ffc107; color: black;">Tidak Ada Peran</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('user.edit', $user->id) }}" class="btn btn-warning btn-sm" aria-label="Edit {{ $user->name }}">Edit</a>
                                                <form action="{{ route('user.delete', $user->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" aria-label="Hapus {{ $user->name }}">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">Tidak ada data pengguna.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
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
                                TIDAK TERAUTENTIKASI
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
