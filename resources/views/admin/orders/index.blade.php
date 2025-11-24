@extends('admin.layout')

@section('title', 'Manajemen Pesanan')

@section('content')
    <div class="mb-8 flex justify-between items-center">
        <div>
            <h2 class="text-3xl font-bold text-[#052c62]">Manajemen Pesanan</h2>
            <p class="text-gray-600">Kelola seluruh data transaksi dan pesanan pelanggan</p>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-md border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-[#052c62]/10">
                    <tr>
                        <th class="px-6 py-4 text-left font-semibold text-[#052c62]">#</th>
                        <th class="px-6 py-4 text-left font-semibold text-[#052c62]">User</th>
                        <th class="px-6 py-4 text-left font-semibold text-[#052c62]">Worker</th>
                        <th class="px-6 py-4 text-left font-semibold text-[#052c62]">Tanggal</th>
                        <th class="px-6 py-4 text-left font-semibold text-[#052c62]">Waktu</th>
                        <th class="px-6 py-4 text-left font-semibold text-[#052c62]">Jarak</th>
                        <th class="px-6 py-4 text-left font-semibold text-[#052c62]">Harga</th>
                        <th class="px-6 py-4 text-center font-semibold text-[#052c62]">Status</th>
                        <th class="px-6 py-4 text-center font-semibold text-[#052c62]">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($orders as $order)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">{{ $order->id }}</td>

                            <td class="px-6 py-4">
                                <p class="font-semibold text-[#052c62]">{{ $order->user->name }}</p>
                                <p class="text-xs text-gray-500">{{ $order->user->email }}</p>
                            </td>

                            <td class="px-6 py-4">
                                <p class="font-semibold">{{ $order->worker->name }}</p>
                                <p class="text-xs text-gray-500">{{ $order->worker->job_title }}</p>
                            </td>

                            <td class="px-6 py-4">{{ $order->order_date->format('d M Y') }}</td>
                            <td class="px-6 py-4">{{ $order->time_slot }}</td>
                            <td class="px-6 py-4">{{ $order->distance_km }} km</td>

                            <td class="px-6 py-4 font-bold text-green-600">
                                Rp {{ number_format($order->total_price, 0, ',', '.') }}
                            </td>

                            <td class="px-6 py-4 text-center">
                                @php
                                    $colors = [
                                        'pending' => 'bg-yellow-100 text-yellow-700',
                                        'accepted' => 'bg-blue-100 text-blue-700',
                                        'on_the_way' => 'bg-indigo-100 text-indigo-700',
                                        'in_progress' => 'bg-purple-100 text-purple-700',
                                        'completed' => 'bg-green-100 text-green-700',
                                        'cancelled' => 'bg-red-100 text-red-700',
                                    ];
                                @endphp
                                <span
                                    class="px-3 py-1 rounded-full text-xs font-semibold {{ $colors[$order->status] ?? 'bg-gray-100 text-gray-700' }}">
                                    {{ ucfirst(str_replace('_', ' ', $order->status)) }}
                                </span>
                            </td>

                            <td class="px-6 py-4 text-center">
                                <div class="flex justify-center gap-2">
                                    <a href="{{ route('admin.orders.show', $order->id) }}"
                                        class="p-2 rounded bg-[#052c62] hover:bg-[#031f46] text-white transition">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                    <form action="{{ route('admin.orders.delete', $order->id) }}" method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus order ini?')">
                                        @csrf @method('DELETE')
                                        <button class="p-2 rounded bg-red-500 hover:bg-red-600 text-white transition">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="px-6 py-10 text-center text-gray-500">
                                <i class="fa-solid fa-box-open text-5xl mb-2"></i><br>
                                Belum ada data pesanan
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="px-6 py-4 bg-gray-50">
            {{ $orders->links() }}
        </div>
    </div>
@endsection