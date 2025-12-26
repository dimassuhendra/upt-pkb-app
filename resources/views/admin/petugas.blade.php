@extends('admin.layouts')

@section('content')
    <style>
        /* Container Area */
        .content-area {
            background: #f8faff;
            min-height: 100vh;
        }

        /* Card & Table */
        .card {
            border-radius: 15px;
            overflow: hidden;
            background: white;
        }

        .table thead {
            background-color: #f1f5f9;
        }

        .table thead th {
            font-size: 0.75rem;
            letter-spacing: 0.05em;
            font-weight: 700;
            color: #64748b;
            border: none;
            padding: 15px;
        }

        .table tbody td {
            padding: 15px;
            border-bottom: 1px solid #f1f5f9;
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

        /* Button Custom */
        .btn-primary {
            background-color: #3A59D1;
            border: none;
        }

        .btn-outline-warning {
            color: #f59e0b;
            border-color: #f59e0b;
        }

        .btn-outline-warning:hover {
            background-color: #f59e0b;
            color: white;
        }

        /* Modal Styling */
        .modal-content {
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .form-control {
            border-radius: 10px;
            padding: 10px;
            border: 1px solid #e2e8f0;
        }
    </style>

    <div class="d-flex">
        <div class="content-area w-100 p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h3 class="fw-bold m-0 text-dark">Manajemen Petugas</h3>
                    <p class="text-muted small">Kelola hak akses akun sistem</p>
                </div>
                <button class="btn btn-primary rounded-pill px-4" data-bs-toggle="modal" data-bs-target="#modalTambah">
                    <i class="fa fa-user-plus me-2"></i> Tambah Petugas
                </button>
            </div>

            <div class="card border-0 shadow-sm">
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead class="bg-light text-muted small">
                            <tr>
                                <th class="ps-4">NAMA / USERNAME</th>
                                <th>ROLE</th>
                                <th>EMAIL</th>
                                <th>STATUS</th>
                                <th class="text-center">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($petugas as $p)
                                <tr>
                                    <td class="ps-4">
                                        <div class="fw-bold text-dark">{{ $p->name }}</div>
                                        <div class="text-muted small">@ {{ $p->username }}</div>
                                    </td>
                                    <td>
                                        <span class="badge bg-role text-uppercase">{{ $p->role }}</span>
                                    </td>
                                    <td class="text-muted small">{{ $p->email }}</td>
                                    <td>
                                        <span class="badge {{ $p->is_active ? 'bg-success' : 'bg-danger' }}">
                                            {{ $p->is_active ? 'Aktif' : 'Non-Aktif' }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group gap-2">
                                            <form action="{{ route('admin.petugas.toggle', $p->id) }}" method="POST">
                                                @csrf @method('PATCH')
                                                <button type="submit" class="btn btn-sm btn-light border" title="Ubah Status">
                                                    <i
                                                        class="fa {{ $p->is_active ? 'fa-ban text-warning' : 'fa-check text-success' }}"></i>
                                                </button>
                                            </form>
                                            <form action="{{ route('admin.petugas.destroy', $p->id) }}" method="POST"
                                                onsubmit="return confirm('Hapus permanen?')">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-light border"><i
                                                        class="fa fa-trash text-danger"></i></button>
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
                    <h5 class="fw-bold">Daftarkan Akun Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('admin.petugas.store') }}" method="POST">
                    @csrf
                    <div class="modal-body p-4">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold">Nama Lengkap</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold">Username</label>
                                <input type="text" name="username" class="form-control" placeholder="contoh: budi_uji"
                                    required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold">Role Akses</label>
                                <select name="role" class="form-select" required>
                                    <option value="petugas">Petugas</option>
                                    <option value="admin_pendaftaran">Admin</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold">Password</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0 p-4 pt-0">
                        <button type="submit" class="btn btn-primary w-100 rounded-pill py-2">Simpan Akun Petugas</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection