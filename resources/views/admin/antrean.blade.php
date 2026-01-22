@extends('admin.layouts')

@section('content')
    <style>
        :root {
            --primary-color: #3A59D1;
            --secondary-color: #B5FCCD;
            --bg-light: #f4f7fe;
        }

        body {
            background-color: var(--bg-light);
            font-family: 'Fredoka', sans-serif;
        }

        .form-container {
            max-width: 1000px;
            margin: 20px auto;
        }

        .card-custom {
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(58, 89, 209, 0.1);
            overflow: hidden;
        }

        .card-header-custom {
            background: var(--primary-color);
            color: white;
            padding: 30px;
            border: none;
        }

        .card-header-custom h3 {
            font-family: 'Domine', serif;
            margin: 0;
            font-size: 24px;
        }

        .section-title {
            font-size: 14px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--primary-color);
            margin: 30px 0 20px 0;
            padding-bottom: 10px;
            border-bottom: 2px solid #eee;
            display: flex;
            align-items: center;
        }

        .section-title i {
            margin-right: 10px;
            background: rgba(58, 89, 209, 0.1);
            padding: 8px;
            border-radius: 8px;
        }

        .form-label {
            font-weight: 600;
            color: #4a5568;
            font-size: 13px;
            margin-bottom: 8px;
        }

        .form-control,
        .form-select {
            border-radius: 12px;
            padding: 12px 15px;
            border: 1px solid #e2e8f0;
            font-size: 14px;
            transition: all 0.3s;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(58, 89, 209, 0.1);
        }

        .btn-submit {
            background: var(--primary-color);
            color: white;
            padding: 15px 40px;
            border-radius: 12px;
            font-weight: 600;
            border: none;
            transition: all 0.3s;
            width: 100%;
            margin-top: 30px;
            font-size: 16px;
        }

        .btn-submit:hover {
            background: #2d46a8;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(58, 89, 209, 0.3);
        }

        .input-group-text {
            border-radius: 0 12px 12px 0;
            background: #f8fafc;
            border-left: none;
        }
    </style>

    <div class="content-area p-4">
        <div class="form-container">
            <div class="mb-4">
                <h2 class="fw-bold text-dark">Input Hasil Pengujian</h2>
                <p class="text-muted">Silakan pilih pendaftaran dan lengkapi data teknis kendaraan.</p>
            </div>

            @if(session('success'))
                <div class="alert alert-success border-0 shadow-sm mb-4" style="border-radius: 15px;">
                    <i class="fa fa-check-circle me-2"></i> {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('admin.hasil-uji.store-manual') }}" method="POST">
                @csrf
                <div class="card card-custom">
                    <div class="card-header-custom d-flex align-items-center">
                        <i class="fa fa-clipboard-check fs-2 me-3"></i>
                        <div>
                            <h3 class="fw-bold">Formulir Hasil Pemeriksaan</h3>
                            <small class="opacity-75">Data ini akan menjadi dasar penerbitan bukti lulus uji</small>
                        </div>
                    </div>

                    <div class="card-body p-4 p-md-5">
                        <div class="row mb-4">
                            <div class="col-md-12">
                                <label class="form-label">Pilih Kendaraan (Nomor Uji / Plat)</label>
                                <select name="pendaftaran_id" class="form-select select2" required>
                                    <option value="">-- Pilih Kendaraan yang Sedang Mengantre --</option>
                                    @foreach($antrean as $data)
                                        <option value="{{ $data->id }}">
                                            {{ $data->kode_pendaftaran }} | {{ $data->kendaraan->no_kendaraan }} -
                                            {{ $data->kendaraan->pemilik->nama_lengkap }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="section-title">
                            <i class="fa fa-gauge-high"></i> POS 1: Emisi Gas Buang & Penerangan
                        </div>
                        <div class="row g-3">
                            <div class="col-md-3">
                                <label class="form-label">Emisi CO (%)</label>
                                <input type="number" step="0.01" name="emisi_co" class="form-control" placeholder="0.00">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Emisi HC (ppm)</label>
                                <input type="number" name="emisi_hc" class="form-control" placeholder="0">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Lampu Utama Kiri (cd)</label>
                                <input type="number" name="lampu_utama_kiri" class="form-control" placeholder="0">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Lampu Utama Kanan (cd)</label>
                                <input type="number" name="lampu_utama_kanan" class="form-control" placeholder="0">
                            </div>
                        </div>

                        <div class="section-title">
                            <i class="fa fa-truck-fast"></i> POS 2: Sistem Pengereman & Kemudi
                        </div>
                        <div class="row g-3">
                            <div class="col-md-3">
                                <label class="form-label">Rem Utama Kiri (kg)</label>
                                <input type="number" name="rem_utama_kiri" class="form-control" placeholder="0">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Rem Utama Kanan (kg)</label>
                                <input type="number" name="rem_utama_kanan" class="form-control" placeholder="0">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Rem Parkir (kg)</label>
                                <input type="number" name="rem_parkir" class="form-control" placeholder="0">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Side Slip (mm/m)</label>
                                <input type="number" step="0.1" name="side_slip" class="form-control" placeholder="0.0">
                            </div>
                        </div>

                        <div class="section-title">
                            <i class="fa fa-file-contract"></i> POS 3: Ringkasan & Keputusan
                        </div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Keputusan Hasil Uji</label>
                                <select name="hasil_akhir" class="form-select" required>
                                    <option value="">-- Pilih Status Kelulusan --</option>
                                    <option value="lulus" style="color: green; font-weight: bold;">LULUS UJI</option>
                                    <option value="tidak_lulus" style="color: red; font-weight: bold;">TIDAK LULUS</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Petugas Penguji</label>
                                <input type="text" class="form-control" value="{{ Auth::user()->name }}" readonly>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Keterangan Catatan</label>
                                <textarea name="keterangan" class="form-control" rows="3"
                                    placeholder="Masukkan alasan jika tidak lulus atau catatan teknis lainnya..."></textarea>
                            </div>
                        </div>

                        <button type="submit" class="btn-submit">
                            <i class="fa fa-save me-2"></i> Simpan Data Pengujian
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection