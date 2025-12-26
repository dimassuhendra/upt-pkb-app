@extends('admin.layouts')

@section('content')
    <style>
        .form-control,
        .form-select {
            border-radius: 8px;
            border: 1px solid #d1d5db;
            padding: 6px 10px;
            font-size: 13px;
        }

        .form-label {
            font-weight: 600;
            font-size: 12px;
            color: #374151;
            margin-bottom: 2px;
        }

        .table-card {
            border-radius: 15px;
            border: none;
            background: white;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .modal-xl {
            max-width: 1100px;
        }

        .section-title {
            font-size: 14px;
            font-weight: 700;
            color: #3A59D1;
            border-bottom: 2px solid #eef2ff;
            padding-bottom: 5px;
            margin-top: 15px;
            margin-bottom: 10px;
        }
    </style>

    <div class="d-flex">
        <div class="content-area w-100 p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h3 class="fw-bold m-0 text-dark">Database Kendaraan</h3>
                    <p class="text-muted small">Kelola data teknis kendaraan wajib uji</p>
                </div>
                <button type="button" class="btn btn-primary rounded-pill px-4 shadow-sm" data-bs-toggle="modal"
                    data-bs-target="#modalForm" onclick="resetForm()">
                    <i class="fa fa-truck me-2"></i> Registrasi Kendaraan
                </button>
            </div>

            @if(session('success'))
                <div class="alert alert-success border-0 shadow-sm rounded-3">{{ session('success') }}</div>
            @endif

            <div class="card table-card mb-4 p-3">
                <form action="{{ route('admin.kendaraan.index') }}" method="GET" class="row g-2">
                    <div class="col-md-8">
                        <input type="text" name="search" class="form-control"
                            placeholder="Cari Plat Nomor, No. Rangka, atau Nama Pemilik..." value="{{ request('search') }}">
                    </div>
                    <div class="col-md-3">
                        <select name="sort_by" class="form-select" onchange="this.form.submit()">
                            <option value="created_at" {{ request('sort_by') == 'created_at' ? 'selected' : '' }}>Terbaru
                            </option>
                            <option value="no_kendaraan" {{ request('sort_by') == 'no_kendaraan' ? 'selected' : '' }}>Plat
                                Nomor</option>
                        </select>
                    </div>
                    <div class="col-md-1">
                        <button type="submit" class="btn btn-dark w-100"><i class="fa fa-search"></i></button>
                    </div>
                </form>
            </div>

            <div class="card table-card">
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead class="bg-light text-muted small">
                            <tr>
                                <th class="ps-4">PLAT / MEREK</th>
                                <th>PEMILIK</th>
                                <th>JBB / JENIS</th>
                                <th>MASA BERLAKU KIR</th>
                                <th class="text-center">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($kendaraans as $k)
                                <tr>
                                    <td class="ps-4">
                                        <div class="fw-bold text-dark">{{ $k->no_kendaraan }}</div>
                                        <small class="text-muted">{{ $k->merek }} {{ $k->tipe }}</small>
                                    </td>
                                    <td>
                                        <div class="small fw-bold">{{ $k->pemilik->nama_lengkap ?? '-' }}</div>
                                        <small class="text-muted">{{ $k->pemilik->nik ?? '-' }}</small>
                                    </td>
                                    <td>
                                        <div class="small">{{ $k->jbb }} kg</div>
                                        <small class="text-muted">{{ $k->jenis_kendaraan }}</small>
                                    </td>
                                    <td>
                                        <span
                                            class="badge {{ \Carbon\Carbon::parse($k->masa_berlaku_uji_kir)->isPast() ? 'bg-danger' : 'bg-success' }}">
                                            {{ \Carbon\Carbon::parse($k->masa_berlaku_uji_kir)->format('d/m/Y') }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group shadow-sm rounded-pill bg-white border">
                                            <button class="btn btn-sm btn-white text-primary border-0"
                                                onclick="editData({{ json_encode($k) }})"><i class="fa fa-edit"></i></button>
                                            <button class="btn btn-sm btn-white text-danger border-0"
                                                onclick="deleteData({{ $k->id }})"><i class="fa fa-trash"></i></button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center p-5 text-muted">Data kendaraan tidak ditemukan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="p-3">{{ $kendaraans->links() }}</div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalForm" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header p-4 border-0">
                    <h5 class="fw-bold" id="modalTitle">Registrasi Kendaraan Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="kendaraanForm" action="{{ route('admin.kendaraan.store') }}" method="POST">
                    @csrf
                    <div id="methodField"></div>
                    <div class="modal-body p-4 pt-0">
                        <div class="row">
                            <div class="col-md-3 border-end">
                                <div class="section-title"><i class="fa fa-id-card me-2"></i>Identitas</div>
                                <div class="mb-2">
                                    <label class="form-label">Pemilik</label>
                                    <select name="pemilik_id" id="f_pemilik" class="form-select" required>
                                        <option value="">-- Pilih Pemilik --</option>
                                        @foreach($pemiliks as $p)
                                            <option value="{{ $p->id }}">{{ $p->nama_lengkap }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-2">
                                    <label class="form-label">No. Kendaraan (Plat)</label>
                                    <input type="text" name="no_kendaraan" id="f_no_ken" class="form-control" required>
                                </div>
                                <div class="mb-2">
                                    <label class="form-label">No. BPKB</label>
                                    <input type="text" name="no_bpkb" id="f_bpkb" class="form-control">
                                </div>
                                <div class="mb-2">
                                    <label class="form-label">Masa Berlaku STNK</label>
                                    <input type="date" name="masa_berlaku_stnk" id="f_tgl_stnk" class="form-control">
                                </div>
                                <div class="mb-2">
                                    <label class="form-label">Masa Berlaku KIR</label>
                                    <input type="date" name="masa_berlaku_uji_kir" id="f_kir" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-3 border-end">
                                <div class="section-title"><i class="fa fa-tag me-2"></i>Merek & Tipe</div>
                                <div class="mb-2">
                                    <label class="form-label">Merek</label>
                                    <input type="text" name="merek" id="f_merek" class="form-control">
                                </div>
                                <div class="mb-2">
                                    <label class="form-label">Tipe</label>
                                    <input type="text" name="tipe" id="f_tipe" class="form-control">
                                </div>
                                <div class="mb-2">
                                    <label class="form-label">Model</label>
                                    <input type="text" name="model" id="f_model" class="form-control">
                                </div>
                                <div class="mb-2">
                                    <label class="form-label">Jenis Kendaraan</label>
                                    <select name="jenis_kendaraan" id="f_jenis" class="form-select" required>
                                        <option value="">-- Pilih Jenis --</option>
                                        @foreach($optJenis as $jenis)
                                            <option value="{{ $jenis }}">{{ $jenis }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="row">
                                    <div class="col-6 mb-2">
                                        <label class="form-label">Thn Buat</label>
                                        <input type="number" name="tahun_pembuatan" id="f_thn_buat" class="form-control">
                                    </div>
                                    <div class="col-6 mb-2">
                                        <label class="form-label">Thn Rakit</label>
                                        <input type="number" name="tahun_perakitan" id="f_thn_rakit" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3 border-end">
                                <div class="section-title"><i class="fa fa-cogs me-2"></i>Mesin & Fisik</div>
                                <div class="mb-2">
                                    <label class="form-label">No. Rangka</label>
                                    <input type="text" name="no_rangka" id="f_rangka" class="form-control" required>
                                </div>
                                <div class="mb-2">
                                    <label class="form-label">No. Mesin</label>
                                    <input type="text" name="no_mesin" id="f_mesin" class="form-control">
                                </div>
                                <div class="mb-2">
                                    <label class="form-label">Isi Silinder (CC)</label>
                                    <input type="number" name="isi_silinder" id="f_cc" class="form-control">
                                </div>
                                <div class="mb-2">
                                    <label class="form-label">Bahan Bakar</label>
                                    <select name="bahan_bakar" id="f_bbm" class="form-select" required>
                                        <option value="">-- Pilih Bahan Bakar --</option>
                                        @foreach($optBahanBakar as $bbm)
                                            <option value="{{ $bbm }}">{{ $bbm }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="row">
                                    <div class="col-6 mb-2">
                                        <label class="form-label">Warna</label>
                                        <input type="text" name="warna" id="f_warna" class="form-control">
                                    </div>
                                    <div class="col-6 mb-2">
                                        <label class="form-label">Warna TNKB</label>
                                        <input type="text" name="warna_tnkb" id="f_tnkb" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="section-title"><i class="fa fa-weight me-2"></i>Berat & Beban</div>
                                <div class="row">
                                    <div class="col-6 mb-2">
                                        <label class="form-label">Jml Roda</label>
                                        <input type="number" name="jumlah_roda" id="f_roda" class="form-control">
                                    </div>
                                    <div class="col-6 mb-2">
                                        <label class="form-label">Jml Sumbu</label>
                                        <input type="number" name="jumlah_sumbu" id="f_sumbu" class="form-control">
                                    </div>
                                </div>
                                <div class="mb-2">
                                    <label class="form-label">Kapasitas Penumpang</label>
                                    <input type="number" name="kapasitas_penumpang" id="f_penumpang" class="form-control">
                                </div>
                                <div class="mb-2">
                                    <label class="form-label">Berat Kosong (kg)</label>
                                    <input type="number" name="berat_kosong" id="f_berat_k" class="form-control">
                                </div>
                                <div class="mb-2">
                                    <label class="form-label">JBB (kg)</label>
                                    <input type="number" name="jbb" id="f_jbb" class="form-control">
                                </div>
                                <div class="mb-2">
                                    <label class="form-label">JBI (kg)</label>
                                    <input type="number" name="jbi" id="f_jbi" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0 p-4 pt-0">
                        <button type="submit" class="btn btn-primary w-100 rounded-pill py-2">Simpan Data Kendaraan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <form id="formDelete" action="" method="POST" style="display:none">
        @csrf @method('DELETE')
    </form>

    <script>
        function resetForm() {
            document.getElementById('modalTitle').innerText = 'Registrasi Kendaraan Baru';
            document.getElementById('kendaraanForm').action = "{{ route('admin.kendaraan.store') }}";
            document.getElementById('methodField').innerHTML = '';
            document.getElementById('kendaraanForm').reset();
        }

        function editData(data) {
            document.getElementById('modalTitle').innerText = 'Edit Data Kendaraan';
            document.getElementById('kendaraanForm').action = "/admin/kendaraan/" + data.id;
            document.getElementById('methodField').innerHTML = '@method("PUT")';

            // Mapping 23 Field
            document.getElementById('f_pemilik').value = data.pemilik_id;
            document.getElementById('f_no_ken').value = data.no_kendaraan;
            document.getElementById('f_rangka').value = data.no_rangka;
            document.getElementById('f_mesin').value = data.no_mesin;
            document.getElementById('f_bpkb').value = data.no_bpkb;
            document.getElementById('f_merek').value = data.merek;
            document.getElementById('f_tipe').value = data.tipe;
            document.getElementById('f_jenis').value = data.jenis_kendaraan;
            document.getElementById('f_model').value = data.model;
            document.getElementById('f_thn_buat').value = data.tahun_pembuatan;
            document.getElementById('f_thn_rakit').value = data.tahun_perakitan;
            document.getElementById('f_cc').value = data.isi_silinder;
            document.getElementById('f_warna').value = data.warna;
            document.getElementById('f_tnkb').value = data.warna_tnkb;
            document.getElementById('f_bbm').value = data.bahan_bakar;
            document.getElementById('f_roda').value = data.jumlah_roda;
            document.getElementById('f_sumbu').value = data.jumlah_sumbu;
            document.getElementById('f_penumpang').value = data.kapasitas_penumpang;
            document.getElementById('f_berat_k').value = data.berat_kosong;
            document.getElementById('f_jbb').value = data.jbb;
            document.getElementById('f_jbi').value = data.jbi;
            document.getElementById('f_tgl_stnk').value = data.masa_berlaku_stnk;
            document.getElementById('f_kir').value = data.masa_berlaku_uji_kir;

            new bootstrap.Modal(document.getElementById('modalForm')).show();
        }

        function deleteData(id) {
            if (confirm('Hapus data kendaraan ini permanen?')) {
                let form = document.getElementById('formDelete');
                form.action = "/admin/kendaraan/" + id;
                form.submit();
            }
        }
    </script>
@endsection