@extends('admin.layouts')

@section('content')
    <div class="container-fluid py-4" style="background-color: #f8f9fc; min-height: 100vh;">
        @if($mode == 'input')
            {{-- MODE INPUT: Desain Fokus & Minimalis --}}
            <div class="row justify-content-center">
                <div class="col-xxl-4 col-xl-5 col-lg-6 col-md-8">
                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-body p-4">
                            <div class="text-center mb-4">
                                <div class="d-inline-flex align-items-center justify-content-center bg-primary bg-opacity-10 rounded-circle mb-3"
                                    style="width: 60px; height: 60px;">
                                    <i class="fa-solid fa-pen-to-square text-primary fs-4"></i>
                                </div>
                                <h5 class="fw-bold m-0">Penilaian Layanan</h5>
                                <p class="small text-muted">Silakan masukkan data kendaraan Anda</p>
                            </div>

                            {{-- Alert Messages --}}
                            @if(session('success') || session('error'))
                                <div
                                    class="alert {{ session('success') ? 'alert-success' : 'alert-danger' }} border-0 small py-2 shadow-sm">
                                    {{ session('success') ?? session('error') }}
                                </div>
                            @endif

                            <form action="{{ route('rating.index') }}" method="GET" class="mb-4">
                                <div class="form-group">
                                    <label class="form-label small fw-semibold text-secondary">Nomor Uji Kendaraan</label>
                                    <div class="input-group input-group-sm">
                                        <input type="text" name="no_uji" class="form-control border-light-subtle"
                                            placeholder="BD 1234 XX" value="{{ request('no_uji') }}">
                                        <button class="btn btn-dark px-3" type="submit">Cari</button>
                                    </div>
                                </div>
                            </form>

                            @if($pendaftaran)
                                <div class="bg-light p-3 rounded-3 mb-4 border-start border-primary border-4">
                                    <div class="small text-muted">Kendaraan Ditemukan:</div>
                                    <div class="fw-bold">{{ $pendaftaran->no_uji }}</div>
                                </div>

                                <form action="{{ route('rating.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="pendaftaran_id" value="{{ $pendaftaran->id }}">

                                    <div class="mb-3">
                                        <label class="form-label small fw-semibold text-secondary">Aspek Pelayanan</label>
                                        <select name="aspek_layanan" class="form-select form-select-sm border-light-subtle"
                                            required>
                                            <option value="" disabled selected>Pilih unit layanan...</option>
                                            <option value="administrasi">Administrasi / Loket</option>
                                            <option value="pos_1">Pos 1 (Pra Uji)</option>
                                            <option value="pos_2">Pos 2 (Emisi)</option>
                                            <option value="pos_3">Pos 3 (Rem/Lampu)</option>
                                            <option value="pos_4">Pos 4 (Bawah Kendaraan)</option>
                                            <option value="pos_5">Pos 5 (Pengesahan)</option>
                                        </select>
                                    </div>

                                    <div class="mb-4 text-center">
                                        <label class="form-label d-block small fw-semibold text-secondary mb-2">Berikan Skor</label>
                                        <div class="star-rating fs-3">
                                            @for($i = 1; $i <= 5; $i++)
                                                <input type="radio" name="skor_bintang" id="star{{$i}}" value="{{$i}}" class="d-none"
                                                    required>
                                                <label for="star{{$i}}"
                                                    class="fa-regular fa-star pointer text-warning mx-1 transition-all"
                                                    onclick="setStar({{$i}})"></label>
                                            @endfor
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label small fw-semibold text-secondary">Komentar Tambahan</label>
                                        <textarea name="komentar" class="form-control form-control-sm border-light-subtle" rows="3"
                                            placeholder="Apa yang perlu kami perbaiki?"></textarea>
                                    </div>

                                    <button type="submit" class="btn btn-primary w-100 fw-bold shadow-sm">Kirim Feedback</button>
                                </form>
                            @elseif(request('no_uji'))
                                <div class="text-center py-3">
                                    <i class="fa-solid fa-magnifying-glass text-muted mb-2"></i>
                                    <p class="small text-muted">Data tidak ditemukan. Pastikan nomor uji benar.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @else
            {{-- MODE REKAP: Tampilan Dashboard Admin yang Bersih --}}
            <div class="d-flex align-items-center justify-content-between mb-4">
                <div>
                    <h4 class="fw-bold m-0 text-dark">Ringkasan Kepuasan Pelanggan</h4>
                    <p class="text-muted small m-0">Update terakhir: {{ date('d M Y') }}</p>
                </div>
            </div>

            <div class="row g-3 mb-4">
                @foreach($statistik as $s)
                    <div class="col-xl-2 col-md-4 col-6">
                        <div class="card border-0 shadow-sm h-100 rounded-3">
                            <div class="card-body p-3">
                                <p class="text-uppercase text-secondary fw-bold mb-1"
                                    style="font-size: 0.65rem; letter-spacing: 0.5px;">
                                    {{ str_replace('_', ' ', $s->aspek_layanan) }}
                                </p>
                                <div class="d-flex align-items-baseline gap-2">
                                    <h4 class="fw-bold m-0 text-primary">{{ number_format($s->rata_rata, 1) }}</h4>
                                    <small class="text-warning"><i class="fa-solid fa-star fs-xs"></i></small>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-header bg-white py-3 border-0">
                    <h6 class="fw-bold m-0 text-dark">Daftar Feedback Terbaru</h6>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle custom-table mb-0">
                        <thead>
                            <tr>
                                <!-- <th class="ps-4">No. Uji</th> -->
                                <th>Layanan</th>
                                <th>Rating</th>
                                <th>Komentar</th>
                                <th class="text-end pe-4">Waktu</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($ratings as $r)
                                <tr>
                                    <!-- <td class="ps-4 fw-medium">{{ $r->pendaftaran->no_uji ?? '-' }}</td> -->
                                    <td>
                                        <span
                                            class="badge bg-light text-dark border-start border-primary border-3 rounded-1 text-capitalize">
                                            {{ str_replace('_', ' ', $r->aspek_layanan) }}
                                        </span>
                                    </td>
                                    <td>
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="fa-{{ $i <= $r->skor_bintang ? 'solid' : 'regular' }} fa-star text-warning"
                                                style="font-size: 0.75rem;"></i>
                                        @endfor
                                    </td>
                                    <td class="text-muted small w-25">{{ $r->komentar ?: '-' }}</td>
                                    <td class="text-end pe-4 text-muted small">{{ $r->created_at->diffForHumans() }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5 text-muted">Belum ada feedback yang masuk.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($ratings->hasPages())
                    <div class="card-footer bg-white border-0 py-3">
                        {{ $ratings->links() }}
                    </div>
                @endif
            </div>
        @endif
    </div>

    <style>
        /* Reset & Typography */
        .custom-table thead th {
            background-color: #f8f9fc;
            color: #858796;
            font-size: 0.75rem;
            text-transform: uppercase;
            font-weight: 700;
            border: none;
            padding: 12px 10px;
        }

        .custom-table tbody td {
            border-color: #f1f1f1;
            padding: 15px 10px;
            font-size: 0.85rem;
        }

        /* Interactive Elements */
        .pointer {
            cursor: pointer;
        }

        .transition-all {
            transition: all 0.2s ease-in-out;
        }

        .star-rating label:hover {
            transform: scale(1.2);
        }

        /* Form Scaling */
        .form-control-sm,
        .form-select-sm,
        .btn-sm {
            border-radius: 6px;
        }

        .btn-primary {
            background-color: #4e73df;
            border: none;
        }

        .btn-primary:hover {
            background-color: #2e59d9;
        }
    </style>

    <script>
        function setStar(n) {
            const stars = document.querySelectorAll('.star-rating label');
            stars.forEach((star, index) => {
                if (index < n) {
                    star.classList.replace('fa-regular', 'fa-solid');
                } else {
                    star.classList.replace('fa-solid', 'fa-regular');
                }
            });
        }
    </script>
@endsection