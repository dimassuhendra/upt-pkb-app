<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - UPT PKB DIGITAL</title>

    <link href="https://fonts.googleapis.com/css2?family=Domine:wght@400..700&family=Fredoka:wght@300..700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">

    @stack('styles') {{-- Tempat jika ada CSS tambahan khusus per halaman --}}
</head>

<body>

    <div class="dashboard-wrapper">
        @include('admin.sidebar')

        <div class="main-content">
            <header class="admin-header border-bottom shadow-sm bg-white">
                <div class="container-fluid py-3">
                    <div class="row align-items-center">
                        <div class="col-2 text-start">
                            <img src="{{ asset('img/logo-bandarlampung.png') }}" alt="Logo Pemkot" style="height: 80px; width: auto;">
                        </div>

                        <div class="col-8 text-center">
                            <div class="instansi-title">
                                <h5 class="m-0 fw-bold text-uppercase" style="letter-spacing: 1.5px; font-size: 16px; color: #1f2937;">
                                    Pemerintah Kota Bandar Lampung
                                </h5>
                                <h2 class="m-0 fw-bold text-uppercase" style="letter-spacing: 2px; color: #111827; font-size: 26px;">
                                    Dinas Perhubungan
                                </h2>
                                <p class="m-0 text-muted" style="font-size: 11px; letter-spacing: 0.5px;">
                                    JL. BASUKI RAHMAT NO. 34, SUMUR PUTRI, TLK BETUNG UTARA, KOTA BANDAR LAMPUNG, LAMPUNG 35211
                                </p>
                            </div>
                        </div>

                        <div class="col-2 text-end">
                            <img src="{{ asset('img/logo-dishub.png') }}" alt="Logo Dishub" style="height: 80px; width: auto;">
                        </div>
                    </div>

                    <div class="d-flex justify-content-center mt-3">
                        <nav class="breadcrumb bg-light px-3 py-1 rounded-pill border" style="font-size: 12px;">
                            <span class="text-muted">Admin</span>
                            <i class="fa fa-chevron-right mx-2 text-muted" style="font-size: 9px; align-self: center;"></i>
                            <span class="text-primary fw-bold">{{ ucfirst(Request::segment(2)) }}</span>
                        </nav>
                    </div>
                </div>
            </header>

            @yield('content')

        </div>
    </div>

    @stack('scripts')
    <script>
        function updateClock() {
            const now = new Date();
            const timeString = now.toLocaleTimeString('id-ID', { hour12: false });
            document.getElementById('clock').textContent = timeString + " WIB";
        }
        setInterval(updateClock, 1000);
        updateClock();
    </script>
</body>

</html>