<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MaGood - Manajemen Gudang Modern</title>
    @vite('resources/css/app.css')
    <script defer src="//unpkg.com/alpinejs"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
</head>

<body class="min-h-screen bg-gradient-to-b from-emerald-100 to-white text-slate-800">

    {{-- NAVBAR --}}
    <header class="sticky top-0 z-30 backdrop-blur bg-white/70 border-b border-white/50">
        <div class="mx-auto max-w-7xl px-4 py-3 flex items-center justify-between">
            <div class="flex items-center gap-2">
                <svg class="h-6 w-6 text-emerald-500" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 7v13h18V7l-9-4-9 4z" />
                </svg>
                <span class="font-semibold text-slate-800">MaGood</span>
            </div>
            <nav class="hidden md:flex items-center gap-6 text-sm">
                <a href="#fitur" class="hover:text-emerald-500 transition-colors">Fitur</a>
                <a href="#demo" class="hover:text-yellow-400 transition-colors">Demo</a>
                <a href="#harga" class="hover:text-yellow-400 transition-colors">Harga</a>
                <a href="#testimoni" class="hover:text-emerald-500 transition-colors">Testimoni</a>
                <a href="#faq" class="hover:text-emerald-500 transition-colors">FAQ</a>
                <a href="#kontak" class="hover:text-yellow-400 transition-colors">Kontak</a>
            </nav>
            <div class="flex items-center gap-2">
                <a href="/login"
                    class="hidden md:inline-flex px-4 py-2 text-sm rounded-lg border border-white/50 hover:bg-white/30">Masuk</a>
                <a href="/register"
                    class="px-4 py-2 text-sm rounded-lg bg-yellow-400 text-slate-900 hover:bg-yellow-500">Coba Gratis 14
                    Hari</a>
            </div>
        </div>
    </header>

    {{-- HERO --}}
    <section
        class="relative overflow-hidden bg-gradient-to-r from-emerald-200 via-white to-emerald-300 text-slate-800">
        <div class="mx-auto max-w-7xl px-4 py-24 grid md:grid-cols-2 gap-10 items-center">
            <div>
                <span
                    class="inline-block px-3 py-1 rounded-full text-sm bg-yellow-400 border border-yellow-300 text-slate-900">Solusi
                    Multi-Gudang</span>
                <h1 class="mt-4 text-4xl md:text-5xl font-bold tracking-tight">Kelola Multi-Gudang Lebih Efisien &
                    Real-Time</h1>
                <p class="mt-4 text-slate-700 leading-relaxed">MaGood membantu bisnis Anda mengendalikan stok,
                    mempercepat distribusi, dan mengurangi kerugian akibat human error. Solusi fleksibel untuk UMKM
                    hingga enterprise.</p>
                <div class="mt-6 flex flex-col sm:flex-row gap-3">
                    <a href="#demo"
                        class="px-5 py-3 rounded-lg bg-emerald-500 text-white hover:bg-emerald-600 shadow">Lihat
                        Demo</a>
                    <a href="#kontak"
                        class="px-5 py-3 rounded-lg bg-yellow-400 text-slate-900 hover:bg-yellow-500 shadow">Konsultasi</a>
                </div>
                <div class="mt-6 flex items-center gap-4 text-xs text-slate-600">
                    <div class="flex items-center gap-1">✅ Terpercaya</div>
                    <div class="flex items-center gap-1">✅ Implementasi ≤ 7 hari</div>
                    <div class="flex items-center gap-1">✅ Dukungan 24/7</div>
                </div>
            </div>
            <div class="rounded-2xl shadow-lg border p-6 bg-white">
                <h3 class="text-lg font-semibold">Ringkasan Stok</h3>
                <div class="mt-4 grid grid-cols-2 gap-3 text-sm">
                    <div class="p-3 rounded-xl bg-emerald-100 border border-emerald-200">
                        <div class="text-slate-500">Total Order</div>
                        <div class="text-xl font-semibold">3.100+</div>
                    </div>
                    <div class="p-3 rounded-xl bg-emerald-100 border border-emerald-200">
                        <div class="text-slate-500">Akurasi Stok</div>
                        <div class="text-xl font-semibold">99.3%</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- FITUR --}}
    <section class="py-16 bg-white" id="fitur">
        <div class="mx-auto max-w-7xl px-4">
            <div class="max-w-2xl mb-10">
                <h2 class="text-3xl font-semibold tracking-tight text-slate-800">Fitur Utama</h2>
                <p class="mt-2 text-slate-700">Semua yang Anda butuhkan untuk kontrol persediaan, pelacakan, dan
                    pertumbuhan bisnis.</p>
            </div>
            <div class="grid md:grid-cols-2 gap-6">
                <div class="p-6 rounded-2xl border shadow-sm bg-emerald-50">
                    <h3 class="font-semibold mb-2">Manajemen Stok</h3>
                    <p class="text-slate-700 text-sm">* Pencatatan stok masuk, keluar.<br>* Pelacakan posisi
                        barang.<br>* Peringatan stok minimum.<br>* Laporan mutasi stok.</p>
                </div>
                <div class="p-6 rounded-2xl border shadow-sm bg-emerald-50">
                    <h3 class="font-semibold mb-2">Inbound / Receiving</h3>
                    <p class="text-slate-700 text-sm">* Penerimaan barang dari supplier.<br>* Verifikasi barang sesuai
                        PO.<br>* Barcode / QR code scanning.</p>
                </div>
                <div class="p-6 rounded-2xl border shadow-sm bg-emerald-50">
                    <h3 class="font-semibold mb-2">Manajemen Transaksi</h3>
                    <p class="text-slate-700 text-sm">* Pengepakan barang sesuai pesanan.<br>* Labeling
                        <br>* Integrasi ekspedisi/logistik.<br>* Laporan pengiriman & tracking.</p>
                </div>
                <div class="p-6 rounded-2xl border shadow-sm bg-emerald-50">
                    <h3 class="font-semibold mb-2">Pelacakan & Audit Trail</h3>
                    <p class="text-slate-700 text-sm">* Data supplier.<br>* Data customer.<br>* Riwayat transaksi.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- IKLAN --}}
    <section class="py-12 bg-gradient-to-r from-emerald-200 via-white to-yellow-200 text-slate-800">
        <div class="mx-auto max-w-6xl px-4">
            <h3 class="text-3xl font-bold text-center mb-8">🚀 Gabung dengan <span class="underline">MaGood</span>
                Sekarang!</h3>
            <div class="swiper promoSwiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide flex justify-center">
                        <img src={{ asset("storage/portfolio/product-1.jpg") }} alt="Promo 1"
                            class="rounded shadow-lg w-full max-h-80 object-cover">
                    </div>
                    <div class="swiper-slide flex justify-center">
                        <img src={{ asset("storage/portfolio/product-2.jpg") }} alt="Promo 2"
                            class="rounded shadow-lg w-full max-h-80 object-cover">
                    </div>
                    <div class="swiper-slide flex justify-center">
                        <img src={{ asset("storage/portfolio/product-3.jpg") }} alt="Promo 3"
                            class="rounded shadow-lg w-full max-h-80 object-cover">
                    </div>
                </div>
                <div class="swiper-pagination mt-4"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>
        </div>
    </section>

    {{-- DEMO --}}
    <section class="py-16 bg-white" id="demo">
        <div class="mx-auto max-w-7xl px-4">
            <h2 class="text-3xl font-semibold text-center mb-10">Demo Dashboard Interaktif</h2>
            <div class="grid md:grid-cols-3 gap-6">
                <div class="p-6 bg-emerald-50 border rounded-2xl shadow hover:shadow-xl transition" data-aos="fade-up">
                    <h3 class="font-semibold text-lg mb-4">Produk Terlaris</h3>
                    <canvas id="salesChart"></canvas>
                </div>
                <div class="p-6 bg-emerald-50 border rounded-2xl shadow hover:shadow-xl transition" data-aos="fade-up"
                    data-aos-delay="150">
                    <h3 class="font-semibold text-lg mb-4">Distribusi Stok</h3>
                    <canvas id="stockPie"></canvas>
                </div>
                <div class="p-6 bg-emerald-50 border rounded-2xl shadow hover:shadow-xl transition" data-aos="fade-up"
                    data-aos-delay="300">
                    <h3 class="font-semibold text-lg mb-4">Stok Habis</h3>
                    <ul class="space-y-2 text-sm text-red-600">
                        <li class="flex items-center"><i class="fas fa-exclamation-circle mr-2"></i>Product 1</li>
                        <li class="flex items-center"><i class="fas fa-exclamation-circle mr-2"></i>Product 2</li>
                        <li class="flex items-center"><i class="fas fa-exclamation-circle mr-2"></i>Product 3</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>




    {{-- cekcekcek --}}
    {{-- INTEGRASI --}}
