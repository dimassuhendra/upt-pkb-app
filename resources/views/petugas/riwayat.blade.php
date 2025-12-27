@extends('petugas.layouts')

@section('content')
    <div class="container-fluid p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="fw-bold">Riwayat Pemeriksaan</h3>
                <p class="text-muted">Daftar kendaraan yang telah Anda proses</p>
            </div>
        </div>

        <div class="card border-0 shadow-sm" style="border-radius: 15px;">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="px-4 py-3 text-muted">Tanggal</th>
                                <th class="py-3 text-muted">No. Antrean</th>
                                <th class="py-3 text-muted">Plat Nomor</th>
                                <th class="py-3 text-muted">Jenis Kendaraan</th>
                                <th class="py-3 text-muted">Hasil Akhir</th>
                                <th class="py-3 text-muted text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($riwayat as $item)
                                <tr>
                                    <td class="px-4 py-3 align-middle">
                                        {{ $item->created_at->format('d/m/Y') }}<br>
                                        <small class="text-muted">{{ $item->created_at->format('H:i') }} WIB</small>
                                    </td>
                                    <td class="py-3 align-middle fw-bold">
                                        {{ $item->pendaftaran->nomor_antrean ?? '-' }}
                                    </td>
                                    <td class="py-3 align-middle">
                                        <span
                                            class="badge bg-dark px-2 py-1">{{ $item->pendaftaran->kendaraan->no_kendaraan }}</span>
                                    </td>
                                    <td class="py-3 align-middle">
                                        {{ $item->pendaftaran->kendaraan->jenis_kendaraan }}
                                    </td>
                                    <td class="py-3 align-middle">
                                        @if($item->hasil_akhir == 'lulus')
                                            <span class="badge bg-success rounded-pill px-3">LULUS</span>
                                        @elseif($item->hasil_akhir == 'tidak_lulus')
                                            <span class="badge bg-danger rounded-pill px-3">TIDAK LULUS</span>
                                        @else
                                            <span class="badge bg-secondary rounded-pill px-3">DALAM PROSES</span>
                                        @endif
                                    </td>
                                    <td class="py-3 align-middle text-center">
                                        <a href="{{ route('petugas.detail', $item->pendaftaran_id) }}"
                                            class="btn btn-outline-primary btn-sm rounded-pill px-3">
                                            <i class="fa fa-search me-1"></i> Detail
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-5 text-muted">
                                        <i class="fa fa-folder-open fa-3x mb-3 opacity-20"></i><br>
                                        Belum ada riwayat pemeriksaan yang Anda lakukan.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @if($riwayat->hasPages())
                <div class="card-footer bg-white border-0 py-3">
                    {{ $riwayat->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection