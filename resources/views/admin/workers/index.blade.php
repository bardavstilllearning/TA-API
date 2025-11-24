@extends('admin.layout')

@section('title', 'Manajemen Mitra Pekerja')

@section('content')
    <div class="mb-8 flex justify-between items-center">
        <div>
            <h2 class="text-3xl font-bold text-[#052c62]">Manajemen Mitra Pekerja</h2>
            <p class="text-gray-600">Kelola seluruh mitra pekerja yang terdaftar</p>
        </div>

        <a href="{{ route('admin.workers.create') }}"
            class="bg-[#052c62] hover:bg-[#031f46] text-white px-6 py-3 rounded-lg transition">
            <i class="fa-solid fa-user-plus mr-1"></i> Tambah Worker
        </a>
    </div>

    {{-- Workers Grid --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($workers as $worker)
            <div class="bg-white rounded-lg shadow-md border border-gray-200 overflow-hidden hover:shadow-xl transition">

                {{-- Foto --}}
                @if($worker->photo)
                    <img src="{{ asset('storage/' . $worker->photo) }}" class="w-full h-48 object-cover">
                @else
                    <div class="w-full h-48 bg-[#052c62] flex items-center justify-center">
                        <span class="text-5xl text-white font-bold">
                            {{ strtoupper(substr($worker->name, 0, 1)) }}
                        </span>
                    </div>
                @endif

                {{-- Card Info --}}
                <div class="p-6">
                    <h3 class="text-xl font-bold text-[#052c62]">{{ $worker->name }}</h3>
                    <p class="text-gray-600 text-sm mb-3">{{ $worker->job_title }}</p>

                    {{-- Rating & Order Count --}}
                    <div class="flex items-center gap-3 mb-4">
                        <p class="text-yellow-500 flex items-center gap-1 font-semibold">
                            <i class="fa-solid fa-star"></i> {{ $worker->rating }}
                        </p>
                        <p class="text-gray-600 text-sm">
                            {{ $worker->total_orders }} pesanan
                        </p>
                    </div>

                    {{-- Harga --}}
                    <p class="text-lg font-bold text-green-600 mb-3">
                        Rp {{ number_format($worker->price_per_hour, 0, ',', '.') }}/jam
                    </p>

                    {{-- Status --}}
                    <p class="mb-4">
                        <span
                            class="px-3 py-1 rounded-full text-xs font-semibold
                                            {{ $worker->gender == 'Laki-laki' ? 'bg-blue-100 text-blue-700' : 'bg-pink-100 text-pink-700' }}">
                            <i class="fa-solid {{ $worker->gender == 'Laki-laki' ? 'fa-person' : 'fa-person-dress' }}"></i>
                            {{ $worker->gender }}
                        </span>

                        <span
                            class="px-3 py-1 rounded-full text-xs font-semibold
                                            {{ $worker->is_available ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            <i class="fa-solid {{ $worker->is_available ? 'fa-check-circle' : 'fa-xmark-circle' }}"></i>
                            {{ $worker->is_available ? 'Available' : 'Unavailable' }}
                        </span>
                    </p>

                    <div class="flex gap-2">
                        <a href="{{ route('admin.workers.show', $worker->id) }}"
                            class="flex-1 text-center bg-[#052c62] hover:bg-[#031f46] text-white px-3 py-2 rounded-lg">
                            <i class="fa-solid fa-eye"></i>
                        </a>
                        <a href="{{ route('admin.workers.edit', $worker->id) }}"
                            class="flex-1 text-center bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-2 rounded-lg">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        <form action="{{ route('admin.workers.delete', $worker->id) }}" method="POST"
                            onsubmit="return confirm('Yakin ingin menghapus worker ini?')">
                            @csrf @method('DELETE')
                            <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded-lg">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-12 text-gray-600">
                <i class="fa-solid fa-users-slash text-6xl mb-4"></i>
                <p>Belum ada mitra pekerja terdaftar</p>
            </div>
        @endforelse
    </div>

    <div class="mt-8">
        {{ $workers->links() }}
    </div>
@endsection