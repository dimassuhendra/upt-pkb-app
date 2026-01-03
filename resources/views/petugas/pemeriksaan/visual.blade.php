@extends('petugas.pemeriksaan.layout_form')

@section('form_content')
    <div class="row g-3">
        <div class="col-md-6">
            <label class="form-label fw-bold">Kondisi Ban</label>
            <select name="kondisi_ban" class="form-select border-primary">
                <option value="1" {{ ($hasil->kondisi_ban ?? '') == 1 ? 'selected' : '' }}>Layak</option>
                <option value="0" {{ ($hasil->kondisi_ban ?? '') == 0 ? 'selected' : '' }}>Tidak Layak</option>
            </select>
        </div>
        <div class="col-md-6">
            <label class="form-label fw-bold">Kedalaman Alur Ban (mm)</label>
            <input type="number" step="0.1" name="kedalaman_alur_ban" class="form-control"
                value="{{ $hasil->kedalaman_alur_ban ?? '' }}">
        </div>
        <div class="col-md-4">
            <label class="form-label fw-bold">Kondisi Kaca</label>
            <select name="kondisi_kaca" class="form-select border-primary">
                <option value="1" {{ ($hasil->kondisi_kaca ?? '') == 1 ? 'selected' : '' }}>Baik</option>
                <option value="0" {{ ($hasil->kondisi_kaca ?? '') == 0 ? 'selected' : '' }}>Rusak/Retak</option>
            </select>
        </div>
        <div class="col-md-4">
            <label class="form-label fw-bold">Klakson</label>
            <select name="klakson" class="form-select border-primary">
                <option value="1" {{ ($hasil->klakson ?? '') == 1 ? 'selected' : '' }}>Bunyi</option>
                <option value="0" {{ ($hasil->klakson ?? '') == 0 ? 'selected' : '' }}>Mati</option>
            </select>
        </div>
        <div class="col-md-4">
            <label class="form-label fw-bold">Wiper</label>
            <select name="wiper" class="form-select border-primary">
                <option value="1" {{ ($hasil->wiper ?? '') == 1 ? 'selected' : '' }}>Berfungsi</option>
                <option value="0" {{ ($hasil->wiper ?? '') == 0 ? 'selected' : '' }}>Rusak</option>
            </select>
        </div>
    </div>
@endsection