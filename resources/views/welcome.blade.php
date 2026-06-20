@php
    $galleryDir = public_path('images/gallery');
    $images = [];
    if (file_exists($galleryDir)) {
        $files = scandir($galleryDir);
        foreach ($files as $file) {
            if (in_array(strtolower(pathinfo($file, PATHINFO_EXTENSION)), ['jpg', 'jpeg', 'png', 'webp', 'gif'])) {
                $images[] = asset('images/gallery/' . $file);
            }
        }
    }
    // Fallback/dummy images if folder is empty or doesn't exist
    if (empty($images)) {
        $images = [
            'https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&h=675&q=80',
            'https://images.unsplash.com/photo-1522071820081-009f0129c71c?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&h=675&q=80',
            'https://images.unsplash.com/photo-1531538606174-0f90ff5dce83?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&h=675&q=80',
        ];
    }
    // Extend images array to ensure seamless marquee scrolling
    $extendedImages = $images;
    while (count($extendedImages) < 10) {
        $extendedImages = array_merge($extendedImages, $images);
    }
@endphp
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
    
    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
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
        @keyframes marquee {
            0% {
                transform: translateX(0);
            }
            100% {
                transform: translateX(-50%);
            }
        }
        .animate-marquee-track {
            display: flex;
            width: max-content;
            animation: marquee 60s linear infinite;
            gap: 1.5rem;
        }
        .animate-marquee-track:hover {
            animation-play-state: paused;
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
                <div class="hidden md:flex gap-6 items-center">
                    <a href="#" class="text-sm font-semibold text-neutral hover:text-primary transition-colors">Beranda</a>
                    <a href="#galeri" class="text-sm font-semibold text-neutral hover:text-primary transition-colors">Galeri</a>
                    <a href="#tentang" class="text-sm font-semibold text-neutral hover:text-primary transition-colors">Tentang Kami</a>
                    <a href="#visi-misi" class="text-sm font-semibold text-neutral hover:text-primary transition-colors">Visi & Misi</a>
                    <a href="#tim" class="text-sm font-semibold text-neutral hover:text-primary transition-colors">Susunan Pengurus</a>
                    <a href="#program" class="text-sm font-semibold text-neutral hover:text-primary transition-colors">Program Kerja</a>
                    <a href="#footer-kontak" class="text-sm font-semibold text-neutral hover:text-primary transition-colors">Kontak</a>
                    <a href="https://www.instagram.com/pkksumedang?igsh=dHVoa3kyMHRj" target="_blank" rel="noopener noreferrer" class="text-sm font-semibold text-neutral hover:text-primary transition-colors">Instagram</a>
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
    <section class="relative pt-24 pb-20 lg:pt-36 lg:pb-32 overflow-hidden flex items-center min-h-[90vh]">
        <!-- Decorative Background Elements -->
        <div class="absolute top-0 right-0 -z-10 translate-x-1/3 -translate-y-1/4">
            <div class="w-[600px] h-[600px] rounded-full bg-primary-light opacity-70 blur-3xl"></div>
        </div>
        <div class="absolute bottom-0 left-0 -z-10 -translate-x-1/3 translate-y-1/3">
            <div class="w-[500px] h-[500px] rounded-full bg-yellow-50 opacity-70 blur-3xl"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
            <div class="text-center max-w-4xl mx-auto flex flex-col items-center">
                <!-- Logo PKK -->
                <div data-aos="fade-down" class="mb-4">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo PKK" class="h-36 w-36 md:h-44 md:w-44 object-contain drop-shadow-md mx-auto" onerror="this.onerror=null; this.src='https://upload.wikimedia.org/wikipedia/commons/4/4e/Lambang_PKK.png'">
                </div>
                
                <!-- TP PKK KABUPATEN SUMEDANG -->
                <h2 data-aos="fade-down" data-aos-delay="100" class="text-xl md:text-2xl font-extrabold tracking-wider text-primary uppercase mb-4">
                    TP PKK KABUPATEN SUMEDANG
                </h2>

                <!-- Pill -->
                <div data-aos="fade-down" data-aos-delay="150" class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-primary-light text-primary font-semibold text-sm mb-8 border border-primary/20">
                    <span class="flex h-2 w-2 rounded-full bg-primary animate-pulse"></span>
                    Sistem Pelaporan Digital 2026
                </div>

                <h1 data-aos="fade-up" data-aos-delay="200" class="text-4xl md:text-5xl lg:text-7xl font-extrabold tracking-tight mb-8 leading-[1.2]">
                    Mewujudkan Keluarga Sehat, <br/>
                    <span class="text-primary relative inline-block mt-2">
                        Cerdas, dan Sejahtera
                        <svg class="absolute w-full h-3 -bottom-1 left-0 text-secondary" viewBox="0 0 100 10" preserveAspectRatio="none"><path d="M0 5 Q 50 10 100 5" stroke="currentColor" stroke-width="4" fill="transparent"/></svg>
                    </span>
                </h1>
                <p data-aos="fade-up" data-aos-delay="250" class="mt-6 text-lg md:text-xl text-neutral leading-relaxed max-w-3xl mx-auto">
                    Tim Penggerak PKK hadir sebagai mitra di tengah masyarakat, berdedikasi memberdayakan keluarga melalui implementasi 10 Program Pokok PKK demi masa depan yang lebih baik.
                </p>
                <div data-aos="fade-up" data-aos-delay="300" class="mt-10 flex flex-col sm:flex-row justify-center gap-4 sm:gap-6">
                    <a href="#program" class="inline-flex justify-center items-center px-8 py-4 text-base md:text-lg font-bold rounded-2xl text-white bg-primary hover:bg-primary-dark shadow-soft hover:shadow-lg hover:-translate-y-1 transition-all duration-300">
                        Pelajari Program Kami
                    </a>
                    <a href="#footer-kontak" class="inline-flex justify-center items-center px-8 py-4 text-base md:text-lg font-bold rounded-2xl text-primary bg-white border-2 border-primary hover:bg-primary-light shadow-sm hover:shadow-md hover:-translate-y-1 transition-all duration-300">
                        Hubungi Kami
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Gallery Section -->
    <section id="galeri" class="py-20 bg-white relative border-b border-gray-100 overflow-hidden" data-aos="fade-up"
             x-data="{ 
                isOpen: false, 
                activeImage: '', 
                imagesList: {{ json_encode($extendedImages) }},
                currentIndex: 0,
                openLightbox(url, index) {
                    this.activeImage = url;
                    this.currentIndex = index;
                    this.isOpen = true;
                },
                closeLightbox() {
                    this.isOpen = false;
                },
                next() {
                    this.currentIndex = (this.currentIndex + 1) % this.imagesList.length;
                    this.activeImage = this.imagesList[this.currentIndex];
                },
                prev() {
                    this.currentIndex = (this.currentIndex - 1 + this.imagesList.length) % this.imagesList.length;
                    this.activeImage = this.imagesList[this.currentIndex];
                }
             }"
             @keydown.escape.window="closeLightbox()"
             @keydown.arrow-right.window="if (isOpen) next()"
             @keydown.arrow-left.window="if (isOpen) prev()">
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-12">
            <div class="text-center max-w-3xl mx-auto">
                <h2 class="text-3xl md:text-4xl font-extrabold mb-4">Galeri Kegiatan</h2>
                <p class="text-lg text-neutral">Dokumentasi momen gotong royong, posyandu, dan kebersamaan seluruh kader TP PKK Sumedang.</p>
            </div>
        </div>

        <!-- Infinite Scrolling Marquee Track -->
        <div class="relative w-full overflow-hidden py-4">
            <!-- Fade overlays on the left and right sides for a premium soft edge -->
            <div class="absolute inset-y-0 left-0 w-16 md:w-32 bg-gradient-to-r from-white to-transparent z-10 pointer-events-none"></div>
            <div class="absolute inset-y-0 right-0 w-16 md:w-32 bg-gradient-to-l from-white to-transparent z-10 pointer-events-none"></div>

            <div class="animate-marquee-track">
                <!-- Group 1 -->
                <div class="flex gap-6 shrink-0">
                    @foreach($extendedImages as $img)
                        <div @click="openLightbox('{{ $img }}', {{ $loop->index }})" class="w-[300px] md:w-[400px] aspect-[16/9] rounded-2xl overflow-hidden shadow-md hover:shadow-xl hover:scale-[1.02] transition-all duration-300 cursor-pointer">
                            <img src="{{ $img }}" alt="Galeri PKK" class="w-full h-full object-cover">
                        </div>
                    @endforeach
                </div>
                <!-- Group 2 (Duplicate for seamless scroll) -->
                <div class="flex gap-6 shrink-0" aria-hidden="true">
                    @foreach($extendedImages as $img)
                        <div @click="openLightbox('{{ $img }}', {{ $loop->index }})" class="w-[300px] md:w-[400px] aspect-[16/9] rounded-2xl overflow-hidden shadow-md hover:shadow-xl hover:scale-[1.02] transition-all duration-300 cursor-pointer">
                            <img src="{{ $img }}" alt="Galeri PKK" class="w-full h-full object-cover">
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Lightbox Modal -->
        <template x-teleport="body">
            <div x-show="isOpen" 
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="fixed inset-0 z-[100] flex items-center justify-center bg-black/90 p-4 backdrop-blur-sm"
                 style="display: none;">
                
                <!-- Close Button -->
                <button @click="closeLightbox()" class="absolute top-6 right-6 text-white/80 hover:text-white transition-colors duration-200 p-2 focus:outline-none z-[110]">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>

                <!-- Prev Arrow -->
                <button @click="prev()" class="absolute left-6 top-1/2 -translate-y-1/2 w-14 h-14 rounded-full bg-white/10 hover:bg-white/20 text-white flex items-center justify-center transition-all duration-200 focus:outline-none z-[110]">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"></path></svg>
                </button>

                <!-- Next Arrow -->
                <button @click="next()" class="absolute right-6 top-1/2 -translate-y-1/2 w-14 h-14 rounded-full bg-white/10 hover:bg-white/20 text-white flex items-center justify-center transition-all duration-200 focus:outline-none z-[110]">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path></svg>
                </button>

                <!-- Image Container -->
                <div class="relative max-w-5xl max-h-[85vh] overflow-hidden rounded-2xl shadow-2xl flex items-center justify-center" @click.away="closeLightbox()">
                    <img :src="activeImage" alt="Foto Galeri Detail" class="max-w-full max-h-[85vh] object-contain rounded-2xl">
                </div>
            </div>
        </template>
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

    <!-- Visi Misi Section -->
    <section id="visi-misi" class="py-20 lg:py-32 bg-gradient-to-br from-primary-light/30 via-white to-yellow-50/20 relative border-t border-b border-gray-100 overflow-hidden">
        <!-- Decorative blob background -->
        <div class="absolute top-1/2 left-0 -translate-y-1/2 -z-10 translate-x-[-20%]">
            <div class="w-[400px] h-[400px] rounded-full bg-primary-light opacity-40 blur-3xl"></div>
        </div>
        <div class="absolute bottom-0 right-0 -z-10 translate-x-[20%] translate-y-[20%]">
            <div class="w-[350px] h-[350px] rounded-full bg-yellow-50 opacity-40 blur-3xl"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
            <div class="lg:grid lg:grid-cols-12 gap-12 lg:gap-16 items-start">
                
                <!-- Left: Visi Card (Span 5) -->
                <div class="lg:col-span-5 mb-12 lg:mb-0" data-aos="fade-right">
                    <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-primary-light text-primary font-bold text-sm mb-6 border border-primary/20">
                        Visi Gerakan PKK
                    </div>
                    <div class="text-white rounded-3xl p-8 lg:p-10 shadow-soft hover:shadow-xl transition-all duration-300 relative overflow-hidden group" style="background: linear-gradient(135deg, #1E88E5 0%, #1565C0 100%)">
                        <!-- Decorative quote mark background -->
                        <div class="absolute -right-4 -bottom-10 text-white/10 text-[180px] font-serif select-none pointer-events-none transition-transform duration-500 group-hover:scale-110">
                            ”
                        </div>
                        
                        <div class="relative z-10">
                            <!-- Quote Icon -->
                            <div class="w-12 h-12 rounded-2xl bg-white/20 flex items-center justify-center mb-6">
                                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M9.9 19c0-1.8 1-3.3 2.7-4.2V11c-2.3.9-3.7 2.8-3.7 5.2V19h1v-4.2c1.7.9 2.7 2.4 2.7 4.2H9.9zm-6 0c0-1.8 1-3.3 2.7-4.2V11c-2.3.9-3.7 2.8-3.7 5.2V19h1v-4.2C5.6 15.7 6.6 17.2 6.6 19H3.9z"/></svg>
                            </div>
                            
                            <h3 class="text-2xl font-bold mb-4">Visi Utama</h3>
                            <p class="text-lg lg:text-xl font-medium leading-relaxed text-white/95">
                                "Terwujudnya keluarga yang beriman dan bertakwa kepada Tuhan Yang Maha Esa, berakhlak mulia dan berbudi luhur, sehat, sejahtera, maju dan mandiri, kesetaraan dan keadilan gender, serta memiliki kesadaran hukum dan lingkungan."
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Right: Misi List (Span 7) -->
                <div class="lg:col-span-7" data-aos="fade-left">
                    <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-amber-100 text-amber-900 font-bold text-sm mb-6 border border-amber-200">
                        Misi Gerakan PKK
                    </div>
                    <h2 class="text-3xl lg:text-4xl font-extrabold mb-8 text-tertiary">Misi Pemberdayaan</h2>
                    
                    <div class="space-y-6">
                        <!-- Misi Item 1 -->
                        <div class="flex gap-4 p-5 rounded-2xl bg-white border border-gray-100 hover:border-primary/20 hover:shadow-soft transition-all duration-300 group">
                            <div class="flex-shrink-0 w-10 h-10 rounded-xl bg-primary-light flex items-center justify-center font-bold text-primary group-hover:bg-primary group-hover:text-white transition-colors duration-300">
                                1
                            </div>
                            <div>
                                <h4 class="font-bold text-lg text-tertiary group-hover:text-primary transition-colors duration-200">Peningkatan Mental & Spiritual</h4>
                                <p class="text-neutral text-sm mt-1 leading-relaxed">Meningkatkan perilaku hidup beriman dan bertakwa kepada Tuhan YME, menghayati dan mengamalkan Pancasila, serta menumbuhkan kesadaran hukum dan gotong royong.</p>
                            </div>
                        </div>

                        <!-- Misi Item 2 -->
                        <div class="flex gap-4 p-5 rounded-2xl bg-white border border-gray-100 hover:border-primary/20 hover:shadow-soft transition-all duration-300 group">
                            <div class="flex-shrink-0 w-10 h-10 rounded-xl bg-primary-light flex items-center justify-center font-bold text-primary group-hover:bg-primary group-hover:text-white transition-colors duration-300">
                                2
                            </div>
                            <div>
                                <h4 class="font-bold text-lg text-tertiary group-hover:text-primary transition-colors duration-200">Pendidikan & Peningkatan Ekonomi</h4>
                                <p class="text-neutral text-sm mt-1 leading-relaxed">Meningkatkan kualitas pendidikan dan keterampilan kader serta keluarga guna mencerdaskan kehidupan bangsa dan mengembangkan usaha ekonomi keluarga.</p>
                            </div>
                        </div>

                        <!-- Misi Item 3 -->
                        <div class="flex gap-4 p-5 rounded-2xl bg-white border border-gray-100 hover:border-primary/20 hover:shadow-soft transition-all duration-300 group">
                            <div class="flex-shrink-0 w-10 h-10 rounded-xl bg-primary-light flex items-center justify-center font-bold text-primary group-hover:bg-primary group-hover:text-white transition-colors duration-300">
                                3
                            </div>
                            <div>
                                <h4 class="font-bold text-lg text-tertiary group-hover:text-primary transition-colors duration-200">Kesejahteraan Fisik & Pangan</h4>
                                <p class="text-neutral text-sm mt-1 leading-relaxed">Mewujudkan kemandirian pangan keluarga melalui pemanfaatan lahan pekarangan (HATINYA PKK), pemenuhan sandang, serta perumahan yang layak dan sehat.</p>
                            </div>
                        </div>

                        <!-- Misi Item 4 -->
                        <div class="flex gap-4 p-5 rounded-2xl bg-white border border-gray-100 hover:border-primary/20 hover:shadow-soft transition-all duration-300 group">
                            <div class="flex-shrink-0 w-10 h-10 rounded-xl bg-primary-light flex items-center justify-center font-bold text-primary group-hover:bg-primary group-hover:text-white transition-colors duration-300">
                                4
                            </div>
                            <div>
                                <h4 class="font-bold text-lg text-tertiary group-hover:text-primary transition-colors duration-200">Kesehatan & Perencanaan Keluarga</h4>
                                <p class="text-neutral text-sm mt-1 leading-relaxed">Meningkatkan derajat kesehatan keluarga, pencegahan stunting, pelestarian lingkungan hidup, serta membiasakan perencanaan keluarga berencana.</p>
                            </div>
                        </div>

                        <!-- Misi Item 5 -->
                        <div class="flex gap-4 p-5 rounded-2xl bg-white border border-gray-100 hover:border-primary/20 hover:shadow-soft transition-all duration-300 group">
                            <div class="flex-shrink-0 w-10 h-10 rounded-xl bg-primary-light flex items-center justify-center font-bold text-primary group-hover:bg-primary group-hover:text-white transition-colors duration-300">
                                5
                            </div>
                            <div>
                                <h4 class="font-bold text-lg text-tertiary group-hover:text-primary transition-colors duration-200">Penguatan Kelembagaan PKK</h4>
                                <p class="text-neutral text-sm mt-1 leading-relaxed">Memantapkan pengelolaan gerakan PKK secara sistematis, terencana, dan adaptif terhadap perkembangan teknologi informasi demi pelayanan yang optimal.</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Sejarah Section -->
    <section id="sejarah" class="py-20 lg:py-32 bg-white relative border-t border-gray-100 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-center">
                <div class="relative pr-4 pb-4" data-aos="fade-right">
                    <div class="absolute top-4 left-4 right-0 bottom-0 bg-secondary rounded-3xl -z-10"></div>
                    <img src="https://images.unsplash.com/photo-1573164713988-8665fc963095?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Sejarah PKK" class="rounded-3xl shadow-xl w-full object-cover h-[250px] sm:h-[350px] lg:h-[400px]">
                </div>
                <div data-aos="fade-left">
                    <h2 class="text-3xl md:text-4xl lg:text-5xl font-extrabold mb-3 text-tertiary">Sejarah Gerakan PKK</h2>
                    <h3 class="text-lg md:text-xl font-bold text-primary mb-6">Jejak Langkah Pengabdian</h3>
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

    <!-- Team Section -->
    <section id="tim" class="py-20 lg:py-32 bg-gray-50 border-y border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-3xl md:text-4xl font-extrabold mb-4">Susunan Kepengurusan Inti</h2>
                <p class="text-lg text-neutral">Pengelompokan tugas untuk pengurus inti gerakan PKK.</p>
            </div>
            
            <!-- Top Leaders Row (Ketua & Wakil Ketua) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-8 max-w-3xl mx-auto mb-12 justify-center">
                <!-- Member 1: Ketua -->
                <div data-aos="zoom-in" class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100 text-center hover:shadow-soft hover:-translate-y-1 transition-all duration-300">
                    <div class="w-24 h-24 mx-auto bg-primary-light rounded-full flex items-center justify-center text-primary text-3xl font-bold mb-6 border-4 border-white shadow-md">
                        SG
                    </div>
                    <h3 class="text-xl font-bold text-tertiary mb-1">Hj. Susi Gantini, S.Si.</h3>
                    <p class="text-sm font-semibold text-primary">Ketua TP PKK</p>
                </div>
                <!-- Member 2: Wakil Ketua -->
                <div data-aos="zoom-in" class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100 text-center hover:shadow-soft hover:-translate-y-1 transition-all duration-300">
                    <div class="w-24 h-24 mx-auto bg-primary-light rounded-full flex items-center justify-center text-primary text-3xl font-bold mb-6 border-4 border-white shadow-md">
                        AD
                    </div>
                    <h3 class="text-xl font-bold text-tertiary mb-1">Adita</h3>
                    <p class="text-sm font-semibold text-primary">Wakil Ketua TP PKK</p>
                </div>
            </div>

            <!-- Supporting Board Row (Sekretaris & Bendahara) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 justify-center">
                <!-- Member 3: Sekretaris I -->
                <div data-aos="zoom-in" class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100 text-center hover:shadow-soft hover:-translate-y-1 transition-all duration-300">
                    <div class="w-24 h-24 mx-auto bg-primary-light rounded-full flex items-center justify-center text-primary text-3xl font-bold mb-6 border-4 border-white shadow-md">
                        SS
                    </div>
                    <h3 class="text-xl font-bold text-tertiary mb-1">Hj. Sri Teti Setiawati, S.Pd.I.</h3>
                    <p class="text-sm font-semibold text-primary">Sekretaris I</p>
                </div>
                <!-- Member 4: Sekretaris II -->
                <div data-aos="zoom-in" class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100 text-center hover:shadow-soft hover:-translate-y-1 transition-all duration-300">
                    <div class="w-24 h-24 mx-auto bg-primary-light rounded-full flex items-center justify-center text-primary text-3xl font-bold mb-6 border-4 border-white shadow-md">
                        YS
                    </div>
                    <h3 class="text-xl font-bold text-tertiary mb-1">Yusrina, S.E.</h3>
                    <p class="text-sm font-semibold text-primary">Sekretaris II</p>
                </div>
                <!-- Member 5: Bendahara I -->
                <div data-aos="zoom-in" class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100 text-center hover:shadow-soft hover:-translate-y-1 transition-all duration-300">
                    <div class="w-24 h-24 mx-auto bg-primary-light rounded-full flex items-center justify-center text-primary text-3xl font-bold mb-6 border-4 border-white shadow-md">
                        NM
                    </div>
                    <h3 class="text-xl font-bold text-tertiary mb-1">Nina Marlina, S.Pd.</h3>
                    <p class="text-sm font-semibold text-primary">Bendahara I</p>
                </div>
                <!-- Member 6: Bendahara II -->
                <div data-aos="zoom-in" class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100 text-center hover:shadow-soft hover:-translate-y-1 transition-all duration-300">
                    <div class="w-24 h-24 mx-auto bg-primary-light rounded-full flex items-center justify-center text-primary text-3xl font-bold mb-6 border-4 border-white shadow-md">
                        NZ
                    </div>
                    <h3 class="text-xl font-bold text-tertiary mb-1">Hj. Nenden Zunaedah, A.Md.</h3>
                    <p class="text-sm font-semibold text-primary">Bendahara II</p>
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
    <!-- Footer -->
    <footer id="footer-kontak" class="bg-tertiary pt-20 pb-10 border-t border-gray-800 text-gray-400">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12 mb-16">
                <!-- Col 1: Branding -->
                <div class="space-y-4">
                    <div class="flex items-center gap-3">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo PKK" class="h-10 w-10 object-contain" onerror="this.onerror=null; this.src='https://upload.wikimedia.org/wikipedia/commons/4/4e/Lambang_PKK.png'">
                        <span class="font-extrabold text-2xl text-white tracking-tight">LKP PKK</span>
                    </div>
                    <p class="text-sm leading-relaxed text-gray-500">Mewujudkan keluarga sehat, cerdas, dan sejahtera melalui koordinasi dan pelaporan LKP yang terintegrasi di Kabupaten Sumedang.</p>
                </div>

                <!-- Col 2: Kontak Sekretariat -->
                <div class="space-y-4">
                    <h3 class="font-bold text-white text-md tracking-wider uppercase">Kontak Sekretariat</h3>
                    <ul class="space-y-3 text-sm">
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-primary flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            <a href="https://maps.app.goo.gl/P1UtL1GLoYFz51E89" target="_blank" rel="noopener noreferrer" class="hover:text-primary transition-colors leading-relaxed">
                                Regol Wetan, Kec. Sumedang Sel., Kabupaten Sumedang, Jawa Barat 45311
                            </a>
                        </li>
                        <li class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-primary flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            <a href="mailto:pkksumedangsimpati@gmail.com" class="hover:text-primary transition-colors">pkksumedangsimpati@gmail.com</a>
                        </li>
                        <li class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-primary flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>
                            <a href="https://www.instagram.com/pkksumedang?igsh=dHVoa3kyMHRj" target="_blank" rel="noopener noreferrer" class="hover:text-primary transition-colors">@pkksumedang</a>
                        </li>
                    </ul>
                </div>

                <!-- Col 3: Link Bantuan -->
                <div class="space-y-4">
                    <h3 class="font-bold text-white text-md tracking-wider uppercase">Menu Lainnya</h3>
                    <ul class="space-y-2 text-sm flex flex-col">
                        <li><a href="#" class="hover:text-white transition-colors">Kebijakan Privasi</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Syarat Ketentuan</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Bantuan</a></li>
                    </ul>
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
