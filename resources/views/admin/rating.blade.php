@extends('layouts.app') {{-- Sesuaikan dengan layout Anda --}}

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="card shadow border-0 rounded-4">
                    <div class="card-body p-4 p-md-5">
                        <div class="text-center mb-4">
                            <h3 class="fw-bold">Rating Pelayanan PKB</h3>
                            <p class="text-muted">Kepuasan Anda adalah prioritas kami</p>
                        </div>

                        @if(session('success'))
                            <div class="alert alert-success border-0 shadow-sm">{{ session('success') }}</div>
                        @endif

                        @if(session('error'))
                            <div class="alert alert-danger border-0 shadow-sm">{{ session('error') }}</div>
                        @endif

                        <form action="#" method="GET" class="mb-4">
                            <label class="form-label small fw-bold">Masukkan Nomor Uji Kendaraan Anda</label>
                            <div class="input-group">
                                <input type="text" name="no_uji" class="form-control" placeholder="Contoh: BD 1234 XX"
                                    value="{{ request('no_uji') }}">
                                <button class="btn btn-primary" type="submit">Cek Data</button>
                            </div>
                        </form>

                        @if($pendaftaran)
                            <hr>
                            <form action="{{ route('rating.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="pendaftaran_id" value="{{ $pendaftaran->id }}">

                                <div class="mb-3">
                                    <label class="form-label small fw-bold">Aspek Layanan yang Dinilai</label>
                                    <select name="aspek_layanan" class="form-select" required>
                                        <option value="">-- Pilih Aspek --</option>
                                        <option value="administrasi">Administrasi / Loket</option>
                                        <option value="pos_1">Pos 1 (Pra Uji)</option>
                                        <option value="pos_2">Pos 2 (Emisi/Kebisingan)</option>
                                        <option value="pos_3">Pos 3 (Rem/Lampu)</option>
                                        <option value="pos_4">Pos 4 (Bawah Kendaraan)</option>
                                        <option value="pos_5">Pos 5 (Pengesahan)</option>
                                    </select>
                                </div>

                                <div class="mb-4 text-center">
                                    <label class="form-label d-block small fw-bold">Berikan Bintang</label>
                                    <div class="star-rating h2 text-warning">
                                        @for($i = 1; $i <= 5; $i++)
                                            <input type="radio" name="skor_bintang" id="star{{$i}}" value="{{$i}}" class="d-none"
                                                required>
                                            <label for="star{{$i}}" class="fa-regular fa-star pointer"
                                                onclick="setStar({{$i}})"></label>
                                        @endfor
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label small fw-bold">Komentar / Saran</label>
                                    <textarea name="komentar" class="form-control" rows="3"
                                        placeholder="Ceritakan pengalaman Anda..."></textarea>
                                </div>

                                <button type="submit" class="btn btn-primary w-100 py-2 rounded-pill shadow">Kirim
                                    Penilaian</button>
                            </form>
                        @elseif(request('no_uji'))
                            <div class="alert alert-warning">Nomor Uji tidak ditemukan.</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .pointer {
            cursor: pointer;
        }

        .fa-star.active {
            font-weight: 900 !important;
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