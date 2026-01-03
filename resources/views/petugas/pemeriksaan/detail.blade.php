@extends('petugas.layouts')

@section('content')
    <div class="container-fluid p-4">
        <div class="mb-4">
            <a href="{{ route('petugas.riwayat') }}" class="text-decoration-none"><i class="fa fa-arrow-left me-2"></i>
                Kembali ke Riwayat</a>
            <h3 class="fw-bold mt-2">Detail Hasil Pemeriksaan</h3>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-primary text-white">Informasi Kendaraan</div>
                    <div class="card-body">
                        <table class="table table-borderless table-sm mb-0">
                            <tr>
                                <td class="text-muted">No. Plat:</td>
                                <td class="fw-bold">{{ $hasil->pendaftaran->kendaraan->no_kendaraan }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted">Pemilik:</td>
                                <td>{{ $hasil->pendaftaran->kendaraan->nama_pemilik }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted">Hasil Akhir:</td>
                                <td>
                                    <span class="badge {{ $hasil->hasil_akhir == 'lulus' ? 'bg-success' : 'bg-danger' }}">
                                        {{ strtoupper($hasil->hasil_akhir ?? 'PROSES') }}
                                    </span>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white fw-bold">Data Teknis Pemeriksaan</div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-6 col-md-4">
                                <label class="small text-muted d-block">Emisi CO</label>
                                <span class="fw-bold">{{ $hasil->emisi_co ?? '-' }} %</span>
                            </div>
                            <div class="col-6 col-md-4">
                                <label class="small text-muted d-block">Emisi HC</label>
                                <span class="fw-bold">{{ $hasil->emisi_hc ?? '-' }} ppm</span>
                            </div>
                            <div class="col-6 col-md-4">
                                <label class="small text-muted d-block">Rem Utama Kiri</label>
                                <span class="fw-bold">{{ $hasil->rem_utama_kiri ?? '-' }} kg</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection