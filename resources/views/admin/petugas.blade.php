@extends('admin.layouts')

@section('content')
    <style>
        /* Card & Table */
        .card {
            border-radius: 15px;
            overflow: hidden;
            background: white;
            border: none;
        }

        /* Status Badge */
        .badge {
            padding: 6px 12px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.7rem;
        }

        .bg-success {
            background-color: #dcfce7 !important;
            color: #166534 !important;
        }

        .bg-danger {
            background-color: #fee2e2 !important;
            color: #991b1b !important;
        }

        .bg-role {
            background-color: #e0e7ff !important;
            color: #4338ca !important;
        }

        .bg-pos-active {
            background-color: #fef9c3 !important;
            color: #854d0e !important;
            border: 1px solid #fde047;
        }

        /* Button Custom */
        .btn-primary {
            background-color: #3A59D1;
            border: none;
        }

        .btn-primary:hover {
            background-color: #2e47b3;
        }

        /* Form Styling */
        .form-control,
        .form-select {
            border-radius: 10px;
            padding: 10px;
            border: 1px solid #e2e8f0;
        }

        .modal-content {
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }
    </style>

    <div class="d-flex">
        <div class="content-area w-100 p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h3 class="fw-bold m-0 text-dark">Manajemen Petugas</h3>
                    <p class="text-muted small">Kelola hak akses dan alokasi 5 Pos Pengujian</p>
                </div>
                <button class="btn btn-primary rounded-pill px-4" data-bs-toggle="modal" data-bs-target="#modalTambah">
                    <i class="fa fa-user-plus me-2"></i> Tambah Akun
                </button>
            </div>

            @if(session('success'))
                <div class="alert alert-success border-0 shadow-sm rounded-3 mb-4">{{ session('success') }}</div>
            @endif

            <div class="card table-card">
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead class="bg-light text-muted small">
                            <tr>
                                <th class="ps-4">INFORMASI PETUGAS</th>
                                <th>ROLE</th>
                                <th>GANTI PENEMPATAN POS</th>
                                <th>STATUS</th>
                                <th class="text-center">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($petugas as $p)
                                <tr>
                                    <td class="ps-4">
                                        <div class="fw-bold text-dark">{{ $p->name }}</div>
                                        <div class="text-muted small">
                                            {{ $p->email }} |
                                            <span class="fw-bold text-primary">@ {{ $p->username }}</span> |
                                            <span class="badge bg-pos-active text-uppercase" style="font-size: 0.6rem;">
                                                <i class="fa fa-map-marker-alt me-1"></i> {{ $p->pos_tugas ?? 'Belum Ada Pos' }}
                                            </span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-role text-uppercase">{{ str_replace('_', ' ', $p->role) }}</span>
                                    </td>
                                    <td>
                                        @if($p->role === 'petugas')
                                            <form action="{{ route('admin.petugas.updatePos', $p->id) }}" method="POST">
                                                @csrf @method('PATCH')
                                                <select name="pos_tugas" onchange="this.form.submit()"
                                                    class="form-select form-select-sm bg-light border-0 w-auto">
                                                    <option value="">-- Pilih Pos --</option>
                                                    <option value="Pos 1" {{ $p->pos_tugas == 'Pos 1' ? 'selected' : '' }}>Pos 1
                                                        (Visual)</option>
                                                    <option value="Pos 2" {{ $p->pos_tugas == 'Pos 2' ? 'selected' : '' }}>Pos 2
                                                        (Emisi)</option>
                                                    <option value="Pos 3" {{ $p->pos_tugas == 'Pos 3' ? 'selected' : '' }}>Pos 3 (Rem)
                                                    </option>
                                                    <option value="Pos 4" {{ $p->pos_tugas == 'Pos 4' ? 'selected' : '' }}>Pos 4
                                                        (Lampu & Kebisingan)</option>
                                                    <option value="Pos 5" {{ $p->pos_tugas == 'Pos 5' ? 'selected' : '' }}>Pos 5
                                                        (Kuncup Roda)</option>
                                                </select>
                                            </form>
                                        @else
                                            <span class="text-muted small">Akses Kontrol Sistem</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge {{ $p->is_active ? 'bg-success' : 'bg-danger' }}">
                                            {{ $p->is_active ? 'Aktif' : 'Non-Aktif' }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group gap-2">
                                            <form action="{{ route('admin.petugas.toggle', $p->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf @method('PATCH')
                                                <button type="submit" class="btn btn-sm btn-light border"
                                                    title="Aktif/Nonaktifkan">
                                                    <i
                                                        class="fa {{ $p->is_active ? 'fa-ban text-warning' : 'fa-check text-success' }}"></i>
                                                </button>
                                            </form>
                                            <form action="{{ route('admin.petugas.destroy', $p->id) }}" method="POST"
                                                class="d-inline" onsubmit="return confirm('Hapus akun secara permanen?')">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-light border">
                                                    <i class="fa fa-trash text-danger"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalTambah" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0">
                <div class="modal-header border-0 p-4 pb-0">
                    <h5 class="fw-bold text-dark">Daftarkan Akun Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('admin.petugas.store') }}" method="POST">
                    @csrf
                    <div class="modal-body p-4">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold">Nama Lengkap</label>
                                <input type="text" name="name" class="form-control" placeholder="Nama petugas" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold">Username</label>
                                <input type="text" name="username" class="form-control" placeholder="username_login"
                                    required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Alamat Email</label>
                            <input type="email" name="email" class="form-control" placeholder="email@upt-pkb.go.id"
                                required>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold">Role Akses</label>
                                <select name="role" id="roleSelect" class="form-select" required
                                    onchange="togglePosInput()">
                                    <option value="admin_pendaftaran">Admin Pendaftaran</option>
                                    <option value="petugas" selected>Petugas Lapangan</option>
                                    <option value="super_admin">Super Admin</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold">Password</label>
                                <input type="password" name="password" class="form-control" placeholder="Min. 8 Karakter"
                                    required>
                            </div>
                        </div>

                        <div class="mb-0" id="posInputContainer">
                            <label class="form-label small fw-bold text-primary">Penempatan Awal Pos</label>
                            <select name="pos_tugas" class="form-select border-primary text-primary">
                                <option value="">-- Pilih Pos Tugas --</option>
                                <option value="Pos 1">Pos 1 (Pemeriksaan Visual)</option>
                                <option value="Pos 2">Pos 2 (Pemeriksaan Emisi)</option>
                                <option value="Pos 3">Pos 3 (Pemeriksaan Rem)</option>
                                <option value="Pos 4">Pos 4 (Lampu & Kebisingan)</option>
                                <option value="Pos 5">Pos 5 (Kuncup Roda Depan)</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer border-0 p-4 pt-0">
                        <button type="submit" class="btn btn-primary w-100 rounded-pill py-2 fw-bold">Simpan Akun
                            Petugas</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Jalankan saat halaman load untuk menyesuaikan tampilan awal modal
        document.addEventListener("DOMContentLoaded", function () {
            togglePosInput();
        });

        function togglePosInput() {
            const role = document.getElementById('roleSelect').value;
            const container = document.getElementById('posInputContainer');
            if (role === 'petugas') {
                container.style.display = 'block';
            } else {
                container.style.display = 'none';
            }
        }
    </script>
@endsection