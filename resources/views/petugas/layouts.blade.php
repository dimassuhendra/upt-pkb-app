<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - UPT PKB DIGITAL</title>

    <link href="https://fonts.googleapis.com/css2?family=Domine:wght@400..700&family=Fredoka:wght@300..700&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">

    @stack('styles') {{-- Tempat jika ada CSS tambahan khusus per halaman --}}
</head>

<body>

    <div class="dashboard-wrapper">
        @include('petugas.sidebar')

        <div class="main-content">
            <header class="admin-header">
                <div class="header-left">
                    <div class="page-info">
                        <h4 class="font-header">Panel Administrator</h4>
                        <nav class="breadcrumb">
                            <span>Admin</span>
                            <i class="fa fa-chevron-right"></i>
                            <span class="current-page">{{ ucfirst(Request::segment(2)) }}</span>
                        </nav>
                    </div>

                </div>

                <div class="header-right">
                    <div class="digital-clock">
                        <i class="fa-regular fa-clock"></i>
                        <span id="clock">00:00:00</span>
                    </div>

                    <div class="header-icon-btn">
                        <i class="fa-regular fa-bell"></i>
                        <span class="notification-dot"></span>
                    </div>

                    <div class="user-profile-wrapper">
                        <div class="user-info">
                            <span class="user-name">{{ Auth::user()->name }}</span>
                            <span class="user-role">{{ Auth::user()->role }}</span>
                        </div>
                        <div class="user-avatar">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
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