@extends('admin.layout')

@section('title', 'Home')

@section('content')
        <div class="mb-8">
            <h2 class="text-3xl font-bold text-[#052c62]">Dashboard Kerah Biru</h2>
            <p class="text-gray-600">Pantau pengguna, mitra, dan pesanan dengan mudah melalui sistem manajemen Kerah Biru.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            @php
    $statsData = [
        ['label' => 'Total Pengguna', 'value' => $stats['total_users'], 'icon' => 'fa-users', 'color' => '#0d6efd'],
        ['label' => 'Total Mitra Pekerja', 'value' => $stats['total_workers'], 'icon' => 'fa-helmet-safety', 'color' => '#0aa04f'],
        ['label' => 'Total Pesanan', 'value' => $stats['total_orders'], 'icon' => 'fa-cart-shopping', 'color' => '#6f42c1'],
        ['label' => 'Dalam Proses', 'value' => $stats['pending_orders'], 'icon' => 'fa-hourglass-half', 'color' => '#ff8c00'],
        ['label' => 'Pesanan Selesai', 'value' => $stats['completed_orders'], 'icon' => 'fa-circle-check', 'color' => '#009d8b'],
        ['label' => 'Pendapatan', 'value' => 'Rp ' . number_format($stats['total_revenue'], 0, ",", "."), 'icon' => 'fa-coins', 'color' => '#198754'],
    ];
            @endphp
            @foreach($statsData as $card)
                <div class="bg-white shadow-md p-5 rounded-lg border border-gray-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500">{{ $card['label'] }}</p>
                            <h3 class="text-3xl font-bold" style="color: {{ $card['color'] }};">
                                {{ $card['value'] }}
                            </h3>
                        </div>
                        <div class="p-4 rounded-full" style="background: {{ $card['color'] }}15;">
                            <i class="fas {{ $card['icon'] }} text-3xl" style="color: {{ $card['color'] }};"></i>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="bg-white rounded-lg shadow-md p-6 mb-8 border border-gray-200">
            <h3 class="text-lg font-bold mb-4 text-[#052c62]">
                <i class="fas fa-receipt"></i> Pesanan Terbaru
            </h3>
            <div class="overflow-x-auto">
                <table class="w-full border-collapse">
                    <thead class="bg-[#052c62] text-white">
                        <tr>
                            <th class="px-4 py-2 text-left">ID</th>
                            <th class="px-4 py-2 text-center">User</th>
                            <th class="px-4 py-2 text-center">Worker</th>
                            <th class="px-4 py-2 text-center">Tanggal</th>
                            <th class="px-4 py-2 text-center">Status</th>
                            <th class="px-4 py-2 text-center">Harga</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y">
                        @forelse($recent_orders as $order)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-2">{{ $order->id }}</td>
                                <td class="px-4 py-2 text-center">{{ $order->user->name }}</td>
                                <td class="px-4 py-2 text-center">{{ $order->worker->name }}</td>
                                <td class="px-4 py-2 text-center">{{ $order->order_date->format('d M Y') }}</td>
                                <td class="px-4 py-2 text-center">
                                    @php
        $colors = [
            'completed' => 'bg-green-100 text-green-800',
            'pending' => 'bg-yellow-100 text-yellow-800',
            'in_progress' => 'bg-blue-100 text-blue-800',
            'cancelled' => 'bg-red-100 text-red-800'
        ];
                                    @endphp
                                    <span class="px-3 py-1 text-xs rounded-full font-semibold {{ $colors[$order->status] ?? '' }}">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                                <td class="px-4 py-2 text-center font-semibold">
                                    Rp {{ number_format($order->total_price, 0, ",", ".") }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-6 text-center text-gray-500">
                                    Belum ada order masuk
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6 border border-gray-200">
            <h3 class="text-lg font-bold mb-4 text-[#052c62]">
                <i class="fas fa-medal"></i> Mitra Pekerja Terbaik
            </h3>
            <div class="space-y-4">
                @forelse($top_workers as $worker)
                    <div class="flex items-center justify-between bg-gray-50 p-4 rounded-lg">
                        <div class="flex items-center gap-3">
                            @if($worker->photo)
                                <img src="{{ asset('storage/' . $worker->photo) }}" class="w-12 h-12 rounded-full object-cover shadow">
                            @else
                                <div class="w-12 h-12 rounded-full bg-[#052c62] text-white flex justify-center items-center font-bold">
                                    {{ strtoupper(substr($worker->name, 0, 1)) }}
                                </div>
                            @endif
                            <div>
                                <p class="font-semibold text-[#052c62]">{{ $worker->name }}</p>
                                <p class="text-sm text-gray-600">{{ $worker->job_title }}</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <span class="flex items-center justify-end text-yellow-500 gap-1 font-semibold">
                                <i class="fas fa-star"></i> {{ $worker->rating }}
                            </span>
                            <p class="text-sm text-gray-600">{{ $worker->total_orders }} pesanan</p>
                        </div>
                    </div>
                @empty
                    <p class="text-center text-gray-500 py-4">Belum ada worker terdaftar</p>
                @endforelse
            </div>
        </div>

@endsection