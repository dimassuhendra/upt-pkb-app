<style>
    /* Sidebar Container */
    .sidebar {
        width: 280px;
        min-width: 280px;
        background: var(--primary-color);
        /* #3A59D1 */
        color: white;
        min-height: 100vh;
        padding: 30px 15px;
        box-sizing: border-box;
        display: flex;
        flex-direction: column;
        box-shadow: 4px 0 10px rgba(0, 0, 0, 0.1);
    }

    /* Judul/Logo di Sidebar */
    .sidebar h2 {
        font-family: 'Domine', serif;
        font-size: 22px;
        color: white;
        text-align: center;
        margin-bottom: 40px;
        padding-bottom: 20px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    /* Label Kategori Menu (Main, Transaksi, dll) */
    .nav-label {
        font-family: 'Fredoka', sans-serif;
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        color: var(--light-color);
        /* #B5FCCD */
        margin: 25px 0 10px 15px;
        font-weight: 600;
        opacity: 0.8;
    }

    /* Link Navigasi */
    .nav-link {
        display: flex;
        align-items: center;
        padding: 12px 18px;
        color: rgba(255, 255, 255, 0.8);
        text-decoration: none;
        border-radius: 12px;
        margin-bottom: 5px;
        font-family: 'Fredoka', sans-serif;
        font-size: 14px;
        transition: all 0.3s ease;
    }

    /* Icon di samping teks menu */
    .nav-link i {
        width: 25px;
        font-size: 18px;
        margin-right: 12px;
        text-align: center;
    }

    /* Efek Hover */
    .nav-link:hover {
        background: rgba(255, 255, 255, 0.15);
        color: white;
        transform: translateX(5px);
    }

    /* State Menu yang sedang aktif */
    .nav-link.active {
        background: var(--white);
        color: var(--primary-color);
        font-weight: 600;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .nav-link.active i {
        color: var(--primary-color);
    }

    /* Tombol Keluar (Logout) */
    .logout-btn {
        width: 100%;
        text-align: left;
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        color: #FFB5B5;
        /* Warna merah soft */
        padding: 12px 18px;
        border-radius: 12px;
        cursor: pointer;
        font-family: 'Fredoka', sans-serif;
        font-size: 14px;
        font-weight: 600;
        margin-top: auto;
        /* Mendorong tombol ke paling bawah */
        transition: all 0.3s;
    }

    .logout-btn:hover {
        background: #E11D48;
        /* Merah tegas saat hover */
        color: white;
        border-color: transparent;
    }
</style>

<div class="sidebar">
    <div style="padding: 0 10px;">
        <h2 class="font-header" style="font-size: 20px; margin-bottom: 30px; letter-spacing: 1px;">
            <i class="fa-solid fa-truck-ramp-box mr-2"></i> PKB DIGITAL
        </h2>

        <nav class="sidebar-nav">
            <p class="nav-label">Main</p>
            <a href="{{ route('admin.dashboard') }}"
                class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fa fa-chart-line"></i> Dashboard
            </a>

            <p class="nav-label">Transaksi & Operasional</p>
            <a href="{{ route('admin.pendaftaran.create') }}"
                class="nav-link {{ request()->routeIs('admin.pendaftaran.create') ? 'active' : '' }}">
                <i class="fa fa-file-signature"></i> Pendaftaran Baru
            </a>
        <a href="{{ route('admin.antrean.index') }}" class="nav-link {{ request()->routeIs('admin.antrean.index') ? 'active' : '' }}">
                <i class="fa fa-list-ol"></i> Antrean Kendaraan
            </a>
            <a href="#" class="nav-link">
                <i class="fa fa-clipboard-check"></i> Rekap Hasil Uji
            </a>
            <a href="#" class="nav-link">
                <i class="fa fa-history"></i> Riwayat Uji
            </a>

            <p class="nav-label">Master Data</p>
            <a href="{{ route('admin.kendaraan.index') }}"
                class="nav-link {{ request()->routeIs('admin.kendaraan.index') ? 'active' : '' }}">
                <i class="fa fa-truck"></i> Data Kendaraan
            </a>
            <a href="{{ route('admin.pemilik.index') }}"
                class="nav-link {{ request()->routeIs('admin.pemilik.index') ? 'active' : '' }}">
                <i class="fa fa-users"></i> Data Pemilik
            </a>
            <a href="{{ route('admin.petugas.index') }}" class="nav-link {{ request()->routeIs('admin.petugas.index') ? 'active' : '' }}">
                <i class="fa fa-user-gear"></i> Data Petugas Pos
            </a>

            <p class="nav-label">Evaluasi</p>
            <a href="#" class="nav-link">
                <i class="fa fa-star"></i> Rating & Feedback
            </a>
            <a href="#" class="nav-link">
                <i class="fa fa-file-pdf"></i> Laporan Periodik
            </a>

            <div style="border-top: 1px solid rgba(255,255,255,0.1); margin: 20px 0;"></div>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout-btn">
                    <i class="fa fa-sign-out-alt mr-2"></i> Keluar Sistem
                </button>
            </form>
        </nav>
    </div>
</div>