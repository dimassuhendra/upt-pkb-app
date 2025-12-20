@extends('admin.layouts')

@section('content')
    <div class="container-fluid" style="padding: 0 20px;">
        <div style="margin-bottom: 35px;">
            <h1 class="font-header" style="color: var(--primary-color); margin-bottom: 8px;">Pendaftaran Uji Baru</h1>
            <p style="color: #64748b; font-size: 14px;">Gunakan form ini untuk mendaftarkan kendaraan ke dalam antrean
                pengujian hari ini.</p>
        </div>

        <div class="card-custom"
            style="margin-bottom: 50px; border-top: 6px solid var(--primary-color); background: white; border-radius: 20px; box-shadow: 0 10px 25px rgba(0,0,0,0.05);">
            <div style="padding: 25px 35px; border-bottom: 1px solid #f1f5f9;">
                <h3 class="font-header" style="font-size: 18px; margin: 0; color: #1e293b;">
                    <i class="fa fa-file-invoice mr-2" style="color: var(--secondary-color);"></i> Form Registrasi &
                    Retribusi
                </h3>
            </div>

            <div style="padding: 40px 35px;">
                <form action="{{ route('admin.pendaftaran.store') }}" method="POST" id="formPendaftaran">
                    @csrf
                    <div style="display: grid; grid-template-columns: 2fr 1fr 1fr; gap: 30px;">

                        <div class="form-group">
                            <label class="font-header"
                                style="display: block; margin-bottom: 12px; font-size: 14px; color: #475569;">Cari Kendaraan
                                (Plat Nomor)</label>
                            <select name="kendaraan_id" id="selectKendaraan" class="form-control-custom" required
                                onchange="updateInfoKendaraan()"
                                style="width: 100%; padding: 12px; border-radius: 12px; border: 1px solid #e2e8f0;">
                                <option value="" data-jenis="-" data-biaya="0">-- Pilih Plat Nomor Kendaraan --</option>
                                @foreach($kendaraans as $k)
                                    <option value="{{ $k->id }}" data-jenis="{{ $k->jenis_kendaraan }}"
                                        data-biaya="{{ $k->jenis_kendaraan == 'Truk' ? 150000 : ($k->jenis_kendaraan == 'Bus' ? 200000 : 100000) }}">
                                        {{ $k->no_kendaraan }} — {{ $k->pemilik->nama_lengkap }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="font-header"
                                style="display: block; margin-bottom: 12px; font-size: 14px; color: #475569;">Jenis
                                Kendaraan</label>
                            <input type="text" id="displayJenis" class="form-control-custom"
                                style="background: #f8fafc; color: #64748b; cursor: not-allowed;" readonly
                                placeholder="Otomatis">
                        </div>

                        <div class="form-group">
                            <label class="font-header"
                                style="display: block; margin-bottom: 12px; font-size: 14px; color: #475569;">Biaya
                                Retribusi</label>
                            <input type="text" id="displayBiaya" class="form-control-custom"
                                style="background: #f8fafc; font-weight: 700; color: var(--primary-color); cursor: not-allowed;"
                                readonly placeholder="Rp 0">
                        </div>
                    </div>

                    <div
                        style="margin-top: 40px; padding-top: 25px; border-top: 1px dashed #e2e8f0; display: flex; justify-content: space-between; align-items: center;">
                        <small style="color: #94a3b8;">* Data ini akan langsung masuk ke layar monitor petugas
                            penguji.</small>
                        <button type="submit" class="btn-primary-custom" style="padding: 14px 45px; font-weight: 600;">
                            DAFTARKAN KENDARAAN <i class="fa fa-arrow-right ml-2"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="table-container"
            style="padding: 35px; background: #fff; border-radius: 20px; box-shadow: 0 4px 15px rgba(0,0,0,0.03);">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 35px;">
                <div>
                    <h3 class="font-header" style="font-size: 20px; margin: 0;">Monitoring Antrean Hari Ini</h3>
                    <p style="font-size: 13px; color: #94a3b8; margin-top: 5px;">Data diperbarui secara real-time saat
                        pendaftaran masuk.</p>
                </div>
                <div
                    style="background: #eff6ff; padding: 10px 20px; border-radius: 12px; border: 1px solid #dbeafe; color: var(--primary-color); font-weight: 600;">
                    <i class="fa fa-calendar-alt mr-2"></i> {{ date('d F Y') }}
                </div>
            </div>

            <table style="width: 100%; border-collapse: separate; border-spacing: 0 12px;">
                <thead>
                    <tr style="color: #64748b; font-size: 12px; text-transform: uppercase; letter-spacing: 1px;">
                        <th style="padding: 10px; text-align: center;">No. Antrean</th>
                        <th style="padding: 10px;">Identitas Kendaraan</th>
                        <th style="padding: 10px;">Pemilik</th>
                        <th style="padding: 10px;">Status</th>
                        <th style="padding: 10px; text-align: right;">Jam Daftar</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($antrean as $a)
                        <tr style="background: #fcfcfc; box-shadow: 0 2px 5px rgba(0,0,0,0.02);">
                            <td style="padding: 20px; text-align: center; border-radius: 15px 0 0 15px;">
                                <span
                                    style="font-size: 18px; font-weight: 800; color: var(--primary-color);">#{{ $a->nomor_antrean }}</span>
                            </td>
                            <td style="padding: 20px;">
                                <span class="badge-plat"
                                    style="background: #1e293b; color: white; padding: 6px 12px; border-radius: 6px; font-weight: bold;">
                                    {{ $a->kendaraan->no_kendaraan }}
                                </span>
                            </td>
                            <td style="padding: 20px; font-weight: 500;">{{ $a->kendaraan->pemilik->nama_lengkap }}</td>
                            <td style="padding: 20px;">
                                <span
                                    style="background: #fff7ed; color: #c2410c; padding: 6px 15px; border-radius: 20px; font-size: 12px; font-weight: 600; border: 1px solid #ffedd5;">
                                    <i class="fa fa-sync fa-spin mr-1"></i> Sedang Proses Uji
                                </span>
                            </td>
                            <td style="padding: 20px; text-align: right; color: #94a3b8; border-radius: 0 15px 15px 0;">
                                {{ $a->created_at->format('H:i') }} WIB
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="text-align: center; padding: 80px; color: #cbd5e1;">
                                <i class="fa fa-inbox fa-3x mb-3"></i><br>Belum ada kendaraan yang terdaftar hari ini.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @push('scripts')
        <script>
            function updateInfoKendaraan() {
                const select = document.getElementById('selectKendaraan');
                const selectedOption = select.options[select.selectedIndex];

                const jenis = selectedOption.getAttribute('data-jenis');
                const biaya = selectedOption.getAttribute('data-biaya');

                document.getElementById('displayJenis').value = jenis || '-';
                document.getElementById('displayBiaya').value = biaya > 0 ? 'Rp ' + parseInt(biaya).toLocaleString('id-ID') : 'Rp 0';
            }
        </script>
    @endpush
@endsection