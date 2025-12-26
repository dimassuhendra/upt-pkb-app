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

        .detail-label {
            font-size: 11px;
            color: #6b7280;
            text-transform: uppercase;
            font-weight: 700;
            margin-bottom: 0;
        }

        .detail-value {
            font-size: 14px;
            color: #111827;
            font-weight: 500;
            margin-bottom: 10px;
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

            @if(session('success'))
                <div class="alert alert-success border-0 shadow-sm rounded-3">{{ session('success') }}</div>
            @endif

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
                        <thead class="bg-light text-muted small">
                            <tr>
                                <th class="ps-4">NIK / NAMA</th>
                                <th>KONTAK</th>
                                <th>KOTA/PROVINSI</th>
                                <th class="text-center">AKSI</th>
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
                                        <div class="small"><i class="fa fa-phone me-1 text-primary"></i> {{ $p->no_hp }}</div>
                                        <div class="small text-muted text-truncate" style="max-width: 150px;">
                                            {{ $p->email ?? '-' }}</div>
                                    </td>
                                    <td>
                                        <div class="small">{{ $p->kota_kabupaten }}, {{ $p->provinsi }}</div>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group shadow-sm rounded-pill bg-white border">
                                            <button class="btn btn-sm btn-white text-primary border-0"
                                                onclick="showDetail({{ json_encode($p) }})" title="Detail">
                                                <i class="fa fa-eye"></i>
                                            </button>
                                            <button class="btn btn-sm btn-white text-warning border-0"
                                                onclick="editData({{ json_encode($p) }})" title="Edit">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                            <button class="btn btn-sm btn-white text-danger border-0"
                                                onclick="deleteData({{ $p->id }})" title="Hapus">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center p-5 text-muted">Data tidak ditemukan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="p-3">{{ $pemiliks->links() }}</div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalForm" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header p-4 pb-0 border-0">
                    <h5 class="fw-bold" id="modalTitle">Tambah Pemilik</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="pemilikForm" action="{{ route('admin.pemilik.store') }}" method="POST">
                    @csrf
                    <div id="methodField"></div>
                    <div class="modal-body p-4">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">NIK</label>
                                <input type="text" name="nik" id="f_nik" class="form-control" required maxlength="16">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" name="nama_lengkap" id="f_nama" class="form-control" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Jenis Kelamin</label>
                                <select name="jenis_kelamin" id="f_jk" class="form-select">
                                    <option value="L">Laki-laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Tempat Lahir</label>
                                <input type="text" name="tempat_lahir" id="f_tempat" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir" id="f_tgl" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">No. HP</label>
                                <input type="text" name="no_hp" id="f_hp" class="form-control" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" id="f_email" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Pekerjaan</label>
                                <input type="text" name="pekerjaan" id="f_kerja" class="form-control">
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Alamat KTP</label>
                                <textarea name="alamat_ktp" id="f_alamat" class="form-control" rows="2"></textarea>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Provinsi</label>
                                <input type="text" name="provinsi" id="f_prov" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Kota/Kab</label>
                                <input type="text" name="kota_kabupaten" id="f_kota" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Kecamatan</label>
                                <input type="text" name="kecamatan" id="f_kec" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Kelurahan</label>
                                <input type="text" name="kelurahan" id="f_kel" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Kode Pos</label>
                                <input type="text" name="kode_pos" id="f_pos" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer p-4 pt-0 border-0">
                        <button type="submit" class="btn btn-primary rounded-pill px-5 shadow w-100">Simpan Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalDetail" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content shadow-lg border-0">
                <div class="modal-header p-4 border-0 bg-light rounded-top">
                    <h5 class="fw-bold mb-0">Detail Profil Pemilik</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="row">
                        <div class="col-6">
                            <p class="detail-label">NIK</p>
                            <p id="d_nik" class="detail-value"></p>
                        </div>
                        <div class="col-6">
                            <p class="detail-label">Nama</p>
                            <p id="d_nama" class="detail-value"></p>
                        </div>
                        <div class="col-6">
                            <p class="detail-label">JK / TTL</p>
                            <p id="d_ttl" class="detail-value"></p>
                        </div>
                        <div class="col-6">
                            <p class="detail-label">Pekerjaan</p>
                            <p id="d_kerja" class="detail-value"></p>
                        </div>
                        <div class="col-12">
                            <p class="detail-label">Kontak</p>
                            <p id="d_kontak" class="detail-value"></p>
                        </div>
                        <div class="col-12">
                            <hr class="my-2">
                        </div>
                        <div class="col-12">
                            <p class="detail-label">Alamat Lengkap</p>
                            <p id="d_alamat" class="detail-value mb-0"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form id="formDelete" action="" method="POST" style="display:none">
        @csrf
        @method('DELETE')
    </form>

    <script>
        // FUNGSI EDIT
        function editData(data) {
            document.getElementById('modalTitle').innerText = 'Edit Data Pemilik';
            document.getElementById('pemilikForm').action = "/admin/pemilik/" + data.id;
            document.getElementById('methodField').innerHTML = '@method("PUT")';

            // Fill Fields
            document.getElementById('f_nik').value = data.nik;
            document.getElementById('f_nama').value = data.nama_lengkap;
            document.getElementById('f_jk').value = data.jenis_kelamin;
            document.getElementById('f_tempat').value = data.tempat_lahir;
            document.getElementById('f_tgl').value = data.tanggal_lahir;
            document.getElementById('f_hp').value = data.no_hp;
            document.getElementById('f_email').value = data.email;
            document.getElementById('f_kerja').value = data.pekerjaan;
            document.getElementById('f_alamat').value = data.alamat_ktp;
            document.getElementById('f_prov').value = data.provinsi;
            document.getElementById('f_kota').value = data.kota_kabupaten;
            document.getElementById('f_kec').value = data.kecamatan;
            document.getElementById('f_kel').value = data.kelurahan;
            document.getElementById('f_pos').value = data.kode_pos;

            new bootstrap.Modal(document.getElementById('modalForm')).show();
        }

        // FUNGSI DETAIL
        function showDetail(data) {
            document.getElementById('d_nik').innerText = data.nik;
            document.getElementById('d_nama').innerText = data.nama_lengkap;
            document.getElementById('d_ttl').innerText = (data.jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan') + ' | ' + (data.tempat_lahir ?? '-') + ', ' + (data.tanggal_lahir ?? '-');
            document.getElementById('d_kerja').innerText = data.pekerjaan ?? '-';
            document.getElementById('d_kontak').innerText = data.no_hp + ' / ' + (data.email ?? '-');
            document.getElementById('d_alamat').innerText = data.alamat_ktp + ', ' + (data.kelurahan ?? '') + ', ' + (data.kecamatan ?? '') + ', ' + (data.kota_kabupaten ?? '') + ' - ' + (data.kode_pos ?? '');

            new bootstrap.Modal(document.getElementById('modalDetail')).show();
        }

        // FUNGSI HAPUS
        function deleteData(id) {
            if (confirm('Apakah Anda yakin ingin menghapus data pemilik ini?')) {
                let form = document.getElementById('formDelete');
                form.action = "/admin/pemilik/" + id;
                form.submit();
            }
        }

        // Reset Modal saat klik Tambah
        document.querySelector('[data-bs-target="#modalTambah"]').addEventListener('click', function () {
            document.getElementById('modalTitle').innerText = 'Tambah Pemilik';
            document.getElementById('pemilikForm').action = "{{ route('admin.pemilik.store') }}";
            document.getElementById('methodField').innerHTML = '';
            document.getElementById('pemilikForm').reset();
            new bootstrap.Modal(document.getElementById('modalForm')).show();
        });
    </script>
@endsection