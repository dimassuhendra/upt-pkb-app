@extends('admin.layouts')

@section('content')
    <style>
        .form-card {
            border: none;
            border-radius: 20px;
            background: white;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        }

        .form-label {
            font-weight: 600;
            color: #4a5568;
            font-size: 14px;
        }

        .form-control,
        .form-select {
            border-radius: 12px;
            padding: 12px;
            border: 1px solid #e2e8f0;
        }

        .btn-save {
            background: var(--primary-color);
            color: white;
            border-radius: 12px;
            padding: 12px 30px;
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn-save:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(58, 89, 209, 0.3);
        }
    </style>

    <div class="d-flex">
        <div class="content-area w-100 p-4" style="background: #f8f9fa;">
            <div class="container">
                <div class="mb-4">
                    <h3 class="fw-bold">Pendaftaran Uji Baru</h3>
                    <p class="text-muted">Input data kendaraan untuk memulai proses pengujian</p>
                </div>

                <div class="row">
                    <div class="col-lg-8">
                        <div class="card form-card p-4">
                            <form action="{{ route('admin.pendaftaran.store') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12 mb-4">
                                        <label class="form-label">Cari Kendaraan (Plat Nomor / No. Rangka)</label>
                                        <select name="kendaraan_id" class="form-select select2">
                                            <option value="">-- Pilih Kendaraan --</option>
                                            @foreach($kendaraan as $item)
                                                <option value="{{ $item->id }}">{{ $item->no_kendaraan }} -
                                                    {{ $item->pemilik->nama_lengkap }}</option>
                                            @endforeach
                                        </select>
                                        <small class="text-primary mt-2 d-block">
                                            <i class="fa fa-plus-circle"></i> Kendaraan tidak ada? <a href="#">Tambah
                                                Kendaraan Baru</a>
                                        </small>
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <label class="form-label">Jenis Pendaftaran</label>
                                        <select name="jenis_pendaftaran" class="form-select">
                                            <option value="uji_berkala">Uji Berkala (6 Bulan)</option>
                                            <option value="uji_pertama">Uji Pertama (Baru)</option>
                                            <option value="numpang_uji">Numpang Uji</option>
                                        </select>
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <label class="form-label">Total Biaya Retribusi (Rp)</label>
                                        <input type="number" name="total_biaya" class="form-control" value="150000"
                                            placeholder="Contoh: 150000">
                                    </div>

                                    <div class="col-md-12">
                                        <hr class="my-4" style="opacity: 0.1;">
                                        <div class="d-flex justify-content-end">
                                            <button type="reset" class="btn btn-light me-3 px-4 rounded-pill">Batal</button>
                                            <button type="submit" class="btn btn-save">
                                                <i class="fa fa-print me-2"></i> Simpan & Cetak Antrean
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="card border-0 shadow-sm p-4"
                            style="border-radius: 20px; background: #3A59D1; color: white;">
                            <h5>Informasi Antrean</h5>
                            <p style="opacity: 0.8; font-size: 14px;">Nomor antrean akan digenerate otomatis oleh sistem
                                setelah tombol simpan ditekan. Pastikan data kendaraan sudah sesuai dengan STNK.</p>
                            <hr style="border-color: rgba(255,255,255,0.2);">
                            <div class="d-flex align-items-center">
                                <i class="fa fa-info-circle me-2"></i>
                                <small>Sistem menggunakan Real-Time Sync ke 5 Pos Lapangan.</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection