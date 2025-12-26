@extends('admin.layouts')

@section('content')
    <style>
        .form-control,
        .form-select {
            border-radius: 8px;
            border: 1px solid #d1d5db;
            padding: 8px 12px;
            font-size: 14px;
        }

        .form-label {
            font-weight: 600;
            font-size: 13px;
            color: #374151;
            margin-bottom: 4px;
        }

        .table-card {
            border-radius: 15px;
            border: none;
            background: white;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        .modal-lg {
            max-width: 900px;
        }
    </style>

    <div class="d-flex">
        <div class="content-area w-100 p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h3 class="fw-bold m-0 text-dark">Data Pemilik Kendaraan</h3>
                    <p class="text-muted small">Manajemen database pemilik kendaraan UPT PKB</p>
                </div>
                <button type="button" class="btn btn-primary rounded-pill px-4 shadow-sm" data-bs-toggle="modal"
                    data-bs-target="#modalTambah">
                    <i class="fa fa-plus me-2"></i> Tambah Pemilik
                </button>
            </div>

            <div class="card table-card mb-4 p-3">
                <form action="{{ route('admin.pemilik.index') }}" method="GET" class="row g-2">
                    <div class="col-md-8">
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0"><i
                                    class="fa fa-search text-muted"></i></span>
                            <input type="text" name="search" class="form-control border-start-0"
                                placeholder="Cari berdasarkan Nama, NIK, atau No. HP..." value="{{ request('search') }}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <select name="sort_by" class="form-select" onchange="this.form.submit()">
                            <option value="created_at" {{ request('sort_by') == 'created_at' ? 'selected' : '' }}>Terbaru
                            </option>
                            <option value="nama_lengkap" {{ request('sort_by') == 'nama_lengkap' ? 'selected' : '' }}>Nama
                                (A-Z)</option>
                            <option value="nik" {{ request('sort_by') == 'nik' ? 'selected' : '' }}>NIK</option>
                        </select>
                    </div>
                    <div class="col-md-1">
                        <button type="submit" class="btn btn-dark w-100">Cari</button>
                    </div>
                </form>
            </div>

            <div class="card table-card">
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="ps-4">NIK / Nama</th>
                                <th>Kontak</th>
                                <th>Alamat</th>
                                <th>Pekerjaan</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pemiliks as $p)
                                <tr>
                                    <td class="ps-4">
                                        <div class="fw-bold text-dark">{{ $p->nama_lengkap }}</div>
                                        <small class="text-muted">{{ $p->nik }}</small>
                                    </td>
                                    <td>
                                        <div class="small"><i class="fa fa-phone me-1"></i> {{ $p->no_hp }}</div>
                                        <div class="small text-muted"><i class="fa fa-envelope me-1"></i> {{ $p->email ?? '-' }}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="small">{{ $p->kota_kabupaten }}, {{ $p->provinsi }}</div>
                                        <div class="text-muted" style="font-size: 11px;">{{ Str::limit($p->alamat_ktp, 40) }}
                                        </div>
                                    </td>
                                    <td><span class="badge bg-light text-dark border">{{ $p->pekerjaan ?? '-' }}</span></td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-outline-primary rounded-pill px-3">Detail</button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center p-4">Data tidak ditemukan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="p-3">
                    {{ $pemiliks->links() }}
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalTambah" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header p-4 pb-0 border-0">
                    <h5 class="fw-bold">Form Input Data Pemilik</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('admin.pemilik.store') }}" method="POST">
                    @csrf
                    <div class="modal-body p-4">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">NIK (16 Digit)</label>
                                <input type="text" name="nik" class="form-control" required maxlength="16">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" name="nama_lengkap" class="form-control" required>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Jenis Kelamin</label>
                                <select name="jenis_kelamin" class="form-select">
                                    <option value="L">Laki-laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Tempat Lahir</label>
                                <input type="text" name="tempat_lahir" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir" class="form-control">
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">No. HP / WhatsApp</label>
                                <input type="text" name="no_hp" class="form-control" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Pekerjaan</label>
                                <input type="text" name="pekerjaan" class="form-control">
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">Alamat Sesuai KTP</label>
                                <textarea name="alamat_ktp" class="form-control" rows="2"></textarea>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Provinsi</label>
                                <input type="text" name="provinsi" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Kota / Kabupaten</label>
                                <input type="text" name="kota_kabupaten" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Kecamatan</label>
                                <input type="text" name="kecamatan" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Kelurahan</label>
                                <input type="text" name="kelurahan" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Kode Pos</label>
                                <input type="text" name="kode_pos" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer p-4 pt-0 border-0">
                        <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary rounded-pill px-4">Simpan Database</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection