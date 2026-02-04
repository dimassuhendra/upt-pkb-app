<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UPT PKB Kota Bandar Lampung - Layanan Uji KIR</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#3A59D1',
                        secondary: '#2B42A1',
                        accent: '#F0F4FF',
                    }
                }
            }
        }
    </script>
    <style>
        html {
            scroll-behavior: smooth;
        }

        section {
            scroll-margin-top: 5rem;
        }
    </style>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-gray-50 font-sans">

    <nav class="bg-white shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20">
                <div class="flex items-center">
                    <div class="flex-shrink-0 flex items-center gap-3">
                        <img class="h-12 w-auto" src="{{ asset('img/logo-bandarlampung.png') }}"
                            alt="Logo Bandar Lampung">
                        <div>
                            <span class="text-primary text-center font-bold text-xl block leading-none">UPT PKB</span>
                            <span class="text-gray-500 text-xs font-semibold uppercase tracking-widest">Kota Bandar
                                Lampung</span>
                        </div>
                        <img class="h-12 w-auto" src="{{ asset('img/logo-dishub.png') }}"
                            alt="Logo Bandar Lampung">
                    </div>
                </div>
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#" class="text-gray-700 hover:text-primary font-medium">Beranda</a>
                    <a href="#layanan" class="text-gray-700 hover:text-primary font-medium">Keunggulan</a>
                    <a href="#alur" class="text-gray-700 hover:text-primary font-medium">Alur Uji</a>
                </div>
            </div>
        </div>
    </nav>

    <section class="relative bg-white overflow-hidden">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center py-16 px-4 sm:px-6 lg:px-8">
            <div class="md:w-1/2 mb-10 md:mb-0">
                <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 leading-tight mb-6">
                    Layanan Pengujian Kendaraan <span class="text-primary">Terpercaya & Transparan</span>
                </h1>
                <p class="text-lg text-gray-600 mb-8">
                    Pastikan kendaraan Anda layak jalan demi keselamatan bersama. UPT PKB Kota Bandar Lampung kini hadir
                    dengan sistem digital untuk efisiensi waktu Anda.
                </p>
                <div class="mt-8 bg-white p-6 rounded-xl shadow-lg border border-gray-100 max-w-md">
                    <h3 class="text-sm font-bold text-gray-700 mb-4 uppercase tracking-wider">Cek Masa Berlaku Uji KIR
                    </h3>
                    <form action="{{ route('cek.kir') }}" method="POST" class="space-y-4">
                        @csrf
                        <div class="relative">
                            <input type="text" name="no_kendaraan"
                                placeholder="Contoh: B 1234 ABC"
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary focus:border-transparent outline-none uppercase"
                                required>
                        </div>
                        <button type="submit"
                            class="w-full bg-primary text-white py-3 rounded-lg font-bold hover:bg-secondary transition shadow-md">
                            <i class="fas fa-search mr-2"></i> Periksa Sekarang
                        </button>
                    </form>

                    @if(session('error'))
                    <div class="mt-4 p-3 bg-red-100 text-red-700 rounded-lg text-sm">
                        <i class="fas fa-exclamation-circle mr-2"></i> {{ session('error') }}
                    </div>
                    @endif

                    @if(session('hasil'))
                    <div class="mt-6 p-4 bg-blue-50 border-l-4 border-primary rounded-r-lg">
                        <h4 class="font-bold text-primary mb-2 text-sm">Hasil Pencarian:</h4>
                        <div class="grid grid-cols-2 gap-2 text-xs">
                            <p class="text-gray-500">No. Kendaraan:</p>
                            <p class="font-bold uppercase">{{ session('hasil')->no_kendaraan }}</p>

                            <p class="text-gray-500">Merek/Tipe:</p>
                            <p class="font-semibold">{{ session('hasil')->merek }} {{ session('hasil')->tipe }}</p>

                            <p class="text-gray-500">Masa Berlaku KIR:</p>
                            <p class="font-bold text-red-600">
                                {{ \Carbon\Carbon::parse(session('hasil')->masa_berlaku_uji_kir)->translatedFormat('d F Y') }}
                            </p>
                        </div>

                        @php
                        $expired = \Carbon\Carbon::parse(session('hasil')->masa_berlaku_uji_kir);
                        $isExpired = $expired->isPast();
                        @endphp

                        <div class="mt-3 pt-2 border-t border-blue-100">
                            @if($isExpired)
                            <span
                                class="px-2 py-1 bg-red-600 text-white text-[10px] rounded-full uppercase font-bold">Masa
                                Berlaku Habis</span>
                            @else
                            <span
                                class="px-2 py-1 bg-green-600 text-white text-[10px] rounded-full uppercase font-bold">Masih
                                Berlaku</span>
                            @endif
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            <div class="md:w-1/2 flex justify-center">
                <div class="relative w-full max-w-lg">
                    <div
                        class="absolute top-0 -left-4 w-72 h-72 bg-primary opacity-10 rounded-full mix-blend-multiply filter blur-xl">
                    </div>
                    <div
                        class="absolute -bottom-8 right-0 w-72 h-72 bg-blue-300 opacity-10 rounded-full mix-blend-multiply filter blur-xl">
                    </div>
                    <img src="{{ asset('img/login-img.png') }}" alt="Inspection Image"
                        class="relative rounded-2xl shadow-2xl">
                </div>
            </div>
        </div>
    </section>

    <section id="layanan" class="py-20 bg-accent">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-gray-900">Keunggulan Layanan Kami</h2>
                <div class="w-20 h-1 bg-primary mx-auto mt-4"></div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-8 rounded-xl shadow-sm border-b-4 border-primary">
                    <div
                        class="w-14 h-14 bg-blue-100 text-primary flex items-center justify-center rounded-lg mb-6 text-2xl">
                        <i class="fas fa-id-card"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Smart Card (Blue-E)</h3>
                    <p class="text-gray-600">Integrasi data pengujian digital yang lebih aman dan terpusat secara
                        nasional.</p>
                </div>
                <div class="bg-white p-8 rounded-xl shadow-sm border-b-4 border-primary">
                    <div
                        class="w-14 h-14 bg-blue-100 text-primary flex items-center justify-center rounded-lg mb-6 text-2xl">
                        <i class="fas fa-bolt"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Proses Cepat</h3>
                    <p class="text-gray-600">Alur pengujian yang sistematis menjamin efisiensi waktu bagi pemilik
                        kendaraan.</p>
                </div>
                <div class="bg-white p-8 rounded-xl shadow-sm border-b-4 border-primary">
                    <div
                        class="w-14 h-14 bg-blue-100 text-primary flex items-center justify-center rounded-lg mb-6 text-2xl">
                        <i class="fas fa-money-check-alt"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Cashless Payment</h3>
                    <p class="text-gray-600">Mendukung transparansi dengan pembayaran melalui sistem non-tunai / Bank
                        Lampung.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="alur" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-gray-900">Alur Pengujian Kendaraan</h2>
                <p class="text-gray-500 mt-2">Ikuti langkah-langkah berikut untuk menyelesaikan uji KIR Anda</p>
                <div class="w-20 h-1 bg-primary mx-auto mt-4"></div>
            </div>

            <div class="relative">
                <div class="hidden md:block absolute top-1/2 left-0 w-full h-1 bg-blue-100 -translate-y-1/2 z-0"></div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-12 relative z-10">
                    <div class="flex flex-col items-center text-center bg-white p-4">
                        <div
                            class="w-16 h-16 bg-primary text-white rounded-full flex items-center justify-center text-2xl font-bold mb-6 shadow-lg border-4 border-white">
                            1</div>
                        <h4 class="text-xl font-bold mb-2">Pendaftaran</h4>
                        <p class="text-gray-600">Melakukan pendaftaran dan verifikasi berkas di loket **Resepsionis**.
                        </p>
                    </div>

                    <div class="flex flex-col items-center text-center bg-white p-4">
                        <div
                            class="w-16 h-16 bg-primary text-white rounded-full flex items-center justify-center text-2xl font-bold mb-6 shadow-lg border-4 border-white">
                            2</div>
                        <h4 class="text-xl font-bold mb-2">Proses Uji</h4>
                        <p class="text-gray-600">Kendaraan memasuki area pengujian untuk dilakukan pemeriksaan teknis
                            melalui **5 Pos Uji**.</p>
                    </div>

                    <div class="flex flex-col items-center text-center bg-white p-4">
                        <div
                            class="w-16 h-16 bg-primary text-white rounded-full flex items-center justify-center text-2xl font-bold mb-6 shadow-lg border-4 border-white">
                            3</div>
                        <h4 class="text-xl font-bold mb-2">Hasil Uji</h4>
                        <p class="text-gray-600">Menuju **Loket Hasil** untuk pengambilan sertifikat hasil uji (Smart
                            Card) dari petugas.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-gray-900 text-gray-300 py-12">
        <div class="max-w-7xl mx-auto px-4 grid grid-cols-1 md:grid-cols-3 gap-12">
            <div>
                <h4 class="text-white font-bold text-lg mb-6">UPT PKB Kota Bandar Lampung</h4>
                <p class="text-sm leading-relaxed">
                    Instansi resmi di bawah Dinas Perhubungan Kota Bandar Lampung yang melayani pengujian kelaikan
                    kendaraan bermotor wajib uji.
                </p>
            </div>
            <div>
                <h4 class="text-white font-bold text-lg mb-6">Kontak Kami</h4>
                <ul class="space-y-4 text-sm">
                    <li class="flex items-center gap-3"><i class="fas fa-map-marker-alt text-primary"></i> Jl. Terusan
                        Ryacudu, Bandar Lampung</li>
                    <li class="flex items-center gap-3"><i class="fas fa-phone text-primary"></i> (0721) 1234567</li>
                    <li class="flex items-center gap-3"><i class="fas fa-envelope text-primary"></i>
                        pkb@bandarlampungkota.go.id</li>
                </ul>
            </div>
            <div>
                <h4 class="text-white font-bold text-lg mb-6">Jam Operasional</h4>
                <ul class="space-y-2 text-sm">
                    <li class="flex justify-between"><span>Senin - Kamis:</span> <span>08:00 - 15:00</span></li>
                    <li class="flex justify-between"><span>Jumat:</span> <span>08:00 - 11:30</span></li>
                    <li class="flex justify-between border-t border-gray-700 pt-2 font-bold text-red-400"><span>Sabtu -
                            Minggu:</span> <span>Tutup</span></li>
                </ul>
            </div>
        </div>
        <div class="max-w-7xl mx-auto px-4 mt-12 pt-8 border-t border-gray-800 text-center text-xs">
            <p>&copy; {{ date('Y') }} UPT PKB Dinas Perhubungan Kota Bandar Lampung. Seluruh Hak Cipta Dilindungi.</p>
        </div>
    </footer>

</body>

</html>