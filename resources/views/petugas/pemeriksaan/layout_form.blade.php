@extends('petugas.layouts')

@section('content')
    <div class="container-fluid p-4">
        <div class="row">
            <div class="col-md-4">
                <div class="card shadow-sm mb-4 border-0">
                    <div class="card-header bg-primary text-white fw-bold">Detail Kendaraan</div>
                    <div class="card-body">
                        <table class="table table-sm mb-0">
                            <tr>
                                <td class="text-muted">No. Uji</td>
                                <td class="fw-bold">{{ $pendaftaran->kode_pendaftaran }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted">No. Plat</td>
                                <td class="fw-bold">{{ $pendaftaran->kendaraan->no_kendaraan }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted">Jenis</td>
                                <td>{{ $pendaftaran->kendaraan->jenis_kendaraan }}</td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="card shadow-sm border-0 bg-light">
                    <div class="card-header fw-bold text-muted">Ringkasan Pos Lain</div>
                    <div class="card-body p-2" style="font-size: 0.85rem;">
                        @if($hasil)
                            <p class="mb-1"><strong>Pos 1:</strong> Ban: {{ $hasil->kondisi_ban ? 'OK' : '-' }}, Kaca:
                                {{ $hasil->kondisi_kaca ? 'OK' : '-' }}
                            </p>
                            <p class="mb-1"><strong>Pos 2:</strong> CO: {{ $hasil->emisi_co ?? '-' }}%, HC:
                                {{ $hasil->emisi_hc ?? '-' }}ppm
                            </p>
                            <p class="mb-1"><strong>Pos 3:</strong> Rem: {{ $hasil->rem_utama_kiri ?? '-' }}kg /
                                {{ $hasil->rem_utama_kanan ?? '-' }}kg
                            </p>
                            <p class="mb-1"><strong>Pos 4:</strong> Lampu: {{ $hasil->lampu_utama_kekuatan ?? '-' }}cd</p>
                        @else
                            <p class="text-center text-muted py-3">Belum ada data dari pos sebelumnya</p>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center">
                        <h5 class="fw-bold m-0">Input Pemeriksaan: {{ Auth::user()->pos_tugas }}</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('petugas.store', $pendaftaran->id) }}" method="POST">
                            @csrf
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @yield('form_content')
                            <hr>
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('petugas.antrean') }}" class="btn btn-light rounded-pill px-4">
                                    <i class="fa fa-arrow-left me-2"></i>Kembali
                                </a>
                                <button type="submit" class="btn btn-primary rounded-pill px-5 fw-bold">
                                    <i class="fa fa-save me-2"></i>Simpan Data {{ Auth::user()->pos_tugas }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection