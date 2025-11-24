@extends('admin.layout')

@section('title', 'Detail Pesanan')

@section('content')
    <div class="mb-8 flex justify-between items-center">
        <div>
            <h2 class="text-3xl font-bold text-[#052c62]">Detail Pesanan #{{ $order->id }}</h2>
            <p class="text-gray-600">Ringkasan dan status pengerjaan layanan</p>
        </div>

        <a href="{{ route('admin.orders') }}"
            class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-lg transition">
            <i class="fa-solid fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        {{-- User Info --}}
        <x-order-card title="Informasi Pengguna" icon="fa-user" color="text-[#052c62]">
            <x-order-profile :model="$order->user" />
        </x-order-card>

        {{-- Worker Info --}}
        <x-order-card title="Informasi Pekerja" icon="fa-person-digging" color="text-green-700">
            <x-order-profile :model="$order->worker" :showJob="true" :showRating="true" />
        </x-order-card>

        {{-- Order Details --}}
        <x-order-detail-card :order="$order" />

        {{-- Timeline --}}
        <x-order-timeline :order="$order" />
    </div>

    {{-- Photos --}}
    @if($order->photo_before || $order->photo_after)
        <x-order-photos :order="$order" />
    @endif

    {{-- Review --}}
    @if($order->user_rating)
        <x-order-review :order="$order" />
    @endif

@endsection