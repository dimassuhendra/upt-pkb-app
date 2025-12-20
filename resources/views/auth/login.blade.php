<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk Akun - UPT PKB</title>
    <link href="https://fonts.googleapis.com/css2?family=Domine:wght@400..700&family=Fredoka:wght@300..700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{  asset('css/auth.css') }}">
</head>

<body>

    <div class="login-wrapper">
        <div class="login-container">

            <div class="login-side-illustration">
                <img src="{{ asset('img/login-img.png') }}" alt="Ilustrasi Login">

                <h2 class="font-header" style="color: white; font-size: 32px; margin-bottom: 15px;">Sistem PKB Digital
                </h2>
                <p style="opacity: 0.9; max-width: 300px; margin: 0 auto;">
                    Kelola data pengujian kendaraan dan pantau kepuasan layanan dalam satu platform terintegrasi.
                </p>
            </div>

            <div class="login-side-form">
                <div style="margin-bottom: 40px;">
                    <h2 class="font-header">Selamat Datang</h2>
                    <p>Silakan masuk menggunakan akun admin Anda.</p>
                </div>

                <form action="{{ route('login') }}" method="POST">
                    @csrf

                    @if($errors->any())
                        <div
                            style="background: #fee2e2; color: #dc2626; padding: 12px; border-radius: 8px; margin-bottom: 20px; font-size: 13px;">
                            <i class="fa-solid fa-circle-exclamation mr-2"></i> {{ $errors->first() }}
                        </div>
                    @endif

                    @if(session('info'))
                        <div
                            style="background: #e0f2fe; color: #0369a1; padding: 12px; border-radius: 8px; margin-bottom: 20px; font-size: 13px;">
                            <i class="fa-solid fa-info-circle mr-2"></i> {{ session('info') }}
                        </div>
                    @endif

                    <div class="input-group-custom">
                        <i class="fa-solid fa-user"></i>
                        <input type="text" name="username" placeholder="Username / Email" required autofocus>
                    </div>

                    <div class="input-group-custom">
                        <i class="fa-solid fa-lock"></i>
                        <input type="password" name="password" placeholder="Kata Sandi" required>
                    </div>

                    <div
                        style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
                        <label style="font-size: 13px; display: flex; align-items: center; cursor: pointer;">
                            <input type="checkbox" name="remember" style="width: auto; margin-right: 8px;"> Ingat Saya
                        </label>
                        <a href="#" style="font-size: 13px; color: var(--primary-color); text-decoration: none;">Lupa
                            Sandi?</a>
                    </div>

                    <button type="submit" class="btn-primary-custom"
                        style="width: 100%; padding: 18px; font-size: 16px;">
                        MASUK KE DASHBOARD <i class="fa-solid fa-arrow-right-to-bracket ml-2"></i>
                    </button>
                </form>

                <div class="login-footer">
                    &copy; {{ date('Y') }} UPT Pengujian Kendaraan Bermotor. <br>
                    Seluruh Hak Cipta Dilindungi.
                </div>
            </div>

        </div>
    </div>

</body>

</html>