@extends('admin.layouts')

@section('content')
    <div class="stat-grid">
        <div class="stat-card">
            <div class="stat-icon" style="background: #e0e7ff; color: #4338ca;"><i class="fa fa-car"></i></div>
            <div>
                <div style="font-size: 20px; font-weight: bold;">{{ $total_kendaraan }}</div>
                <div style="font-size: 12px; color: #64748b;">Total Unit</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon" style="background: var(--light-color); color: #065f46;"><i
                    class="fa fa-clipboard-list"></i></div>
            <div>
                <div style="font-size: 20px; font-weight: bold;">{{ $total_uji_hari_ini }}</div>
                <div style="font-size: 12px; color: #64748b;">Uji Hari Ini</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon" style="background: #dcfce7; color: #166534;"><i class="fa fa-check-circle"></i></div>
            <div>
                <div style="font-size: 20px; font-weight: bold;">{{ $uji_lulus }}</div>
                <div style="font-size: 12px; color: #64748b;">Lulus Uji</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon" style="background: #fee2e2; color: #991b1b;"><i class="fa fa-times-circle"></i></div>
            <div>
                <div style="font-size: 20px; font-weight: bold;">{{ $uji_gagal }}</div>
                <div style="font-size: 12px; color: #64748b;">Gagal Uji</div>
            </div>
        </div>
    </div>

    <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 30px;">
        <div class="table-container">
            <h3 class="font-header" style="font-size: 18px; margin-bottom: 20px;">Antrean Pengujian Berjalan
            </h3>
            <table>
                <thead>
                    <tr>
                        <th>No. Antrean</th>
                        <th>Plat Nomor</th>
                        <th>Pemilik</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($antrean as $a)
                        <tr>
                            <td><strong>#{{ $a->nomor_antrean }}</strong></td>
                            <td>{{ $a->kendaraan->no_kendaraan }}</td>
                            <td>{{ $a->kendaraan->pemilik->nama_lengkap }}</td>
                            <td><button class="btn-primary-custom" style="padding: 5px 10px; font-size: 11px;">Input
                                    Hasil</button></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="table-container">
            <h3 class="font-header" style="font-size: 18px; margin-bottom: 20px;">Rating Terbaru</h3>
            @foreach($recent_ratings as $r)
                <div style="padding: 10px 0; border-bottom: 1px solid #f1f5f9;">
                    <div style="display: flex; justify-content: space-between;">
                        <span style="font-weight: 600; font-size: 13px;">{{ $r->pendaftaran->kendaraan->no_kendaraan }}</span>
                        <span style="color: #f59e0b;">{{ str_repeat('★', $r->skor_bintang) }}</span>
                    </div>
                    <small style="color: #64748b; font-size: 11px;">Petugas: {{ $r->petugas->nama_petugas }}</small>
                </div>
            @endforeach
        </div>
    </div>
@endsection