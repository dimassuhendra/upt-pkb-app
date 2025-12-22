@extends('petugas.layouts') {{-- Sesuaikan dengan nama layout Anda --}}

@section('content')
    <div class="container">
        <div class="row mb-4">
            <div class="col-md-12">
                <h2>Dashboard Petugas</h2>
                <p>Selamat Datang, <strong>{{ Auth::user()->name }}</strong></p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="card bg-primary text-white mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Total Uji Hari Ini</h5>
                        <h2 class="display-4">{{ $stats['total_uji_hari_ini'] }}</h2>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card bg-success text-white mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Kendaraan Lulus</h5>
                        <h2 class="display-4">{{ $stats['lulus_hari_ini'] }}</h2>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card bg-warning text-dark mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Rata-rata Rating</h5>
                        <h2 class="display-4">{{ number_format($stats['rating_rata_rata'], 1) }} ⭐</h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Informasi Petugas</div>
                    <div class="card-body">
                        <p>Gunakan menu di samping atau atas untuk mengelola data pengujian kendaraan sesuai dengan tugas
                            dan fungsi Pembimbing Kemasyarakatan.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection