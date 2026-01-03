@extends('petugas.pemeriksaan.layout_form')

@section('form_content')
    <div class="row g-3">
        <div class="col-md-12 mb-3">
            <label class="form-label fw-bold">Side Slip (mm/m)</label>
            <input type="number" step="0.01" name="side_slip" class="form-control border-primary"
                value="{{ $hasil->side_slip ?? '' }}">
        </div>

        <div class="col-12 p-3 bg-warning bg-opacity-10 border border-warning rounded">
            <h6 class="fw-bold"><i class="fa fa-gavel me-2"></i>KEPUTUSAN AKHIR</h6>
            <div class="row mt-3">
                <div class="col-md-6">
                    <label class="form-label fw-bold">Hasil Uji</label>
                    <select name="hasil_akhir" class="form-select bg-white border-dark fw-bold text-uppercase">
                        <option value="lulus" {{ ($hasil->hasil_akhir ?? '') == 'lulus' ? 'selected' : '' }}>LULUS</option>
                        <option value="tidak_lulus" {{ ($hasil->hasil_akhir ?? '') == 'tidak_lulus' ? 'selected' : '' }}>TIDAK
                            LULUS</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Masa Berlaku Sampai</label>
                    <input type="date" name="masa_berlaku_sampai" class="form-control"
                        value="{{ $hasil->masa_berlaku_sampai ?? date('Y-m-d', strtotime('+6 months')) }}">
                </div>
                <div class="col-12 mt-3">
                    <label class="form-label fw-bold">Catatan Perbaikan (Opsional)</label>
                    <textarea name="catatan_perbaikan" class="form-control"
                        rows="3">{{ $hasil->catatan_perbaikan ?? '' }}</textarea>
                </div>
            </div>
        </div>
    </div>
@endsection