<section class="py-16 bg-emerald-50">
  <div class="mx-auto max-w-7xl px-4 text-center">
    <h2 class="text-3xl font-semibold mb-10">Integrasi Sistem</h2>
    <p class="text-slate-700 max-w-2xl mx-auto mb-12">
      Terhubung langsung dengan berbagai platform marketplace, logistik, dan sistem akuntansi.
    </p>
    <div class="flex flex-wrap justify-center gap-8">
      <img src="https://upload.wikimedia.org/wikipedia/commons/a/a9/Amazon_logo.svg" alt="Amazon" class="h-12">
      <img src="https://upload.wikimedia.org/wikipedia/commons/a/a5/Instagram_icon.png" alt="Instagram" class="h-12">
      <img src="https://e7.pngegg.com/pngimages/631/197/png-clipart-logo-shopee-indonesia-online-shopping-brand-shopee-platform-text-trademark-thumbnail.png" alt="Shopee" class="h-12">
      <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRDjSk1uCE41PQjtpfy8irjUZBHn-9amsZctg&s" alt="Tokopedia" class="h-12">
      <img src="https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEg8e5_pFxfsjAmyPdNXpI2mj3CLLwwBf0mb9i4xDbIXZDrr_4V9Srci4Wus24yxED-F_QcXfch3Hw0SbrCTqo0DDao4XqWxpogvyEIIzzkAObHmQ3xBw1dntxAUrDySSnv8w8TJyaxThDLK/s1442/logo-lazada.jpg" alt="Lazada" class="h-12">
    </div>
  </div>
</section>

{{-- STUDI KASUS --}}
<section class="py-16 bg-white">
  <div class="mx-auto max-w-7xl px-4">
    <h2 class="text-3xl font-semibold text-center mb-12">Studi Kasus</h2>
    <div class="grid md:grid-cols-3 gap-6">
      <div class="p-6 border rounded-xl bg-emerald-50 shadow-sm">
        <h3 class="font-semibold mb-2">Retail</h3>
        <p class="text-slate-700 text-sm">
          Optimalkan stok di toko fisik & online secara sinkron. Penurunan <b>stock out</b> hingga 30%.
        </p>
      </div>
      <div class="p-6 border rounded-xl bg-emerald-50 shadow-sm">
        <h3 class="font-semibold mb-2">Distribusi</h3>
        <p class="text-slate-700 text-sm">
          Kendalikan distribusi ke banyak cabang. Efisiensi waktu distribusi hingga <b>25%</b>.
        </p>
      </div>
      <div class="p-6 border rounded-xl bg-emerald-50 shadow-sm">
        <h3 class="font-semibold mb-2">E-Commerce</h3>
        <p class="text-slate-700 text-sm">
          Integrasi marketplace otomatis. Tingkatkan kecepatan pemrosesan order hingga <b>2x lipat</b>.
        </p>
      </div>
    </div>
  </div>
</section>

