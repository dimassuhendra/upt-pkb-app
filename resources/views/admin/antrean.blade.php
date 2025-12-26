@extends('admin.layouts')

@section('content')
    <style>
        .antrean-card {
            border-radius: 15px;
            border: none;
            transition: transform 0.2s;
        }

        .antrean-card:hover {
            transform: translateY(-5px);
        }

        .number-circle {
            width: 60px;
            height: 60px;
            background: #3A59D1;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            font-weight: bold;
        }

        .status-badge {
            font-size: 11px;
            padding: 5px 12px;
            border-radius: 20px;
        }

        .pos-step {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: #e5e7eb;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            margin-right: 5px;
        }

        .pos-step.active {
            background: #10b981;
            color: white;
        }
    </style>

    <div class="d-flex">
        <div class="content-area w-100 p-4">
            <div class="mb-4">
                <h3 class="fw-bold m-0 text-dark">Monitoring Antrean Uji</h3>
                <p class="text-muted small">Update posisi kendaraan di jalur uji secara real-time</p>
            </div>

            @if(session('success'))
                <div class="alert alert-success border-0 shadow-sm">{{ session('success') }}</div>
            @endif

            <div class="row">
                @forelse($antreanAktif as $item)
                    <div class="col-md-4 mb-4">
                        <div class="card antrean-card shadow-sm">
                            <div class="card-body p-4">
                                <div class="d-flex justify-content-between align-items-start mb-3">
                                    <div class="number-circle shadow-sm">{{ $item->nomor_antrean }}</div>
                                    <span
                                        class="badge status-badge {{ $item->status_uji == 'menunggu' ? 'bg-warning text-dark' : 'bg-primary' }}">
                                        {{ strtoupper($item->status_uji) }}
                                    </span>
                                </div>

                                <h5 class="fw-bold mb-1">{{ $item->kendaraan->no_kendaraan }}</h5>
                                <p class="text-muted small mb-3">{{ $item->kendaraan->pemilik->nama_lengkap }} |
                                    {{ $item->kendaraan->jenis_kendaraan }}
                                </p>

                                <div class="mb-4">
                                    <p class="small fw-bold mb-2">Progress Jalur Uji:</p>
                                    <div class="d-flex align-items-center">
                                        <div class="pos-step {{ $item->status_pos >= 1 ? 'active' : '' }}" title="Pra-Uji">1
                                        </div>
                                        <div class="pos-step {{ $item->status_pos >= 2 ? 'active' : '' }}" title="Uji Utama">2
                                        </div>
                                        <div class="pos-step {{ $item->status_pos >= 3 ? 'active' : '' }}" title="Selesai">3
                                        </div>
                                        <small class="text-muted ms-2">
                                            @if($item->status_pos == 0) Menunggu Jalur @else Pos {{ $item->status_pos }} @endif
                                        </small>
                                    </div>
                                </div>

                                <form action="{{ route('admin.antrean.next', $item->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-primary w-100 rounded-pill">
                                        @if($item->status_pos == 0)
                                            Mulai Masuk Jalur <i class="fa fa-arrow-right ms-2"></i>
                                        @else
                                            Lanjut ke Pos Berikutnya <i class="fa fa-chevron-right ms-2"></i>
                                        @endif
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center p-5">
                        <img src="https://cdn-icons-png.flaticon.com/512/4076/4076549.png" width="100" class="mb-3 opacity-50">
                        <p class="text-muted">Tidak ada antrean aktif saat ini.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection