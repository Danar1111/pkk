<x-filament-widgets::widget>
    <div style="
        background: linear-gradient(135deg, #1E88E5 0%, #0D47A1 100%);
        border-radius: 1rem;
        padding: 2rem 2.5rem;
        position: relative;
        overflow: hidden;
        min-height: 160px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    ">
        {{-- Decorative circles --}}
        <div style="position: absolute; top: -40px; right: -40px; width: 200px; height: 200px; background: rgba(255,214,0,0.15); border-radius: 50%;"></div>
        <div style="position: absolute; bottom: -60px; right: 80px; width: 180px; height: 180px; background: rgba(255,255,255,0.08); border-radius: 50%;"></div>
        <div style="position: absolute; top: 20px; right: 20px; width: 120px; height: 120px; background: rgba(79,195,247,0.12); border-radius: 50%;"></div>

        <div style="position: relative; z-index: 10;">
            <p style="
                font-size: 0.7rem;
                font-weight: 700;
                color: rgba(255,255,255,0.7);
                letter-spacing: 0.1em;
                text-transform: uppercase;
                margin-bottom: 0.5rem;
                font-family: 'Plus Jakarta Sans', sans-serif;
            ">{{ strtoupper(now()->translatedFormat('l, d F Y')) }}</p>

            <h2 style="
                font-size: 1.75rem;
                font-weight: 800;
                color: #ffffff;
                margin-bottom: 0.5rem;
                letter-spacing: -0.02em;
                font-family: 'Plus Jakarta Sans', sans-serif;
            ">Selamat Datang, {{ auth()->user()?->name ?? 'Ibu Admin' }}</h2>

            <p style="
                font-size: 0.9rem;
                color: rgba(255,255,255,0.8);
                max-width: 500px;
                line-height: 1.5;
                font-family: 'Plus Jakarta Sans', sans-serif;
            ">Berikut adalah ringkasan aktivitas dan laporan terkini dari seluruh komunitas PKK. Semangat bergotong royong!</p>
        </div>
    </div>
</x-filament-widgets::widget>
