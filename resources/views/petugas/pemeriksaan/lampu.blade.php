@extends('petugas.pemeriksaan.layout_form')

@section('form_content')
    <div class="row g-3">
        <div class="col-md-6">
            <label class="form-label fw-bold">Kekuatan Cahaya Lampu (cd)</label>
            <input type="number" name="lampu_utama_kekuatan" class="form-control border-primary"
                value="{{ $hasil->lampu_utama_kekuatan ?? '' }}">
        </div>
        <div class="col-md-6">
            <label class="form-label fw-bold">Penyimpangan Lampu (derajat)</label>
            <input type="number" step="0.01" name="lampu_utama_penyimpangan" class="form-control border-primary"
                value="{{ $hasil->lampu_utama_penyimpangan ?? '' }}">
        </div>
        <div class="col-md-12">
            <label class="form-label fw-bold">Tingkat Kebisingan (dB)</label>
            <input type="number" step="0.1" name="kebisingan_desibel" class="form-control border-primary"
                value="{{ $hasil->kebisingan_desibel ?? '' }}">
        </div>
    </div>
@endsection