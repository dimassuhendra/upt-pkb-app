@extends('admin.layouts')

@section('content')
    <style>
        .table-card {
            border-radius: 15px;
            border: none;
            background: white;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }
    </style>
    <div class="d-flex">
        <div class="content-area w-100 p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h3 class="fw-bold">Rekap Hasil Uji</h3>
                    <p class="text-muted">Daftar kendaraan yang telah selesai melakukan pengujian</p>
                </div>
            </div>

            <div class="card table-card">
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead class="bg-light text-muted small">
                            <tr>
                                <th class="ps-4">TANGGAL</th>
                                <th>NO. UJI / PLAT</th>
                                <th>PEMILIK</th>
                                <th>HASIL AKHIR</th>
                                <th class="text-center">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($rekap as $r)
                                <tr>
                                    <td class="ps-4">{{ $r->created_at->format('d/m/Y') }}</td>
                                    <td>
                                        <div class="fw-bold">{{ $r->pendaftaran->no_uji }}</div>
                                        <div class="small text-muted">{{ $r->pendaftaran->kendaraan->no_kendaraan }}</div>
                                    </td>
                                    <td>{{ $r->pendaftaran->nama_pemilik }}</td>
                                    <td>
                                        <span class="badge {{ $r->hasil_akhir == 'lulus' ? 'bg-success' : 'bg-danger' }}">
                                            {{ strtoupper($r->hasil_akhir) }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.hasil_uji.cetak', $r->id) }}" target="_blank"
                                            class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                            <i class="fa fa-print me-1"></i> Cetak PDF
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center p-5 text-muted">Belum ada hasil uji yang dapat ditampilkan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection