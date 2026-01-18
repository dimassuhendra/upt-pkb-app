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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-gray-50 font-sans">

    <nav class="bg-white shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20">
                <div class="flex items-center">
                    <div class="flex-shrink-0 flex items-center gap-3">
                        <img class="h-12 w-auto"
                            src="https://upload.wikimedia.org/wikipedia/commons/thumb/d/d1/Logo_Kota_Bandar_Lampung.png/480px-Logo_Kota_Bandar_Lampung.png"
                            alt="Logo Bandar Lampung">
                        <div>
                            <span class="text-primary font-bold text-xl block leading-none">UPT PKB</span>
                            <span class="text-gray-500 text-xs font-semibold uppercase tracking-widest">Kota Bandar
                                Lampung</span>
                        </div>
                    </div>
                </div>
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#" class="text-gray-700 hover:text-primary font-medium">Beranda</a>
                    <a href="#layanan" class="text-gray-700 hover:text-primary font-medium">Layanan</a>
                    <a href="#alur" class="text-gray-700 hover:text-primary font-medium">Alur Uji</a>
                    <a href="#"
                        class="bg-primary text-white px-6 py-2 rounded-full font-semibold hover:bg-secondary transition duration-300">Daftar
                        Online</a>
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
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="#"
                        class="bg-primary text-white text-center px-8 py-4 rounded-lg font-bold shadow-lg hover:bg-secondary transition">
                        <i class="fas fa-calendar-alt mr-2"></i> Booking Jadwal KIR
                    </a>
                    <a href="#"
                        class="border-2 border-primary text-primary text-center px-8 py-4 rounded-lg font-bold hover:bg-accent transition">
                        Cek Masa Berlaku
                    </a>
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
                    <img src="https://images.unsplash.com/photo-1590674852885-8c64507b3050?auto=format&fit=crop&q=80&w=800"
                        alt="Truck Inspection" class="relative rounded-2xl shadow-2xl">
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
                <div class="bg-white p-8 rounded-xl shadow-sm hover:shadow-md transition border-b-4 border-primary">
                    <div
                        class="w-14 h-14 bg-blue-100 text-primary flex items-center justify-center rounded-lg mb-6 text-2xl">
                        <i class="fas fa-id-card"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Smart Card (Blue-E)</h3>
                    <p class="text-gray-600">Integrasi data pengujian digital yang lebih aman dan terpusat secara
                        nasional.</p>
                </div>
                <div class="bg-white p-8 rounded-xl shadow-sm hover:shadow-md transition border-b-4 border-primary">
                    <div
                        class="w-14 h-14 bg-blue-100 text-primary flex items-center justify-center rounded-lg mb-6 text-2xl">
                        <i class="fas fa-bolt"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Proses Cepat</h3>
                    <p class="text-gray-600">Alur pengujian yang sistematis menjamin efisiensi waktu bagi pemilik
                        kendaraan.</p>
                </div>
                <div class="bg-white p-8 rounded-xl shadow-sm hover:shadow-md transition border-b-4 border-primary">
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

    <section class="bg-primary py-16">
        <div class="max-w-5xl mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold text-white mb-6">Siap Melakukan Pengujian?</h2>
            <p class="text-blue-100 text-lg mb-10">Hindari denda dan pastikan keselamatan angkutan Anda di jalan raya.
            </p>
            <a href="#"
                class="bg-white text-primary px-10 py-4 rounded-full font-bold text-lg hover:bg-gray-100 shadow-xl transition">
                Daftar Sekarang Juga
            </a>
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