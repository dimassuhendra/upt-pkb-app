<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Survei Kepuasan UPT PKB</title>
    <link href="https://fonts.googleapis.com/css2?family=Domine:wght@400..700&family=Fredoka:wght@300..700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">

    <style>
        .survey-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .header-accent {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            padding: 40px;
            color: white;
            text-align: center;
        }

        .info-vehicle {
            background-color: var(--light-color);
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 30px;
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .icon-circle {
            background: white;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary-color);
            font-size: 20px;
        }
    </style>
</head>

<body>

    <div class="survey-wrapper">
        <div class="card-custom" style="max-width: 650px; width: 100%;">
            <div class="header-accent">
                <i class="fa-solid fa-square-poll-vertical fa-3x mb-3"></i>
                <h1>E-SURVEI LAYANAN</h1>
                <p>Bantu kami meningkatkan kualitas pengujian kendaraan</p>
            </div>

            <div class="survey-body" style="padding: 40px;">
                @if($antreanSurvei)
                    <div class="info-vehicle">
                        <div class="icon-circle">
                            <i class="fa-solid fa-truck-pickup"></i>
                        </div>
                        <div>
                            <span style="font-size: 12px; color: #555; font-weight: bold; display: block;">KENDARAAN SAAT
                                INI:</span>
                            <span class="font-header" style="font-size: 22px; color: var(--primary-color);">
                                {{ $antreanSurvei->kendaraan->no_kendaraan }}
                            </span>
                        </div>
                    </div>

                    <form action="{{ route('survei.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="pendaftaran_id" value="{{ $antreanSurvei->id }}">

                        <div style="margin-bottom: 25px;">
                            <label style="display:block; margin-bottom: 10px; font-weight: 600;">
                                <i class="fa-solid fa-user-tie mr-2"></i> Pilih Penguji yang Melayani:
                            </label>
                            <select name="petugas_id"
                                style="width:100%; padding:12px; border-radius:10px; border: 1px solid #DDD;" required>
                                <option value="">-- Pilih Nama Petugas --</option>
                                @foreach($petugas as $p)
                                    <option value="{{ $p->id }}">{{ $p->nama_petugas }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div style="margin-bottom: 25px; text-align: center;">
                            <label style="font-weight: 600; margin-bottom: 15px; display: block;">Tingkat Kepuasan
                                Anda:</label>
                            <div class="rating-group">
                                <input type="radio" name="skor_bintang" id="s5" value="5" required><label for="s5">★</label>
                                <input type="radio" name="skor_bintang" id="s4" value="4"><label for="s4">★</label>
                                <input type="radio" name="skor_bintang" id="s3" value="3"><label for="s3">★</label>
                                <input type="radio" name="skor_bintang" id="s2" value="2"><label for="s2">★</label>
                                <input type="radio" name="skor_bintang" id="s1" value="1"><label for="s1">★</label>
                            </div>
                        </div>

                        <div style="margin-bottom: 30px;">
                            <label style="display:block; margin-bottom: 10px; font-weight: 600;">Saran & Kritik:</label>
                            <textarea name="komentar_saran" rows="3"
                                style="width:100%; padding:12px; border-radius:10px; border: 1px solid #DDD;"
                                placeholder="Apa yang perlu kami perbaiki?"></textarea>
                        </div>

                        <button type="submit" class="btn-primary-custom" style="width: 100%;">
                            KIRIM PENILAIAN <i class="fa-solid fa-paper-plane ml-2"></i>
                        </button>
                    </form>
                @else
                    <div style="text-align: center; padding: 40px 0;">
                        <i class="fa-solid fa-circle-check"
                            style="font-size: 80px; color: var(--accent-color); margin-bottom: 20px;"></i>
                        <h2 class="font-header">Semua Sudah Dirating</h2>
                        <p>Terima kasih. Tidak ada kendaraan dalam antrean survei saat ini.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

</body>

</html>