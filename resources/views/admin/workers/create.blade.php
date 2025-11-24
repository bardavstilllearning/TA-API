@extends('admin.layout')

@section('title', 'Tambah Worker')

@section('content')
    <div class="mb-8">
        <h2 class="text-3xl font-bold text-[#052c62]">Tambah Mitra Pekerja</h2>
        <p class="text-gray-600">Isi form berikut untuk mendaftarkan worker baru</p>
    </div>

    <div class="bg-white rounded-lg shadow-md p-8 border border-gray-200 max-w-3xl">
        <form action="{{ route('admin.workers.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                {{-- Nama --}}
                <div>
                    <label class="font-semibold text-[#052c62] mb-2 block"><i class="fa-solid fa-user-gear"></i>
                        Nama</label>
                    <input type="text" name="name" value="{{ old('name') }}" required
                        class="w-full px-4 py-3 border rounded-lg focus:ring focus:ring-blue-300">
                </div>

                {{-- Pekerjaan --}}
                <div>
                    <label class="font-semibold text-[#052c62] mb-2 block"><i class="fa-solid fa-briefcase"></i>
                        Pekerjaan</label>
                    <input type="text" name="job_title" value="{{ old('job_title') }}" required
                        class="w-full px-4 py-3 border rounded-lg focus:ring focus:ring-blue-300">
                </div>

                {{-- Gender --}}
                <div>
                    <label class="font-semibold text-[#052c62] mb-2 block"><i class="fa-solid fa-person-half-dress"></i>
                        Gender</label>
                    <select name="gender" required
                        class="w-full px-4 py-3 border rounded-lg focus:ring focus:ring-blue-300">
                        <option value="">Pilih</option>
                        <option {{ old('gender') == 'Laki-laki' ? 'selected' : '' }} value="Laki-laki">Laki-laki</option>
                        <option {{ old('gender') == 'Perempuan' ? 'selected' : '' }} value="Perempuan">Perempuan</option>
                    </select>
                </div>

                {{-- Harga --}}
                <div>
                    <label class="font-semibold text-[#052c62] mb-2 block"><i class="fa-solid fa-coins"></i> Harga /
                        Jam</label>
                    <input type="number" name="price_per_hour" required
                        class="w-full px-4 py-3 border rounded-lg focus:ring focus:ring-blue-300" placeholder="50000">
                </div>

                {{-- Telepon --}}
                <div>
                    <label class="font-semibold text-[#052c62] mb-2 block"><i class="fa-solid fa-phone"></i> Telepon</label>
                    <input type="text" name="phone" value="{{ old('phone') }}" required
                        class="w-full px-4 py-3 border rounded-lg focus:ring focus:ring-blue-300">
                </div>

                {{-- WhatsApp --}}
                <div>
                    <label class="font-semibold text-[#052c62] mb-2 block"><i class="fa-brands fa-whatsapp"></i>
                        WhatsApp</label>
                    <input type="text" name="whatsapp" value="{{ old('whatsapp') }}"
                        class="w-full px-4 py-3 border rounded-lg focus:ring focus:ring-blue-200">
                </div>

                {{-- Latitude --}}
                <div>
                    <label class="font-semibold text-[#052c62] mb-2 block"><i class="fa-solid fa-location-dot"></i>
                        Latitude</label>
                    <input type="number" name="latitude" step="any" value="{{ old('latitude', -7.7956) }}" required
                        class="w-full px-4 py-3 border rounded-lg focus:ring focus:ring-blue-300">
                </div>

                {{-- Longitude --}}
                <div>
                    <label class="font-semibold text-[#052c62] mb-2 block"><i class="fa-solid fa-location-crosshairs"></i>
                        Longitude</label>
                    <input type="number" name="longitude" step="any" value="{{ old('longitude', 110.3695) }}" required
                        class="w-full px-4 py-3 border rounded-lg focus:ring focus:ring-blue-300">
                </div>
            </div>

            {{-- Deskripsi --}}
            <div class="mt-6">
                <label class="font-semibold text-[#052c62] mb-2 block"><i class="fa-solid fa-align-left"></i>
                    Deskripsi</label>
                <textarea name="description" rows="4"
                    class="w-full px-4 py-3 border rounded-lg focus:ring focus:ring-blue-300">{{ old('description') }}</textarea>
            </div>

            {{-- Foto --}}
            <div class="mt-6">
                <label class="font-semibold text-[#052c62] mb-2 block"><i class="fa-solid fa-image"></i> Foto</label>
                <input type="file" name="photo" accept="image/*"
                    class="w-full px-4 py-3 border rounded-lg focus:ring focus:ring-blue-300">
            </div>

            <div class="mt-8 flex gap-4">
                <button type="submit" class="bg-[#052c62] hover:bg-[#031f46] text-white px-6 py-3 rounded-lg transition">
                    <i class="fa-solid fa-plus"></i> Tambah Worker
                </button>
                <a href="{{ route('admin.workers') }}"
                    class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-lg">
                    <i class="fa-solid fa-arrow-left"></i> Kembali
                </a>
            </div>
        </form>
    </div>
@endsection