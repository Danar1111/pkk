<div class="login-wrapper">
    <style>
        *, *::before, *::after {
            font-family: 'Plus Jakarta Sans', sans-serif !important;
            box-sizing: border-box;
        }

        /* ===== SPLIT-SCREEN WRAPPER ===== */
        .login-wrapper {
            display: flex;
            min-height: 100vh;
            width: 100%;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: 9999;
            background: #ffffff;
            overflow-y: auto; /* Enable vertical scroll if content exceeds screen height */
        }

        /* ===== LEFT PANEL ===== */
        .login-left {
            position: relative;
            width: 60%;
            background: linear-gradient(150deg, #0A1F44 0%, #0D2E6E 40%, #1565C0 100%);
            display: flex;
            flex-direction: column;
            justify-content: space-between; /* Anchor top, middle, and bottom content */
            align-items: flex-start;
            padding: clamp(2.5rem, 5vh, 4rem) clamp(3rem, 5vw, 5rem);
            overflow: hidden; /* Force hide scrollbar on the panel itself */
            min-height: 100vh;
        }

        /* Decorative circle orbs */
        .login-left::before {
            content: '';
            position: absolute;
            width: 700px; height: 700px;
            border-radius: 50%;
            border: 1px solid rgba(255,255,255,0.07);
            background: radial-gradient(circle, rgba(255,255,255,0.06) 0%, transparent 70%);
            top: -150px; right: -150px;
        }
        .login-left::after {
            content: '';
            position: absolute;
            width: 600px; height: 600px;
            border-radius: 50%;
            border: 1px solid rgba(255,255,255,0.05);
            background: radial-gradient(circle, rgba(100,180,255,0.08) 0%, transparent 70%);
            bottom: -150px; left: -100px;
        }
        .orb-mid {
            position: absolute;
            width: 400px; height: 400px;
            border-radius: 50%;
            border: 1px solid rgba(255,255,255,0.06);
            bottom: 120px; right: 100px;
        }

        /* Minimalist, ultra-premium inline back link with hover animation */
        .back-link-left-inline {
            display: inline-flex;
            align-items: center;
            gap: 0.625rem;
            font-size: 0.875rem;
            font-weight: 700;
            color: rgba(255, 255, 255, 0.75) !important;
            text-decoration: none;
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 50;
            margin-bottom: clamp(1rem, 3vh, 2rem);
            flex-shrink: 0;
            padding: 0.25rem 0;
        }
        .back-link-left-inline svg {
            width: 16px;
            height: 16px;
            transition: transform 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .back-link-left-inline:hover {
            color: #ffffff !important;
        }
        .back-link-left-inline:hover svg {
            transform: translateX(-4px); /* Interactive micro-slide left */
        }

        /* Middle content in layout flow */
        .login-left-content {
            position: relative;
            z-index: 10;
            max-width: 780px;
            margin: auto 0; /* Dynamically centers content vertically */
            padding: 1rem 0;
        }

        .left-logo {
            display: flex;
            align-items: center;
            gap: 1.25rem;
            margin-bottom: clamp(1.5rem, 4vh, 3rem);
        }
        .left-logo img {
            width: 72px;
            height: 72px;
            object-fit: contain;
            filter: drop-shadow(0 4px 12px rgba(0,0,0,0.3));
        }
        .left-logo-text {
            display: flex;
            flex-direction: column;
        }
        .left-logo-text .brand-name {
            font-size: 1.45rem;
            font-weight: 800;
            color: #ffffff;
            letter-spacing: -0.02em;
            line-height: 1.2;
        }
        .left-logo-text .brand-sub {
            font-size: 0.85rem;
            font-weight: 600;
            color: rgba(255,255,255,0.55);
            letter-spacing: 0.04em;
            text-transform: uppercase;
            margin-top: 2px;
        }

        .left-headline {
            font-size: clamp(2.25rem, 4vw, 3.75rem);
            font-weight: 800;
            color: #ffffff;
            line-height: 1.15;
            letter-spacing: -0.03em;
            margin-bottom: clamp(1rem, 2.5vh, 1.5rem);
        }
        .left-headline span {
            color: #60AEFF;
        }

        .left-desc {
            font-size: 1.15rem;
            font-weight: 400;
            color: rgba(255,255,255,0.75);
            line-height: 1.7;
            margin-bottom: clamp(1.5rem, 4vh, 3rem);
            max-width: 680px;
        }

        /* Feature list */
        .left-features {
            display: flex;
            flex-direction: column;
            gap: clamp(1rem, 2.5vh, 1.5rem);
        }
        .feature-item {
            display: flex;
            align-items: center;
            gap: 1.125rem;
        }
        .feature-icon {
            flex-shrink: 0;
            width: 46px; height: 46px;
            border-radius: 12px;
            background: rgba(255,255,255,0.08);
            border: 1px solid rgba(255,255,255,0.15);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .feature-icon svg {
            width: 22px; height: 22px;
            color: #60AEFF;
        }
        .feature-text {
            font-size: 1.1rem;
            font-weight: 600;
            color: rgba(255,255,255,0.9);
        }

        /* Bottom tag in layout flow */
        .left-bottom {
            width: 100%;
            z-index: 10;
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 2rem;
            flex-shrink: 0;
        }
        .left-bottom-text {
            font-size: 0.8rem;
            color: rgba(255,255,255,0.35);
            font-weight: 500;
        }

        /* ===== RIGHT PANEL ===== */
        .login-right {
            width: 40%;
            background: #ffffff;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 3rem 4rem;
            position: relative;
        }

        .login-right-inner {
            width: 100%;
            max-width: 380px;
        }

        /* Form heading */
        .form-heading {
            margin-bottom: 1.5rem;
        }
        .form-heading h1 {
            font-size: 1.625rem;
            font-weight: 800;
            color: #0A1F44;
            letter-spacing: -0.03em;
            margin: 0 0 0.375rem;
            line-height: 1.2;
        }
        .form-heading p {
            font-size: 0.875rem;
            font-weight: 400;
            color: #64748B;
            margin: 0;
        }

        /* ===== Override Filament form styles for clean fieldset-free look ===== */
        .fi-simple-layout,
        .fi-simple-layout > *,
        .fi-simple-main-ctn,
        .fi-simple-main {
            all: unset !important;
            display: block !important;
            width: 100% !important;
        }
        .fi-simple-page {
            all: unset !important;
            display: block !important;
            width: 100% !important;
        }

        /* hide Filament logo & heading since we render our own */
        .fi-logo,
        .fi-simple-header {
            display: none !important;
        }

        /* ---- Field labels ---- */
        .fi-fo-field-label {
            font-size: 0.78rem !important;
            font-weight: 700 !important;
            color: #475569 !important;
            letter-spacing: 0.01em !important;
            margin-bottom: 0.3rem !important;
            display: block !important;
        }
        .fi-fo-field-label-required-mark {
            color: #EF4444 !important;
        }

        /* ---- Inputs ---- */
        .fi-input-wrp {
            background: #F8FAFC !important;
            border: 1.25px solid #E2E8F0 !important;
            border-radius: 0.5rem !important;
            box-shadow: none !important;
            transition: border-color 0.2s ease, background 0.2s ease, box-shadow 0.2s ease !important;
        }
        .fi-input-wrp:hover {
            border-color: #93C5FD !important;
            background: #ffffff !important;
        }
        .fi-input-wrp:focus-within {
            background: #ffffff !important;
            border-color: #1565C0 !important;
            box-shadow: 0 0 0 3px rgba(21, 101, 192, 0.1) !important;
        }
        .fi-input {
            background: transparent !important;
            border: none !important;
            outline: none !important;
            box-shadow: none !important;
            padding: 0.55rem 0.75rem !important;
            font-size: 0.85rem !important;
            color: #0A1F44 !important;
            font-weight: 500 !important;
        }
        .fi-input::placeholder {
            color: #94A3B8 !important;
            font-weight: 400 !important;
        }

        /* ---- Password suffix icon ---- */
        .fi-input-wrp-suffix {
            padding-right: 0.625rem !important;
            display: flex !important;
            align-items: center !important;
        }
        .fi-icon-btn { color: #94A3B8 !important; transition: color 0.2s !important; }
        .fi-icon-btn:hover { color: #1565C0 !important; }

        /* ---- Checkbox ---- */
        .fi-checkbox-input {
            border-radius: 0.25rem !important;
            border-color: #CBD5E1 !important;
            color: #1565C0 !important;
            width: 1.05rem !important;
            height: 1.05rem !important;
            margin-right: 0.45rem !important;
            cursor: pointer !important;
        }
        .fi-checkbox-input:checked { background-color: #1565C0 !important; border-color: #1565C0 !important; }
        .fi-fo-field-label-content {
            font-size: 0.78rem !important;
            font-weight: 500 !important;
            color: #475569 !important;
        }

        /* ---- Field spacing ---- */
        .fi-sc-form { display: flex !important; flex-direction: column !important; gap: 0.875rem !important; }
        .fi-fo-field { margin-bottom: 0 !important; }
        .fi-fo-field-label-col { margin-bottom: 0.25rem !important; }

        /* ---- Submit Button Styling ---- */
        .fi-btn {
            background: linear-gradient(135deg, #1E88E5 0%, #1565C0 100%) !important;
            border-radius: 0.5rem !important;
            font-weight: 700 !important;
            padding: 0.625rem 1.25rem !important;
            font-size: 0.875rem !important;
            transition: all 0.2s ease !important;
            color: #ffffff !important;
            width: 100% !important;
            display: inline-flex !important;
            justify-content: center !important;
            align-items: center !important;
            box-shadow: 0 4px 12px rgba(30, 136, 229, 0.2) !important;
            border: none !important;
            cursor: pointer !important;
        }
        .fi-btn:hover {
            transform: translateY(-1px) !important;
            box-shadow: 0 6px 16px rgba(30, 136, 229, 0.3) !important;
            background: linear-gradient(135deg, #2196F3 0%, #1E88E5 100%) !important;
        }
        .fi-btn:active {
            transform: translateY(0) !important;
        }
        .fi-btn * {
            color: #ffffff !important;
            font-weight: 700 !important;
        }

        /* ---- Links ---- */
        .fi-link, .fi-simple-page a {
            color: #1565C0 !important;
            font-weight: 600 !important;
            font-size: 0.8rem !important;
            text-decoration: none !important;
            transition: color 0.2s !important;
        }
        .fi-link:hover, .fi-simple-page a:hover {
            color: #0D47A1 !important;
            text-decoration: underline !important;
        }

        /* ---- Validation errors ---- */
        .fi-fo-field-wrp-error-message, .text-danger-600 {
            color: #EF4444 !important;
            font-size: 0.75rem !important;
            font-weight: 500 !important;
            margin-top: 0.25rem !important;
        }

        /* ---- Auth footer / registration links ---- */
        .auth-footer {
            margin-top: 1.5rem;
            text-align: center;
            font-size: 0.85rem;
            color: #64748B;
        }
        .auth-footer a {
            color: #1565C0 !important;
            font-weight: 700;
            text-decoration: none;
            transition: color 0.15s ease;
        }
        .auth-footer a:hover {
            color: #0D47A1 !important;
            text-decoration: underline;
        }

        /* ---- Filament notification ---- */
        .fi-no-footer { display: none !important; }

        /* ===== LAPTOP RESPONSIVE (Saves spacing on notebook screens) ===== */
        @media (max-width: 1366px) {
            .login-left {
                padding: clamp(2rem, 4vh, 3rem) clamp(2rem, 4vw, 3.5rem);
            }
            .back-link-left-inline {
                margin-bottom: 1rem;
                padding: 0.25rem 0;
                font-size: 0.8rem;
            }
            .left-logo {
                gap: 0.875rem !important;
                margin-bottom: 1.25rem !important;
            }
            .left-logo img {
                width: 54px !important;
                height: 54px !important;
            }
            .left-logo-text .brand-name {
                font-size: 1.15rem !important;
            }
            .left-logo-text .brand-sub {
                font-size: 0.7rem !important;
            }
            .left-headline {
                font-size: clamp(1.75rem, 3vw, 2.25rem) !important;
                margin-bottom: 0.75rem !important;
            }
            .left-desc {
                font-size: 0.95rem !important;
                margin-bottom: 1.5rem !important;
                line-height: 1.6 !important;
            }
            .left-features {
                gap: 0.75rem !important;
            }
            .feature-icon {
                width: 36px !important;
                height: 36px !important;
                border-radius: 10px !important;
            }
            .feature-icon svg {
                width: 18px !important;
                height: 18px !important;
            }
            .feature-text {
                font-size: 0.9rem !important;
            }
            .left-bottom {
                margin-top: 1rem !important;
            }
            .left-bottom-text {
                font-size: 0.75rem !important;
            }
        }

        /* ===== MOBILE RESPONSIVE ===== */
        @media (max-width: 900px) {
            .login-wrapper {
                flex-direction: column !important;
                position: fixed !important;
                top: 0 !important;
                left: 0 !important;
                right: 0 !important;
                bottom: 0 !important;
                overflow-y: auto !important;
            }
            .login-left {
                width: 100% !important;
                height: auto !important;
                min-height: auto !important;
                flex-shrink: 0 !important;
                padding: 2.5rem 2rem 2rem !important;
                justify-content: flex-start !important;
                overflow: hidden !important;
            }
            .left-bottom { display: none !important; }
            .login-right {
                width: 100% !important;
                flex-shrink: 0 !important;
                padding: 2.5rem 1.5rem 4.5rem !important; /* Add bottom space so footer links are never cut off */
                align-items: stretch !important;
            }
            .login-right-inner {
                max-width: 100% !important;
            }
            .back-link-left-inline {
                display: inline-flex !important;
                margin-bottom: 1.25rem !important;
            }
            .left-features { display: none !important; }
            .left-headline { font-size: 1.5rem !important; margin-bottom: 0.5rem !important; }
            .left-desc { display: none !important; }
            .left-logo { margin-bottom: 1.5rem !important; }
        }
    </style>

    <!-- ===== LEFT PANEL ===== -->
    <div class="login-left">
        <!-- Single Back Button (Inline) -->
        <a href="{{ url('/') }}" class="back-link-left-inline">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Kembali ke Beranda
        </a>

        <div class="orb-mid"></div>
        
        <div class="login-left-content">
            <!-- Logo -->
            <div class="left-logo">
                <img src="{{ asset('images/logo.png') }}" alt="PKK Logo">
                <div class="left-logo-text">
                    <span class="brand-name">LKP PKK</span>
                    <span class="brand-sub">Kabupaten Sumedang</span>
                </div>
            </div>

            <!-- Headline -->
            <h2 class="left-headline">
                Selamat Datang di<br>
                <span>Sistem LKP PKK</span>
            </h2>

            <!-- Desc -->
            <p class="left-desc">
                Sistem Informasi Laporan Kegiatan PKK Kabupaten Sumedang yang terintegrasi, akurat, dan mudah digunakan oleh seluruh tingkat kader PKK.
            </p>

            <!-- Features -->
            <div class="left-features">
                <div class="feature-item">
                    <div class="feature-icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <span class="feature-text">Laporan Terintegrasi & Mudah Diakses</span>
                </div>
                <div class="feature-item">
                    <div class="feature-icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    </div>
                    <span class="feature-text">Data Akurat dan Terstruktur</span>
                </div>
                <div class="feature-item">
                    <div class="feature-icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                    </div>
                    <span class="feature-text">Keamanan Data Terjamin</span>
                </div>
            </div>
        </div>

        <!-- Bottom bar (Inline) -->
        <div class="left-bottom">
            <span class="left-bottom-text">© {{ date('Y') }} TP PKK Kabupaten Sumedang</span>
            <span class="left-bottom-text">v1.0</span>
        </div>
    </div>

    <!-- ===== RIGHT PANEL ===== -->
    <div class="login-right">
        <div class="login-right-inner">
            <!-- Heading -->
            <div class="form-heading">
                <h1>Masuk ke Akun Anda</h1>
                <p>Masukkan kredensial untuk melanjutkan</p>
            </div>

            <!-- Filament Login Form -->
            {{ $this->content }}

            <!-- Register Footer Link -->
            @if (filament()->hasRegistration())
                <div class="auth-footer">
                    Belum punya akun? <a href="{{ filament()->getRegistrationUrl() }}">Daftar sekarang</a>
                </div>
            @endif
        </div>
    </div>
</div>
