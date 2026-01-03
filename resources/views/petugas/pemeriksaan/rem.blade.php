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
    </div>
@endsection