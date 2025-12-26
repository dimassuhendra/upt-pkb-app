@extends('admin.layouts')

@section('content')
    <style>
        .stat-card {
            border-radius: 15px;
            border: none;
            transition: transform 0.2s;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .icon-box {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>

    <div class="content-area p-4">
        <div class="mb-4">
            <h3 class="fw-bold">Laporan Periodik</h3>
            <p class="text-muted">Analisis statistik pengujian kendaraan bermotor</p>
        </div>

        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <form action="{{ route('admin.laporan.index') }}" method="GET" class="row align-items-end g-3">
                    <div class="col-md-3">
                        <label class="form-label small fw-bold">Dari Tanggal</label>
                        <input type="date" name="start_date" class="form-control" value="{{ $startDate }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label small fw-bold">Sampai Tanggal</label>
                        <input type="date" name="end_date" class="form-control" value="{{ $endDate }}">
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100"><i class="fa fa-sync me-2"></i>Filter</button>
                    </div>
                    <div class="col-md-2">
                        <button type="button" onclick="window.print()" class="btn btn-outline-dark w-100">
                            <i class="fa fa-print me-2"></i>Cetak Laporan
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card stat-card shadow-sm bg-white">
                    <div class="card-body d-flex align-items-center">
                        <div class="icon-box bg-soft-primary text-primary me-3" style="background: #eef2ff;">
                            <i class="fa fa-car-side fa-lg"></i>
                        </div>
                        <div>
                            <div class="text-muted small">Total Pengujian</div>
                            <h4 class="fw-bold m-0">{{ $stats['total'] }}</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card stat-card shadow-sm bg-white">
                    <div class="card-body d-flex align-items-center">
                        <div class="icon-box bg-soft-success text-success me-3" style="background: #ecfdf5;">
                            <i class="fa fa-check-circle fa-lg"></i>
                        </div>
                        <div>
                            <div class="text-muted small">Lulus Uji</div>
                            <h4 class="fw-bold m-0 text-success">{{ $stats['lulus'] }}</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card stat-card shadow-sm bg-white">
                    <div class="card-body d-flex align-items-center">
                        <div class="icon-box bg-soft-danger text-danger me-3" style="background: #fff1f2;">
                            <i class="fa fa-times-circle fa-lg"></i>
                        </div>
                        <div>
                            <div class="text-muted small">Tidak Lulus</div>
                            <h4 class="fw-bold m-0 text-danger">{{ $stats['gagal'] }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-header bg-white py-3">
                <h6 class="m-0 fw-bold">Rincian Data Pengujian</h6>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light small fw-bold">
                        <tr>
                            <th class="ps-4">TANGGAL</th>
                            <th>NOMOR UJI</th>
                            <th>PLAT NOMOR</th>
                            <th>JENIS KENDARAAN</th>
                            <th>HASIL AKHIR</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($data as $item)
                            <tr>
                                <td class="ps-4">{{ $item->created_at->format('d/m/Y') }}</td>
                                <td>{{ $item->pendaftaran->no_uji }}</td>
                                <td class="fw-bold">{{ $item->pendaftaran->kendaraan->no_kendaraan }}</td>
                                <td>{{ $item->pendaftaran->kendaraan->jenis_kendaraan }}</td>
                                <td>
                                    <span class="badge {{ $item->hasil_akhir == 'lulus' ? 'bg-success' : 'bg-danger' }}">
                                        {{ strtoupper($item->hasil_akhir) }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5 text-muted">Tidak ada data untuk periode ini.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection