<x-filament-widgets::widget>
    <style>
        .pkk-stats-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1rem;
            width: 100%;
        }
        @media (min-width: 640px) {
            .pkk-stats-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 1.25rem;
            }
        }
        @media (min-width: 1024px) {
            .pkk-stats-grid {
                grid-template-columns: repeat(4, 1fr);
                gap: 1.5rem;
            }
        }
    </style>

    <div class="pkk-stats-grid">
        
        <!-- Card 1: Total Laporan -->
        <div style="background: #ffffff; border: 1px solid #E2E8F0; border-radius: 1rem; padding: 1.5rem; display: flex; flex-direction: column; gap: 0.75rem; box-shadow: 0px 4px 20px rgba(18, 26, 33, 0.04);">
            <div style="display: flex; justify-content: flex-start; align-items: center; width: 100%;">
                <div style="width: 2.75rem; height: 2.75rem; border-radius: 0.75rem; background-color: #E3F2FD; display: flex; align-items: center; justify-content: center;">
                    <svg style="width: 1.5rem; height: 1.5rem; color: #1E88E5;" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                    </svg>
                </div>
            </div>
            <div>
                <p style="font-size: 0.875rem; font-weight: 600; color: #64748B; margin: 0;">Total Laporan</p>
                <h3 style="font-size: 2rem; font-weight: 800; color: #0F172A; margin: 0.25rem 0 0 0; letter-spacing: -0.03em;">{{ $totalReports }}</h3>
            </div>
        </div>

        <!-- Card 2: Laporan Bulan Ini -->
        <div style="background: #ffffff; border: 1px solid #E2E8F0; border-radius: 1rem; padding: 1.5rem; display: flex; flex-direction: column; gap: 0.75rem; box-shadow: 0px 4px 20px rgba(18, 26, 33, 0.04);">
            <div style="display: flex; justify-content: flex-start; align-items: center; width: 100%;">
                <div style="width: 2.75rem; height: 2.75rem; border-radius: 0.75rem; background-color: #FFF8E1; display: flex; align-items: center; justify-content: center;">
                    <svg style="width: 1.5rem; height: 1.5rem; color: #FFB300;" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                    </svg>
                </div>
            </div>
            <div>
                <p style="font-size: 0.875rem; font-weight: 600; color: #64748B; margin: 0;">Laporan Bulan Ini</p>
                <h3 style="font-size: 2rem; font-weight: 800; color: #0F172A; margin: 0.25rem 0 0 0; letter-spacing: -0.03em;">{{ $monthlyReports }}</h3>
            </div>
        </div>

        <!-- Card 3: Total Kecamatan -->
        <div style="background: #ffffff; border: 1px solid #E2E8F0; border-radius: 1rem; padding: 1.5rem; display: flex; flex-direction: column; gap: 0.75rem; box-shadow: 0px 4px 20px rgba(18, 26, 33, 0.04);">
            <div style="display: flex; justify-content: flex-start; align-items: center; width: 100%;">
                <div style="width: 2.75rem; height: 2.75rem; border-radius: 0.75rem; background-color: #E0F7FA; display: flex; align-items: center; justify-content: center;">
                    <svg style="width: 1.5rem; height: 1.5rem; color: #00ACC1;" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                    </svg>
                </div>
            </div>
            <div>
                <p style="font-size: 0.875rem; font-weight: 600; color: #64748B; margin: 0;">Total Kecamatan</p>
                <h3 style="font-size: 2rem; font-weight: 800; color: #0F172A; margin: 0.25rem 0 0 0; letter-spacing: -0.03em;">{{ $totalKecamatan }}</h3>
            </div>
        </div>

        <!-- Card 4: Total Bidang -->
        <div style="background: #ffffff; border: 1px solid #E2E8F0; border-radius: 1rem; padding: 1.5rem; display: flex; flex-direction: column; gap: 0.75rem; box-shadow: 0px 4px 20px rgba(18, 26, 33, 0.04);">
            <div style="display: flex; justify-content: flex-start; align-items: center; width: 100%;">
                <div style="width: 2.75rem; height: 2.75rem; border-radius: 0.75rem; background-color: #F1F5F9; display: flex; align-items: center; justify-content: center;">
                    <svg style="width: 1.5rem; height: 1.5rem; color: #475569;" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
                    </svg>
                </div>
            </div>
            <div>
                <p style="font-size: 0.875rem; font-weight: 600; color: #64748B; margin: 0;">Total Bidang</p>
                <h3 style="font-size: 2rem; font-weight: 800; color: #0F172A; margin: 0.25rem 0 0 0; letter-spacing: -0.03em;">{{ $totalBidang }}</h3>
            </div>
        </div>

    </div>
</x-filament-widgets::widget>
