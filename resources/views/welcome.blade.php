<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- Favicon -->
    <title>Platform Insan Karya Raga | Kerah Biru</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('images/Icon.png') }}" />

    <!-- CSS Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
        crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" />

    <!-- Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet" />

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/public.css') }}">
</head>

<body>
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
                <li><a class="nav-link active" href="{{ route('welcome') }}">Beranda</a></li>
                <li><a class="nav-link" href="{{ route('worker.register.form') }}">Bergabung Menjadi Mitra</a></li>
            </ul>
        </div>
    </nav>

    <!-- Hero -->
    <section id="hero" class="hero d-flex align-items-center text-light" style="
        height: 95vh;
        background-color: #6980a1;
        border-radius: 0 0 75px 75px;
        margin: 0px 10px 10px;
        overflow: hidden;
    ">
        <div class="container-fluid">
            <div class="row gx-0 h-100 d-flex align-items-center">
                <div class="col-md-4 d-none d-md-flex">
                    <img src="{{ asset('images/Worker.png') }}" style="object-position: center;height:40rem;"
                        alt="Worker Image">
                </div>
                <div class="col-md-8 d-flex align-items-center justify-content-center p-5">
                    <div class="text-start">
                        <h1 class="fw-bold display-4 mb-3">
                            Platform Insan Karya Raga
                        </h1>
                        <p class="lead mb-4">
                            <span class="align-items-center text-primary-emphasis fw-bold">
                                <img src="{{ asset('images/Icon.png') }}" style="width: 2rem;" />
                                Kerah Biru </span>
                            menghadirkan akses kerja yang adil, layak, dan transparan bagi para pekerja fisik di
                            Indonesia — sembari
                            membantu masyarakat mendapatkan layanan jasa terpercaya kapan saja.
                        </p>
                        <a href="{{ route('worker.register.form') }}"
                            class="btn btn-navy btn-lg rounded-pill px-4 fw-semibold">
                            Bergabung Bersama Kami
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Intro -->
    <section id="intro" class="pt-5">
        <div class="container text-center border-bottom">
            <h5 class="mb-4">
                <span class="align-items-center text-primary-emphasis fw-bold">
                    <img src="{{ asset('images/Icon.png') }}" style="width: 2rem;" />
                    Kerah Biru</span> adalah platform digital yang menghubungkan pekerja fisik dengan
                pelanggan secara cepat, aman, dan transparan.
                Kami percaya setiap pekerja memiliki hak untuk tetap produktif dan mendapatkan kesempatan kerja tanpa
                batasan usia
                maupun latar belakang pendidikan.
            </h5>
        </div>
    </section>

    <!-- History -->
    <section class="py-5" id="history">
        <div class="container text-center pb-4 border-bottom">
            <h2 class="fw-bold" style="color: #052c62;">Perkembangan Kami</h2>
            <p class="text-muted">Jejak nyata <span class="align-items-center text-primary-emphasis fw-bold">
                    <img src="{{ asset('images/Icon.png') }}" style="width: 2rem;" />
                    Kerah Biru </span>dalam membangun ekosistem kerja yang inklusif</p>

            <div class=" d-flex flex-wrap justify-content-center position-relative">
                <div class="text-center position-relative p-3" style="flex:1 1 250px;">
                    <div class="rounded-circle bg-primary mx-auto mb-3" style="width:30px; height:30px;"></div>
                    <div class="p-4 bg-white rounded shadow hover-shadow ">
                        <h5 class="fw-bold text-primary">2019</h5>
                        <p class="small text-muted mb-0">
                            Riset kebutuhan pekerja lepas dan masyarakat perkotaan dimulai.
                        </p>
                    </div>
                </div>
                <div class="text-center position-relative p-3" style="flex:1 1 250px;">
                    <div class="rounded-circle bg-success mx-auto mb-3" style="width:30px; height:30px;"></div>
                    <div class="p-4 bg-white rounded hover-shadow shadow">
                        <h5 class="fw-bold text-success">2020</h5>
                        <p class="small text-muted mb-0">
                            Pengembangan sistem pemesanan jasa berbasis digital mulai dirancang.
                        </p>
                    </div>
                </div>
                <div class="text-center position-relative p-3" style="flex:1 1 250px;">
                    <div class="rounded-circle bg-warning mx-auto mb-3" style="width:30px; height:30px;"></div>
                    <div class="p-4 bg-white rounded hover-shadow shadow">
                        <h5 class="fw-bold text-warning">2021</h5>
                        <p class="small text-muted mb-0">
                            Program percontohan layanan pekerja fisik diluncurkan di beberapa wilayah.
                        </p>
                    </div>
                </div>
                <div class="text-center position-relative p-3" style="flex:1 1 250px;">
                    <div class="rounded-circle bg-danger mx-auto mb-3" style="width:30px; height:30px;"></div>
                    <div class="p-4 bg-white rounded hover-shadow shadow">
                        <h5 class="fw-bold text-danger">2022</h5>
                        <p class="small text-muted mb-0">
                            <span class="align-items-center text-primary-emphasis fw-bold">
                                <img src="{{ asset('images/Icon.png') }}" style="width: 1rem;" />
                                Kerah Biru</span> dikembangkan menjadi platform penuh dengan fitur rating, pembayaran
                            aman, dan verifikasi pekerja.
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Vision Mission -->
    <section class="py-4 container" id="vision-mission">
        <div class="row align-items-start position-relative">

            <!-- Vision -->
            <div class="col-md-5">
                <h2 class="fw-bold mb-3" style="color: #052c62;">Visi Kami</h2>
                <p class="text-muted">
                    Menjadi platform tenaga kerja fisik terdepan di Indonesia
                    yang memberikan kesempatan kerja layak dan meningkatkan taraf hidup masyarakat.
                </p>
            </div>
            <!-- Divider Line -->
            <div class="divider-line d-none d-md-block"></div>
            <!-- Mission -->
            <div class="col-md-7 mt-4 mt-md-0">
                <h2 class="fw-bold mb-3" style="color: #052c62;">Misi Kami</h2>
                <ul class="fs-6 text-muted">
                    <li>Meningkatkan akses pekerjaan bagi pekerja fisik tanpa batasan usia.</li>
                    <li>Membantu masyarakat mendapatkan layanan jasa yang profesional dan terpercaya.</li>
                    <li>Menyediakan sistem pencocokan kerja yang adil berbasis rating dan ulasan.</li>
                    <li>Menjamin keamanan transaksi melalui pembayaran digital yang transparan.</li>
                    <li>Mendukung pemberdayaan ekonomi masyarakat melalui teknologi.</li>
                </ul>
            </div>
        </div>
    </section>

    <!-- Advantage -->
    <section class="py-5 bg-light" id="advantages">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-md-3">
                    <h2 class="fw-bold mb-3" style="color: #052c62;">
                        Kenapa Kami?
                    </h2>
                    <p class="text-muted mb-4">
                        Kami tak hanya menghubungkan — kami memberdayakan
                    </p>
                </div>
                <div class="col-md-9">
                    <div class="row g-4">
                        <div class="col-md-4">
                            <div class="card h-100 border-0 shadow-sm p-4 hover-shadow text-center">
                                <div class="icon-circle d-flex align-items-center justify-content-center rounded-circle bg-primary text-white mx-auto mb-3"
                                    style="width: 70px; height: 70px;">
                                    <i class="bi bi-people fs-3"></i>
                                </div>
                                <h5 class="fw-bold">Akses Kerja Inklusif</h5>
                                <p class="text-muted small">
                                    Kesempatan untuk bekerja tanpa diskriminasi usia dan latar belakang.
                                </p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card h-100 border-0 shadow-sm p-4 hover-shadow text-center">
                                <div class="icon-circle d-flex align-items-center justify-content-center rounded-circle bg-success text-white mx-auto mb-3"
                                    style="width: 70px; height: 70px;">
                                    <i class="bi bi-clock fs-3"></i>
                                </div>
                                <h5 class="fw-bold">Layanan yang Fleksibel</h5>
                                <p class="text-muted small">
                                    Pekerja bebas memilih waktu dan jenis pekerjaan sesuai kemampuan.
                                </p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card h-100 border-0 shadow-sm p-4 hover-shadow text-center">
                                <div class="icon-circle d-flex align-items-center justify-content-center rounded-circle bg-warning text-white mx-auto mb-3"
                                    style="width: 70px; height: 70px;">
                                    <i class="bi bi-search fs-3"></i>
                                </div>
                                <h5 class="fw-bold">Cepat & Tepat</h5>
                                <p class="text-muted small">
                                    Menemukan pekerja sesuai lokasi, tarif, dan keahlian.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Mitra -->
    <section class="py-5" id="clients">
        <div class="container text-center">
            <h2 class="fw-bold" style="color: #052c62;">Mitra Kami</h2>
            <p class="text-muted mb-5">
                Dipercaya oleh berbagai perusahaan dan penyedia jasa untuk memenuhi kebutuhan tenaga kerja fisik secara
                tepat dan
                berkualitas.
            </p>

            <div class="slider">
                <div class="slide-track">
                    <div class="slide text-center">
                        <img src="assets/images/client.jpg" alt="Client 5" class="rounded-circle mb-2" />
                        <p class="small fw-bold">CPT ABC</p>
                    </div>
                    <div class="slide text-center">
                        <img src="assets/images/analyst.jpg" alt="Client 5" class="rounded-circle mb-2" />
                        <p class="small fw-bold">PT BCD</p>
                    </div>
                    <div class="slide text-center">
                        <img src="assets/images/developer.jpg" alt="Client 5" class="rounded-circle mb-2" />
                        <p class="small fw-bold">PT EFG</p>
                    </div>
                    <div class="slide text-center">
                        <img src="assets/images/designer.jpg" alt="Client 5" class="rounded-circle mb-2" />
                        <p class="small fw-bold">PT FGH</p>
                    </div>
                    <div class="slide text-center">
                        <img src="assets/images/mission.jpg" alt="Client 5" class="rounded-circle mb-2" />
                        <p class="small fw-bold">PT SGH</p>
                    </div>
                    <div class="slide text-center">
                        <img src="assets/images/vision.jpg" alt="Client 5" class="rounded-circle mb-2" />
                        <p class="small fw-bold">PT JKT</p>
                    </div>
                    <div class="slide text-center">
                        <img src="assets/images/client.jpg" alt="Client 5" class="rounded-circle mb-2" />
                        <p class="small fw-bold">CPT ABC</p>
                    </div>
                    <div class="slide text-center">
                        <img src="assets/images/analyst.jpg" alt="Client 5" class="rounded-circle mb-2" />
                        <p class="small fw-bold">PT BCD</p>
                    </div>
                    <div class="slide text-center">
                        <img src="assets/images/developer.jpg" alt="Client 5" class="rounded-circle mb-2" />
                        <p class="small fw-bold">PT EFG</p>
                    </div>
                    <div class="slide text-center">
                        <img src="assets/images/designer.jpg" alt="Client 5" class="rounded-circle mb-2" />
                        <p class="small fw-bold">PT FGH</p>
                    </div>
                    <div class="slide text-center">
                        <img src="assets/images/mission.jpg" alt="Client 5" class="rounded-circle mb-2" />
                        <p class="small fw-bold">PT SGH</p>
                    </div>
                    <div class="slide text-center">
                        <img src="assets/images/vision.jpg" alt="Client 5" class="rounded-circle mb-2" />
                        <p class="small fw-bold">PT JKT</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="container border-bottom"></section>

    <!-- Contact Us -->
    <section class="py-5" id="contact">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold" style="color: #052c62;">Hubungi Kami</h2>
                <p class="text-muted">Mari berkolaborasi bersama dalam membangun masa depan kerja yang lebih inklusif
                    dan sejahtera bagi para pekerja
                    Indonesia.</p>
            </div>

            <div class="row g-4 align-items-center">
                <!-- Contact Person -->
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm p-4 h-100">
                        <ul class="list-unstyled mb-4">
                            <li class="mb-3">
                                <i class="bi bi-geo-alt-fill me-2"></i>
                                <strong>Alamat:</strong> Jl. Mampang Prapatan Raya, Jakarta Selatan 12790
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-telephone-fill me-2"></i>
                                <strong>HP:</strong> +62 812 1233 0404
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-envelope-fill me-2"></i>
                                <strong>Email:</strong> info@kerahbiru.com
                            </li>
                            <li>
                                <i class="bi bi-printer-fill me-2"></i>
                                <strong>Fax:</strong> 021 5098 3829
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- GMaps Location -->
                <div class="col-md-6">
                    <div class="ratio ratio-16x9 shadow-sm rounded">
                        <div style="width: 100%"><iframe width="100%" height="100%" frameborder="0" scrolling="no"
                                marginheight="0" marginwidth="0"
                                src="https://maps.google.com/maps?width=100%25&amp;height=200&amp;hl=en&amp;q=Jl.%20Mampang%20Prapatan%20Raya,%20No.%2073A%20Lantai%203,%20Jakarta%20Selatan%2012790+(Camp%20404)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"><a
                                    href="https://www.mapsdirections.info/fr/calculer-la-population-sur-une-carte">mesurer
                                    la population sur une carte</a></iframe></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="text-center py-2 text-white" style="background: #052c62;">
        <i class="opacity-75 small">Copyright &copy; 2025</i>
    </footer>

    <!-- Script Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous">
        </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
        </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js"
        integrity="sha384-7qAoOXltbVP82dhxHAUje59V5r2YsVfBafyUDxEdApLPmcdhBPg1DKg1ERo0BZlK" crossorigin="anonymous">
        </script>
</body>

</html>