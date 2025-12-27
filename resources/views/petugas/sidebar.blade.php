<style>
    /* Sidebar Container */
    .sidebar {
        width: 280px;
        min-width: 280px;
        background: #3A59D1;
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
        margin-bottom: 5px;
        /* Dikurangi untuk memberi ruang info petugas */
        padding-bottom: 20px;
    }

    /* Info Petugas di Sidebar */
    .petugas-info {
        background: rgba(255, 255, 255, 0.1);
        border-radius: 12px;
        padding: 12px;
        margin-bottom: 25px;
        text-align: center;
    }

    .petugas-info .pos-badge {
        background: #B5FCCD;
        color: #166534;
        font-size: 11px;
        font-weight: 700;
        padding: 3px 10px;
        border-radius: 20px;
        text-transform: uppercase;
        display: inline-block;
        margin-top: 5px;
    }

    /* Label Kategori Menu */
    .nav-label {
        font-family: 'Fredoka', sans-serif;
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        color: #B5FCCD;
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

    .nav-link i {
        width: 25px;
        font-size: 18px;
        margin-right: 12px;
        text-align: center;
    }

    .nav-link:hover {
        background: rgba(255, 255, 255, 0.15);
        color: white;
        transform: translateX(5px);
    }

    .nav-link.active {
        background: white;
        color: #3A59D1;
        font-weight: 600;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .nav-link.active i {
        color: #3A59D1;
    }

    .logout-btn {
        width: 100%;
        text-align: left;
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        color: #FFB5B5;
        padding: 12px 18px;
        border-radius: 12px;
        cursor: pointer;
        font-family: 'Fredoka', sans-serif;
        font-size: 14px;
        font-weight: 600;
        margin-top: auto;
        transition: all 0.3s;
    }

    .logout-btn:hover {
        background: #E11D48;
        color: white;
        border-color: transparent;
    }
</style>

<div class="sidebar">
    <div style="padding: 0 10px;">
        <h2 class="font-header">
            <i class="fa-solid fa-shield-halved"></i> PKB SYSTEM
        </h2>

        <div class="petugas-info">
            <div class="small fw-light" style="font-size: 12px; opacity: 0.8;">Petugas Aktif:</div>
            <div class="fw-bold">{{ Auth::user()->name }}</div>
            <span class="pos-badge">{{ Auth::user()->pos_tugas ?? 'Belum Ada Pos' }}</span>
        </div>

        <nav class="sidebar-nav">
            <p class="nav-label">Main Menu</p>
            <a href="{{ route('petugas.dashboard') }}"
                class="nav-link {{ request()->routeIs('petugas.dashboard') ? 'active' : '' }}">
                <i class="fa fa-th-large"></i> Dashboard
            </a>

            <p class="nav-label">Proses Uji</p>

            <a href="{{ route('petugas.antrean') }}"
                class="nav-link {{ request()->routeIs('petugas.antrean*') ? 'active' : '' }}">
                <i class="fa fa-list-ol"></i> Antrean Kendaraan
            </a>

            @if(Auth::user()->pos_tugas == 'Pos 1')
                <a href="{{ route('petugas.visual.index') }}"
                    class="nav-link {{ request()->is('petugas/visual*') ? 'active' : '' }}">
                    <i class="fa fa-eye"></i> Pemeriksaan Visual
                </a>
            @elseif(Auth::user()->pos_tugas == 'Pos 2')
                <a href="{{ route('petugas.emisi.index') }}"
                    class="nav-link {{ request()->is('petugas/emisi*') ? 'active' : '' }}">
                    <i class="fa fa-smog"></i> Pemeriksaan Emisi
                </a>
            @elseif(Auth::user()->pos_tugas == 'Pos 3')
                <a href="{{ route('petugas.rem.index') }}"
                    class="nav-link {{ request()->is('petugas/rem*') ? 'active' : '' }}">
                    <i class="fa fa-stop-circle"></i> Pemeriksaan Rem
                </a>
            @elseif(Auth::user()->pos_tugas == 'Pos 4')
                <a href="{{ route('petugas.lampu.index') }}"
                    class="nav-link {{ request()->is('petugas/lampu*') ? 'active' : '' }}">
                    <i class="fa fa-bolt"></i> Lampu & Kebisingan
                </a>
            @elseif(Auth::user()->pos_tugas == 'Pos 5')
                <a href="{{ route('petugas.roda.index') }}"
                    class="nav-link {{ request()->is('petugas/roda*') ? 'active' : '' }}">
                    <i class="fa fa-arrows-left-right"></i> Kuncup Roda Depan
                </a>
            @endif

            <a href="{{ route('petugas.riwayat') }}"
                class="nav-link {{ request()->routeIs('petugas.riwayat') ? 'active' : '' }}">
                <i class="fa fa-history"></i> Riwayat Input Saya
            </a>

            <p class="nav-label">Sistem</p>
            <a href="{{ route('petugas.profil') }}"
                class="nav-link {{ request()->routeIs('petugas.profil') ? 'active' : '' }}">
                <i class="fa fa-user-circle"></i> Profil Saya
            </a>

            <div style="border-top: 1px solid rgba(255,255,255,0.1); margin: 20px 0;"></div>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout-btn">
                    <i class="fa fa-right-from-bracket mr-2"></i> Keluar
                </button>
            </form>
        </nav>
    </div>
</div>