{{-- TESTIMONI --}}
<section class="py-16 bg-emerald-50" id="testimoni">
  <div class="mx-auto max-w-7xl px-4">
    <h2 class="text-3xl font-semibold text-center mb-12">Apa Kata Klien Kami?</h2>
    <div class="grid md:grid-cols-3 gap-6">
      <div class="p-6 bg-white border rounded-xl shadow text-center">
        <p class="italic text-slate-700">"Sistem MaGood membuat manajemen stok kami lebih terkontrol dan hemat waktu."</p>
        <div class="mt-4 font-semibold">– Budi, Owner Toko A</div>
      </div>
      <div class="p-6 bg-white border rounded-xl shadow text-center">
        <p class="italic text-slate-700">"Integrasi marketplace-nya sangat membantu, order langsung tercatat."</p>
        <div class="mt-4 font-semibold">– Sari, Manager Gudang</div>
      </div>
      <div class="p-6 bg-white border rounded-xl shadow text-center">
        <p class="italic text-slate-700">"Laporan analitik real-time membuat keputusan bisnis lebih cepat."</p>
        <div class="mt-4 font-semibold">– Andi, Distribusi</div>
      </div>
    </div>
  </div>
</section>

{{-- FAQ --}}
<section class="py-16 bg-white" id="faq">
  <div class="mx-auto max-w-4xl px-4">
    <h2 class="text-3xl font-semibold text-center mb-10">Pertanyaan Umum (FAQ)</h2>
    <div class="space-y-4">
      <details class="p-4 border rounded-lg bg-emerald-50">
        <summary class="font-semibold cursor-pointer">Apakah bisa digunakan untuk multi-gudang?</summary>
        <p class="mt-2 text-slate-700">Ya, MaGood mendukung multi-gudang dengan visibilitas real-time.</p>
      </details>
      <details class="p-4 border rounded-lg bg-emerald-50">
        <summary class="font-semibold cursor-pointer">Apakah tersedia aplikasi mobile?</summary>
        <p class="mt-2 text-slate-700">Ya, tersedia versi mobile (Android & iOS) untuk akses kapan saja.</p>
      </details>
      <details class="p-4 border rounded-lg bg-emerald-50">
        <summary class="font-semibold cursor-pointer">Apakah bisa integrasi dengan marketplace?</summary>
        <p class="mt-2 text-slate-700">Tentu, kami sudah mendukung integrasi dengan Tokopedia, Shopee, dan Lazada.</p>
      </details>
    </div>
  </div>
</section>

{{-- CTA PENUTUP --}}
<section class="py-20 bg-gradient-to-r from-emerald-400 to-emerald-600 text-white text-center">
  <h2 class="text-4xl font-bold mb-4">Siap Tingkatkan Efisiensi Gudang Anda?</h2>
  <p class="mb-6 text-lg">Mulai gunakan MaGood sekarang juga dan nikmati uji coba gratis 14 hari.</p>
  <a href="/register" class="px-6 py-3 rounded-lg bg-yellow-400 text-slate-900 hover:bg-yellow-500 font-semibold shadow">
    Coba Gratis Sekarang
  </a>
