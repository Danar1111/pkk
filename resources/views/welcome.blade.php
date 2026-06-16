<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Portal LKP Cerdas TP PKK</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- AOS Animation CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <!-- Tailwind CSS (CDN for immediate preview) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                    },
                    colors: {
                        primary: '#1E88E5',
                        secondary: '#FFD600',
                        tertiary: '#121A21',
                        neutral: '#64748B',
                        'primary-light': '#E3F2FD',
                        'primary-dark': '#1565C0',
                    },
                    boxShadow: {
                        'soft': '0 10px 40px -10px rgba(30,136,229,0.15)',
                    }
                }
            }
        }
    </script>
    
    <style>
        /* Custom Utilities */
        .glass-nav {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
        }
    </style>
</head>
<body class="antialiased bg-gray-50 text-tertiary font-sans selection:bg-primary selection:text-white">

    <!-- Navbar -->
    <nav class="fixed w-full z-50 glass-nav border-b border-gray-100 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <div class="flex-shrink-0 flex items-center gap-3">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo PKK" class="h-10 w-10 object-contain drop-shadow-sm" onerror="this.onerror=null; this.src='https://upload.wikimedia.org/wikipedia/commons/4/4e/Lambang_PKK.png'">
                    <span class="font-extrabold text-2xl tracking-tight text-tertiary">LKP PKK</span>
                </div>
                <div class="hidden md:flex space-x-8 items-center">
                    <a href="#" class="text-sm font-semibold text-neutral hover:text-primary transition-colors">Beranda</a>
                    <a href="#tentang" class="text-sm font-semibold text-neutral hover:text-primary transition-colors">Tentang Kami</a>
                    <a href="#program" class="text-sm font-semibold text-neutral hover:text-primary transition-colors">Program Kerja</a>
                    <a href="#tim" class="text-sm font-semibold text-neutral hover:text-primary transition-colors">Susunan Pengurus</a>
                    <a href="#kontak" class="text-sm font-semibold text-neutral hover:text-primary transition-colors">Kontak</a>
                    <a href="{{ url('/lkp/login') }}" class="inline-flex items-center justify-center px-6 py-2.5 rounded-full text-sm font-bold text-white bg-primary hover:bg-primary-dark shadow-soft hover:-translate-y-0.5 transition-all duration-200">
                        Masuk Portal Kader
                    </a>
                </div>
                <!-- Mobile menu button -->
                <div class="md:hidden flex items-center">
                    <a href="{{ url('/lkp/login') }}" class="inline-flex items-center justify-center px-5 py-2 rounded-full text-sm font-bold text-white bg-primary hover:bg-primary-dark shadow-sm">
                        Masuk
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="relative pt-32 pb-20 lg:pt-48 lg:pb-32 overflow-hidden flex items-center min-h-[90vh]">
        <!-- Decorative Background Elements -->
        <div class="absolute top-0 right-0 -z-10 translate-x-1/3 -translate-y-1/4">
            <div class="w-[600px] h-[600px] rounded-full bg-primary-light opacity-70 blur-3xl"></div>
        </div>
        <div class="absolute bottom-0 left-0 -z-10 -translate-x-1/3 translate-y-1/3">
            <div class="w-[500px] h-[500px] rounded-full bg-yellow-50 opacity-70 blur-3xl"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
            <div class="text-center max-w-4xl mx-auto">
                <div data-aos="fade-down" class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-primary-light text-primary font-semibold text-sm mb-6 border border-primary/20">
                    <span class="flex h-2 w-2 rounded-full bg-primary animate-pulse"></span>
                    Sistem Pelaporan Digital 2026
                </div>
                <h1 data-aos="fade-up" data-aos-delay="100" class="text-4xl md:text-5xl lg:text-7xl font-extrabold tracking-tight mb-8 leading-[1.2]">
                    Mewujudkan Keluarga Sehat, <br/>
                    <span class="text-primary relative inline-block mt-2">
                        Cerdas, dan Sejahtera
                        <svg class="absolute w-full h-3 -bottom-1 left-0 text-secondary" viewBox="0 0 100 10" preserveAspectRatio="none"><path d="M0 5 Q 50 10 100 5" stroke="currentColor" stroke-width="4" fill="transparent"/></svg>
                    </span>
                </h1>
                <p data-aos="fade-up" data-aos-delay="200" class="mt-6 text-lg md:text-xl text-neutral leading-relaxed max-w-3xl mx-auto">
                    Tim Penggerak PKK hadir sebagai mitra di tengah masyarakat, berdedikasi memberdayakan keluarga melalui implementasi 10 Program Pokok PKK demi masa depan yang lebih baik.
                </p>
                <div data-aos="fade-up" data-aos-delay="300" class="mt-10 flex flex-col sm:flex-row justify-center gap-4 sm:gap-6">
                    <a href="#program" class="inline-flex justify-center items-center px-8 py-4 text-base md:text-lg font-bold rounded-2xl text-white bg-primary hover:bg-primary-dark shadow-soft hover:shadow-lg hover:-translate-y-1 transition-all duration-300">
                        Pelajari Program Kami
                    </a>
                    <a href="#kontak" class="inline-flex justify-center items-center px-8 py-4 text-base md:text-lg font-bold rounded-2xl text-primary bg-white border-2 border-primary hover:bg-primary-light shadow-sm hover:shadow-md hover:-translate-y-1 transition-all duration-300">
                        Hubungi Kami
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="tentang" class="py-20 bg-white relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-4xl mx-auto" data-aos="zoom-in">
                <h2 class="text-3xl md:text-4xl font-extrabold mb-6">Tentang Gerakan PKK</h2>
                <p class="text-lg text-neutral leading-relaxed">
                    Pemberdayaan Kesejahteraan Keluarga (PKK) adalah gerakan nasional dalam pembangunan masyarakat yang tumbuh dari bawah, yang pengelolaannya dari, oleh, dan untuk masyarakat demi mewujudkan keluarga yang beriman, berakhlak mulia, sehat, sejahtera, maju, dan mandiri.
                </p>
            </div>
        </div>
    </section>

    <!-- Sejarah Section -->
    <section id="sejarah" class="py-20 lg:py-32 bg-white relative border-t border-gray-100 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lg:grid lg:grid-cols-2 gap-16 items-center">
                <div class="order-2 lg:order-1 mt-12 lg:mt-0 relative" data-aos="fade-right">
                    <div class="absolute inset-0 bg-secondary rounded-3xl translate-x-4 translate-y-4 -z-10"></div>
                    <img src="https://images.unsplash.com/photo-1573164713988-8665fc963095?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Sejarah PKK" class="rounded-3xl shadow-xl w-full object-cover h-[400px]">
                </div>
                <div class="order-1 lg:order-2" data-aos="fade-left">
                    <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-yellow-50 text-secondary font-bold text-sm mb-6 border border-yellow-100">
                        Sejarah Kami
                    </div>
                    <h2 class="text-3xl md:text-4xl font-extrabold mb-6">Jejak Langkah Pengabdian</h2>
                    <p class="text-lg text-neutral leading-relaxed mb-6">
                        Gerakan PKK pada awalnya berawal dari Kepanitiaan Pendidikan Kesejahteraan Keluarga yang didirikan untuk menanggulangi masalah gizi dan kesehatan di masyarakat. Seiring berjalannya waktu, PKK bertransformasi menjadi pilar kekuatan sosial yang masif.
                    </p>
                    <p class="text-lg text-neutral leading-relaxed mb-8">
                        Kini, TP PKK tidak hanya berfokus pada kesehatan, namun telah merambah hingga pendidikan, pembinaan karakter, pelestarian lingkungan, dan ekonomi kreatif melalui UP2K. Kami bangga telah menjadi mitra strategis pemerintah dan sahabat terdekat masyarakat.
                    </p>
                    <a href="#program" class="inline-flex items-center font-bold text-primary hover:text-primary-dark transition-colors group">
                        Lihat Peran Kami Saat Ini 
                        <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Program Kerja & Pokja -->
    <section id="program" class="py-20 bg-gray-50 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16" data-aos="fade-up">
                <h2 class="text-3xl md:text-4xl font-extrabold mb-4">Program Kerja & Susunan Pokja</h2>
                <p class="text-lg text-neutral">Pengelompokan tugas untuk implementasi 10 Program Pokok PKK secara terstruktur dan terukur.</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Pokja I -->
                <div data-aos="fade-up" class="bg-white rounded-2xl p-8 shadow-lg border border-gray-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                    <div class="w-14 h-14 rounded-2xl bg-blue-50 text-primary flex items-center justify-center mb-6">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    </div>
                    <h3 class="text-2xl font-bold text-tertiary mb-3">Pokja I <span class="text-lg font-semibold text-neutral block mt-1">(Pembinaan Karakter Keluarga)</span></h3>
                    <p class="text-neutral leading-relaxed mb-8">Mengelola program Penghayatan dan Pengamalan Pancasila serta Gotong Royong untuk membangun mental spiritual dan kepedulian sosial masyarakat.</p>
                    <div class="bg-gray-50 rounded-xl p-5 border border-gray-100">
                        <h4 class="font-bold text-sm text-tertiary uppercase tracking-wider mb-4">Susunan Anggota</h4>
                        <ul class="space-y-3">
                            <li class="flex items-center gap-3"><div class="w-8 h-8 rounded-full bg-primary text-white flex items-center justify-center text-xs font-bold">K</div><span class="font-semibold text-tertiary">Ny. Budi Lestari</span> <span class="text-sm text-neutral">(Ketua)</span></li>
                            <li class="flex items-center gap-3"><div class="w-8 h-8 rounded-full bg-white border border-gray-200 text-tertiary flex items-center justify-center text-xs font-bold">S</div><span class="font-medium text-tertiary">Ny. Ahmad</span> <span class="text-sm text-neutral">(Sekretaris)</span></li>
                            <li class="flex items-center gap-3"><div class="w-8 h-8 rounded-full bg-white border border-gray-200 text-tertiary flex items-center justify-center text-xs font-bold">A</div><span class="font-medium text-tertiary">Ny. Joko</span> <span class="text-sm text-neutral">(Anggota)</span></li>
                        </ul>
                    </div>
                </div>
                
                <!-- Pokja II -->
                <div data-aos="fade-up" class="bg-white rounded-2xl p-8 shadow-lg border border-gray-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                    <div class="w-14 h-14 rounded-2xl bg-yellow-50 text-secondary flex items-center justify-center mb-6">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                    </div>
                    <h3 class="text-2xl font-bold text-tertiary mb-3">Pokja II <span class="text-lg font-semibold text-neutral block mt-1">(Pendidikan & Peningkatan Ekonomi)</span></h3>
                    <p class="text-neutral leading-relaxed mb-8">Fokus pada program Pendidikan dan Keterampilan, serta Pengembangan Kehidupan Berkoperasi melalui program UP2K untuk meningkatkan ekonomi keluarga.</p>
                    <div class="bg-gray-50 rounded-xl p-5 border border-gray-100">
                        <h4 class="font-bold text-sm text-tertiary uppercase tracking-wider mb-4">Susunan Anggota</h4>
                        <ul class="space-y-3">
                            <li class="flex items-center gap-3"><div class="w-8 h-8 rounded-full bg-secondary text-tertiary flex items-center justify-center text-xs font-bold">K</div><span class="font-semibold text-tertiary">Ny. Dewi Sartika</span> <span class="text-sm text-neutral">(Ketua)</span></li>
                            <li class="flex items-center gap-3"><div class="w-8 h-8 rounded-full bg-white border border-gray-200 text-tertiary flex items-center justify-center text-xs font-bold">S</div><span class="font-medium text-tertiary">Ny. Hendra</span> <span class="text-sm text-neutral">(Sekretaris)</span></li>
                            <li class="flex items-center gap-3"><div class="w-8 h-8 rounded-full bg-white border border-gray-200 text-tertiary flex items-center justify-center text-xs font-bold">A</div><span class="font-medium text-tertiary">Ny. Anton</span> <span class="text-sm text-neutral">(Anggota)</span></li>
                        </ul>
                    </div>
                </div>
                
                <!-- Pokja III -->
                <div data-aos="fade-up" class="bg-white rounded-2xl p-8 shadow-lg border border-gray-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                    <div class="w-14 h-14 rounded-2xl bg-green-50 text-green-600 flex items-center justify-center mb-6">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    </div>
                    <h3 class="text-2xl font-bold text-tertiary mb-3">Pokja III <span class="text-lg font-semibold text-neutral block mt-1">(Penguatan Ketahanan Keluarga)</span></h3>
                    <p class="text-neutral leading-relaxed mb-8">Mengelola program Pangan, Sandang, serta Perumahan dan Tata Laksana Rumah Tangga demi mewujudkan pemenuhan kebutuhan dasar keluarga yang layak.</p>
                    <div class="bg-gray-50 rounded-xl p-5 border border-gray-100">
                        <h4 class="font-bold text-sm text-tertiary uppercase tracking-wider mb-4">Susunan Anggota</h4>
                        <ul class="space-y-3">
                            <li class="flex items-center gap-3"><div class="w-8 h-8 rounded-full bg-green-600 text-white flex items-center justify-center text-xs font-bold">K</div><span class="font-semibold text-tertiary">Ny. Rina Mulyani</span> <span class="text-sm text-neutral">(Ketua)</span></li>
                            <li class="flex items-center gap-3"><div class="w-8 h-8 rounded-full bg-white border border-gray-200 text-tertiary flex items-center justify-center text-xs font-bold">S</div><span class="font-medium text-tertiary">Ny. Wahyu</span> <span class="text-sm text-neutral">(Sekretaris)</span></li>
                            <li class="flex items-center gap-3"><div class="w-8 h-8 rounded-full bg-white border border-gray-200 text-tertiary flex items-center justify-center text-xs font-bold">A</div><span class="font-medium text-tertiary">Ny. Ilham</span> <span class="text-sm text-neutral">(Anggota)</span></li>
                        </ul>
                    </div>
                </div>
                
                <!-- Pokja IV -->
                <div data-aos="fade-up" class="bg-white rounded-2xl p-8 shadow-lg border border-gray-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                    <div class="w-14 h-14 rounded-2xl bg-red-50 text-red-500 flex items-center justify-center mb-6">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                    </div>
                    <h3 class="text-2xl font-bold text-tertiary mb-3">Pokja IV <span class="text-lg font-semibold text-neutral block mt-1">(Kesehatan Keluarga & Lingkungan)</span></h3>
                    <p class="text-neutral leading-relaxed mb-8">Mengelola program Kesehatan, Kelestarian Lingkungan Hidup, dan Perencanaan Sehat, termasuk pendampingan Posyandu dan penyuluhan kesehatan.</p>
                    <div class="bg-gray-50 rounded-xl p-5 border border-gray-100">
                        <h4 class="font-bold text-sm text-tertiary uppercase tracking-wider mb-4">Susunan Anggota</h4>
                        <ul class="space-y-3">
                            <li class="flex items-center gap-3"><div class="w-8 h-8 rounded-full bg-red-500 text-white flex items-center justify-center text-xs font-bold">K</div><span class="font-semibold text-tertiary">Ny. dr. Fitriani</span> <span class="text-sm text-neutral">(Ketua)</span></li>
                            <li class="flex items-center gap-3"><div class="w-8 h-8 rounded-full bg-white border border-gray-200 text-tertiary flex items-center justify-center text-xs font-bold">S</div><span class="font-medium text-tertiary">Ny. Rizal</span> <span class="text-sm text-neutral">(Sekretaris)</span></li>
                            <li class="flex items-center gap-3"><div class="w-8 h-8 rounded-full bg-white border border-gray-200 text-tertiary flex items-center justify-center text-xs font-bold">A</div><span class="font-medium text-tertiary">Ny. Arif</span> <span class="text-sm text-neutral">(Anggota)</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section id="tim" class="py-20 lg:py-32 bg-gray-50 border-y border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-3xl md:text-4xl font-extrabold mb-4">Susunan Kepengurusan Inti</h2>
                <p class="text-lg text-neutral">Penggerak utama di balik optimalisasi program kesejahteraan keluarga.</p>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 justify-center">
                <!-- Member 1 -->
                <div data-aos="zoom-in" class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100 text-center hover:shadow-soft hover:-translate-y-1 transition-all duration-300">
                    <div class="w-24 h-24 mx-auto bg-primary-light rounded-full flex items-center justify-center text-primary text-3xl font-bold mb-6 border-4 border-white shadow-md">
                        RN
                    </div>
                    <h3 class="text-xl font-bold text-tertiary mb-1">Ny. Hj. Ratna Ningsih</h3>
                    <p class="text-sm font-semibold text-primary">Ketua TP PKK</p>
                </div>
                <!-- Member 2 -->
                <div data-aos="zoom-in" class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100 text-center hover:shadow-soft hover:-translate-y-1 transition-all duration-300">
                    <div class="w-24 h-24 mx-auto bg-primary-light rounded-full flex items-center justify-center text-primary text-3xl font-bold mb-6 border-4 border-white shadow-md">
                        SA
                    </div>
                    <h3 class="text-xl font-bold text-tertiary mb-1">Ny. Siti Aminah</h3>
                    <p class="text-sm font-semibold text-primary">Sekretaris Umum</p>
                </div>
                <!-- Member 3 -->
                <div data-aos="zoom-in" class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100 text-center hover:shadow-soft hover:-translate-y-1 transition-all duration-300">
                    <div class="w-24 h-24 mx-auto bg-primary-light rounded-full flex items-center justify-center text-primary text-3xl font-bold mb-6 border-4 border-white shadow-md">
                        NH
                    </div>
                    <h3 class="text-xl font-bold text-tertiary mb-1">Ny. Nurul Hidayah</h3>
                    <p class="text-sm font-semibold text-primary">Bendahara</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="kontak" class="py-20 lg:py-32 bg-white overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lg:grid lg:grid-cols-2 gap-16 items-start">
                <div data-aos="fade-right">
                    <h2 class="text-3xl md:text-4xl font-extrabold mb-6">Hubungi Sekretariat</h2>
                    <p class="text-lg text-neutral mb-10 leading-relaxed">Punya pertanyaan seputar pelaporan LKP atau program PKK? Silakan hubungi kami melalui form di samping atau melalui kontak di bawah ini.</p>
                    
                    <div class="space-y-6">
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-full bg-primary-light flex items-center justify-center text-primary flex-shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-lg">Alamat</h4>
                                <p class="text-neutral mt-1 leading-relaxed">Gedung Serbaguna TP PKK,<br/>Jl. Merdeka No. 10, Kecamatan Sukamaju,<br/>Kabupaten/Kota Anda.</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 rounded-full bg-primary-light flex items-center justify-center text-primary flex-shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-lg">Email</h4>
                                <p class="text-neutral mt-1">sekretariat@lkp-pkk.desa.id</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 rounded-full bg-primary-light flex items-center justify-center text-primary flex-shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-lg">WhatsApp</h4>
                                <p class="text-neutral mt-1">+62 812-3456-7890 <span class="block text-sm opacity-80">(Jam Kerja: 08.00 - 15.00 WIB)</span></p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="mt-12 lg:mt-0 bg-white p-8 rounded-3xl shadow-soft border border-gray-100" data-aos="fade-left">
                    <form action="#" method="POST" class="space-y-6">
                        <div>
                            <label for="name" class="block text-sm font-bold text-gray-700 mb-2">Nama Lengkap</label>
                            <input type="text" id="name" name="name" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary focus:border-primary transition-all outline-none" placeholder="Masukkan nama Anda">
                        </div>
                        <div>
                            <label for="instansi" class="block text-sm font-bold text-gray-700 mb-2">Asal Instansi/Pokja</label>
                            <input type="text" id="instansi" name="instansi" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary focus:border-primary transition-all outline-none" placeholder="Contoh: Pokja II / Desa X">
                        </div>
                        <div>
                            <label for="message" class="block text-sm font-bold text-gray-700 mb-2">Pesan Anda</label>
                            <textarea id="message" name="message" rows="4" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary focus:border-primary transition-all outline-none resize-none" placeholder="Tuliskan pesan atau pertanyaan Anda di sini..."></textarea>
                        </div>
                        <button type="button" class="w-full py-4 px-6 rounded-xl text-white bg-primary hover:bg-primary-dark font-bold text-lg shadow-md hover:shadow-lg transition-all hover:-translate-y-0.5">
                            Kirim Pesan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-tertiary pt-16 pb-8 border-t border-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-6">
                <div class="flex items-center gap-3">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo PKK" class="h-8 w-8 object-contain brightness-0 invert opacity-90" onerror="this.src='https://upload.wikimedia.org/wikipedia/commons/4/4e/Lambang_PKK.png'">
                    <span class="font-bold text-xl text-white tracking-tight">LKP PKK</span>
                </div>
                <div class="flex space-x-6 text-sm text-gray-400 font-medium">
                    <a href="#" class="hover:text-white transition-colors">Kebijakan Privasi</a>
                    <a href="#" class="hover:text-white transition-colors">Syarat Ketentuan</a>
                    <a href="#" class="hover:text-white transition-colors">Bantuan</a>
                </div>
            </div>
            <div class="border-t border-gray-800 pt-8 text-center text-sm text-gray-500">
                &copy; {{ date('Y') }} Sistem Pelaporan LKP TP PKK. Hak Cipta Dilindungi.
            </div>
        </div>
    </footer>

    <!-- AOS Animation Script -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            once: true,
            offset: 50,
            duration: 800,
        });
    </script>
</body>
</html>
