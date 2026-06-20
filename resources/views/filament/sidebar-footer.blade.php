<div class="fi-sidebar-custom-footer" x-data="{}">
    <form action="{{ filament()->getLogoutUrl() }}" method="POST" style="width: 100%; margin: 0;">
        @csrf
        <button type="submit" class="fi-sidebar-custom-footer-item logout-btn">
            <svg fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
            </svg>
            <span x-show="$store.sidebar.isOpen" x-transition.opacity>Keluar</span>
        </button>
    </form>
</div>
