@extends('admin.layout')

@section('title', 'Edit Worker')

@section('content')
    <div class="mb-8">
        <h2 class="text-3xl font-bold text-[#052c62]">Perbarui Data Worker</h2>
        <p class="text-gray-600">Silahkan ubah informasi worker di bawah ini</p>
    </div>

    <div class="bg-white rounded-lg shadow-md p-8 border border-gray-200 max-w-3xl">
        <form action="{{ route('admin.workers.update', $worker->id) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                {{-- Nama + Pekerjaan --}}
                <div>
                    <label class="font-semibold text-[#052c62] mb-2 block">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name', $worker->name) }}" required class="input-text">
                </div>
                <div>
                    <label class="font-semibold text-[#052c62] mb-2 block">Pekerjaan</label>
                    <input type="text" name="job_title" value="{{ old('job_title', $worker->job_title) }}" required
                        class="input-text">
                </div>

                {{-- Gender + Harga --}}
                <div>
                    <label class="font-semibold text-[#052c62] mb-2 block">Jenis Kelamin</label>
                    <select name="gender" required class="input-text">
                        <option value="">Pilih</option>
                        <option value="Laki-laki" @selected($worker->gender == 'Laki-laki')>Laki-laki</option>
                        <option value="Perempuan" @selected($worker->gender == 'Perempuan')>Perempuan</option>
                    </select>
                </div>

                <div>
                    <label class="font-semibold text-[#052c62] mb-2 block">Harga per Jam (Rp)</label>
                    <input type="number" name="price_per_hour" value="{{ old('price_per_hour', $worker->price_per_hour) }}"
                        required class="input-text">
                </div>

                {{-- Phone + WhatsApp --}}
                <div>
                    <label class="font-semibold text-[#052c62] mb-2 block">Nomor Telepon</label>
                    <input type="text" name="phone" value="{{ old('phone', $worker->phone) }}" required class="input-text">
                </div>

                <div>
                    <label class="font-semibold text-[#052c62] mb-2 block">WhatsApp</label>
                    <input type="text" name="whatsapp" value="{{ old('whatsapp', $worker->whatsapp) }}" class="input-text">
                </div>

                {{-- Lokasi --}}
                <div>
                    <label class="font-semibold text-[#052c62] mb-2 block">Latitude</label>
                    <input type="number" step="any" name="latitude" value="{{ old('latitude', $worker->latitude) }}"
                        required class="input-text">
                </div>

                <div>
                    <label class="font-semibold text-[#052c62] mb-2 block">Longitude</label>
                    <input type="number" step="any" name="longitude" value="{{ old('longitude', $worker->longitude) }}"
                        required class="input-text">
                </div>
            </div>

            {{-- Deskripsi --}}
            <div class="mt-6">
                <label class="font-semibold text-[#052c62] mb-2 block">Deskripsi</label>
                <textarea name="description" rows="4"
                    class="input-text">{{ old('description', $worker->description) }}</textarea>
            </div>

            {{-- Foto --}}
            <div class="mt-6">
                <label class="font-semibold text-[#052c62] mb-2 block">Foto</label>
                @if($worker->photo)
                    <img src="{{ asset('storage/' . $worker->photo) }}" class="w-28 h-28 rounded-lg object-cover mb-3">
                @endif
                <input type="file" name="photo" accept="image/*" class="input-text">
            </div>

            {{-- Buttons --}}
            <div class="mt-8 flex gap-4">
                <button type="submit" class="bg-[#052c62] hover:bg-[#031f46] text-white px-6 py-3 rounded-lg transition">
                    <i class="fa-solid fa-floppy-disk"></i> Simpan
                </button>

                <a href="{{ route('admin.workers') }}"
                    class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-lg">
                    <i class="fa-solid fa-arrow-left"></i> Batal
                </a>
            </div>
        </form>
    </div>
@endsection