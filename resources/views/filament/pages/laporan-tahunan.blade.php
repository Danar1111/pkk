<x-filament-panels::page>
    <div class="flex flex-col items-center justify-center p-8 bg-white rounded-xl shadow border border-gray-100 dark:bg-gray-800 dark:border-gray-700">
        <h2 class="text-xl font-bold mb-4 text-gray-800 dark:text-white">Laporan Tahunan</h2>
        <p class="text-gray-600 dark:text-gray-400 mb-6 text-center">Anda akan diarahkan ke dokumen Laporan Tahunan. Jika tidak terbuka secara otomatis, silakan klik tombol di bawah ini.</p>
        <a href="{{ \App\Models\AnnualReportSetting::getUrl() }}" target="_blank" class="fi-btn fi-btn-primary inline-flex items-center justify-center" style="max-width: 200px;">
            Buka Laporan Tahunan
        </a>
    </div>
</x-filament-panels::page>
