<x-filament-widgets::widget>
    @php
        $galleryDir = public_path('images/gallery');
        $bannerImages = [];
        if (file_exists($galleryDir)) {
            $files = scandir($galleryDir);
            foreach ($files as $file) {
                if (in_array(strtolower(pathinfo($file, PATHINFO_EXTENSION)), ['jpg', 'jpeg', 'png', 'webp', 'gif'])) {
                    $bannerImages[] = asset('images/gallery/' . $file);
                }
            }
        }

        // Fallback jika kosong
        if (empty($bannerImages)) {
            $bannerImages = [
                asset('images/banner-1.png'),
                asset('images/banner-2.png'),
                asset('images/banner-3.png'),
                asset('images/banner-4.png'),
                asset('images/banner-5.png'),
            ];
        }

        $randomImage = $bannerImages[array_rand($bannerImages)];
    @endphp

    <div style="
        background: linear-gradient(135deg, #DCE7F3 0%, #FFF3C4 60%, #FDD835 100%);
        border-radius: 1rem;
        padding: 2rem 2.5rem;
        position: relative;
        overflow: hidden;
        min-height: 160px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        border: 1px solid #E2E8F0;
        box-shadow: 0px 4px 20px rgba(18, 26, 33, 0.04);
        margin-top: -0.5rem;
    ">
        {{-- Gambar sisi kanan – berubah setiap refresh/navigasi --}}
        <div style="
            position: absolute;
            right: 0;
            top: 0;
            bottom: 0;
            width: 38%;
            background-image: url('{{ $randomImage }}');
            background-size: cover;
            background-position: center;
            border-top-left-radius: 100px;
            border-bottom-left-radius: 100px;
            z-index: 1;
            border-left: 2px solid rgba(255, 255, 255, 0.5);
        "></div>

        <div style="position: relative; z-index: 10; max-width: 60%;">
            <p style="
                font-size: 0.75rem;
                font-weight: 700;
                color: #4A5D78;
                letter-spacing: 0.05em;
                text-transform: uppercase;
                margin-bottom: 0.5rem;
                font-family: 'Plus Jakarta Sans', sans-serif;
            ">{{ strtoupper(now()->translatedFormat('l, d F Y')) }}</p>

            <h2 style="
                font-size: 1.75rem;
                font-weight: 800;
                color: #0F172A;
                margin-bottom: 0.5rem;
                letter-spacing: -0.025em;
                font-family: 'Plus Jakarta Sans', sans-serif;
                line-height: 1.2;
            ">Selamat Datang, {{ auth()->user()?->name ?? 'Ibu Admin' }}</h2>

            <p style="
                font-size: 0.875rem;
                color: #334155;
                line-height: 1.5;
                font-family: 'Plus Jakarta Sans', sans-serif;
                margin: 0;
            ">Berikut adalah ringkasan aktivitas dan laporan terkini dari seluruh komunitas PKK. Semangat bergotong royong!</p>
        </div>
    </div>
</x-filament-widgets::widget>
