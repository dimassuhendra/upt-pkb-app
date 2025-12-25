@extends('petugas.layouts')

@section('content')
    <style>
        /* Styling Card Modern */
        .stat-card {
            border: none;
            border-radius: 12px;
            color: white;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 20px rgba(0, 0, 0, 0.15);
        }

        .stat-card .card-body {
            padding: 1.5rem;
            z-index: 1;
            position: relative;
        }

        .stat-card i {
            position: absolute;
            right: 15px;
            bottom: 10px;
            font-size: 3.5rem;
            opacity: 0.2;
        }

        /* Warna Custom */
        .bg-gradient-blue {
            background: linear-gradient(45deg, #3a7bd5, #00d2ff);
        }

        .bg-gradient-green {
            background: linear-gradient(45deg, #11998e, #38ef7d);
        }

        .bg-gradient-orange {
            background: linear-gradient(45deg, #f2994a, #f2c94c);
        }

        .table-container {
            background: #ffffff;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }
    </style>

    <div class="container py-4">
        <div class="row g-4 mb-5">
            <div class="col-md-4">
                <div class="card stat-card bg-gradient-blue">
                    <div class="card-body">
                        <h6 class="text-uppercase fw-bold small">Total Uji Hari Ini</h6>
                        <h2 class="fw-bold mb-0">{{ $stats['total_uji_hari_ini'] }}</h2>
                        <p class="small mb-0 mt-2"><i class="fas fa-arrow-up me-1"></i> Transaksi Aktif</p>
                        <i class="fas fa-file-signature"></i>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card stat-card bg-gradient-green">
                    <div class="card-body">
                        <h6 class="text-uppercase fw-bold small">Kendaraan Lulus</h6>
                        <h2 class="fw-bold mb-0">{{ $stats['lulus_hari_ini'] }}</h2>
                        <p class="small mb-0 mt-2"><i class="fas fa-check-circle me-1"></i> Layak Jalan</p>
                        <i class="fas fa-truck-check"></i>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card stat-card bg-gradient-orange">
                    <div class="card-body">
                        <h6 class="text-uppercase fw-bold small">Rata-rata Rating</h6>
                        <h2 class="fw-bold mb-0">{{ number_format($stats['rating_rata_rata'], 1) }}</h2>
                        <p class="small mb-0 mt-2"><i class="fas fa-star me-1"></i> Kepuasan Publik</p>
                        <i class="fas fa-users"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="table-container p-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="fw-bold"><i class="fas fa-list-ol me-2 text-primary"></i>Antrean Pos Pemeriksaan</h5>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light text-secondary">
                                <tr>
                                    <th>NO. ANTREAN</th>
                                    <th>NOMOR UJI</th>
                                    <th>STATUS</th>
                                    <th class="text-center">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($antreanPos as $item)
                                    <tr>
                                        <td class="fw-bold">#{{ $item->nomor_antrean }}</td>
                                        <td>{{ $item->kendaraan->no_uji }}</td>
                                        <td><span class="badge bg-soft-info text-info border border-info px-3">Dalam
                                                Proses</span></td>
                                        <td class="text-center">
                                            <button class="btn btn-primary btn-sm rounded-pill px-4" data-bs-toggle="modal"
                                                data-bs-target="#modalUji{{ $item->id }}">
                                                Input Hasil
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-4">Belum ada antrean masuk.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection