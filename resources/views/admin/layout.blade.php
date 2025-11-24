<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') | Dashboard Kerah Biru</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('images/Icon.png') }}" />

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <style>
        .bg-navy {
            background: #062e6f;
        }

        .hover-light {
            background: rgba(255, 255, 255, 0.15);
        }

        .sidebar {
            background: #052c62;
            min-height: 100vh;
            padding: 1rem 0;
        }

        .sidebar-link {
            color: #ffffffcc;
            border-radius: 8px;
            transition: all 0.25s ease;
            font-size: .95rem;
        }

        .sidebar-link:hover {
            background: #ffffff22;
            color: #fff;
        }

        .sidebar-link.active {
            background: #fff !important;
            color: #052c62 !important;
            font-weight: 700;
        }

        .sidebar-link.active i {
            color: #052c62 !important;
        }

        .sidebar-link i {
            font-size: 1.1rem;
        }
    </style>
</head>

<body class="bg-gray-100">

    <div class="flex">
        <!-- Sidebar -->
        <aside class="bg-navy text-white w-64 min-h-screen px-6 py-6 flex flex-col fixed top-0 left-0">

            <!-- Branding -->
            <div class="mb-8">
                <div class="flex items-center gap-3">
                    <img src="{{ asset('images/Icon.png') }}" class="w-10">
                    <h2 class="text-lg font-bold">Admin Kerah Biru</h2>
                </div>
            </div>

            <hr class="border-white/30 mb-6">

            <!-- Menu -->
            <nav class="space-y-2 flex-grow">
                <a href="{{ route('admin.dashboard') }}" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-lg transition
                   {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-chart-line w-5"></i> Dashboard
                </a>

                <a href="{{ route('admin.users') }}" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-lg transition
                   {{ request()->routeIs('admin.users*') ? 'active' : '' }}">
                    <i class="fas fa-users w-5"></i> Pengguna
                </a>

                <a href="{{ route('admin.workers') }}" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-lg transition
                   {{ request()->routeIs('admin.workers*') ? 'active' : '' }}">
                    <i class="fas fa-helmet-safety w-5"></i> Mitra Pekerja
                </a>

                <a href="{{ route('admin.orders') }}" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-lg transition
                   {{ request()->routeIs('admin.orders*') ? 'active' : '' }}">
                    <i class="fas fa-cart-shopping w-5"></i> Pesanan
                </a>

            </nav>

            <!-- Logout -->
            <form action="{{ route('admin.logout') }}" method="POST" class="mt-8">
                @csrf
                <button type="submit"
                    class="w-full flex items-center gap-3 px-4 py-3 rounded-lg bg-red-600 hover:bg-red-700 transition font-semibold">
                    <i class="fas fa-sign-out-alt w-5"></i> Keluar
                </button>
            </form>

        </aside>

        <!-- Content -->
        <main class="flex-1 p-10 ml-64">
            @yield('content')
        </main>

    </div>

</body>

</html>