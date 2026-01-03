@extends('petugas.pemeriksaan.layout_form')

@section('form_content')
    <div class="row g-3">
        <div class="col-md-6">
            <label class="form-label fw-bold">Emisi CO (%)</label>
            <input type="number" step="0.01" name="emisi_co" class="form-control border-primary"
                value="{{ $hasil->emisi_co ?? '' }}" required>
        </div>
        <div class="col-md-6">
            <label class="form-label fw-bold">Emisi HC (ppm)</label>
            <input type="number" name="emisi_hc" class="form-control border-primary" value="{{ $hasil->emisi_hc ?? '' }}"
                required>
        </div>
        <div class="col-md-12">
            <label class="form-label fw-bold">Opasitas (Diesel)</label>
            <input type="number" name="emisi_asap_opasitas" class="form-control border-primary"
                value="{{ $hasil->emisi_asap_opasitas ?? '' }}">
        </div>

        <div class="col-12 mt-4">
            <h6 class="text-muted border-bottom pb-2 italic small">Review Data Pos 1 (Visual) - Read Only</h6>
        </div>
        <div class="col-md-4">
            <label class="small">Kondisi Ban</label>
            <input type="text" class="form-control form-control-sm bg-light"
                value="{{ ($hasil && $hasil->kondisi_ban) ? 'Baik' : 'Belum Dicek' }}" disabled>
        </div>
        <div class="col-md-4">
            <label class="small">Kondisi Kaca</label>
            <input type="text" class="form-control form-control-sm bg-light"
                value="{{ ($hasil && $hasil->kondisi_kaca) ? 'Baik' : 'Belum Dicek' }}" disabled>
        </div>
    </div>
@endsection