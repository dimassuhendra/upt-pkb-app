@extends('petugas.layouts')

@section('content')
    <style>
        .welcome-card {
            background: linear-gradient(135deg, #3A59D1 0%, #5C7CF2 100%);
            color: white;
            border-radius: 20px;
            border: none;
        }

        .stat-card {
            border-radius: 15px;
            border: none;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            transition: transform 0.2s;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .icon-circle {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>

    <div class="container-fluid p-4">
        <div class="card welcome-card mb-4 shadow-sm">
            <div class="card-body p-4">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h2 class="fw-bold">Selamat Datang, {{ $user->name }}!</h2>
                        <p class="mb-0 opacity-75">Semangat bertugas hari ini. Pastikan alat uji dalam kondisi prima.</p>
                    </div>
                    <div class="col-md-4 text-md-end mt-3 mt-md-0">
                        <div class="bg-white text-primary px-4 py-2 rounded-pill d-inline-block fw-bold shadow-sm">
                            <i class="fa fa-map-marker-alt me-2"></i> {{ $user->pos_tugas ?? 'Pos Belum Ditentukan' }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4 mb-4 d-flex justify-content-center">
            <div class="col-md-6 col-xl-3">
                <div class="card stat-card h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="icon-circle bg-light-primary" style="background: #eef2ff; color: #3A59D1;">
                                <i class="fa fa-users fa-lg"></i>
                            </div>
                            <span class="badge bg-soft-primary text-primary px-3 rounded-pill">Hari Ini</span>
                        </div>
                        <h3 class="fw-bold mb-1">{{ $jumlahAntrean }}</h3>
                        <p class="text-muted small mb-0">Total Antrean Kendaraan</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="card stat-card h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="icon-circle bg-light-success" style="background: #ecfdf5; color: #10b981;">
                                <i class="fa fa-clipboard-check fa-lg"></i>
                            </div>
                            <span class="badge bg-success text-white px-3 rounded-pill">Selesai</span>
                        </div>
                        <h3 class="fw-bold mb-1">{{ $pemeriksaanSaya }}</h3>
                        <p class="text-muted small mb-0">Kendaraan Saya Periksa</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card stat-card">
            <div class="card-header bg-white py-3 border-0">
                <h5 class="fw-bold m-0"><i class="fa fa-history me-2 text-primary"></i> Aktivitas Terakhir Saya</h5>
            </div>
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead class="bg-light small fw-bold text-muted">
                        <tr>
                            <th class="ps-4">WAKTU</th>
                            <th>NO. UJI</th>
                            <th>PLAT NOMOR</th>
                            <th>HASIL</th>
                            <th class="text-center">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($riwayatTerakhir as $riwayat)
                            <tr>
                                <td class="ps-4">{{ $riwayat->created_at->format('H:i') }} WIB</td>
                                <td class="fw-bold">{{ $riwayat->pendaftaran->no_uji }}</td>
                                <td><span
                                        class="badge bg-light text-dark border">{{ $riwayat->pendaftaran->kendaraan->no_kendaraan }}</span>
                                </td>
                                <td>
                                    <span
                                        class="badge {{ $riwayat->hasil_akhir == 'lulus' ? 'bg-success' : 'bg-danger' }} rounded-pill">
                                        {{ strtoupper($riwayat->hasil_akhir) }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-primary rounded-pill px-3">Detail</button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center p-5 text-muted">
                                    <div class="col-12 text-center">
                                        <img src="https://cdn-icons-png.flaticon.com/512/4076/4076549.png" width="100"
                                            class="mb-3 opacity-50">
                                        <p class="text-muted">Belum ada pemeriksaan yang dilakukan
                                            hari ini.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection