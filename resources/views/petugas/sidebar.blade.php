<button class="sidebar-toggle" id="toggleBtn">
    <i class="fa-solid fa-bars"></i>
</button>

<div class="sidebar-overlay" id="overlay"></div>

<div class="sidebar" id="sidebar">
    <div style="padding: 0 10px; display: flex; flex-direction: column; height: 100%;">
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
                <a href="{{ route('petugas.antrean') }}"
                    class="nav-link {{ request()->is('petugas/visual*') ? 'active' : '' }}">
                    <i class="fa fa-eye"></i> Pemeriksaan Visual
                </a>
            @elseif(Auth::user()->pos_tugas == 'Pos 2')
                <a href="{{ route('petugas.antrean') }}"
                    class="nav-link {{ request()->is('petugas/emisi*') ? 'active' : '' }}">
                    <i class="fa fa-smog"></i> Pemeriksaan Emisi
                </a>
            @elseif(Auth::user()->pos_tugas == 'Pos 3')
                <a href="{{ route('petugas.antrean') }}"
                    class="nav-link {{ request()->is('petugas/rem*') ? 'active' : '' }}">
                    <i class="fa fa-stop-circle"></i> Pemeriksaan Rem
                </a>
            @elseif(Auth::user()->pos_tugas == 'Pos 4')
                <a href="{{ route('petugas.antrean') }}"
                    class="nav-link {{ request()->is('petugas/lampu*') ? 'active' : '' }}">
                    <i class="fa fa-bolt"></i> Lampu & Kebisingan
                </a>
            @elseif(Auth::user()->pos_tugas == 'Pos 5')
                <a href="{{ route('petugas.antrean') }}"
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

            <form action="{{ route('logout') }}" method="POST" class="mt-auto">
                @csrf
                <button type="submit" class="logout-btn">
                    <i class="fa-solid fa-right-from-bracket"></i> Keluar
                </button>
            </form>
        </nav>
    </div>
</div>

<style>
    /* --- CSS BASE --- */
    .sidebar {
        width: 280px;
        min-width: 280px;
        background: #3A59D1;
        color: white;
        height: 100vh;
        position: sticky;
        top: 0;
        padding: 30px 15px;
        box-sizing: border-box;
        display: flex;
        flex-direction: column;
        box-shadow: 4px 0 10px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }

    .sidebar h2 {
        font-family: 'Domine', serif;
        font-size: 22px;
        color: white;
        text-align: center;
        margin-bottom: 5px;
        padding-bottom: 20px;
    }

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

    .nav-link.active i { color: #3A59D1; }

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
        transition: all 0.3s;
    }

    .logout-btn:hover {
        background: #E11D48;
        color: white;
    }

    /* --- RESPONSIVE CSS --- */
    .sidebar-toggle {
        display: none;
        position: fixed;
        top: 20px;
        left: 20px;
        z-index: 1100;
        background: #3A59D1;
        color: white;
        border: none;
        width: 45px;
        height: 45px;
        border-radius: 10px;
        cursor: pointer;
        box-shadow: 0 4px 12px rgba(58, 89, 209, 0.3);
    }

    .sidebar-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        backdrop-filter: blur(4px);
        z-index: 999;
    }

    @media (max-width: 992px) {
        .sidebar {
            position: fixed;
            left: -280px;
            z-index: 1000;
        }

        .sidebar.active {
            left: 0;
        }

        .sidebar-toggle {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .sidebar-overlay.active {
            display: block;
        }
    }

    @media (max-width: 480px) {
        .sidebar {
            width: 260px;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggleBtn = document.getElementById('toggleBtn');
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');

        function toggleMenu() {
            sidebar.classList.toggle('active');
            overlay.classList.toggle('active');
        }

        if(toggleBtn) {
            toggleBtn.addEventListener('click', toggleMenu);
        }
        
        if(overlay) {
            overlay.addEventListener('click', toggleMenu);
        }
    });
</script>