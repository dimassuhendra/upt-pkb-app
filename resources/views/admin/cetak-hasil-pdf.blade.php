<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Hasil Uji - {{ $data->pendaftaran->no_uji }}</title>
    <style>
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-size: 11px;
            line-height: 1.4;
            color: #111;
        }

        .kop-surat {
            border-bottom: 3px double #000;
            padding-bottom: 10px;
            margin-bottom: 20px;
            width: 100%;
        }

        .table-kop {
            width: 100%;
            border-collapse: collapse;
        }

        .logo-box {
            width: 70px;
            text-align: center;
        }

        .logo-img {
            height: 70px;
            width: auto;
        }

        .text-center {
            text-align: center;
        }

        .instansi-title h5 {
            margin: 0;
            font-size: 14px;
            text-transform: uppercase;
            color: #1f2937;
        }

        .instansi-title h2 {
            margin: 2px 0;
            font-size: 20px;
            text-transform: uppercase;
            color: #000;
        }

        .instansi-title p {
            margin: 0;
            font-size: 9px;
            color: #4b5563;
        }

        .doc-title {
            text-align: center;
            text-decoration: underline;
            font-size: 13px;
            font-weight: bold;
            margin: 15px 0;
        }

        .info-table {
            width: 100%;
            margin-bottom: 20px;
        }

        .info-table td {
            padding: 5px 0;
            vertical-align: top;
            border-bottom: 0.5px solid #eee;
        }

        .label {
            width: 30%;
            font-weight: bold;
            text-transform: uppercase;
            color: #444;
        }

        .colon {
            width: 3%;
        }

        .result-container {
            margin: 25px 0;
            text-align: center;
        }

        .result-box {
            display: inline-block;
            border: 2px solid #000;
            padding: 12px 35px;
            font-size: 16px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .lulus {
            color: #15803d;
            border-color: #15803d;
        }

        .tidak-lulus {
            color: #b91c1c;
            border-color: #b91c1c;
        }

        .footer-table {
            width: 100%;
            margin-top: 30px;
            position: relative;
        }

        .signature {
            text-align: center;
            width: 50%;
            float: right;
        }

        .spacer {
            height: 60px;
        }
    </style>
</head>

<body>

    <div class="kop-surat">
        <table class="table-kop">
            <tr>
                <td class="logo-box">
                    <img src="{{ public_path('img/logo-bandarlampung.png') }}" class="logo-img">
                </td>
                <td class="text-center">
                    <div class="instansi-title">
                        <h5>Pemerintah Kota Bandar Lampung</h5>
                        <h2>Dinas Perhubungan</h2>
                        <p>JL. BASUKI RAHMAT NO. 34, SUMUR PUTRI, TLK BETUNG UTARA, KOTA BANDAR LAMPUNG</p>
                        <p>Telp: (0721) XXXXXX | Website: dishub.bandarlampungkota.go.id</p>
                    </div>
                </td>
                <td class="logo-box">
                    <img src="{{ public_path('img/logo-dishub.png') }}" class="logo-img">
                </td>
            </tr>
        </table>
    </div>

    <div class="doc-title">BUKTI HASIL PEMERIKSAAN KENDARAAN BERMOTOR</div>

    <table class="info-table">
        <tr>
            <td class="label">Nomor Uji / Pendaftaran</td>
            <td class="colon">:</td>
            <td><strong>{{ $data->pendaftaran->no_uji ?? $data->pendaftaran->kode_pendaftaran }}</strong></td>
        </tr>
        <tr>
            <td class="label">Nomor Kendaraan (Plat)</td>
            <td class="colon">:</td>
            <td>{{ $data->pendaftaran->kendaraan->no_kendaraan }}</td>
        </tr>
        <tr>
            <td class="label">Nama Pemilik</td>
            <td class="colon">:</td>
            <td>{{ strtoupper($data->pendaftaran->kendaraan->pemilik->nama_lengkap ?? 'DATA TIDAK DITEMUKAN') }}</td>
        </tr>
        <tr>
            <td class="label">Tanggal Pengujian</td>
            <td class="colon">:</td>
            <td>{{ \Carbon\Carbon::parse($data->created_at)->translatedFormat('d F Y') }}</td>
        </tr>
        <tr>
            <td class="label">Masa Berlaku Sampai</td>
            <td class="colon">:</td>
            <td>
                {{-- Masa berlaku otomatis 6 bulan dari tanggal uji --}}
                <strong>{{ \Carbon\Carbon::parse($data->created_at)->addMonths(6)->translatedFormat('d F Y') }}</strong>
            </td>
        </tr>
    </table>

    <div class="result-container">
        <div class="result-box {{ $data->hasil_akhir == 'lulus' ? 'lulus' : 'tidak-lulus' }}">
            DINYATAKAN: {{ strtoupper($data->hasil_akhir) }}
        </div>
    </div>

    <div style="margin-bottom: 5px;"><strong>Catatan / Saran Penguji:</strong></div>
    <div style="border: 1px solid #ddd; padding: 10px; min-height: 30px; background-color: #f9fafb;">
        {{ $data->catatan ?? 'Kendaraan memenuhi persyaratan teknis dan layak jalan.' }}
    </div>

    <div class="footer-table">
        <div class="signature">
            <p>Bandar Lampung, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
            <p>Kepala UPT Pengujian Kendaraan Bermotor<br>Dinas Perhubungan Kota Bandar Lampung,</p>
            <div class="spacer"></div>
            <p><strong>Andy Irawan Koenang, S.H., M.H.</strong></p>
            <p>NIP. 19XXXXXXXXXXXXX</p>
        </div>
    </div>

</body>

</html>