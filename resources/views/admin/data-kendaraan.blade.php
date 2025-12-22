@extends('admin.layouts')

@section('content')
    <div class="container-fluid" style="padding: 0 20px;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 35px;">
            <div>
                <h1 class="font-header" style="color: var(--primary-color); margin: 0;">Data Master Kendaraan</h1>
                <p style="color: #64748b; font-size: 14px; margin-top: 5px;">Kelola armada kendaraan yang terdaftar di
                    sistem.</p>
            </div>
            <button onclick="toggleModal('modalTambah')" class="btn-primary-custom" style="padding: 12px 25px;">
                <i class="fa fa-truck mr-2"></i> TAMBAH KENDARAAN
            </button>
        </div>

        @if(session('success'))
            <div
                style="background: #dcfce7; color: #166534; padding: 15px; border-radius: 12px; margin-bottom: 25px; border: 1px solid #bbf7d0;">
                {{ session('success') }}
            </div>
        @endif

        <div class="table-container"
            style="padding: 30px; border-radius: 20px; background: white; box-shadow: 0 4px 6px rgba(0,0,0,0.05);">
            <table style="width: 100%; border-collapse: separate; border-spacing: 0 10px;">
                <thead>
                    <tr style="color: #64748b; font-size: 12px; text-transform: uppercase;">
                        <th style="padding: 15px;">PLAT NOMOR</th>
                        <th style="padding: 15px;">PEMILIK</th>
                        <th style="padding: 15px;">JENIS/MEREK</th>
                        <th style="padding: 15px;">TAHUN</th>
                        <th style="padding: 15px; text-align: center;">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($kendaraans as $k)
                        <tr style="background: #f8fafc;">
                            <td style="padding: 20px; border-radius: 15px 0 0 15px;">
                                <span
                                    style="background: #1e293b; color: white; padding: 5px 12px; border-radius: 6px; font-weight: bold;">{{ $k->no_kendaraan }}</span>
                            </td>
                            <td style="padding: 20px; font-weight: 600;">{{ $k->pemilik->nama_lengkap }}</td>
                            <td style="padding: 20px;">{{ $k->jenis_kendaraan }} / {{ $k->merek }}</td>
                            <td style="padding: 20px;">{{ $k->tahun_pembuatan }}</td>
                            <td style="padding: 20px; text-align: center; border-radius: 0 15px 15px 0;">
                                <div style="display: flex; gap: 10px; justify-content: center;">
                                    <button onclick='editKendaraan(@json($k))' class="btn-action"
                                        style="color: #2563eb; background: #eff6ff; border: none; padding: 8px; border-radius: 8px; cursor: pointer;">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    <form action="{{ route('admin.data-kendaraan.destroy', $k->id) }}" method="POST"
                                        onsubmit="return confirm('Hapus kendaraan ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit"
                                            style="color: #dc2626; background: #fef2f2; border: none; padding: 8px; border-radius: 8px; cursor: pointer;">
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
        style="display:none; position: fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.6); z-index:9999; justify-content:center; align-items:center;">
        <div class="card-custom" style="width: 550px; background: white; padding: 40px; border-radius: 24px;">
            <h3 id="modalTitle" class="font-header" style="margin-bottom: 30px;">Tambah Kendaraan</h3>
            <form id="kendaraanForm" action="{{ route('admin.data-kendaraan.store') }}" method="POST">
                @csrf
                <div id="methodField"></div>

                <div style="margin-bottom: 15px;">
                    <label style="display:block; font-size: 13px; margin-bottom: 8px; font-weight: 600;">Pilih
                        Pemilik</label>
                    <select name="pemilik_id" id="formPemilik" class="form-control-custom" required>
                        <option value="">-- Pilih Pemilik --</option>
                        @foreach($pemiliks as $p)
                            <option value="{{ $p->id }}">{{ $p->nama_lengkap }} ({{ $p->nik }})</option>
                        @endforeach
                    </select>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 15px;">
                    <div>
                        <label style="display:block; font-size: 13px; margin-bottom: 8px; font-weight: 600;">Plat
                            Nomor</label>
                        <input type="text" name="no_kendaraan" id="formPlat" class="form-control-custom"
                            placeholder="B 1234 ABC" required>
                    </div>
                    <div>
                        <label style="display:block; font-size: 13px; margin-bottom: 8px; font-weight: 600;">Jenis</label>
                        <select name="jenis_kendaraan" id="formJenis" class="form-control-custom" required>
                            <option value="Mobil">Mobil</option>
                            <option value="Truk">Truk</option>
                            <option value="Bus">Bus</option>
                        </select>
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 25px;">
                    <div>
                        <label style="display:block; font-size: 13px; margin-bottom: 8px; font-weight: 600;">Merek</label>
                        <input type="text" name="merek" id="formMerek" class="form-control-custom"
                            placeholder="Toyota/Hino/dll" required>
                    </div>
                    <div>
                        <label style="display:block; font-size: 13px; margin-bottom: 8px; font-weight: 600;">Tahun
                            Pembuatan</label>
                        <input type="number" name="tahun_pembuatan" id="formTahun" class="form-control-custom"
                            placeholder="2024" required>
                    </div>
                </div>

                <div style="display: flex; gap: 15px;">
                    <button type="button" onclick="toggleModal()"
                        style="flex:1; padding:14px; border-radius:12px; border:1px solid #ddd; background:none; cursor:pointer;">Batal</button>
                    <button type="submit" class="btn-primary-custom" style="flex:1;">Simpan Kendaraan</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function toggleModal(type) {
            const modal = document.getElementById('modalContainer');
            const form = document.getElementById('kendaraanForm');
            if (modal.style.display === 'none' || modal.style.display === '') {
                modal.style.display = 'flex';
                if (type === 'modalTambah') {
                    document.getElementById('modalTitle').innerText = 'Tambah Kendaraan Baru';
                    form.action = "{{ route('admin.data-kendaraan.store') }}";
                    document.getElementById('methodField').innerHTML = '';
                    form.reset();
                }
            } else {
                modal.style.display = 'none';
            }
        }

        function editKendaraan(data) {
            toggleModal();
            document.getElementById('modalTitle').innerText = 'Edit Data Kendaraan';
            const form = document.getElementById('kendaraanForm');
            form.action = "/admin/kendaraan/" + data.id;
            document.getElementById('methodField').innerHTML = '@method("PUT")';

            document.getElementById('formPemilik').value = data.pemilik_id;
            document.getElementById('formPlat').value = data.no_kendaraan;
            document.getElementById('formJenis').value = data.jenis_kendaraan;
            document.getElementById('formMerek').value = data.merek;
            document.getElementById('formTahun').value = data.tahun_pembuatan;
        }
    </script>
@endpush