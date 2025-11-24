@extends('admin.layout')

@section('title', 'Edit Pengguna')

@section('content')
    <div class="mb-8">
        <h2 class="text-2xl lg:text-3xl font-bold text-[#052c62]">Perbarui Data Pengguna</h2>
        <p class="text-gray-600 text-sm lg:text-base">Silahkan ubah informasi pengguna di bawah ini</p>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6 lg:p-8 border border-gray-200">
        <form action="{{ route('admin.users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div>
                    <label class="block font-semibold text-[#052c62] mb-2"><i class="fa-solid fa-user"></i> Nama
                        Lengkap</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                        class="w-full px-4 py-3 border rounded-lg focus:ring focus:ring-blue-300">
                    @error('name') <small class="text-red-500">{{ $message }}</small> @enderror
                </div>

                <div>
                    <label class="block font-semibold text-[#052c62] mb-2"><i class="fa-solid fa-envelope"></i>
                        Email</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                        class="w-full px-4 py-3 border rounded-lg focus:ring focus:ring-blue-300">
                    @error('email') <small class="text-red-500">{{ $message }}</small> @enderror
                </div>

                <div>
                    <label class="block font-semibold text-[#052c62] mb-2"><i class="fa-solid fa-phone"></i> Nomor
                        Telepon</label>
                    <input type="text" name="phone" value="{{ old('phone', $user->phone) }}"
                        class="w-full px-4 py-3 border rounded-lg focus:ring focus:ring-blue-300">
                    @error('phone') <small class="text-red-500">{{ $message }}</small> @enderror
                </div>

                <div>
                    <label class="block font-semibold text-[#052c62] mb-2"><i class="fa-solid fa-image"></i> Foto
                        Profil</label>
                    @if($user->photo)
                        <img src="{{ asset('storage/' . $user->photo) }}" class="w-20 h-20 rounded-full mb-3 object-cover">
                    @endif
                    <input type="file" name="photo" accept="image/*"
                        class="w-full px-4 py-3 border rounded-lg focus:ring focus:ring-blue-200">
                    @error('photo') <small class="text-red-500">{{ $message }}</small> @enderror
                </div>
            </div>

            <div class="mt-6">
                <label class="block font-semibold text-[#052c62] mb-2"><i class="fa-solid fa-map-location-dot"></i>
                    Alamat</label>
                <textarea name="address" rows="3"
                    class="w-full px-4 py-3 border rounded-lg focus:ring focus:ring-blue-300">{{ old('address', $user->address) }}</textarea>
                @error('address') <small class="text-red-500">{{ $message }}</small> @enderror
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-6">
                <div>
                    <label class="block font-semibold text-[#052c62] mb-2"><i class="fa-solid fa-location-dot"></i>
                        Latitude</label>
                    <input type="number" step="any" name="latitude" value="{{ old('latitude', $user->latitude) }}"
                        class="w-full px-4 py-3 border rounded-lg focus:ring focus:ring-blue-300"
                        placeholder="Klik peta untuk pilih lokasi">
                    @error('latitude') <small class="text-red-500">{{ $message }}</small> @enderror
                </div>

                <div>
                    <label class="block font-semibold text-[#052c62] mb-2"><i class="fa-solid fa-location-crosshairs"></i>
                        Longitude</label>
                    <input type="number" step="any" name="longitude" value="{{ old('longitude', $user->longitude) }}"
                        class="w-full px-4 py-3 border rounded-lg focus:ring focus:ring-blue-300"
                        placeholder="Klik peta untuk pilih lokasi">
                    @error('longitude') <small class="text-red-500">{{ $message }}</small> @enderror
                </div>
            </div>

            <div class="mt-6">
                <div id="map" style="height: 400px; border-radius: 8px;" class="border border-gray-300"></div>
            </div>

            <div class="flex justify-end gap-4 mt-8">
                <a href="{{ route('admin.users') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-lg">
                    <i class="fa-solid fa-arrow-left"></i> Batal
                </a>
                <button type="submit" class="bg-[#052c62] hover:bg-[#031f46] text-white px-6 py-3 rounded-lg transition">
                    <i class="fa-solid fa-floppy-disk"></i> Simpan
                </button>
            </div>
        </form>
    </div>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        const lat = {{ $user->latitude ?? -7.7956 }};
        const lng = {{ $user->longitude ?? 110.3695 }};

        const map = L.map('map').setView([lat, lng], 13);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        let marker = L.marker([lat, lng], { draggable: true }).addTo(map);

        marker.on('dragend', function (e) {
            const position = marker.getLatLng();
            document.querySelector('input[name="latitude"]').value = position.lat;
            document.querySelector('input[name="longitude"]').value = position.lng;
        });

        map.on('click', function (e) {
            marker.setLatLng(e.latlng);
            document.querySelector('input[name="latitude"]').value = e.latlng.lat;
            document.querySelector('input[name="longitude"]').value = e.latlng.lng;
        });

        document.querySelector('input[name="latitude"]').addEventListener('change', function () {
            const newLat = parseFloat(this.value) || lat;
            const newLng = parseFloat(document.querySelector('input[name="longitude"]').value) || lng;
            marker.setLatLng([newLat, newLng]);
            map.setView([newLat, newLng], 13);
        });

        document.querySelector('input[name="longitude"]').addEventListener('change', function () {
            const newLat = parseFloat(document.querySelector('input[name="latitude"]').value) || lat;
            const newLng = parseFloat(this.value) || lng;
            marker.setLatLng([newLat, newLng]);
            map.setView([newLat, newLng], 13);
        });
    </script>
@endsection