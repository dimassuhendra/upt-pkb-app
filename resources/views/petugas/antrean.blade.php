@extends('petugas.layouts')

@section('content')
    <div class="container-fluid p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="fw-bold">Antrean Kendaraan</h3>
                <p class="text-muted">Daftar kendaraan yang menunggu pemeriksaan di
                    <strong>{{ Auth::user()->pos_tugas }}</strong></p>
            </div>
            <div class="text-end">
                <span class="badge bg-primary px-3 py-2 rounded-pill">Total: {{ $antrean->count() }} Kendaraan</span>
            </div>
        </div>

        <div class="card border-0 shadow-sm mb-4" style="border-radius: 15px;">
            <div class="card-body">
                <form action="{{ route('petugas.antrean') }}" method="GET" class="row g-3">
                    <div class="col-md-10">
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0"><i
                                    class="fa fa-search text-muted"></i></span>
                            <input type="text" name="search" class="form-control border-start-0 ps-0"
                                placeholder="Cari Plat Nomor atau Kode Pendaftaran..." value="{{ request('search') }}">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100 fw-bold">Cari</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="row g-3">
            @forelse($antrean as $item)
                <div class="col-md-6 col-lg-4">
                    <div class="card border-0 shadow-sm h-100"
                        style="border-radius: 15px; border-left: 5px solid #3A59D1 !important;">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div class="antrean-number bg-primary text-white d-flex align-items-center justify-content-center fw-bold"
                                    style="width: 40px; height: 40px; border-radius: 10px;">
                                    {{ $item->nomor_antrean }}
                                </div>
                                <span
                                    class="badge {{ $item->status_uji == 'proses' ? 'bg-warning' : 'bg-light text-dark' }} rounded-pill">
                                    {{ strtoupper($item->status_uji) }}
                                </span>
                            </div>

                            <h5 class="fw-bold mb-1">{{ $item->kendaraan->no_kendaraan }}</h5>
                            <p class="text-muted small mb-3"><i class="fa fa-barcode me-1"></i> {{ $item->kode_pendaftaran }}
                            </p>

                            <div class="bg-light p-2 rounded mb-3 small">
                                <div class="d-flex justify-content-between">
                                    <span>Jenis:</span>
                                    <span class="fw-bold">{{ $item->kendaraan->jenis_kendaraan }}</span>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span>Pemilik:</span>
                                    <span class="fw-bold text-truncate"
                                        style="max-width: 120px;">{{ $item->kendaraan->nama_pemilik }}</span>
                                </div>
                            </div>

                            @php
                                $routePos = '#'; 
                                $userPos = Auth::user()->pos_tugas;

                                if ($userPos == 'Pos 1') {
                                    $routePos = route('petugas.visual.index', ['id' => $item->id]);
                                } elseif ($userPos == 'Pos 2') {
                                    $routePos = route('petugas.emisi.index', ['id' => $item->id]);
                                } elseif ($userPos == 'Pos 3') {
                                    $routePos = route('petugas.rem.index', ['id' => $item->id]);
                                } elseif ($userPos == 'Pos 4') {
                                    $routePos = route('petugas.lampu.index', ['id' => $item->id]);
                                } elseif ($userPos == 'Pos 5') {
                                    $routePos = route('petugas.roda.index', ['id' => $item->id]);
                                }
                            @endphp

                            <a href="{{ $routePos }}" class="btn btn-primary w-100 rounded-pill fw-bold">
                                Mulai Periksa <i class="fa fa-arrow-right ms-2"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <img src="https://cdn-icons-png.flaticon.com/512/5058/5058432.png" width="100" class="mb-3 opacity-50">
                    <h5 class="text-muted">Tidak ada antrean kendaraan saat ini.</h5>
                </div>
            @endforelse
        </div>
    </div>
@endsection