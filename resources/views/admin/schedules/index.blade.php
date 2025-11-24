@extends('admin.layout')

@section('title', 'Jadwal Worker')

@section('content')
    <div class="mb-8 flex justify-between items-center">
        <div>
            <h2 class="text-3xl font-bold text-[#052c62]">Jadwal {{ $worker->name }}</h2>
            <p class="text-gray-600">Atur ketersediaan waktu untuk worker ini</p>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('admin.workers.show', $worker->id) }}"
                class="px-5 py-3 rounded-lg bg-[#052c62] text-white hover:bg-[#031f46] transition">
                <i class="fa-solid fa-id-badge mr-2"></i> Profil Worker
            </a>
            <a href="{{ route('admin.workers') }}"
                class="px-5 py-3 rounded-lg bg-gray-500 text-white hover:bg-gray-600 transition">
                <i class="fa-solid fa-arrow-left mr-2"></i> Kembali
            </a>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow border border-gray-200 p-6">
        <p class="text-gray-700 mb-6">
            Klik slot untuk toggle ketersediaan:
            <span class="text-green-600 font-bold">Hijau = Available</span> /
            <span class="text-red-600 font-bold">Merah = Tidak tersedia</span>
        </p>

        <div class="space-y-6">
            @foreach(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'] as $day)
                <div class="border rounded-lg p-4">
                    <h4 class="text-lg font-bold text-[#052c62] mb-3 flex items-center">
                        <i class="fa-solid fa-calendar-day mr-2"></i> {{ $day }}
                    </h4>

                    <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                        @php $slots = $schedules[$day] ?? collect(); @endphp

                        @forelse($slots as $schedule)
                                <form action="{{ route('admin.schedules.toggle', $schedule->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="w-full px-3 py-2 rounded-lg text-sm font-semibold border transition
                                                                {{ $schedule->is_available
                            ? 'bg-green-50 text-green-700 border-green-300 hover:bg-green-100'
                            : 'bg-red-50 text-red-700 border-red-300 hover:bg-red-100' }}">
                                        <i class="fa-solid {{ $schedule->is_available ? 'fa-check' : 'fa-xmark' }} mr-1"></i>
                                        {{ $schedule->time_slot }}
                                    </button>
                                </form>
                        @empty
                            <p class="col-span-full py-3 text-gray-500 text-center">Belum ada jadwal</p>
                        @endforelse
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    {{-- Stats --}}
    <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-6">
        <x-stat-box title="Total Slot" icon="fa-calendar" color="blue" :value="$schedules->flatten()->count()" />
        <x-stat-box title="Tersedia" icon="fa-check" color="green" :value="$schedules->flatten()->where('is_available', true)->count()" />
        <x-stat-box title="Tidak Tersedia" icon="fa-xmark" color="red" :value="$schedules->flatten()->where('is_available', false)->count()" />
    </div>

@endsection