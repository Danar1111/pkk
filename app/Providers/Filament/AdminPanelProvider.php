<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use BezhanSalleh\FilamentShield\FilamentShieldPlugin;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use App\Filament\Pages\Dashboard;
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
use Illuminate\Support\HtmlString;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('lkp')
            ->path('lkp')
            ->sidebarWidth('18rem')
            ->sidebarCollapsibleOnDesktop()
            ->collapsedSidebarWidth('5.5rem')
            ->maxContentWidth('full')
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
                    html:has(.fi-simple-layout),
                    body:has(.fi-simple-layout) {
                        background: linear-gradient(135deg, #0A2E5C 0%, #1E88E5 100%) !important;
                        background-attachment: fixed !important;
                        background-size: cover !important;
                        overflow: hidden !important;
                        margin: 0 !important;
                        padding: 0 !important;
                        height: 100% !important;
                        max-height: 100% !important;
                        width: 100% !important;
                        max-width: 100% !important;
                        position: fixed !important; /* This strictly locks out all mobile scroll physics */
                        top: 0 !important;
                        left: 0 !important;
                        right: 0 !important;
                        bottom: 0 !important;
                    }
                    
                    .fi-simple-layout {
                        background: transparent !important;
                        width: 100% !important;
                        height: 100vh !important;
                        display: flex !important;
                        flex-direction: column !important;
                        justify-content: center !important;
                        align-items: center !important;
                        padding: 1rem !important;
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
                        max-width: {{ request()->is("*/register") ? "40rem" : "24rem" }} !important;
                        width: 100% !important;
                        margin: 0 auto !important;
                        z-index: 20;
                    }

                    /* Advanced Premium Glass Card */
                    .fi-simple-page {
                        background: rgba(255, 255, 255, 0.45) !important;
                        backdrop-filter: blur(30px) !important;
                        -webkit-backdrop-filter: blur(30px) !important;
                        border-radius: 1.5rem !important;
                        padding: 1rem 1.25rem !important; /* Responsive padding: mobile first */
                        height: auto !important; /* Force content-based height */
                        max-height: 95vh !important; /* Never exceed screen height */
                        overflow-y: auto !important; /* Scroll internally if it overflows */
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
                            padding: 1.25rem 1.75rem !important; /* Larger desktop padding */
                        }
                    }

                    /* Logo override to prevent wrapping or collapsing */
                    .fi-logo {
                        display: flex !important;
                        justify-content: center !important;
                        align-items: center !important;
                        height: auto !important;
                        min-height: 2.5rem !important;
                        margin-bottom: 0.125rem !important; /* Reduced spacing */
                        position: relative;
                        z-index: 20;
                    }
                    
                    /* Header block */
                    .fi-simple-header {
                        display: flex !important;
                        flex-direction: column !important;
                        align-items: center !important;
                        text-align: center !important;
                        margin-bottom: 0.875rem !important; /* Reduced spacing */
                    }
                    .fi-simple-header-heading {
                        font-size: 1.35rem !important;
                        font-weight: 800 !important;
                        letter-spacing: -0.025em !important;
                        color: #121A21 !important;
                        margin-top: 0.125rem !important; /* Reduced margin */
                        margin-bottom: 0.125rem !important; /* Reduced margin */
                        line-height: 1.25 !important;
                    }
                    .fi-simple-header-subheading {
                        font-size: 0.8rem !important;
                        font-weight: 500 !important;
                        color: #64748B !important;
                    }

                    /* Form Layout */
                    .fi-sc-form {
                        display: flex !important;
                        flex-direction: column !important;
                        gap: 0.65rem !important;
                    }
                    .fi-fo-field {
                        margin-bottom: 0 !important;
                    }
                    .fi-fo-field-label-col {
                        margin-bottom: 0.25rem !important;
                    }
                    .fi-fo-field-label {
                        font-size: 0.75rem !important;
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
                        border-radius: 0.6rem !important;
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
                        padding: 0.6rem 0.75rem !important;
                        font-size: 0.85rem !important;
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
                        font-size: 0.75rem !important;
                        font-weight: 500 !important;
                        color: #475569 !important;
                        user-select: none !important;
                    }

                    /* Buttons */
                    .fi-btn {
                        border-radius: 0.6rem !important;
                        font-weight: 700 !important;
                        padding: 0.6rem 1.25rem !important;
                        font-size: 0.85rem !important;
                        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
                        letter-spacing: 0.025em !important;
                    }
                    .fi-btn-primary {
                        background: linear-gradient(135deg, #1E88E5 0%, #1565C0 100%) !important;
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
                        font-size: 0.8rem !important;
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

                    /* Floating Back to Home button */
                    .back-to-home {
                        position: fixed !important;
                        top: 1.5rem !important;
                        left: 1.5rem !important;
                        display: flex !important;
                        align-items: center !important;
                        gap: 0.5rem !important;
                        color: rgba(255, 255, 255, 0.8) !important;
                        text-decoration: none !important;
                        font-weight: 700 !important;
                        font-size: 0.8rem !important;
                        background: rgba(255, 255, 255, 0.15) !important;
                        backdrop-filter: blur(10px) !important;
                        -webkit-backdrop-filter: blur(10px) !important;
                        padding: 0.5rem 1rem !important;
                        border-radius: 9999px !important;
                        border: 1px solid rgba(255, 255, 255, 0.25) !important;
                        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1) !important;
                        transition: all 0.2s ease !important;
                        z-index: 1000 !important;
                    }
                    .back-to-home:hover {
                        color: #ffffff !important;
                        background: rgba(255, 255, 255, 0.25) !important;
                        transform: translateX(-4px) !important;
                    }
                    .back-to-home svg {
                        color: inherit !important;
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

                    /* App Background - Soft Blue-Grey */
                    body.fi-body {
                        margin: 0 !important;
                        padding: 0 !important;
                        background-color: #F4F6FA !important;
                    }

                    /* ---- Sidebar Styling ---- */
                    @media (min-width: 1024px) {
                        /* Main content layout adjustment based on sidebar state */
                        .fi-main-ctn {
                            margin-left: var(--collapsed-sidebar-width, 4.5rem) !important;
                            width: calc(100% - var(--collapsed-sidebar-width, 4.5rem)) !important;
                            transition: margin-left 0.2s ease, width 0.2s ease !important;
                        }
                        .fi-main-ctn.fi-main-ctn-sidebar-open {
                            margin-left: var(--sidebar-width, 20rem) !important;
                            width: calc(100% - var(--sidebar-width, 20rem)) !important;
                        }
                        
                        /* Topbar layout adjustment based on sidebar state */
                        .fi-topbar {
                            width: calc(100% - var(--collapsed-sidebar-width, 4.5rem)) !important;
                            height: 4rem !important;
                            margin-left: auto !important;
                            left: auto !important;
                            right: 0 !important;
                            transition: width 0.2s ease !important;
                        }
                        .fi-topbar .fi-logo {
                            display: none !important;
                        }
                        body:has(.fi-main-ctn-sidebar-open) .fi-topbar {
                            width: calc(100% - var(--sidebar-width, 20rem)) !important;
                        }

                        /* Sidebar layout adjustment and collapse width overrides */
                        .fi-sidebar {
                            width: var(--collapsed-sidebar-width, 4.5rem) !important;
                            height: 100vh !important;
                            top: 0 !important;
                            left: 0 !important;
                            z-index: 50 !important;
                            position: fixed !important;
                            transition: width 0.2s ease !important;
                        }
                        .fi-sidebar.fi-sidebar-open {
                            width: var(--sidebar-width, 20rem) !important;
                        }
                        /* Reset collapsible sidebar horizontal padding when closed */
                        .fi-sidebar:not(.fi-sidebar-open) {
                            padding-left: 0 !important;
                            padding-right: 0 !important;
                        }
                        .fi-sidebar-header {
                            display: flex !important;
                            height: 4rem !important;
                            align-items: center !important;
                            justify-content: flex-start !important;
                            padding-left: 1.5rem !important;
                            transition: all 0.2s ease !important;
                        }

                        /* Override Filament inline height on logo container */
                        .fi-logo {
                            height: auto !important;
                            max-height: none !important;
                            width: auto !important;
                        }

                        /* Sidebar Logo Collapsed Behavior */
                        .fi-sidebar:not(.fi-sidebar-open) .fi-sidebar-header {
                            padding: 0 !important;
                            margin: 0 !important;
                            justify-content: center !important;
                            align-items: center !important;
                        }
                        .fi-sidebar:not(.fi-sidebar-open) .fi-sidebar-header-logo-ctn {
                            display: flex !important;
                            justify-content: center !important;
                            align-items: center !important;
                            width: 100% !important;
                            height: 100% !important;
                            padding: 0 !important;
                            margin: 0 !important;
                        }
                        .fi-sidebar:not(.fi-sidebar-open) .fi-sidebar-header-logo-ctn a {
                            display: flex !important;
                            justify-content: center !important;
                            align-items: center !important;
                            width: 100% !important;
                            height: auto !important;
                            padding: 0 !important;
                            margin: 0 !important;
                        }
                        .fi-sidebar:not(.fi-sidebar-open) .fi-logo {
                            display: flex !important;
                            justify-content: center !important;
                            align-items: center !important;
                            width: 100% !important;
                            padding: 0 !important;
                            margin: 0 !important;
                        }
                        .fi-sidebar:not(.fi-sidebar-open) .fi-logo > div {
                            display: flex !important;
                            justify-content: center !important;
                            align-items: center !important;
                            width: 100% !important;
                            gap: 0 !important;
                            padding: 0 !important;
                            margin: 0 !important;
                        }
                        .fi-sidebar:not(.fi-sidebar-open) .fi-sidebar-header img {
                            height: 2.5rem !important;
                            width: 2.5rem !important;
                            object-fit: contain !important;
                            margin: 0 auto !important;
                        }
                        .fi-sidebar:not(.fi-sidebar-open) .fi-logo-text {
                            display: none !important;
                        }
                    }

                    .fi-sidebar {
                        background: #F0F4F8 !important;
                        border-right: 1px solid #E2E8F0 !important;
                        box-shadow: none !important;
                        --tw-ring-shadow: none !important;
                        border-radius: 0 !important;
                    }
                    /* Sidebar Custom Footer (Help & Logout) */
                    .fi-sidebar-custom-footer {
                        border-top: 1px solid #E2E8F0 !important;
                        background-color: #F0F4F8 !important;
                        padding: 1.25rem 1.5rem !important;
                        display: flex !important;
                        flex-direction: column !important;
                        gap: 0.5rem !important;
                        transition: padding 0.2s ease !important;
                    }
                    /* Collapsed state padding & layout */
                    .fi-sidebar:not(.fi-sidebar-open) .fi-sidebar-custom-footer {
                        padding: 1rem 0 !important;
                        align-items: center !important;
                    }
                    .fi-sidebar-custom-footer-item {
                        display: flex !important;
                        align-items: center !important;
                        gap: 0.75rem !important;
                        padding: 0.625rem 1rem !important;
                        border-radius: 0.75rem !important;
                        font-size: 0.875rem !important;
                        font-weight: 600 !important;
                        text-decoration: none !important;
                        color: #475569 !important;
                        background: transparent !important;
                        border: none !important;
                        cursor: pointer !important;
                        text-align: left !important;
                        font-family: inherit !important;
                        width: 100% !important;
                        transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1) !important;
                    }
                    .fi-sidebar-custom-footer-item svg {
                        width: 1.25rem !important;
                        height: 1.25rem !important;
                        color: #64748B !important;
                        flex-shrink: 0 !important;
                        transition: color 0.2s ease !important;
                    }
                    .fi-sidebar-custom-footer-item:hover {
                        background: rgba(30, 136, 229, 0.08) !important;
                        color: #1E88E5 !important;
                    }
                    .fi-sidebar-custom-footer-item:hover svg {
                        color: #1E88E5 !important;
                    }
                    .fi-sidebar-custom-footer-item.logout-btn {
                        color: #EF4444 !important;
                    }
                    .fi-sidebar-custom-footer-item.logout-btn svg {
                        color: #EF4444 !important;
                    }
                    .fi-sidebar-custom-footer-item.logout-btn:hover {
                        background: rgba(239, 68, 68, 0.08) !important;
                        color: #DC2626 !important;
                    }
                    .fi-sidebar-custom-footer-item.logout-btn:hover svg {
                        color: #DC2626 !important;
                    }
                    /* Collapsed state item layout */
                    .fi-sidebar:not(.fi-sidebar-open) .fi-sidebar-custom-footer-item {
                        padding: 0 !important;
                        margin: 0 auto !important;
                        justify-content: center !important;
                        width: 2.75rem !important;
                        height: 2.75rem !important;
                        gap: 0 !important;
                    }
                    .fi-sidebar-nav {
                        background: transparent !important;
                        padding: 0 !important;
                    }
                    
                    /* Sidebar Group Containers Reset when Collapsed */
                    .fi-sidebar-nav-groups {
                        gap: 0.5rem !important;
                        padding: 0.75rem 0 !important;
                    }
                    .fi-sidebar:not(.fi-sidebar-open) .fi-sidebar-nav {
                        padding: 0 !important;
                        margin: 0 !important;
                    }
                    .fi-sidebar:not(.fi-sidebar-open) .fi-sidebar-nav-groups {
                        padding: 0.75rem 0 !important;
                        margin: 0 !important;
                        display: flex !important;
                        flex-direction: column !important;
                        align-items: center !important;
                        width: 100% !important;
                    }
                    .fi-sidebar:not(.fi-sidebar-open) .fi-sidebar-group {
                        padding: 0 !important;
                        margin: 0 !important;
                        width: 100% !important;
                        display: flex !important;
                        flex-direction: column !important;
                        align-items: center !important;
                    }
                    .fi-sidebar:not(.fi-sidebar-open) .fi-sidebar-group-items {
                        padding: 0 !important;
                        margin: 0 !important;
                        display: flex !important;
                        flex-direction: column !important;
                        align-items: center !important;
                        width: 100% !important;
                        gap: 0.375rem !important;
                    }

                    /* Sidebar Header / Brand */
                    .fi-sidebar-header {
                        border-bottom: 1px solid #E2E8F0 !important;
                        background: #F0F4F8 !important;
                    }

                    /* Sidebar Nav Items (Styled only when sidebar is open) */
                    .fi-sidebar.fi-sidebar-open .fi-sidebar-item {
                        border-radius: 0.75rem !important;
                        margin: 0.25rem 0.75rem !important;
                        transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1) !important;
                    }
                    .fi-sidebar.fi-sidebar-open .fi-sidebar-item a {
                        color: #475569 !important;
                        font-weight: 600 !important;
                        font-size: 0.875rem !important;
                        padding: 0.625rem 1rem !important;
                        border-radius: 0.75rem !important;
                        display: flex !important;
                        align-items: center !important;
                        gap: 0.75rem !important;
                        transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1) !important;
                    }

                    /* Collapsed sidebar nav items centering and sizing */
                    .fi-sidebar:not(.fi-sidebar-open) .fi-sidebar-item {
                        margin: 0.25rem 0 !important;
                        padding: 0 !important;
                        display: flex !important;
                        justify-content: center !important;
                        align-items: center !important;
                        width: 100% !important;
                    }
                    .fi-sidebar:not(.fi-sidebar-open) .fi-sidebar-item a {
                        padding: 0 !important;
                        margin: 0 auto !important;
                        display: flex !important;
                        justify-content: center !important;
                        align-items: center !important;
                        border-radius: 0.75rem !important;
                        width: 2.75rem !important;
                        height: 2.75rem !important;
                        transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1) !important;
                    }
                    .fi-sidebar:not(.fi-sidebar-open) .fi-sidebar-item-icon {
                        margin: 0 !important;
                    }

                    /* Active Nav Item Styling - Beautiful Premium Gradient & Glow */
                    .fi-sidebar-item.fi-active a,
                    .fi-sidebar-item a[aria-current="page"] {
                        background: linear-gradient(135deg, #1E88E5 0%, #1565C0 100%) !important;
                        color: #ffffff !important;
                        font-weight: 700 !important;
                        box-shadow: 0 4px 12px rgba(21, 101, 192, 0.25) !important;
                    }
                    .fi-sidebar:not(.fi-sidebar-open) .fi-sidebar-item.fi-active a,
                    .fi-sidebar:not(.fi-sidebar-open) .fi-sidebar-item a[aria-current="page"] {
                        background: linear-gradient(135deg, #1E88E5 0%, #1565C0 100%) !important;
                        color: #ffffff !important;
                        box-shadow: 0 4px 12px rgba(21, 101, 192, 0.35) !important;
                    }

                    /* Hover State for Inactive Items */
                    .fi-sidebar-item:not(.fi-active) a:hover,
                    .fi-sidebar-item:not([aria-current="page"]) a:hover {
                        color: #1E88E5 !important;
                        background: rgba(30, 136, 229, 0.08) !important;
                    }

                    /* White colors for active icons & text */
                    .fi-sidebar-item.fi-active a span,
                    .fi-sidebar-item a[aria-current="page"] span,
                    .fi-sidebar-item.fi-active a svg,
                    .fi-sidebar-item a[aria-current="page"] svg {
                        color: #ffffff !important;
                    }

                    /* Inactive Icon color */
                    .fi-sidebar-item:not(.fi-active) a svg {
                        color: #64748B !important;
                        transition: color 0.25s cubic-bezier(0.4, 0, 0.2, 1) !important;
                    }
                    .fi-sidebar-item:not(.fi-active) a:hover svg {
                        color: #1E88E5 !important;
                    }

                    .fi-sidebar-item .fi-icon {
                        color: inherit !important;
                    }
                    .fi-sidebar-item-icon {
                        width: 1.5rem !important;
                        height: 1.5rem !important;
                        flex-shrink: 0 !important;
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
                        box-shadow: none !important;
                    }
                    .fi-topbar nav {
                        background: transparent !important;
                    }

                    /* ---- Top Navbar Search Pill ---- */
                    .fi-global-search-field {
                        max-width: 20rem !important;
                        width: 100% !important;
                    }
                    .fi-global-search-field .fi-input-wrp {
                        border-radius: 9999px !important;
                        background-color: #F0F4F8 !important;
                        border: none !important;
                        box-shadow: none !important;
                    }
                    .fi-global-search-field .fi-input-wrp:focus-within {
                        background-color: #E2E8F0 !important;
                        box-shadow: none !important;
                    }

                    /* ---- Main Content Area ---- */
                    .fi-main {
                        background: #F4F6FA !important;
                        max-width: none !important;
                        width: 100% !important;
                        padding-left: 1rem !important;
                        padding-right: 1rem !important;
                    }
                    @media (min-width: 640px) {
                        .fi-main {
                            padding-left: 1.5rem !important;
                            padding-right: 1.5rem !important;
                        }
                    }
                    @media (min-width: 1024px) {
                        .fi-main {
                            padding-left: 2rem !important;
                            padding-right: 2rem !important;
                        }
                    }
                    .fi-main-ctn {
                        background: #F4F6FA !important;
                    }

                    /* ---- Page Header (Breadcrumbs & Title) ---- */
                    .fi-header {
                        margin-top: 0 !important;
                        margin-bottom: 0.5rem !important;
                    }
                    .fi-header-heading {
                        font-size: 1.5rem !important;
                        font-weight: 700 !important;
                        color: #121A21 !important;
                        letter-spacing: -0.01em !important;
                        margin: 0 !important;
                    }
                    .fi-page {
                        gap: 0.75rem !important;
                        margin-left: auto !important;
                        margin-right: auto !important;
                    }
                    .fi-breadcrumbs-item, .fi-breadcrumbs-item a {
                        color: #64748B !important;
                        font-size: 0.8rem !important;
                    }

                    /* ---- Cards / Sections (White with Rounded Corners & Soft Shadow) ---- */
                    .fi-section {
                        background: #ffffff !important;
                        border: 1px solid #E2E8F0 !important;
                        border-radius: 1rem !important;
                        box-shadow: 0px 4px 20px rgba(18, 26, 33, 0.04) !important;
                        overflow: visible !important;
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
                    .fi-wi, .fi-wi-widget {
                        background: transparent !important;
                        border: none !important;
                        box-shadow: none !important;
                        overflow: visible !important;
                    }

                    /* ---- Stats Overview Widgets ---- */
                    .fi-wi-stats-overview-stat {
                        background: #ffffff !important;
                        border: 1px solid #E2E8F0 !important;
                        border-radius: 1rem !important;
                        padding: 1.25rem !important;
                        box-shadow: 0px 4px 20px rgba(18, 26, 33, 0.04) !important;
                    }

                    /* ---- Table Styling ---- */
                    .fi-ta-ctn, .fi-ta-content {
                        border-radius: 1rem !important;
                        box-shadow: 0px 4px 20px rgba(18, 26, 33, 0.04) !important;
                        border: 1px solid #E2E8F0 !important;
                        background: #ffffff !important;
                    }

                    /* Align search field and filter on the left, header actions on the right in all standard tables */
                    @media (min-width: 768px) {
                        .fi-ta-header-ctn {
                            display: flex !important;
                            flex-direction: row !important;
                            flex-wrap: nowrap !important;
                            align-items: center !important;
                            justify-content: space-between !important;
                            gap: 1.5rem !important;
                            padding: 1.25rem 1.5rem !important;
                            border-bottom: 1px solid #F1F5F9 !important;
                            background: #ffffff !important;
                            border-top-left-radius: 1rem !important;
                            border-top-right-radius: 1rem !important;
                        }
                        .fi-ta-header {
                            order: 2 !important;
                            width: auto !important;
                            flex: none !important;
                            padding: 0 !important;
                            border: none !important;
                            border-top: none !important;
                            border-bottom: none !important;
                            margin: 0 !important;
                            background: transparent !important;
                        }
                        .fi-ta-header-toolbar {
                            order: 1 !important;
                            width: auto !important;
                            flex-grow: 1 !important;
                            display: flex !important;
                            align-items: center !important;
                            justify-content: flex-start !important;
                            padding: 0 !important;
                            margin: 0 !important;
                            border: none !important;
                            border-top: none !important;
                            border-bottom: none !important;
                            background: transparent !important;
                            box-shadow: none !important;
                        }
                        .fi-ta-header-toolbar > div {
                            display: flex !important;
                            align-items: center !important;
                            gap: 1rem !important;
                            margin: 0 !important;
                            border: none !important;
                            border-top: none !important;
                            border-bottom: none !important;
                        }
                        .fi-ta-search-field {
                            width: 22rem !important;
                            max-width: 100% !important;
                            border: none !important;
                            margin: 0 !important;
                        }
                        .fi-ta-search-field .fi-input-wrp {
                            height: 2.5rem !important; /* Match height of action buttons */
                            border: 1px solid #E2E8F0 !important;
                            box-shadow: none !important;
                        }
                        .fi-ta-filters-trigger-action-ctn,
                        .fi-ta-filters-modal,
                        .fi-ta-filters-dropdown {
                            display: inline-flex !important;
                            align-items: center !important;
                            justify-content: center !important;
                            margin: 0 !important;
                            border: none !important;
                        }
                    }

                    .fi-wi-widget .fi-ta-ctn {
                        border-radius: 1rem !important;
                        box-shadow: 0px 4px 20px rgba(18, 26, 33, 0.04) !important;
                        border: 1px solid #E2E8F0 !important;
                        background: #ffffff !important;
                    }
                    .fi-wi-widget .fi-ta-content {
                        border-radius: 0 !important;
                        box-shadow: none !important;
                        border: none !important;
                        background: transparent !important;
                    }

                    /* Align search field and header actions in table widgets in a single row on desktop/tablet */
                    @media (min-width: 768px) {
                        .fi-wi-widget .fi-ta-header-ctn {
                            display: flex !important;
                            flex-direction: row !important;
                            align-items: center !important;
                            justify-content: space-between !important;
                            gap: 1rem !important;
                            padding: 1.25rem 1.5rem !important;
                            border-bottom: 1px solid #F1F5F9 !important;
                            background: #ffffff !important;
                            border-top-left-radius: 1rem !important;
                            border-top-right-radius: 1rem !important;
                        }
                        .fi-wi-widget .fi-ta-header {
                            display: contents !important;
                        }
                        .fi-wi-widget .fi-ta-header > div:first-child {
                            display: flex !important;
                            flex-direction: column !important;
                            gap: 0.25rem !important;
                            order: 1 !important;
                        }
                        .fi-wi-widget .fi-ta-header-toolbar {
                            display: flex !important;
                            align-items: center !important;
                            justify-content: flex-end !important;
                            padding: 0 !important;
                            margin: 0 !important;
                            margin-left: auto !important; /* Push search and buttons to the right */
                            border: none !important;
                            border-top: none !important;
                            border-bottom: none !important;
                            background: transparent !important;
                            order: 2 !important;
                            box-shadow: none !important;
                        }
                        .fi-wi-widget .fi-ta-header-toolbar > div {
                            margin: 0 !important;
                            width: 100% !important;
                            border: none !important;
                        }
                        .fi-wi-widget .fi-ta-search-field {
                            width: 22rem !important;
                            max-width: 100% !important;
                            border: none !important;
                            transform: translateY(4px) !important; /* Nudge down to align perfectly with buttons */
                        }
                        .fi-wi-widget .fi-ta-search-field .fi-input-wrp {
                            height: 2.5rem !important; /* Match height of buttons */
                            border: 1px solid #E2E8F0 !important;
                            box-shadow: none !important;
                        }
                        .fi-wi-widget .fi-ta-actions {
                            display: flex !important;
                            flex-direction: row !important;
                            align-items: center !important;
                            gap: 0.75rem !important;
                            padding: 0 !important;
                            margin: 0 !important;
                            order: 3 !important;
                        }
                        .fi-wi-widget .fi-ta-actions .fi-btn {
                            height: 2.5rem !important; /* Force exact same height as search input wrapper */
                            padding-top: 0 !important;
                            padding-bottom: 0 !important;
                            display: inline-flex !important;
                            align-items: center !important;
                            justify-content: center !important;
                        }
                    }
                    .fi-ta-header-cell {
                        background: #F8FAFC !important;
                        font-weight: 700 !important;
                        font-size: 0.75rem !important;
                        color: #64748B !important;
                        text-transform: uppercase !important;
                        letter-spacing: 0.05em !important;
                        border-bottom: 1px solid #E2E8F0 !important;
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
                        background: #0077ce !important;
                        box-shadow: 0 2px 8px rgba(0, 119, 206, 0.25) !important;
                        border: none !important;
                        color: #ffffff !important;
                    }
                    .fi-btn-primary:hover {
                        box-shadow: 0 4px 16px rgba(0, 119, 206, 0.35) !important;
                        background: #0060a3 !important;
                    }
                    .fi-btn-primary, .fi-btn-primary * {
                        color: #ffffff !important;
                    }

                    /* ---- Input Fields (Formulir) ---- */
                    .fi-input-wrp {
                        border-radius: 0.625rem !important;
                        border: 1px solid #E2E8F0 !important;
                        background: #F8FAFD !important;
                        transition: all 0.2s ease !important;
                    }
                    .fi-input-wrp:hover {
                        border-color: #CBD5E1 !important;
                        background: #F1F5F9 !important;
                    }
                    .fi-input-wrp:focus-within {
                        border-color: #0077ce !important;
                        background: #ffffff !important;
                        box-shadow: 0 0 0 3px rgba(0, 119, 206, 0.12) !important;
                    }
                    .fi-input {
                        font-size: 0.9rem !important;
                        color: #121A21 !important;
                        background: transparent !important;
                    }
                    /* Textarea specific */
                    .fi-fo-textarea textarea {
                        background: transparent !important;
                        resize: vertical !important;
                        min-height: 8rem !important;
                    }
                    /* Select dropdown styling */
                    .fi-select-input {
                        background: transparent !important;
                    }
                    /* DatePicker */
                    .fi-fo-date-picker input {
                        background: transparent !important;
                    }

                    /* ---- File Upload / FilePond Drag & Drop Area ---- */
                    .filepond--root {
                        border-radius: 0.875rem !important;
                        font-family: \'Plus Jakarta Sans\', sans-serif !important;
                        margin-bottom: 0 !important;
                    }
                    .filepond--panel-root {
                        background-color: #EFF6FF !important;
                        border: 2px dashed #93C5FD !important;
                        border-radius: 0.875rem !important;
                        transition: all 0.2s ease !important;
                    }
                    .filepond--root:hover .filepond--panel-root {
                        background-color: #DBEAFE !important;
                        border-color: #60A5FA !important;
                    }
                    .filepond--root.filepond--hopper[data-is-drag-over] .filepond--panel-root {
                        background-color: #DBEAFE !important;
                        border-color: #3B82F6 !important;
                    }
                    .filepond--drop-label {
                        color: #3B82F6 !important;
                        min-height: 7rem !important;
                    }
                    .filepond--drop-label label {
                        color: #3B82F6 !important;
                        font-weight: 600 !important;
                        font-size: 0.9rem !important;
                        cursor: pointer !important;
                    }
                    .filepond--label-action {
                        color: #0077ce !important;
                        text-decoration-color: #0077ce !important;
                        font-weight: 600 !important;
                    }
                    .filepond--label-action:hover {
                        color: #0060a3 !important;
                    }
                    /* Upload progress and error states */
                    .filepond--item-panel {
                        background-color: #0077ce !important;
                        border-radius: 0.5rem !important;
                    }
                    .filepond--file-action-button {
                        background-color: rgba(0, 0, 0, 0.2) !important;
                    }
                    /* Helper text below upload */
                    .fi-fo-file-upload + .fi-fo-field-wrp-helper-text {
                        color: #64748B !important;
                        font-size: 0.8rem !important;
                        margin-top: 0.375rem !important;
                    }


                    .fi-badge {
                        border-radius: 9999px !important;
                        font-weight: 600 !important;
                        font-size: 0.75rem !important;
                        padding: 0.25rem 0.75rem !important;
                        letter-spacing: 0.02em !important;
                    }

                    /* ---- Modal / Overlay ---- */
                    .fi-modal {
                        z-index: 60 !important;
                    }
                    .fi-modal-close-overlay {
                        z-index: 60 !important;
                    }
                    .fi-modal-window-ctn {
                        z-index: 70 !important;
                    }
                    .fi-modal-window {
                        border-radius: 1.25rem !important;
                        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15) !important;
                        z-index: 71 !important;
                        margin-top: 2.5rem !important;
                    }

                    /* ---- Tabs ---- */
                    .fi-tabs-tab {
                        font-weight: 600 !important;
                        font-size: 0.875rem !important;
                        border-radius: 0.5rem 0.5rem 0 0 !important;
                        transition: all 0.2s ease !important;
                    }

                    /* ---- Notification ---- */
                    .fi-no-notification-ctn,
                    .fi-no {
                        border-radius: 0.75rem !important;
                        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1) !important;
                        z-index: 9999 !important;
                    }

                    /* ---- Footer Branding ---- */
                    .fi-footer {
                        background: transparent !important;
                        border-top: 1px solid #E2E8F0 !important;
                        color: #94A3B8 !important;
                        font-size: 0.75rem !important;
                    }

                    /* Force sticky layout for LKP Report Info column */
                    .filament-sticky-col {
                        position: -webkit-sticky !important; /* Safari support */
                        position: sticky !important;
                        top: 5rem !important; /* 80px offset from viewport top */
                        align-self: start !important;
                    }

                    /* Enable sticky columns on Filament pages by making all ancestors overflow-visible */
                    body:has(.filament-sticky-col) *:has(> .filament-sticky-col),
                    body:has(.filament-sticky-col) *:has(> * > .filament-sticky-col),
                    body:has(.filament-sticky-col) *:has(> * > * > .filament-sticky-col),
                    body:has(.filament-sticky-col) *:has(> * > * > * > .filament-sticky-col),
                    body:has(.filament-sticky-col) *:has(> * > * > * > * > .filament-sticky-col),
                    body:has(.filament-sticky-col) *:has(> * > * > * > * > * > .filament-sticky-col),
                    body:has(.filament-sticky-col) *:has(> * > * > * > * > * > * > .filament-sticky-col),
                    body:has(.filament-sticky-col) *:has(> * > * > * > * > * > * > * > .filament-sticky-col) {
                        overflow: visible !important;
                    }
                </style>
                ')
                    : ''
            )
            ->renderHook(
                PanelsRenderHook::SIDEBAR_FOOTER,
                fn (): string => !request()->is('*/login', '*/register')
                    ? view('filament.sidebar-footer')->render()
                    : ''
            )
            ->renderHook(
                PanelsRenderHook::BODY_END,
                fn (): string => !request()->is('*/login', '*/register')
                    ? '
                    <script>
                        if (!window.hasFilamentFilterAutoCloseListener) {
                            window.hasFilamentFilterAutoCloseListener = true;
                            document.addEventListener("click", (e) => {
                                const target = e.target;
                                const filterAction = target.closest(\'[wire\\\\:click="resetTableFiltersForm"]\') || 
                                                     target.closest(\'[wire\\\\:click="applyTableFilters"]\') ||
                                                     (target.closest(\'button[type="submit"]\') && target.closest(\'.fi-ta-filters\'));
                                                     
                                if (filterAction) {
                                    const dropdown = target.closest(\'.fi-dropdown\');
                                    if (dropdown && window.Alpine) {
                                        const alpineData = window.Alpine.$data(dropdown);
                                        if (alpineData && typeof alpineData.close === "function") {
                                            alpineData.close();
                                        }
                                    }
                                }
                            });
                        }
                    </script>
                    '
                    : '
                    <a href="/" class="back-to-home">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" style="width: 1.15rem; height: 1.15rem; display: inline-block; vertical-align: middle;">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                        </svg>
                        <span style="display: inline-block; vertical-align: middle; margin-left: 0.125rem;">Kembali ke Halaman Awal</span>
                    </a>
                    '
            )
            ->renderHook(
                'panels::body.end',
                fn (): HtmlString => new HtmlString('
                <style>
                    .fi-no {
                        box-shadow: none !important;
                        border: none !important;
                        pointer-events: none !important;
                    }
                    .fi-no-notification {
                        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1) !important;
                        border: 1px solid rgba(0, 0, 0, 0.05) !important;
                        pointer-events: auto !important;
                    }
                </style>
                ')
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
                FilamentShieldPlugin::make()
                    ->navigationGroup(fn () => null)
                    ->navigationSort(2),
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