</section>

    

    {{-- CONTACT FORM --}}
    <section class="py-16 bg-white" id="kontak">
        <div class="mx-auto max-w-7xl px-4 text-center">
            <h2 class="text-3xl font-semibold mb-10">Butuh Bantuan?</h2>
            <div class="mx-auto max-w-2xl mb-10 text-left">
                <form class="space-y-6" onsubmit="alert('Pesan terkirim!'); return false;">
                    <div>
                        <label for="name" class="block font-semibold mb-1">Name</label>
                        <input type="text" id="name" placeholder="Nama Anda"
                            class="w-full p-4 border rounded-lg focus:ring-emerald-300 focus:border-emerald-400 transition">
                    </div>
                    <div>
                        <label for="email" class="block font-semibold mb-1">Email</label>
                        <input type="email" id="email" placeholder="Email Anda"
                            class="w-full p-4 border rounded-lg focus:ring-emerald-300 focus:border-emerald-400 transition">
                    </div>
                    <div>
                        <label for="message" class="block font-semibold mb-1">Message</label>
                        <textarea id="message" rows="5" placeholder="Pesan Anda"
                            class="w-full p-4 border rounded-lg focus:ring-emerald-300 focus:border-emerald-400 transition"></textarea>
                    </div>
                    <div class="text-center">
                        <button type="submit"
                            class="px-5 py-3 rounded-lg bg-emerald-500 text-white hover:bg-emerald-600 shadow transition">
                          Kirim
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    {{-- FOOTER --}}
    <footer class="bg-gradient-to-b from-emerald-100 to-white">
        <div class="mx-auto max-w-7xl px-4 py-10 grid md:grid-cols-3 gap-6">
            <div>
                <div class="flex items-center gap-2">
                    <svg class="h-6 w-6 text-emerald-500" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 7v13h18V7l-9-4-9 4z" />
                    </svg>
                    <span class="font-semibold text-slate-800">MaGood</span>
                </div>
                <p class="mt-3 text-sm text-slate-700">MaGood (manajemen gudang) by ositech merupakan platform manajemen
                    gudang modern untuk visibilitas real-time dan pertumbuhan bisnis.</p>
            </div>
            <div class="text-sm">
                <div class="font-semibold mb-2 text-slate-800">Useful Link</div>
                <ul class="space-y-1 text-slate-700">
                    <li><a href="#fitur" class="hover:text-emerald-500 transition-colors">Fitur</a></li>
                    <li><a href="#harga" class="hover:text-yellow-400 transition-colors">Harga</a></li>
                    <li><a href="#demo" class="hover:text-yellow-400 transition-colors">Demo</a></li>
                    <li><a href="#kontak" class="hover:text-yellow-400 transition-colors">Kontak</a></li>
                </ul>
            </div>
            <div class="text-sm">
                <div class="font-semibold mb-2 text-slate-800">Kontak</div>
                <p class="text-slate-700">📧 support@magood.id</p>
                <p class="text-slate-700">📞 +62 812 3456 7890</p>
                <div class="flex gap-3 mt-3">
                    <a href="#" class="text-slate-700 hover:text-emerald-500 transition"><i
                            class="fab fa-facebook"></i></a>
                    <a href="#" class="text-slate-700 hover:text-yellow-400 transition"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="text-slate-700 hover:text-yellow-400 transition"><i
                            class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
        <div class="text-center mt-6 text-sm text-slate-500">© 2025 MaGood - All rights reserved</div>
    </footer>

    <script>
        // Swiper Init
        const swiper = new Swiper(".promoSwiper", {
            loop: true,
            pagination: { el: ".swiper-pagination", clickable: true },
            navigation: { nextEl: ".swiper-button-next", prevEl: ".swiper-button-prev" },
            autoplay: { delay: 3000 },
        });

        // AOS Init
        AOS.init({ duration: 800, once: true });

        // Chart.js
        const salesCtx = document.getElementById('salesChart').getContext('2d');
        const salesChart = new Chart(salesCtx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
                datasets: [{
                    label: 'Produk Terlaris',
                    data: [120, 150, 180, 170, 190, 210],
                    backgroundColor: [
                        '#f87171', '#fbbf24', '#34d399', '#60a5fa', '#f472b6', '#fcd34d'
                    ]
                }]
            },
            options: { responsive: true, plugins: { legend: { display: false } } }
        });

        const stockCtx = document.getElementById('stockPie').getContext('2d');
        const stockPie = new Chart(stockCtx, {
            type: 'pie',
            data: {
                labels: ['Gudang A', 'Gudang B', 'Gudang C'],
                datasets: [{
                    data: [45, 25, 30],
                    backgroundColor: ['#f87171', '#60a5fa', '#34d399']
                }]
            },
            options: { responsive: true, plugins: { legend: { position: 'bottom' } } }
        });
    </script>
</body>

</html>
