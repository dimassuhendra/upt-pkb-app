<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Survei Kepuasan UPT PKB</title>
    <link href="https://fonts.googleapis.com/css2?family=Domine:wght@400..700&family=Fredoka:wght@300..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">

    <style>
        .survey-wrapper { min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 20px; background-color: #f4f7f6; }
        .header-accent { background: linear-gradient(135deg, #1e3a8a, #3b82f6); padding: 40px; color: white; text-align: center; border-radius: 15px 15px 0 0; }
        .info-vehicle { background-color: #fff; border: 1px solid #e5e7eb; border-radius: 15px; padding: 15px; margin-bottom: 25px; display: flex; align-items: center; gap: 15px; }
        .icon-circle { background: #eff6ff; width: 50px; height: 50px; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #1e3a8a; font-size: 20px; }
        
        /* Style untuk Rating Bintang Per Pos */
        .pos-rating-item { background: white; padding: 15px; border-radius: 12px; margin-bottom: 15px; border: 1px solid #eee; }
        .pos-label { display: block; font-weight: 700; color: #333; margin-bottom: 8px; font-size: 15px; text-transform: uppercase; }
        
        .rating-stars { display: flex; flex-direction: row-reverse; justify-content: center; gap: 10px; }
        .rating-stars input { display: none; }
        .rating-stars label { cursor: pointer; font-size: 30px; color: #ddd; transition: 0.2s; }
        .rating-stars input:checked ~ label,
        .rating-stars label:hover,
        .rating-stars label:hover ~ label { color: #facc15; }
    </style>
</head>

<body>
    <div class="survey-wrapper">
        <div class="card-custom" style="max-width: 700px; width: 100%; background: white; border-radius: 15px; box-shadow: 0 10px 25px rgba(0,0,0,0.1);">
            <div class="header-accent">
                <i class="fa-solid fa-square-poll-vertical fa-3x mb-3"></i>
                <h1 style="margin: 0; font-size: 24px;">E-SURVEI LAYANAN</h1>
                <p style="margin-top: 5px; opacity: 0.9;">Bantu kami meningkatkan kualitas pengujian kendaraan</p>
            </div>

            <div class="survey-body" style="padding: 30px;">
                @if($antreanSurvei)
                    <div class="info-vehicle">
                        <div class="icon-circle"><i class="fa-solid fa-truck-pickup"></i></div>
                        <div>
                            <span style="font-size: 11px; color: #6b7280; font-weight: bold; display: block;">NOMOR KENDARAAN:</span>
                            <span style="font-size: 20px; font-weight: 700; color: #1e3a8a;">{{ $antreanSurvei->kendaraan->no_kendaraan }}</span>
                        </div>
                    </div>

                    <form action="{{ route('survei.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="pendaftaran_id" value="{{ $antreanSurvei->id }}">

                        @php
                            $listPos = [
                                'administrasi' => 'Bagian Administrasi',
                                'pos_1' => 'Pos 1 (Pra Uji)',
                                'pos_2' => 'Pos 2 (Emisi & Kebisingan)',
                                'pos_3' => 'Pos 3 (Rem & Lampu)',
                                'pos_4' => 'Pos 4 (Bawah Kendaraan)',
                                'pos_5' => 'Pos 5 (Pengesahan)',
                            ];
                        @endphp

                        <p style="font-weight: 600; color: #4b5563; margin-bottom: 15px; border-left: 4px solid #3b82f6; padding-left: 10px;">
                            Berikan nilai untuk setiap loket pelayanan:
                        </p>

                        @foreach($listPos as $key => $label)
                        <div class="pos-rating-item">
                            <span class="pos-label"><i class="fa-solid fa-location-dot mr-2" style="color: #3b82f6;"></i> {{ $label }}</span>
                            <div class="rating-stars">
                                @for($i = 5; $i >= 1; $i--)
                                    <input type="radio" name="ratings[{{ $key }}][skor]" id="{{ $key }}_{{ $i }}" value="{{ $i }}" required>
                                    <label for="{{ $key }}_{{ $i }}">★</label>
                                @endfor
                            </div>
                        </div>
                        @endforeach

                        <div style="margin-top: 25px;">
                            <label style="display:block; margin-bottom: 10px; font-weight: 600; color: #374151;">Saran & Kritik Keseluruhan:</label>
                            <textarea name="komentar" rows="3"
                                style="width:100%; padding:15px; border-radius:12px; border: 1px solid #d1d5db; resize: none;"
                                placeholder="Apa yang perlu kami perbaiki dari seluruh proses pengujian?"></textarea>
                        </div>

                        <button type="submit" class="btn-primary-custom" style="width: 100%; padding: 15px; background: #1e3a8a; color: white; border: none; border-radius: 12px; font-weight: 700; font-size: 16px; cursor: pointer; margin-top: 20px; transition: 0.3s;">
                            KIRIM SEMUA PENILAIAN <i class="fa-solid fa-paper-plane ml-2"></i>
                        </button>
                    </form>
                @else
                    <div style="text-align: center; padding: 40px 0;">
                        <i class="fa-solid fa-circle-check" style="font-size: 80px; color: #10b981; margin-bottom: 20px;"></i>
                        <h2 style="font-family: 'Fredoka', sans-serif; color: #1f2937;">Semua Sudah Dirating</h2>
                        <p style="color: #6b7280;">Terima kasih. Tidak ada kendaraan dalam antrean survei saat ini.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</body>
</html>