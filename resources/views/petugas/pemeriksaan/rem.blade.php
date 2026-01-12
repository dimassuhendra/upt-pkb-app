@extends('petugas.pemeriksaan.layout_form')

@section('form_content')
    <div class="row g-3">
        <div class="col-md-6">
            <label class="form-label fw-bold">Rem Utama Kiri (kg)</label>
            <input type="number" name="rem_utama_kiri" class="form-control border-primary"
                value="{{ $hasil->rem_utama_kiri ?? '' }}">
        </div>
        <div class="col-md-6">
            <label class="form-label fw-bold">Rem Utama Kanan (kg)</label>
            <input type="number" name="rem_utama_kanan" class="form-control border-primary"
                value="{{ $hasil->rem_utama_kanan ?? '' }}">
        </div>
        <div class="col-md-6">
            <label class="form-label fw-bold">Selisih Rem Per Sumbu (%)</label>
            <input type="number" step="0.01" name="selisih_rem_per_sumbu" class="form-control"
                value="{{ $hasil->selisih_rem_per_sumbu ?? '' }}">
        </div>
        <div class="col-md-6">
            <label class="form-label fw-bold">Rem Parkir (kg)</label>
            <input type="number" name="rem_parkir" class="form-control border-primary"
                value="{{ $hasil->rem_parkir ?? '' }}">
        </div>

        <div class="col-12 mt-4">
            <h6 class="text-muted border-bottom pb-2 italic small">Review Data Pos 2 (Visual) - Read Only</h6>
        </div>
        <div class="col-md-4">
            <label class="small">Emisi CO (%)</label>
            <input type="text" class="form-control form-control-sm bg-light"
                value="{{ ($hasil->emisi_co) ?? 'Belum Dicek' }} %" disabled>
        </div>
        <div class="col-md-4">
            <label class="small">Emisi HC (ppm)</label>
            <input type="text" class="form-control form-control-sm bg-light"
                value="{{ ($hasil->emisi_hc) ?? 'Belum Dicek' }} ppm" disabled>
        </div>
        <div class="col-md-4">
            <label class="small">Opasitas (Diesel)</label>
            <input type="text" class="form-control form-control-sm bg-light"
                value="{{ ($hasil->emisi_asap_opasitas) ?? 'Belum Dicek' }}" disabled>
        </div>

        <!-- Hasil Dari Pos 1 -->
         <div class="col-12 mt-4">
            <h6 class="text-muted border-bottom pb-2 italic small">Review Data Pos 1 (Visual) - Read Only</h6>
        </div>
        <div class="col-md-4">
            <label class="small">Kondisi Ban</label>
            <input type="text" class="form-control form-control-sm bg-light"
                value="{{ ($hasil && $hasil->kondisi_ban) ? 'Baik' : 'Belum Dicek' }}" disabled>
        </div>
        <div class="col-md-4">
            <label class="small">Kedalaman Alur Ban</label>
            <input type="number" class="form-control form-control-sm bg-light"
                value="{{ ($hasil->kedalaman_alur_ban) ?? '' }} mm" disabled>
        </div>
        <div class="col-md-4">
            <label class="small">Kondisi Kaca</label>
            <input type="text" class="form-control form-control-sm bg-light"
                value="{{ ($hasil && $hasil->kondisi_kaca) ? 'Baik' : 'Belum Dicek' }}" disabled>
        </div>
    </div>
@endsection