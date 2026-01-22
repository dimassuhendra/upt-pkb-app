@extends('admin.layouts')

@section('content')
    <div class="content-area w-100 p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="fw-bold">Input & Rekap Hasil Uji</h3>
                <p class="text-muted">Kelola pengujian kendaraan dan input hasil pemeriksaan</p>
            </div>
        </div>

        <ul class="nav nav-pills mb-4" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active btn-sm" id="pills-antrean-tab" data-bs-toggle="pill"
                    data-bs-target="#pills-antrean" type="button">
                    <i class="fa fa-clock me-1"></i> Antrean Uji
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-rekap-tab" data-bs-toggle="pill" data-bs-target="#pills-rekap"
                    type="button">
                    <i class="fa fa-check-circle me-1"></i> Rekap Selesai
                </button>
            </li>
        </ul>

        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-antrean" role="tabpanel">
                <div class="card table-card border-0 shadow-sm">
                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="ps-4">NO. ANTRI</th>
                                    <th>KENDARAAN</th>
                                    <!-- <th>PEMILIK</th> -->
                                    <th class="text-center">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- Data ini diambil dari variabel $antrean yang perlu dikirim dari Controller --}}
                                @forelse($antrean as $a)
                                    <tr>
                                        <td class="ps-4 fw-bold">#{{ $loop->iteration }}</td>
                                        <td>
                                            <div class="fw-bold">{{ $a->no_uji }}</div>
                                            <div class="small text-muted">{{ $a->kendaraan->no_kendaraan }}</div>
                                        </td>
                                        <!-- <td>{{ $a->nama_lengkap }}</td> -->
                                        <td class="text-center">
                                            <button type="button" class="btn btn-primary btn-sm rounded-pill px-3"
                                                data-bs-toggle="modal" data-bs-target="#modalInput{{ $a->id }}">
                                                <i class="fa fa-edit me-1"></i> Input Hasil
                                            </button>
                                        </td>
                                    </tr>

                                    <div class="modal fade" id="modalInput{{ $a->id }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-xl modal-dialog-scrollable">
                                            <form action="{{ route('admin.hasil-uji.store', $a->id) }}" method="POST">
                                                @csrf
                                                <div class="modal-content">
                                                    <div class="modal-header bg-primary text-white">
                                                        <h5 class="modal-title fw-bold"><i
                                                                class="fa fa-file-signature me-2"></i> Input Hasil Uji:
                                                            {{ $a->no_uji }}
                                                        </h5>
                                                        <button type="button" class="btn-close btn-close-white"
                                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body px-4">
                                                        <div class="row">
                                                            <div class="col-md-6 mb-4">
                                                                <h6 class="fw-bold border-bottom pb-2 text-primary"><i
                                                                        class="fa fa-eye me-1"></i> POS 1: Pemeriksaan Visual
                                                                </h6>
                                                                <div class="row g-2">
                                                                    <div class="col-6">
                                                                        <label class="small">Kondisi Ban</label>
                                                                        <select name="kondisi_ban"
                                                                            class="form-select form-select-sm">
                                                                            <option value="1">Baik</option>
                                                                            <option value="0">Tidak Baik</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <label class="small">Kondisi Kaca</label>
                                                                        <select name="kondisi_kaca"
                                                                            class="form-select form-select-sm">
                                                                            <option value="1">Baik</option>
                                                                            <option value="0">Tidak Baik</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-4">
                                                                        <label class="small">Klakson</label>
                                                                        <select name="klakson"
                                                                            class="form-select form-select-sm">
                                                                            <option value="1">Baik</option>
                                                                            <option value="0">Tidak Baik</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-4">
                                                                        <label class="small">Wiper</label>
                                                                        <select name="wiper" class="form-select form-select-sm">
                                                                            <option value="1">Baik</option>
                                                                            <option value="01">Tidak Baik</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-4">
                                                                        <label class="small">Lampu Sign</label>
                                                                        <select name="lampu_sign"
                                                                            class="form-select form-select-sm">
                                                                            <option value="1">Baik</option>
                                                                            <option value="0">Tidak Baik</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6 mb-4">
                                                                <h6 class="fw-bold border-bottom pb-2 text-primary"><i
                                                                        class="fa fa-smog me-1"></i> POS 2: Emisi & Suara</h6>
                                                                <div class="row g-2">
                                                                    <div class="col-4">
                                                                        <label class="small">Emisi CO (%)</label>
                                                                        <input type="number" step="0.01" name="emisi_co"
                                                                            class="form-control form-control-sm">
                                                                    </div>
                                                                    <div class="col-4">
                                                                        <label class="small">Emisi HC (ppm)</label>
                                                                        <input type="number" name="emisi_hc"
                                                                            class="form-control form-control-sm">
                                                                    </div>
                                                                    <div class="col-4">
                                                                        <label class="small">Asap/Opasitas</label>
                                                                        <input type="number" step="0.1"
                                                                            name="emisi_asap_opasitas"
                                                                            class="form-control form-control-sm">
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <label class="small">Kebisingan (dB)</label>
                                                                        <input type="number" name="kebisingan_desibel"
                                                                            class="form-control form-control-sm">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6 mb-4">
                                                                <h6 class="fw-bold border-bottom pb-2 text-primary"><i
                                                                        class="fa fa-car-crash me-1"></i> POS 3: Sistem Rem</h6>
                                                                <div class="row g-2">
                                                                    <div class="col-6">
                                                                        <label class="small">Rem Utama Kiri</label>
                                                                        <input type="number" name="rem_utama_kiri"
                                                                            class="form-control form-control-sm">
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <label class="small">Rem Utama Kanan</label>
                                                                        <input type="number" name="rem_utama_kanan"
                                                                            class="form-control form-control-sm">
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <label class="small">Selisih Per Sumbu</label>
                                                                        <input type="number" name="selisih_rem_per_sumbu"
                                                                            class="form-control form-control-sm">
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <label class="small">Rem Parkir</label>
                                                                        <input type="number" name="rem_parkir"
                                                                            class="form-control form-control-sm">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6 mb-4">
                                                                <h6 class="fw-bold border-bottom pb-2 text-primary"><i
                                                                        class="fa fa-lightbulb me-1"></i> POS 4: Lampu & Alur
                                                                </h6>
                                                                <div class="row g-2">
                                                                    <div class="col-6">
                                                                        <label class="small">Kekuatan Lampu Utama</label>
                                                                        <input type="number" name="lampu_utama_kekuatan"
                                                                            class="form-control form-control-sm">
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <label class="small">Penyimpangan Lampu</label>
                                                                        <input type="number" name="lampu_utama_penyimpangan"
                                                                            class="form-control form-control-sm">
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <label class="small">Kedalaman Alur Ban (mm)</label>
                                                                        <select name="kedalaman_alur_ban"
                                                                            class="form-select form-select-sm">
                                                                            <option value="1">Baik</option>
                                                                            <option value="0">Tidak Baik</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-12 mb-2">
                                                                <h6 class="fw-bold border-bottom pb-2 text-primary"><i
                                                                        class="fa fa-check-double me-1"></i> POS 5: Akhir &
                                                                    Keputusan</h6>
                                                                <div class="row g-2">
                                                                    <div class="col-md-4">
                                                                        <label class="small">Side Slip (mm/m)</label>
                                                                        <input type="number" name="side_slip"
                                                                            class="form-control form-control-sm">
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <label class="small fw-bold text-danger">Hasil
                                                                            Akhir</label>
                                                                        <select name="hasil_akhir"
                                                                            class="form-select form-select-sm border-danger"
                                                                            required>
                                                                            <option value="">-- Pilih Status --</option>
                                                                            <option value="lulus">LULUS</option>
                                                                            <option value="tidak_lulus">TIDAK LULUS</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <label class="small">Catatan Perbaikan</label>
                                                                        <textarea name="catatan_perbaikan"
                                                                            class="form-control form-control-sm" rows="1"
                                                                            placeholder="Opsional..."></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer bg-light">
                                                        <button type="button" class="btn btn-secondary btn-sm"
                                                            data-bs-dismiss="modal">Tutup</button>
                                                        <button type="submit" class="btn btn-primary btn-sm px-4">Simpan Seluruh
                                                            Hasil Uji</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center p-4 text-muted">Tidak ada antrean kendaraan.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="pills-rekap" role="tabpanel">
                <div class="card table-card border-0 shadow-sm">
                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead class="bg-light text-muted small">
                                <tr>
                                    <th class="ps-4">TANGGAL</th>
                                    <th>NO. UJI / PLAT</th>
                                    <th>PEMILIK</th>
                                    <th>HASIL</th>
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
                                        <td>{{ $r->pendaftaran->nama_lengkap }}</td>
                                        <td>
                                            <span class="badge {{ $r->hasil_akhir == 'lulus' ? 'bg-success' : 'bg-danger' }}">
                                                {{ strtoupper($r->hasil_akhir) }}
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('admin.hasil-uji.cetak', $r->id) }}" target="_blank"
                                                class="btn btn-sm btn-outline-primary">
                                                <i class="fa fa-print"></i> PDF
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center p-4">Belum ada rekap hasil uji.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if(session('show_summary'))
        <div class="modal fade" id="modalSummary" tabindex="-1" data-bs-backdrop="static" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 shadow">
                    <div class="modal-body text-center p-5">
                        @if(session('hasil_akhir') == 'lulus')
                            <div class="mb-3">
                                <i class="fa fa-check-circle text-success" style="font-size: 80px;"></i>
                            </div>
                            <h4 class="fw-bold">PENGUJIAN LULUS!</h4>
                            <p class="text-muted">Kendaraan telah memenuhi standar teknis pengujian.</p>
                        @else
                            <div class="mb-3">
                                <i class="fa fa-times-circle text-danger" style="font-size: 80px;"></i>
                            </div>
                            <h4 class="fw-bold">TIDAK LULUS</h4>
                            <p class="text-muted">Kendaraan tidak memenuhi standar. Silakan berikan catatan perbaikan.</p>
                        @endif

                        <hr>

                        <div class="d-grid gap-2">
                            @if(session('hasil_akhir') == 'lulus')
                                <a href="{{ route('admin.hasil-uji.cetak', session('last_id')) }}" target="_blank"
                                    class="btn btn-primary rounded-pill py-2">
                                    <i class="fa fa-download me-2"></i> Download Bukti Lulus (PDF)
                                </a>
                            @endif
                            <button type="button" class="btn btn-light rounded-pill py-2" data-bs-dismiss="modal">
                                Tutup & Kembali
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            // Otomatis munculkan modal saat halaman load
            document.addEventListener('DOMContentLoaded', function () {
                var myModal = new bootstrap.Modal(document.getElementById('modalSummary'));
                myModal.show();
            });
        </script>
    @endif
@endsection