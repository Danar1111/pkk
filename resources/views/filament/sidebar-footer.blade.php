<div class="fi-sidebar-custom-footer" x-data="{}">
    <a href="#" class="fi-sidebar-custom-footer-item">
        <svg fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9 5.25h.008v.008H12v-.008z" />
        </svg>
        <span x-show="$store.sidebar.isOpen" x-transition.opacity>Bantuan</span>
    </a>
    
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
