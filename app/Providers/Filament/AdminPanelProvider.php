<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use BezhanSalleh\FilamentShield\FilamentShieldPlugin;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets\AccountWidget;
use Filament\Widgets\FilamentInfoWidget;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Filament\View\PanelsRenderHook;
use Illuminate\Support\Facades\Blade;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('lkp')
            ->sidebarCollapsibleOnDesktop()
            ->login(\App\Filament\Pages\Auth\Login::class)
            ->registration(\App\Filament\Pages\Auth\Register::class)
            ->colors([
                'primary' => Color::Blue,
                'secondary' => Color::Cyan,
                'info' => Color::Sky,
                'success' => Color::Emerald,
                'warning' => Color::Amber,
                'danger' => Color::Rose,
                'gray' => Color::Slate,
            ])
            ->font('Plus Jakarta Sans')
            ->brandName('LKP PKK')
            ->brandLogo(fn () => view('filament.logo'))
            ->darkMode(false)
            ->renderHook(
                PanelsRenderHook::HEAD_END,
                fn (): string => request()->is('*/login', '*/register')
                    ? Blade::render('
                <style>
                    @import url(\'https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap\');
                    
                    /* Force Plus Jakarta Sans globally on this page */
                    *, *::before, *::after, body, input, button, select, textarea {
                        font-family: \'Plus Jakarta Sans\', sans-serif !important;
                    }

                    /* Simple Layout Wrapper (Used for Login Page) */
                    body:has(.fi-simple-layout) {
                        background: linear-gradient(135deg, #0A2E5C 0%, #1E88E5 100%) !important;
                        background-attachment: fixed !important;
                        background-size: cover !important;
                        overflow-x: hidden !important;
                        overflow-y: auto !important;
                        margin: 0 !important;
                        padding: 0 !important;
                        height: 100vh !important;
                    }
                    
                    .fi-simple-layout {
                        background: transparent !important;
                        width: 100% !important;
                        min-height: 100vh !important;
                        display: flex !important;
                        flex-direction: column !important;
                        padding: 2rem 1rem !important; /* Padding for mobile */
                        z-index: 10 !important;
                        position: relative !important;
                    }

                    /* Animated background glassmorphic orbs for Login Page */
                    .fi-simple-layout::before {
                        content: "";
                        position: absolute;
                        width: 500px; height: 500px;
                        background: radial-gradient(circle, rgba(255, 214, 0, 0.45) 0%, rgba(255, 214, 0, 0) 70%);
                        border-radius: 50%;
                        filter: blur(80px);
                        top: -150px; left: -150px;
                        animation: floatOrb1 20s ease-in-out infinite;
                        z-index: 0;
                        pointer-events: none;
                    }
                    .fi-simple-layout::after {
                        content: "";
                        position: absolute;
                        width: 600px; height: 600px;
                        background: radial-gradient(circle, rgba(79, 209, 197, 0.35) 0%, rgba(79, 209, 197, 0) 70%);
                        border-radius: 50%;
                        filter: blur(90px);
                        bottom: -200px; right: -150px;
                        animation: floatOrb2 25s ease-in-out infinite alternate;
                        z-index: 0;
                        pointer-events: none;
                    }
                    @keyframes floatOrb1 {
                        0% { transform: translate(0, 0) scale(1); }
                        50% { transform: translate(60px, 40px) scale(1.1); }
                        100% { transform: translate(0, 0) scale(1); }
                    }
                    @keyframes floatOrb2 {
                        0% { transform: translate(0, 0) scale(1); }
                        50% { transform: translate(-80px, -30px) scale(0.9); }
                        100% { transform: translate(0, 0) scale(1); }
                    }

                    /* Remove default Filament outer border / shadow / rings */
                    .fi-simple-main-ctn, .fi-simple-main {
                        border: none !important;
                        box-shadow: none !important;
                        outline: none !important;
                        ring: none !important;
                        background: transparent !important;
                        --tw-ring-color: transparent !important;
                        --tw-ring-shadow: none !important;
                        --tw-shadow: none !important;
                    }
                    .fi-simple-main-ctn {
                        height: auto !important;
                        width: 100% !important;
                        margin: auto !important; /* Centers item perfectly, scrolls gracefully if overflows */
                        display: flex !important;
                        justify-content: center !important;
                    }

                    /* Container limits */
                    .fi-simple-main {
                        max-width: 28rem !important;
                        width: 100% !important;
                        margin: 0 auto !important;
                        z-index: 20;
                    }

                    /* Advanced Premium Glass Card */
                    .fi-simple-page {
                        background: rgba(255, 255, 255, 0.45) !important;
                        backdrop-filter: blur(30px) !important;
                        -webkit-backdrop-filter: blur(30px) !important;
                        border-radius: 2rem !important;
                        padding: 1.5rem !important; /* Responsive padding: mobile first */
                        height: auto !important; /* Force content-based height */
                        min-height: auto !important; /* Disable min-height utility stretch */
                        box-shadow: 
                            0 4px 30px rgba(0, 0, 0, 0.03),
                            0 20px 50px rgba(0, 0, 0, 0.12),
                            inset 0 1px 0 rgba(255, 255, 255, 0.6) !important;
                        border: 1px solid rgba(255, 255, 255, 0.45) !important;
                        display: flex !important;
                        flex-direction: column !important;
                    }
                    @media (min-width: 640px) {
                        .fi-simple-page {
                            padding: 2.25rem !important; /* Larger desktop padding */
                        }
                    }

                    /* Logo override to prevent wrapping or collapsing */
                    .fi-logo {
                        display: flex !important;
                        justify-content: center !important;
                        align-items: center !important;
                        height: auto !important;
                        min-height: 3.5rem !important;
                        margin-bottom: 1rem !important; /* Reduced spacing */
                        position: relative;
                        z-index: 20;
                    }
                    
                    /* Header block */
                    .fi-simple-header {
                        display: flex !important;
                        flex-direction: column !important;
                        align-items: center !important;
                        text-align: center !important;
                        margin-bottom: 1.5rem !important; /* Reduced spacing */
                    }
                    .fi-simple-header-heading {
                        font-size: 1.625rem !important;
                        font-weight: 800 !important;
                        letter-spacing: -0.025em !important;
                        color: #121A21 !important;
                        margin-top: 0.25rem !important; /* Reduced margin */
                        margin-bottom: 0.25rem !important; /* Reduced margin */
                        line-height: 1.25 !important;
                    }
                    .fi-simple-header-subheading {
                        font-size: 0.9rem !important;
                        font-weight: 500 !important;
                        color: #64748B !important;
                    }

                    /* Form Layout */
                    .fi-sc-form {
                        display: flex !important;
                        flex-direction: column !important;
                        gap: 1.25rem !important;
                    }
                    .fi-fo-field {
                        margin-bottom: 0.25rem !important;
                    }
                    .fi-fo-field-label-col {
                        margin-bottom: 0.375rem !important;
                    }
                    .fi-fo-field-label {
                        font-size: 0.85rem !important;
                        font-weight: 600 !important;
                        color: #0A2E5C !important;
                        letter-spacing: -0.01em !important;
                    }
                    .fi-fo-field-label-required-mark {
                        color: #ef4444 !important;
                        margin-left: 0.125rem !important;
                    }

                    /* Clean & Premium Inputs */
                    .fi-input-wrp {
                        background: rgba(255, 255, 255, 0.75) !important;
                        border: 1px solid rgba(0, 0, 0, 0.08) !important;
                        border-radius: 0.875rem !important;
                        box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.03), 0 2px 4px rgba(0, 0, 0, 0.02) !important;
                        transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1) !important;
                        overflow: hidden !important;
                    }
                    .fi-input-wrp:hover {
                        border-color: rgba(30, 136, 229, 0.4) !important;
                        background: rgba(255, 255, 255, 0.9) !important;
                    }
                    .fi-input-wrp:focus-within {
                        background: #ffffff !important;
                        border-color: #1E88E5 !important;
                        box-shadow: 
                            0 0 0 4px rgba(30, 136, 229, 0.15),
                            inset 0 2px 4px rgba(0, 0, 0, 0.01) !important;
                    }
                    .fi-input {
                        background: transparent !important;
                        border: none !important;
                        outline: none !important;
                        box-shadow: none !important;
                        padding: 0.75rem 0.875rem !important;
                        font-size: 0.95rem !important;
                        color: #121A21 !important;
                    }

                    /* Suffix & Reveal Password Button */
                    .fi-input-wrp-suffix {
                        padding-right: 0.5rem !important;
                        display: flex !important;
                        align-items: center !important;
                    }
                    .fi-icon-btn.fi-ac-icon-btn-action {
                        color: #64748B !important;
                        transition: color 0.2s ease, transform 0.1s ease !important;
                    }
                    .fi-icon-btn.fi-ac-icon-btn-action:hover {
                        color: #1E88E5 !important;
                        transform: scale(1.05) !important;
                    }

                    /* Checkbox styling */
                    .fi-checkbox-input {
                        border-radius: 0.25rem !important;
                        border-color: rgba(0, 0, 0, 0.15) !important;
                        color: #1E88E5 !important;
                        width: 1.125rem !important;
                        height: 1.125rem !important;
                        margin-right: 0.5rem !important;
                        cursor: pointer !important;
                        transition: all 0.2s ease !important;
                    }
                    .fi-checkbox-input:focus {
                        box-shadow: 0 0 0 3px rgba(30, 136, 229, 0.2) !important;
                        border-color: #1E88E5 !important;
                    }
                    .fi-checkbox-input:checked {
                        background-color: #1E88E5 !important;
                        border-color: #1E88E5 !important;
                    }
                    .fi-fo-field-label-content {
                        font-size: 0.875rem !important;
                        font-weight: 500 !important;
                        color: #475569 !important;
                        user-select: none !important;
                    }

                    /* Primary Button */
                    .fi-btn-primary {
                        background: linear-gradient(135deg, #1E88E5 0%, #1565C0 100%) !important;
                        border-radius: 0.875rem !important;
                        padding: 0.75rem 1.5rem !important;
                        font-weight: 700 !important;
                        font-size: 0.95rem !important;
                        color: #ffffff !important;
                        letter-spacing: 0.01em !important;
                        transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1) !important;
                        box-shadow: 0 4px 12px rgba(30, 136, 229, 0.25) !important;
                        border: none !important;
                        cursor: pointer !important;
                        display: flex !important;
                        justify-content: center !important;
                        align-items: center !important;
                        width: 100% !important;
                    }
                    .fi-btn-primary:hover {
                        transform: translateY(-2px) !important;
                        box-shadow: 0 8px 20px rgba(30, 136, 229, 0.4) !important;
                        background: linear-gradient(135deg, #2196F3 0%, #1E88E5 100%) !important;
                    }
                    .fi-btn-primary:active {
                        transform: translateY(0) !important;
                    }
                    /* Force white text on primary button and its children */
                    .fi-btn-primary, .fi-btn-primary * {
                        color: #ffffff !important;
                    }

                    /* Link override */
                    .fi-link {
                        color: #1E88E5 !important;
                        font-weight: 600 !important;
                        font-size: 0.9rem !important;
                        transition: all 0.2s ease !important;
                        text-decoration: none !important;
                    }
                    .fi-link:hover {
                        color: #1565C0 !important;
                        text-decoration: underline !important;
                    }

                    /* Validation Error styling */
                    .fi-fo-field-wrp-error-message, .text-danger-600 {
                        color: #ef4444 !important;
                        font-size: 0.8rem !important;
                        font-weight: 500 !important;
                        margin-top: 0.375rem !important;
                        display: flex !important;
                        align-items: center !important;
                        gap: 0.25rem !important;
                    }

                    /* Hide default footer */
                    .fi-simple-layout footer {
                        display: none !important;
                    }
                </style>
                ')
                    : ''
            )
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\Filament\Resources')
            ->renderHook(
                PanelsRenderHook::HEAD_END,
                fn (): string => !request()->is('*/login', '*/register')
                    ? Blade::render('
                <style>
                    @import url(\'https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap\');
                    
                    /* ============================================
                       Sistem Informasi PKK Modern - Dashboard Theme
                       ============================================ */

                    /* Global Font Override */
                    *, *::before, *::after {
                        font-family: \'Plus Jakarta Sans\', sans-serif !important;
                    }

                    /* App Background - Warm Cool Grey */
                    body.fi-body {
                        background-color: #F8FAFC !important;
                    }

                    /* ---- Sidebar Styling ---- */
                    @media (min-width: 1024px) {
                        .fi-topbar {
                            width: calc(100% - 16rem) !important;
                            margin-left: auto !important;
                            left: auto !important;
                            right: 0 !important;
                        }
                        .fi-topbar .fi-logo {
                            display: none !important;
                        }
                        .fi-sidebar {
                            height: 100vh !important;
                            top: 0 !important;
                            z-index: 50 !important;
                            position: fixed !important;
                        }
                        .fi-sidebar-header {
                            display: flex !important;
                            height: 4rem !important;
                            align-items: center !important;
                            justify-content: flex-start !important;
                            padding-left: 1.5rem !important;
                        }
                    }

                    .fi-sidebar {
                        background: #ffffff !important;
                        border-right: 1px solid #E2E8F0 !important;
                    }
                    .fi-sidebar-nav {
                        background: transparent !important;
                    }
                    /* Sidebar Header / Brand */
                    .fi-sidebar-header {
                        border-bottom: 1px solid #E2E8F0 !important;
                        background: #ffffff !important;
                    }
                    /* Sidebar Nav Items */
                    .fi-sidebar-item {
                        border-radius: 0.5rem !important;
                        margin: 0.25rem 0.75rem !important;
                        transition: all 0.2s ease !important;
                    }
                    .fi-sidebar-item a {
                        color: #475569 !important;
                        font-weight: 600 !important;
                        font-size: 0.875rem !important;
                        padding: 0.625rem 1rem !important;
                        border-radius: 0.5rem !important;
                    }
                    .fi-sidebar-item:hover a {
                        color: #0F172A !important;
                        background: rgba(0, 0, 0, 0.04) !important;
                    }
                    .fi-sidebar-item.fi-active a,
                    .fi-sidebar-item a[aria-current="page"] {
                        background: #0077ce !important;
                        color: #ffffff !important;
                        font-weight: 700 !important;
                        box-shadow: 0 4px 12px rgba(0, 119, 206, 0.25) !important;
                    }
                    .fi-sidebar-item.fi-active a span,
                    .fi-sidebar-item a[aria-current="page"] span,
                    .fi-sidebar-item.fi-active a svg,
                    .fi-sidebar-item a[aria-current="page"] svg {
                        color: #ffffff !important;
                    }
                    .fi-sidebar-item .fi-icon {
                        color: inherit !important;
                    }
                    /* Sidebar Group Labels */
                    .fi-sidebar-group-label {
                        color: #64748B !important;
                        font-size: 0.7rem !important;
                        font-weight: 700 !important;
                        letter-spacing: 0.08em !important;
                        text-transform: uppercase !important;
                        padding-left: 1rem !important;
                    }
                    .fi-sidebar-group-button {
                        color: #64748B !important;
                    }

                    /* ---- Top Navbar ---- */
                    .fi-topbar {
                        background: #ffffff !important;
                        border-bottom: 1px solid #E2E8F0 !important;
                        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04) !important;
                    }
                    .fi-topbar nav {
                        background: transparent !important;
                    }

                    /* ---- Main Content Area ---- */
                    .fi-main {
                        background: #F8FAFC !important;
                    }
                    .fi-main-ctn {
                        background: #F8FAFC !important;
                    }

                    /* ---- Page Header (Breadcrumbs & Title) ---- */
                    .fi-header {
                        margin-bottom: 1.5rem !important;
                    }
                    .fi-header-heading {
                        font-size: 1.5rem !important;
                        font-weight: 700 !important;
                        color: #121A21 !important;
                        letter-spacing: -0.01em !important;
                    }
                    .fi-breadcrumbs-item, .fi-breadcrumbs-item a {
                        color: #64748B !important;
                        font-size: 0.8rem !important;
                    }

                    /* ---- Cards / Sections (Warm White with Soft Shadow) ---- */
                    .fi-section {
                        background: #ffffff !important;
                        border: 1px solid #E2E8F0 !important;
                        border-radius: 1rem !important;
                        box-shadow: 0px 4px 20px rgba(18, 26, 33, 0.05) !important;
                        transition: box-shadow 0.25s ease, transform 0.25s ease !important;
                        overflow: hidden !important;
                    }
                    .fi-section:hover {
                        box-shadow: 0px 8px 30px rgba(18, 26, 33, 0.08) !important;
                    }
                    .fi-section-header {
                        background: transparent !important;
                        border-bottom: 1px solid #F1F5F9 !important;
                        padding: 1.25rem 1.5rem !important;
                    }
                    .fi-section-header-heading {
                        font-size: 1.125rem !important;
                        font-weight: 700 !important;
                        color: #121A21 !important;
                    }

                    /* ---- Widget Cards ---- */
                    .fi-wi {
                        background: #ffffff !important;
                        border: 1px solid #E2E8F0 !important;
                        border-radius: 1rem !important;
                        box-shadow: 0px 4px 20px rgba(18, 26, 33, 0.05) !important;
                        transition: all 0.25s ease !important;
                        overflow: hidden !important;
                    }
                    .fi-wi:hover {
                        box-shadow: 0px 8px 30px rgba(18, 26, 33, 0.08) !important;
                        transform: translateY(-2px) !important;
                    }

                    /* ---- Stats Overview Widgets ---- */
                    .fi-wi-stats-overview-stat {
                        background: #ffffff !important;
                        border: 1px solid #E2E8F0 !important;
                        border-radius: 1rem !important;
                        padding: 1.25rem !important;
                        box-shadow: 0px 4px 20px rgba(18, 26, 33, 0.05) !important;
                        transition: all 0.25s ease !important;
                    }
                    .fi-wi-stats-overview-stat:hover {
                        box-shadow: 0px 8px 30px rgba(18, 26, 33, 0.08) !important;
                        transform: translateY(-2px) !important;
                    }
                    .fi-wi-stats-overview-stat-label {
                        font-size: 0.8rem !important;
                        font-weight: 600 !important;
                        color: #64748B !important;
                        text-transform: uppercase !important;
                        letter-spacing: 0.05em !important;
                    }
                    .fi-wi-stats-overview-stat-value {
                        font-size: 1.75rem !important;
                        font-weight: 800 !important;
                        color: #121A21 !important;
                        letter-spacing: -0.02em !important;
                    }

                    /* ---- Table Styling ---- */
                    .fi-ta {
                        border-radius: 1rem !important;
                        overflow: hidden !important;
                    }
                    .fi-ta-header-cell {
                        background: #F8FAFC !important;
                        font-weight: 700 !important;
                        font-size: 0.75rem !important;
                        color: #64748B !important;
                        text-transform: uppercase !important;
                        letter-spacing: 0.05em !important;
                        border-bottom: 2px solid #E2E8F0 !important;
                    }
                    .fi-ta-row {
                        border-bottom: 1px solid #F1F5F9 !important;
                        transition: background 0.15s ease !important;
                    }
                    .fi-ta-row:hover {
                        background: #F8FAFC !important;
                    }
                    .fi-ta-cell {
                        font-size: 0.875rem !important;
                        color: #334155 !important;
                        padding: 0.875rem 1rem !important;
                    }

                    /* ---- Buttons ---- */
                    .fi-btn {
                        border-radius: 0.625rem !important;
                        font-weight: 600 !important;
                        font-size: 0.875rem !important;
                        transition: all 0.2s ease !important;
                        letter-spacing: 0.01em !important;
                    }
                    .fi-btn-primary {
                        background: linear-gradient(135deg, #1E88E5 0%, #1976D2 100%) !important;
                        box-shadow: 0 2px 8px rgba(30, 136, 229, 0.25) !important;
                        border: none !important;
                        color: #ffffff !important;
                    }
                    .fi-btn-primary:hover {
                        box-shadow: 0 4px 16px rgba(30, 136, 229, 0.35) !important;
                        transform: translateY(-1px) !important;
                    }
                    .fi-btn-primary, .fi-btn-primary * {
                        color: #ffffff !important;
                    }

                    /* ---- Input Fields (Formulir) ---- */
                    .fi-input-wrp {
                        border-radius: 0.625rem !important;
                        border: 1px solid #CBD5E1 !important;
                        background: #ffffff !important;
                        transition: all 0.2s ease !important;
                    }
                    .fi-input-wrp:focus-within {
                        border-color: #1E88E5 !important;
                        box-shadow: 0 0 0 3px rgba(30, 136, 229, 0.12) !important;
                    }
                    .fi-input {
                        font-size: 0.9rem !important;
                        color: #121A21 !important;
                    }

                    /* ---- Badge / Status Chips ---- */
                    .fi-badge {
                        border-radius: 9999px !important;
                        font-weight: 600 !important;
                        font-size: 0.75rem !important;
                        padding: 0.25rem 0.75rem !important;
                        letter-spacing: 0.02em !important;
                    }

                    /* ---- Modal / Overlay ---- */
                    .fi-modal-window {
                        border-radius: 1.25rem !important;
                        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15) !important;
                    }

                    /* ---- Tabs ---- */
                    .fi-tabs-tab {
                        font-weight: 600 !important;
                        font-size: 0.875rem !important;
                        border-radius: 0.5rem 0.5rem 0 0 !important;
                        transition: all 0.2s ease !important;
                    }

                    /* ---- Notification ---- */
                    .fi-no {
                        border-radius: 0.75rem !important;
                        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1) !important;
                    }

                    /* ---- Footer Branding ---- */
                    .fi-footer {
                        background: transparent !important;
                        border-top: 1px solid #E2E8F0 !important;
                        color: #94A3B8 !important;
                        font-size: 0.75rem !important;
                    }
                </style>
                ')
                    : ''
            )
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\Filament\Pages')
            ->discoverClusters(in: app_path('Filament/Clusters'), for: 'App\Filament\Clusters')
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\Filament\Widgets')
            ->widgets([])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->plugins([
                FilamentShieldPlugin::make(),
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
