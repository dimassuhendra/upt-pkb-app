@extends('admin.layouts')

@section('content')
    <style>
        .content-area { background-color: #f0f2f5; min-height: 100vh; font-family: 'Fredoka', sans-serif; }
        .stat-card { border: none; border-radius: 20px; transition: transform 0.3s ease; background: white; }
        .stat-card:hover { transform: translateY(-5px); }
        .icon-box { width: 50px; height: 50px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 24px; margin-bottom: 15px; }
        .table-card { border-radius: 20px; border: none; overflow: hidden; background: white; }
        .star-rating { color: #fbbf24; font-size: 14px; }
        .avg-number { font-weight: 800; color: #1e293b; margin-left: 8px; font-size: 15px; }
    </style>

    <div class="content-area p-4">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h3 class="fw-bold m-0">Ringkasan Operasional</h3>
                    <p class="text-muted">Pantau arus kendaraan dan kepuasan layanan hari ini</p>
                </div>
                <span class="badge bg-white text-dark shadow-sm p-2 px-3 rounded-pill">
                    <i class="fa fa-calendar-alt text-primary me-2"></i> {{ date('d M Y') }}
                </span>
            </div>

            <div class="row mb-4">
                @foreach([
                    ['title' => 'Pendaftaran', 'value' => $stats['total_daftar'], 'icon' => 'fa-users', 'bg' => '#eef2ff', 'text' => '#4338ca'],
                    ['title' => 'Dalam Uji', 'value' => $stats['sedang_uji'], 'icon' => 'fa-truck-fast', 'bg' => '#fffbeb', 'text' => '#b45309'],
                    ['title' => 'Lulus Uji', 'value' => $stats['lulus'], 'icon' => 'fa-check-circle', 'bg' => '#f0fdf4', 'text' => '#15803d'],
                    ['title' => 'Gagal Uji', 'value' => $stats['gagal'], 'icon' => 'fa-times-circle', 'bg' => '#fef2f2', 'text' => '#b91c1c']
                ] as $item)
                <div class="col-md-3">
                    <div class="card stat-card shadow-sm p-4">
                        <div class="icon-box" style="background: {{ $item['bg'] }}; color: {{ $item['text'] }};">
                            <i class="fa {{ $item['icon'] }}"></i>
                        </div>
                        <small class="text-muted fw-bold">{{ $item['title'] }}</small>
                        <h2 class="fw-bold m-0">{{ $item['value'] }}</h2>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card table-card shadow-sm">
                        <div class="card-header bg-white p-4 fw-bold border-0 d-flex justify-content-between align-items-center">
                            <span><i class="fa-solid fa-star text-warning me-2"></i> Laporan Kepuasan Pelanggan (Rata-rata 6 Pos)</span>
                        </div>
                        <div class="table-responsive">
                            <table class="table align-middle mb-0">
                                <thead>
                                    <tr>
                                        <th class="ps-4" style="width: 200px;">No. Kendaraan</th>
                                        <th style="width: 250px;">Rata-rata Rating</th>
                                        <th>Komentar/Saran</th>
                                        <th class="text-end pe-4">Waktu</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($recent_ratings as $rating)
                                        <tr>
                                            <td class="ps-4">
                                                <div class="fw-bold text-dark">{{ $rating->pendaftaran->kendaraan->no_kendaraan }}</div>
                                                <small class="text-muted">{{ $rating->pendaftaran->kendaraan->pemilik->nama_pemilik }}</small>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="star-rating">
                                                        @php $avg = round($rating->rata_rata); @endphp
                                                        @for($i = 1; $i <= 5; $i++)
                                                            <i class="fa{{ $i <= $avg ? '-solid' : '-regular' }} fa-star"></i>
                                                        @endfor
                                                    </div>
                                                    <span class="avg-number">{{ number_format($rating->rata_rata, 1) }}</span>
                                                </div>
                                            </td>
                                            <td class="text-muted">
                                                <i class="fa-solid fa-quote-left fa-xs me-2 opacity-50"></i>
                                                {{ $rating->komentar_utama ?? 'Tidak ada komentar' }}
                                            </td>
                                            <td class="text-end pe-4">
                                                <small class="text-muted">{{ \Carbon\Carbon::parse($rating->tgl_rating)->diffForHumans() }}</small>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center p-5 text-muted">Belum ada data rating masuk hari ini.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection