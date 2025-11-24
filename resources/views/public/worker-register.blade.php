<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Worker | Kerah Biru</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('images/Icon.png') }}" />

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" />

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/public.css') }}">

</head>

<body style="font-family: 'Montserrat', sans-serif; background-color: #f6f8fc">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top glass-navbar shadow-sm">
        <a class="navbar-brand fw-bold" href="{{ route('welcome') }}" style="color: #052c62">
            <img src="{{ asset('images/Icon.png') }}" alt="Logo Kerah Biru" height="50"> Kerah Biru
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <i class="bi bi-list fs-2"></i>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav gap-3">
                <li><a class="nav-link " href="{{ route('welcome') }}">Beranda</a></li>
                <li><a class="nav-link active" href="{{ route('worker.register.form') }}">Bergabung Menjadi Mitra</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Page Container -->
    <div class="container py-5 mt-5">
        <div class="row justify-content-center align-items-center">

            <!-- Form Section -->
            <div class="col-lg-7">
                <div class="card border-0 shadow-sm p-4">

                    <!-- Header -->
                    <div class="text-center mb-4">
                        <h2 class="fw-bold" style="color:#052c62;">Daftar Sebagai Mitra Pekerja</h2>
                        <p class="text-muted">Isi data diri Anda dengan benar untuk mulai bekerja</p>
                    </div>

                    @if(session('success'))
                        <div class="alert alert-success rounded-3">
                            <strong>Berhasil!</strong> {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('worker.register') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Personal Info -->
                        <h5 class="text-dark fw-bold">Informasi Pribadi</h5>
                        <hr>

                        <div class="row g-3">

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Nama Lengkap *</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                                @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Jenis Kelamin *</label>
                                <select name="gender" class="form-select" required>
                                    <option value="">Pilih</option>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                                @error('gender') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">No. Telepon *</label>
                                <input type="text" name="phone" class="form-control" required>
                                @error('phone') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">WhatsApp (Opsional)</label>
                                <input type="text" name="whatsapp" class="form-control">
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-semibold">Foto Profil</label>
                                <input type="file" name="photo" class="form-control" required>
                                <small class="text-muted">*Max 5MB</small>
                            </div>
                        </div>

                        <!-- Work Info -->
                        <h5 class="text-dark fw-bold mt-4">Informasi Pekerjaan</h5>
                        <hr>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Jenis Pekerjaan *</label>
                                <input type="text" name="job_title" class="form-control" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Harga per Jam (Rp) *</label>
                                <input type="number" name="price_per_hour" class="form-control" required>
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-semibold">Deskripsi Keahlian *</label>
                                <textarea name="description" class="form-control" rows="3"
                                    placeholder="Ceritakan sedikit tentang pengalaman Anda..." required></textarea>
                            </div>
                        </div>

                        <!-- Location -->
                        <h5 class="text-dark fw-bold mt-4">Lokasi</h5>
                        <hr>

                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <input type="number" step="any" name="latitude" class="form-control" value="-7.7956"
                                    required>
                            </div>
                            <div class="col-md-6">
                                <input type="number" step="any" name="longitude" class="form-control" value="110.3695"
                                    required>
                            </div>
                        </div>

                        <!-- Button -->
                        <button class="btn btn-navy w-100 rounded-pill py-2 fw-semibold">
                            <i class="bi bi-person-plus me-2"></i>Bergabung Sekarang
                        </button>
                    </form>
                </div>
            </div>
            <!-- Illustration -->
            <div class="col-lg-4 d-none d-lg-block text-center">
                <img src="{{ asset('images/Worker.png') }}" class="img-fluid" alt="Worker">
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="text-center py-2 text-white" style="background:#052c62;">
        <small>Copyright © 2025 Kerah Biru</small>
    </footer>

    <!-- Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>