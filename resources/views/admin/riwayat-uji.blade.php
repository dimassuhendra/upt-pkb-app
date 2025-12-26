@extends('admin.layouts')

@section('content')
    <style>
        .content-area {
            background: #f8faff;
            min-height: 100vh;
        }

        .card {
            border-radius: 15px;
            border: none;
        }

        .search-box {
            border-radius: 10px;
            border: 1px solid #e2e8f0;
            padding-left: 40px;
        }

        .search-icon {
            position: absolute;
            left: 15px;
            top: 10px;
            color: #94a3b8;
        }

        .badge-lulus {
            background: #dcfce7;
            color: #166534;
        }

        .badge-gagal {
            background: #fee2e2;
            color: #991b1b;
        }
    </style>

    <div class="content-area p-4">
        <div class="mb-4">
            <h3 class="fw-bold m-0">Riwayat Pengujian</h3>
            <p class="text-muted small">Log lengkap aktivitas pengujian kendaraan</p>
        </div>

        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <form action="{{ route('admin.riwayat.index') }}" method="GET" class="row g-3">
                    <div class="col-md-5 position-relative">
                        <i class="fa fa-search search-icon"></i>
                        <input type="text" name="search" class="form-control search-box"
                            placeholder="Cari No. Uji atau Plat Nomor..." value="{{ request('search') }}">
                    </div>
                    <div class="col-md-3">
                        <select name="status" class="form-select border-0 bg-light">
                            <option value="">Semua Status</option>
                            <option value="lulus" {{ request('status') == 'lulus' ? 'selected' : '' }}>Lulus</option>
                            <option value="tidak_lulus" {{ request('status') == 'tidak_lulus' ? 'selected' : '' }}>Tidak Lulus
                            </option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100">Filter</button>
                    </div>
                    <div class="col-md-2">
                        <a href="{{ route('admin.riwayat.index') }}" class="btn btn-outline-secondary w-100">Reset</a>
                    </div>
                </form>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead class="bg-light text-muted small fw-bold">
                        <tr>
                            <th class="ps-4">WAKTU UJI</th>
                            <th>KENDARAAN</th>
                            <th>PEMERIKSA (PETUGAS)</th>
                            <th>SKOR TEKNIS</th>
                            <th>STATUS AKHIR</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($riwayat as $r)
                            <tr>
                                <td class="ps-4">
                                    <div class="fw-bold">{{ $r->created_at->format('d M Y') }}</div>
                                    <div class="text-muted x-small">{{ $r->created_at->format('H:i') }} WIB</div>
                                </td>
                                <td>
                                    <div class="fw-bold text-primary">{{ $r->pendaftaran->kendaraan->no_kendaraan }}</div>
                                    <div class="small text-muted">{{ $r->pendaftaran->no_uji }}</div>
                                </td>
                                <td>
                                    <div class="small fw-bold">{{ $r->petugas->name }}</div>
                                    <div class="x-small text-muted">Akses: {{ str_replace('_', ' ', $r->petugas->role) }}</div>
                                </td>
                                <td>
                                    <div class="small">Rem: <strong>{{ $r->rem_utama }} kg</strong></div>
                                    <div class="small">Emisi: <strong>{{ $r->emisi_co }}%</strong></div>
                                </td>
                                <td>
                                    <span
                                        class="badge {{ $r->hasil_akhir == 'lulus' ? 'badge-lulus' : 'badge-gagal' }} text-uppercase">
                                        {{ str_replace('_', ' ', $r->hasil_akhir) }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5 text-muted">Data riwayat tidak ditemukan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="card-footer bg-white border-0 py-3">
                {{ $riwayat->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
@endsection