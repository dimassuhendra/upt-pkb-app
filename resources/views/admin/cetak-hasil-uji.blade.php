<!DOCTYPE html>
<html>

<head>
    <title>Bukti Lulus Uji Elektronik</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
        }

        .title {
            font-size: 16px;
            font-weight: bold;
            margin-top: 20px;
            text-align: center;
            text-decoration: underline;
        }

        .content-table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        .content-table td {
            padding: 5px;
            vertical-align: top;
        }

        .hasil-box {
            border: 1px solid #000;
            padding: 10px;
            margin-top: 20px;
            text-align: center;
            font-weight: bold;
            font-size: 14px;
        }

        .footer {
            margin-top: 50px;
            float: right;
            width: 250px;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="header">
        <h3>PEMERINTAH KOTA / KABUPATEN ...</h3>
        <h2>DINAS PERHUBUNGAN</h2>
        <p>Unit Pelaksana Teknis Pengujian Kendaraan Bermotor (UPT-PKB)</p>
    </div>

    <div class="title">BUKTI LULUS UJI ELEKTRONIK</div>

    <table class="content-table">
        <tr>
            <td width="30%">Nomor Uji</td>
            <td width="5%">:</td>
            <td>{{ $data->pendaftaran->no_uji }}</td>
        </tr>
        <tr>
            <td>Nomor Kendaraan</td>
            <td>:</td>
            <td>{{ $data->pendaftaran->kendaraan->no_kendaraan }}</td>
        </tr>
        <tr>
            <td>Nama Pemilik</td>
            <td>:</td>
            <td>{{ $data->pendaftaran->nama_pemilik }}</td>
        </tr>
        <tr>
            <td>Jenis Kendaraan</td>
            <td>:</td>
            <td>{{ $data->pendaftaran->kendaraan->jenis_kendaraan }}</td>
        </tr>
    </table>

    <h4 style="margin-top:20px; border-bottom: 1px solid #ccc;">Ringkasan Hasil Uji Teknis:</h4>
    <table class="content-table" style="border: 1px solid #eee;">
        <tr style="background: #f9f9f9;">
            <td><strong>Pemeriksaan</strong></td>
            <td><strong>Hasil/Nilai</strong></td>
        </tr>
        <tr>
            <td>Emisi CO / HC</td>
            <td>{{ $data->emisi_co }}% / {{ $data->emisi_hc }} ppm</td>
        </tr>
        <tr>
            <td>Rem Utama (Efisiensi)</td>
            <td>{{ $data->rem_utama }} kg</td>
        </tr>
        <tr>
            <td>Lampu Utama</td>
            <td>{{ $data->lampu_utama_kanan }} cd</td>
        </tr>
        <tr>
            <td>Side Slip</td>
            <td>{{ $data->side_slip }} mm</td>
        </tr>
    </table>

    <div class="hasil-box">
        DINYATAKAN: {{ strtoupper($data->hasil_akhir) }}<br>
        <small>Berlaku Sampai: {{ \Carbon\Carbon::parse($data->masa_berlaku_sampai)->format('d F Y') }}</small>
    </div>

    <div class="footer">
        Dicetak pada: {{ date('d/m/Y H:i') }}<br><br><br><br>
        <strong>Kepala UPT PKB</strong>
    </div>
</body>

</html>