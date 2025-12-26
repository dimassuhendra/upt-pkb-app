@extends('admin.layouts')

@section('content')
    <style>
        /* Global Content Style */
        .content-area {
            background-color: #f0f2f5;
            min-height: 100vh;
            font-family: 'Fredoka', sans-serif;
        }

        /* Statistik Cards */
        .stat-card {
            border: none;
            border-radius: 20px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            background: white;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
        }

        .icon-box {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            margin-bottom: 15px;
        }

        /* Jalur Uji / Stepper Style */
        .pos-box {
            background: white;
            border: 2px solid #edf2f7;
            border-radius: 18px;
            padding: 20px;
            position: relative;
            transition: all 0.3s;
        }

        .pos-box.active-load {
            border-color: #3A59D1;
            background: #f0f4ff;
        }

        .pos-box.over-load {
            border-color: #e11d48;
            background: #fff1f2;
        }

        .pos-box h6 {
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #64748b;
            font-weight: 700;
        }

        .pos-box h3 {
            color: #1e293b;
            font-weight: 800;
            margin: 10px 0;
        }

        /* Badge & Tables */
        .table-card {
            border-radius: 20px;
            border: none;
            overflow: hidden;
        }

        .table thead th {
            background: #f8fafc;
            border-bottom: 2px solid #edf2f7;
            color: #64748b;
            font-size: 12px;
            text-transform: uppercase;
        }

        .star-rating {
            color: #fbbf24;
            font-size: 14px;
        }

        /* Info Banner */
        .info-banner {
            background: linear-gradient(135deg, #3A59D1 0%, #6366f1 100%);
            border-radius: 20px;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .info-banner::after {
            content: '';
            position: absolute;
            top: -20px;
            right: -20px;
            width: 100px;
            height: 100px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
        }
    </style>

    <div class="d-flex">
        <div class="content-area w-100 p-4">
            <div class="container-fluid">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h3 class="fw-bold m-0">Ringkasan Operasional</h3>
                        <p class="text-muted">Pantau arus kendaraan di UPT PKB secara real-time</p>
                    </div>
                    <span class="badge bg-white text-dark shadow-sm p-2 px-3 rounded-pill">
                        <i class="fa fa-calendar-alt text-primary me-2"></i> {{ date('d M Y') }}
                    </span>
                </div>

                <div class="row mb-4">
                    <div class="col-md-3">
                        <div class="card stat-card shadow-sm p-4">
                            <div class="icon-box bg-light-primary text-primary" style="background: #eef2ff;">
                                <i class="fa fa-users"></i>
                            </div>
                            <small class="text-muted fw-bold">Pendaftaran</small>
                            <h2 class="fw-bold m-0">{{ $stats['total_daftar'] }}</h2>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card stat-card shadow-sm p-4">
                            <div class="icon-box bg-light-warning text-warning" style="background: #fffbeb;">
                                <i class="fa fa-truck-fast"></i>
                            </div>
                            <small class="text-muted fw-bold">Dalam Uji</small>
                            <h2 class="fw-bold m-0">{{ $stats['sedang_uji'] }}</h2>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card stat-card shadow-sm p-4">
                            <div class="icon-box bg-light-success text-success" style="background: #f0fdf4;">
                                <i class="fa fa-check-circle"></i>
                            </div>
                            <small class="text-muted fw-bold">Lulus Uji</small>
                            <h2 class="fw-bold m-0">{{ $stats['lulus'] }}</h2>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card stat-card shadow-sm p-4">
                            <div class="icon-box bg-light-danger text-danger" style="background: #fef2f2;">
                                <i class="fa fa-times-circle"></i>
                            </div>
                            <small class="text-muted fw-bold">Gagal Uji</small>
                            <h2 class="fw-bold m-0">{{ $stats['gagal'] }}</h2>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-7">
                        <div class="card table-card shadow-sm">
                            <div class="card-header bg-white p-3 fw-bold border-0">
                                Masukan & Rating Supir
                            </div>
                            <div class="table-responsive">
                                <table class="table align-middle mb-0">
                                    <thead>
                                        <tr>
                                            <th class="ps-4">No. Kendaraan</th>
                                            <th>Kepuasan</th>
                                            <th>Komentar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($recent_ratings as $rating)
                                            <tr>
                                                <td class="ps-4 fw-bold text-dark">
                                                    {{ $rating->pendaftaran->kendaraan->no_kendaraan }}</td>
                                                <td class="star-rating">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        <i
                                                            class="fa{{ $i <= $rating->skor_bintang ? '-solid' : '-regular' }} fa-star"></i>
                                                    @endfor
                                                </td>
                                                <td class="text-muted"><small>{{ $rating->komentar ?? '-' }}</small></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-5">
                        <div
                            class="card info-banner shadow-sm p-4 h-100 border-0 d-flex flex-column justify-content-center">
                            <h4 class="fw-bold mb-3">Evaluasi Hari Ini</h4>
                            <p class="mb-4" style="opacity: 0.9; line-height: 1.6;">
                                Gunakan data monitoring di atas untuk mengatur ritme kerja petugas lapangan. Jika terjadi
                                penumpukan di salah satu pos, segera lakukan koordinasi.
                            </p>
                            <div>
                                <button class="btn btn-light rounded-pill px-4 fw-bold text-primary shadow-sm">
                                    <i class="fa fa-print me-2"></i> Cetak Laporan
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection