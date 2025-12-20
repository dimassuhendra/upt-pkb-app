@extends('admin.layouts')

@section('content')
    <div class="container-fluid" style="padding: 0 20px;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 35px;">
            <div>
                <h1 class="font-header" style="color: var(--primary-color); margin: 0;">Data Master Pemilik</h1>
                <p style="color: #64748b; font-size: 14px; margin-top: 5px;">Kelola informasi identitas pemilik kendaraan.
                </p>
            </div>
            <button onclick="toggleModal('modalTambah')" class="btn-primary-custom" style="padding: 12px 25px;">
                <i class="fa fa-plus-circle mr-2"></i> TAMBAH PEMILIK
            </button>
        </div>

        @if(session('success'))
            <div
                style="background: #dcfce7; color: #166534; padding: 15px; border-radius: 12px; margin-bottom: 25px; border: 1px solid #bbf7d0;">
                <i class="fa fa-check-circle mr-2"></i> {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div
                style="background: #fee2e2; color: #991b1b; padding: 15px; border-radius: 12px; margin-bottom: 25px; border: 1px solid #fecaca;">
                <i class="fa fa-exclamation-triangle mr-2"></i> {{ session('error') }}
            </div>
        @endif

        <div class="table-container"
            style="padding: 30px; border-radius: 20px; background: white; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);">
            <table style="width: 100%; border-collapse: separate; border-spacing: 0 10px;">
                <thead>
                    <tr style="color: #64748b; font-size: 12px; text-transform: uppercase; letter-spacing: 1px;">
                        <th style="padding: 15px;">NIK</th>
                        <th style="padding: 15px;">NAMA LENGKAP</th>
                        <th style="padding: 15px;">ALAMAT</th>
                        <th style="padding: 15px;">NO. HP</th>
                        <th style="padding: 15px; text-align: center;">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pemiliks as $p)
                        <tr style="background: #f8fafc; transition: all 0.3s;">
                            <td style="padding: 20px; font-weight: 600; border-radius: 15px 0 0 15px;">{{ $p->nik }}</td>
                            <td style="padding: 20px;">{{ $p->nama_lengkap }}</td>
                            <td style="padding: 20px; color: #64748b;">{{ Str::limit($p->alamat, 40) }}</td>
                            <td style="padding: 20px;">{{ $p->no_hp }}</td>
                            <td style="padding: 20px; text-align: center; border-radius: 0 15px 15px 0;">
                                <div style="display: flex; gap: 10px; justify-content: center;">
                                    <button onclick='editPemilik(@json($p))' class="btn-action"
                                        style="color: #2563eb; background: #eff6ff; border: none; padding: 10px; border-radius: 8px; cursor: pointer;">
                                        <i class="fa fa-edit"></i>
                                    </button>

                                    <form action="{{ route('admin.pemilik.destroy', $p->id) }}" method="POST"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            style="color: #dc2626; background: #fef2f2; border: none; padding: 10px; border-radius: 8px; cursor: pointer;">
                                            <i class="fa fa-trash"></i>
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

    <div id="modalContainer"
        style="display:none; position: fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.6); z-index:9999; justify-content:center; align-items:center; backdrop-filter: blur(4px);">
        <div class="card-custom"
            style="width: 550px; background: white; padding: 40px; border-radius: 24px; box-shadow: 0 20px 25px -5px rgba(0,0,0,0.2);">
            <h3 id="modalTitle" class="font-header" style="margin-bottom: 30px; color: var(--primary-color);">Tambah Pemilik
            </h3>

            <form id="pemilikForm" action="{{ route('admin.pemilik.store') }}" method="POST">
                @csrf
                <div id="methodField"></div>

                <div style="margin-bottom: 20px;">
                    <label style="display:block; font-size: 14px; font-weight: 600; margin-bottom: 8px; color: #475569;">NIK
                        (Sesuai KTP)</label>
                    <input type="number" name="nik" id="formNik" class="form-control-custom"
                        placeholder="Masukkan 16 digit NIK" required>
                </div>

                <div style="margin-bottom: 20px;">
                    <label
                        style="display:block; font-size: 14px; font-weight: 600; margin-bottom: 8px; color: #475569;">Nama
                        Lengkap</label>
                    <input type="text" name="nama_lengkap" id="formNama" class="form-control-custom"
                        placeholder="Nama sesuai identitas" required>
                </div>

                <div style="margin-bottom: 20px;">
                    <label
                        style="display:block; font-size: 14px; font-weight: 600; margin-bottom: 8px; color: #475569;">Nomor
                        WhatsApp/HP</label>
                    <input type="text" name="no_hp" id="formHp" class="form-control-custom"
                        placeholder="Contoh: 08123456789" required>
                </div>

                <div style="margin-bottom: 30px;">
                    <label
                        style="display:block; font-size: 14px; font-weight: 600; margin-bottom: 8px; color: #475569;">Alamat
                        Lengkap</label>
                    <textarea name="alamat" id="formAlamat" class="form-control-custom" rows="3"
                        placeholder="Alamat domisili saat ini" required></textarea>
                </div>

                <div style="display: flex; gap: 15px;">
                    <button type="button" onclick="toggleModal()"
                        style="flex:1; padding:14px; border-radius:12px; border:1px solid #e2e8f0; background:#f8fafc; cursor:pointer; font-weight:600;">Batal</button>
                    <button type="submit" class="btn-primary-custom" style="flex:1; font-weight:600;">Simpan
                        Perubahan</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function toggleModal(type) {
            const modal = document.getElementById('modalContainer');
            const form = document.getElementById('pemilikForm');

            if (modal.style.display === 'none' || modal.style.display === '') {
                modal.style.display = 'flex';
                if (type === 'modalTambah') {
                    document.getElementById('modalTitle').innerText = 'Tambah Pemilik Baru';
                    // Reset Action ke Store
                    form.action = "{{ route('admin.pemilik.store') }}";
                    document.getElementById('methodField').innerHTML = '';
                    form.reset();
                }
            } else {
                modal.style.display = 'none';
            }
        }

        function editPemilik(data) {
            const modal = document.getElementById('modalContainer');
            const form = document.getElementById('pemilikForm');

            modal.style.display = 'flex';
            document.getElementById('modalTitle').innerText = 'Edit Data Pemilik';

            // Set Action ke Update (admin/pemilik/{id})
            form.action = "/admin/pemilik/" + data.id;
            document.getElementById('methodField').innerHTML = '@method("PUT")';

            // Isi field input
            document.getElementById('formNik').value = data.nik;
            document.getElementById('formNama').value = data.nama_lengkap;
            document.getElementById('formHp').value = data.no_hp;
            document.getElementById('formAlamat').value = data.alamat;
        }

        // Close modal when clicking outside
        window.onclick = function (event) {
            const modal = document.getElementById('modalContainer');
            if (event.target == modal) {
                toggleModal();
            }
        }
    </script>
@endpush