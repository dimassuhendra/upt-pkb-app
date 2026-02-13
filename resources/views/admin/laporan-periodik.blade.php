@extends('admin.layouts')

@section('content')
    <style>
        /* UI Styling */
        .stat-card {
            border-radius: 12px;
            border: none;
            transition: transform 0.2s;
        }

        .icon-box {
            width: 42px;
            height: 42px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .bg-soft-primary {
            background: #eef2ff;
            color: #4e73df;
        }

        .bg-soft-success {
            background: #ecfdf5;
            color: #10b981;
        }

        .bg-soft-danger {
            background: #fff1f2;
            color: #f43f5e;
        }

        /* PRINT LOGIC - Rahasia agar rapi saat dicetak */
        @media print {

            /* Sembunyikan elemen yang tidak perlu di kertas */
            .no-print,
            .sidebar,
            .navbar,
            .btn,
            form,
            .breadcrumb,
            footer {
                display: none !important;
            }

            /* Atur ulang margin halaman */
            body {
                background-color: white !important;
                margin: 0;
                padding: 0;
            }

            .content-area {
                padding: 0 !important;
            }

            .card {
                border: none !important;
                box-shadow: none !important;
            }

            /* Munculkan Judul Khusus Cetak (Hanya saat di print) */
            .print-header {
                display: block !important;
                text-align: center;
                margin-bottom: 30px;
                border-bottom: 2px solid #000;
                padding-bottom: 10px;
            }

            /* Tabel agar memenuhi kertas */
            table {
                width: 100% !important;
                border: 1px solid #000 !important;
            }

            .table th {
                background-color: #f8f9fa !important;
                color: black !important;
                -webkit-print-color-adjust: exact;
            }
        }

        /* Sembunyikan Header Print di layar monitor */
        .print-header {
            display: none;
        }
    </style>

    <div class="content-area p-4">

        <div class="print-header text-center">
            <h4 class="fw-bold mb-0">LAPORAN PENGUJIAN KENDARAAN BERMOTOR</h4>
            <p class="mb-0 small text-uppercase">Periode: {{ $startDate }} s/d {{ $endDate }}</p>
        </div>

        <div class="mb-4 no-print d-flex justify-content-between align-items-center">
            <div>
                <h3 class="fw-bold m-0">Laporan Periodik</h3>
                <p class="text-muted small">Analisis statistik pengujian kendaraan bermotor</p>
            </div>
        </div>

        <div class="card shadow-sm mb-4 no-print border-0 rounded-3">
            <div class="card-body p-3">
                <form action="{{ route('admin.laporan.index') }}" method="GET" class="row align-items-end g-2">
                    <div class="col-md-3">
                        <label class="form-label small fw-bold text-secondary">Dari Tanggal</label>
                        <input type="date" name="start_date" class="form-control form-control-sm" value="{{ $startDate }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label small fw-bold text-secondary">Sampai Tanggal</label>
                        <input type="date" name="end_date" class="form-control form-control-sm" value="{{ $endDate }}">
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary btn-sm w-100 shadow-sm">
                            <i class="fa fa-sync me-2"></i>Filter
                        </button>
                    </div>
                    <div class="col-md-2">
                        <button type="button" onclick="window.print()" class="btn btn-dark btn-sm w-100 shadow-sm">
                            <i class="fa fa-print me-2"></i>Cetak Laporan
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="row mb-4 g-3">
            <div class="col-md-4 col-4">
                <div class="card stat-card shadow-sm border-0">
                    <div class="card-body p-3 d-flex align-items-center">
                        <div class="icon-box bg-soft-primary me-3 no-print">
                            <i class="fa fa-car-side"></i>
                        </div>
                        <div>
                            <div class="text-muted" style="font-size: 0.75rem;">Total Pengujian</div>
                            <h5 class="fw-bold m-0">{{ $stats['total'] }}</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-4">
                <div class="card stat-card shadow-sm border-0">
                    <div class="card-body p-3 d-flex align-items-center">
                        <div class="icon-box bg-soft-success me-3 no-print">
                            <i class="fa fa-check-circle"></i>
                        </div>
                        <div>
                            <div class="text-muted" style="font-size: 0.75rem;">Lulus Uji</div>
                            <h5 class="fw-bold m-0 text-success">{{ $stats['lulus'] }}</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-4">
                <div class="card stat-card shadow-sm border-0">
                    <div class="card-body p-3 d-flex align-items-center">
                        <div class="icon-box bg-soft-danger me-3 no-print">
                            <i class="fa fa-times-circle"></i>
                        </div>
                        <div>
                            <div class="text-muted" style="font-size: 0.75rem;">Gagal Uji</div>
                            <h5 class="fw-bold m-0 text-danger">{{ $stats['gagal'] }}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow-sm border-0 rounded-3">
            <div class="card-header bg-white py-3 no-print border-0">
                <h6 class="m-0 fw-bold">Rincian Data Pengujian</h6>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" id="report-table">
                    <thead class="bg-light">
                        <tr style="font-size: 0.75rem;">
                            <th class="ps-4 text-secondary fw-bold">TANGGAL</th>
                            <!-- <th class="text-secondary fw-bold">NOMOR UJI</th> -->
                             <th class="text-secondary fw-bold">NAMA PEMILIK</th>
                            <th class="text-secondary fw-bold">PLAT NOMOR</th>
                            <th class="text-secondary fw-bold">JENIS KENDARAAN</th>
                            <th class="text-secondary fw-bold">HASIL AKHIR</th>
                        </tr>
                    </thead>
                    <tbody style="font-size: 0.85rem;">
                        @forelse($data as $item)
                            <tr>
                                <td class="ps-4">{{ $item->created_at->format('d/m/Y') }}</td>
                                <!-- <td class="fw-medium text-dark">{{ $item->pendaftaran->no_uji }}</td> -->
                                <td class="fw-bold text-primary">{{ $item->pendaftaran->kendaraan->pemilik->nama_lengkap ?? 'DATA TIDAK DITEMUKAN' }}</td>
                                <td class="fw-bold text-primary">{{ $item->pendaftaran->kendaraan->no_kendaraan }}</td>
                                <td>{{ $item->pendaftaran->kendaraan->jenis_kendaraan }}</td>
                                <td>
                                    <span
                                        class="badge {{ $item->hasil_akhir == 'lulus' ? 'bg-success' : 'bg-danger' }} rounded-pill"
                                        style="font-size: 0.7rem;">
                                        {{ strtoupper($item->hasil_akhir) }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5 text-muted">
                                    <i class="fa fa-folder-open d-block mb-2 fs-3"></i>
                                    Tidak ada data untuk periode ini.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        // Opsional: Otomatis set nama file saat diprint (hanya di chrome)
        window.onbeforeprint = function () {
            document.title = "Laporan_PKB_{{ $startDate }}_sd_{{ $endDate }}";
        };
    </script>
@endsection