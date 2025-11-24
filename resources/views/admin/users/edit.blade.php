@extends('admin.layout')

@section('title', 'Edit Pengguna')

@section('content')
    <div class="mb-8">
        <h2 class="text-3xl font-bold text-[#052c62]">Perbarui Data Pengguna</h2>
        <p class="text-gray-600">Silahkan ubah informasi pengguna di bawah ini</p>
    </div>

    <div class="bg-white rounded-lg shadow-md p-8 border border-gray-200 max-w-2xl">
        <form action="{{ route('admin.users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Nama --}}
            <div class="mb-6">
                <label class="block font-semibold text-[#052c62] mb-2"><i class="fa-solid fa-user"></i> Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                    class="w-full px-4 py-3 border rounded-lg focus:ring focus:ring-blue-300">
            </div>

            {{-- Email --}}
            <div class="mb-6">
                <label class="block font-semibold text-[#052c62] mb-2"><i class="fa-solid fa-envelope"></i> Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                    class="w-full px-4 py-3 border rounded-lg focus:ring focus:ring-blue-300">
            </div>

            {{-- Phone --}}
            <div class="mb-6">
                <label class="block font-semibold text-[#052c62] mb-2"><i class="fa-solid fa-phone"></i> Nomor
                    Telepon</label>
                <input type="text" name="phone" value="{{ old('phone', $user->phone) }}"
                    class="w-full px-4 py-3 border rounded-lg focus:ring focus:ring-blue-300">
            </div>

            {{-- Alamat --}}
            <div class="mb-6">
                <label class="block font-semibold text-[#052c62] mb-2"><i class="fa-solid fa-map-location-dot"></i>
                    Alamat</label>
                <textarea name="address" rows="3"
                    class="w-full px-4 py-3 border rounded-lg focus:ring focus:ring-blue-300">{{ old('address', $user->address) }}</textarea>
            </div>

            {{-- Foto --}}
            <div class="mb-6">
                <label class="block font-semibold text-[#052c62] mb-2"><i class="fa-solid fa-image"></i> Foto Profil</label>

                @if($user->photo)
                    <img src="{{ asset('storage/' . $user->photo) }}" class="w-20 h-20 rounded-full mb-3 object-cover">
                @endif

                <input type="file" name="photo" accept="image/*"
                    class="w-full px-4 py-3 border rounded-lg focus:ring focus:ring-blue-200">
            </div>

            <div class="flex gap-4">
                <button class="bg-[#052c62] hover:bg-[#031f46] text-white px-6 py-3 rounded-lg transition">
                    <i class="fa-solid fa-floppy-disk"></i> Simpan
                </button>
                <a href="{{ route('admin.users') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-lg">
                    <i class="fa-solid fa-arrow-left"></i> Kembali
                </a>
            </div>
        </form>
    </div>
@endsection