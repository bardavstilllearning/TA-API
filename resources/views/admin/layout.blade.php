<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') | Dashboard Kerah Biru</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('images/Icon.png') }}" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.all.min.js"></script>

    <style>
        /* SIDEBAR FIXED */
        .sidebar {
            background: #052c62;
            width: 260px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;

            display: flex;
            flex-direction: column;

            padding: 24px;
            overflow-y: auto;
            overflow-x: hidden;
        }

        .sidebar-link {
            display: flex;
            gap: 12px;
            align-items: center;
            padding: 12px 16px;
            border-radius: 8px;
            color: #ffffffcc;
            transition: 0.25s;
            text-decoration: none;
        }

        .sidebar-link:hover {
            background: #ffffff22;
            color: white;
        }

        .sidebar-link.active {
            background: white !important;
            color: #052c62 !important;
            font-weight: bold;
        }

        /* LOGOUT FIX */
        .logout-section {
            margin-top: auto;
            /* INI YANG MEMBAWA LOGOUT KE PALING BAWAH */
        }

        .logout-btn {
            background: #dc2626;
            padding: 12px 16px;
            border-radius: 8px;
            color: white;
            font-weight: bold;
            width: 100%;
            text-align: left;
            display: flex;
            gap: 10px;
            align-items: center;
            transition: 0.25s;
        }

        .logout-btn:hover {
            background: #b91c1c;
        }

        .main-content {
            margin-left: 260px;
            padding: 32px;
        }
    </style>
</head>

<body class="bg-gray-100">

    <!-- SIDEBAR -->
    <aside class="sidebar text-white">

        <!-- HEADER LOGO -->
        <div class="flex items-center gap-3 mb-6">
            <img src="{{ asset('images/Icon.png') }}" class="w-10">
            <h2 class="text-lg font-bold">Admin Kerah Biru</h2>
        </div>

        <hr class="border-white/30 mb-4">

        <!-- MENU -->
        <nav class="space-y-2">
            <a href="{{ route('admin.dashboard') }}"
                class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fas fa-chart-line w-5"></i> Dashboard
            </a>

            <a href="{{ route('admin.users') }}"
                class="sidebar-link {{ request()->routeIs('admin.users*') ? 'active' : '' }}">
                <i class="fas fa-users w-5"></i> Pengguna
            </a>

            <a href="{{ route('admin.workers') }}"
                class="sidebar-link {{ request()->routeIs('admin.workers*') || request()->routeIs('admin.schedules*') ? 'active' : '' }}">
                <i class="fas fa-helmet-safety w-5"></i> Mitra Pekerja
            </a>

            <a href="{{ route('admin.orders') }}"
                class="sidebar-link {{ request()->routeIs('admin.orders*') ? 'active' : '' }}">
                <i class="fas fa-cart-shopping w-5"></i> Pesanan
            </a>
        </nav>

        <!-- LOGOUT PALING BAWAH -->
        <div class="logout-section">
            <form id="logoutForm" action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="button" onclick="confirmLogout()" class="logout-btn">
                    <i class="fas fa-sign-out-alt"></i> Keluar
                </button>
            </form>
        </div>

    </aside>

    <!-- CONTENT -->
    <main class="main-content">

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </main>

    <script>
        function confirmLogout() {
            Swal.fire({
                title: 'Konfirmasi Logout',
                text: 'Apakah Anda yakin ingin keluar?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#dc2626',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Ya, Keluar',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('logoutForm').submit();
                }
            });
        }
    </script>

</body>

</html>