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
        
        /* Custom scrollbar for custom dropdowns */
        .custom-dropdown-list::-webkit-scrollbar {
            width: 5px;
        }
        .custom-dropdown-list::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 99px;
        }
        .custom-dropdown-list::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 99px;
        }
        .custom-dropdown-list::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
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

        <!-- Card 2: Laporan Bulan Ini / Terfilter -->
        <div style="background: #ffffff; border: 1px solid #E2E8F0; border-radius: 1rem; padding: 1.5rem; display: flex; flex-direction: column; gap: 0.75rem; box-shadow: 0px 4px 20px rgba(18, 26, 33, 0.04);">
            <div style="display: flex; justify-content: space-between; align-items: center; width: 100%;">
                <div style="width: 2.75rem; height: 2.75rem; border-radius: 0.75rem; background-color: #FFF8E1; display: flex; align-items: center; justify-content: center;">
                    <svg style="width: 1.5rem; height: 1.5rem; color: #FFB300;" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                    </svg>
                </div>
                <div style="display: flex; gap: 0.375rem;">
                    @if($isFiltered)
                        <button wire:click="resetFilter" type="button" style="color: #EF4444; padding: 0.35rem; border-radius: 0.5rem; background-color: #FEF2F2; border: 1px solid #FEE2E2; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: all 0.2s;" onmouseover="this.style.color='#DC2626'; this.style.backgroundColor='#FEE2E2'" onmouseout="this.style.color='#EF4444'; this.style.backgroundColor='#FEF2F2'" title="Reset ke Bulan Ini">
                            <svg style="width: 1rem; height: 1rem;" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                            </svg>
                        </button>
                    @endif
                    <button wire:click="openFilter" type="button" style="color: #64748B; padding: 0.35rem; border-radius: 0.5rem; background-color: #F8FAFC; border: 1px solid #E2E8F0; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: all 0.2s;" onmouseover="this.style.color='#1E88E5'; this.style.borderColor='#90CAF9'; this.style.backgroundColor='#E3F2FD'" onmouseout="this.style.color='#64748B'; this.style.borderColor='#E2E8F0'; this.style.backgroundColor='#F8FAFC'" title="Filter Bulan & Tahun">
                        <svg style="width: 1rem; height: 1rem;" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 01-.659 1.591l-5.432 5.432a2.25 2.25 0 00-.659 1.591v2.927a2.25 2.25 0 01-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 00-.659-1.591L3.659 7.409A2.25 2.25 0 013 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0112 3z" />
                        </svg>
                    </button>
                </div>
            </div>
            <div>
                <p style="font-size: 0.875rem; font-weight: 600; color: #64748B; margin: 0;">{{ $monthlyLabel }}</p>
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

    <!-- Modal Filter -->
    @if($showFilterModal)
        <div style="position: fixed; inset: 0; background-color: rgba(15, 23, 42, 0.4); backdrop-filter: blur(4px); display: flex; align-items: center; justify-content: center; z-index: 9999;">
            <div style="background-color: #ffffff; border-radius: 1rem; box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04); border: 1px solid #E2E8F0; width: 100%; max-width: 24rem; padding: 1.75rem; display: flex; flex-direction: column; gap: 1.5rem; position: relative;">
                
                <!-- Close Button -->
                <button wire:click="closeFilter" type="button" style="position: absolute; top: 1.25rem; right: 1.25rem; color: #94A3B8; cursor: pointer; background: transparent; border: none; padding: 0; outline: none; transition: color 0.15s;" onmouseover="this.style.color='#475569'" onmouseout="this.style.color='#94A3B8'">
                    <svg style="width: 1.25rem; height: 1.25rem;" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>

                <!-- Header -->
                <div>
                    <h4 style="font-size: 1.125rem; font-weight: 700; color: #0F172A; margin: 0;">Filter Laporan</h4>
                    <p style="font-size: 0.8125rem; color: #64748B; margin: 0.25rem 0 0 0;">Pilih bulan dan tahun laporan yang ingin ditampilkan.</p>
                </div>

                <!-- Form dengan Dropdown Kustom AlpineJS -->
                <div style="display: flex; flex-direction: column; gap: 1.25rem;">
                    
                    <!-- Custom Select Month -->
                    <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                        <label style="font-size: 0.75rem; font-weight: 700; color: #0A2E5C; letter-spacing: 0.05em;">PILIH BULAN</label>
                        <div x-data="{ openMonth: false }" class="relative" style="position: relative; width: 100%;">
                            <!-- Trigger Button -->
                            <button @click="openMonth = !openMonth" type="button" style="width: 100%; border: 1px solid #E2E8F0; border-radius: 0.625rem; padding: 0.625rem 0.875rem; font-size: 0.875rem; background-color: #F8FAFC; color: #0F172A; text-align: left; display: flex; justify-content: space-between; align-items: center; cursor: pointer; outline: none; transition: all 0.2s;" onmouseover="this.style.borderColor='#CBD5E1'; this.style.backgroundColor='#F1F5F9';" onmouseout="this.style.borderColor='#E2E8F0'; this.style.backgroundColor='#F8FAFC';">
                                <span>{{ $this->getMonths()[$tempMonth] }}</span>
                                <svg style="width: 1rem; height: 1rem; color: #64748B;" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                </svg>
                            </button>
                            <!-- List Dropdown -->
                            <div x-show="openMonth" @click.away="openMonth = false" x-transition style="position: absolute; left: 0; right: 0; z-index: 9999; margin-top: 0.375rem; background-color: #ffffff; border: 1px solid #E2E8F0; border-radius: 0.625rem; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.08), 0 4px 6px -2px rgba(0, 0, 0, 0.04); max-height: 12rem; overflow-y: auto; display: flex; flex-direction: column; padding: 0.375rem;" class="custom-dropdown-list">
                                @foreach($this->getMonths() as $key => $name)
                                    <button @click="$wire.set('tempMonth', {{ $key }}); openMonth = false" type="button" style="width: 100%; text-align: left; padding: 0.5rem 0.75rem; font-size: 0.875rem; color: #334155; background: transparent; border: none; border-radius: 0.375rem; cursor: pointer; transition: all 0.15s; font-family: inherit;" onmouseover="this.style.backgroundColor='#F1F5F9'; this.style.color='#1E88E5';" onmouseout="this.style.backgroundColor='transparent'; this.style.color='#334155';">
                                        {{ $name }}
                                    </button>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Custom Select Year -->
                    <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                        <label style="font-size: 0.75rem; font-weight: 700; color: #0A2E5C; letter-spacing: 0.05em;">PILIH TAHUN</label>
                        <div x-data="{ openYear: false }" class="relative" style="position: relative; width: 100%;">
                            <!-- Trigger Button -->
                            <button @click="openYear = !openYear" type="button" style="width: 100%; border: 1px solid #E2E8F0; border-radius: 0.625rem; padding: 0.625rem 0.875rem; font-size: 0.875rem; background-color: #F8FAFC; color: #0F172A; text-align: left; display: flex; justify-content: space-between; align-items: center; cursor: pointer; outline: none; transition: all 0.2s;" onmouseover="this.style.borderColor='#CBD5E1'; this.style.backgroundColor='#F1F5F9';" onmouseout="this.style.borderColor='#E2E8F0'; this.style.backgroundColor='#F8FAFC';">
                                <span>{{ $tempYear }}</span>
                                <svg style="width: 1rem; height: 1rem; color: #64748B;" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                </svg>
                            </button>
                            <!-- List Dropdown -->
                            <div x-show="openYear" @click.away="openYear = false" x-transition style="position: absolute; left: 0; right: 0; z-index: 9999; margin-top: 0.375rem; background-color: #ffffff; border: 1px solid #E2E8F0; border-radius: 0.625rem; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.08), 0 4px 6px -2px rgba(0, 0, 0, 0.04); max-height: 12rem; overflow-y: auto; display: flex; flex-direction: column; padding: 0.375rem;" class="custom-dropdown-list">
                                @for($y = now()->year; $y >= 2023; $y--)
                                    <button @click="$wire.set('tempYear', {{ $y }}); openYear = false" type="button" style="width: 100%; text-align: left; padding: 0.5rem 0.75rem; font-size: 0.875rem; color: #334155; background: transparent; border: none; border-radius: 0.375rem; cursor: pointer; transition: all 0.15s; font-family: inherit;" onmouseover="this.style.backgroundColor='#F1F5F9'; this.style.color='#1E88E5';" onmouseout="this.style.backgroundColor='transparent'; this.style.color='#334155';">
                                        {{ $y }}
                                    </button>
                                @endfor
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Footer Buttons -->
                <div style="display: flex; gap: 0.75rem; margin-top: 0.5rem;">
                    <button wire:click="applyFilter" type="button" style="flex: 1; background: linear-gradient(135deg, #1E88E5 0%, #1565C0 100%); color: #ffffff; font-weight: 700; font-size: 0.85rem; border-radius: 0.625rem; padding: 0.65rem 1.25rem; border: none; cursor: pointer; box-shadow: 0 4px 12px rgba(30, 136, 229, 0.2); transition: all 0.2s; font-family: inherit;" onmouseover="this.style.transform='translateY(-1px)';" onmouseout="this.style.transform='none';">
                        Terapkan
                    </button>
                    <button wire:click="closeFilter" type="button" style="flex: 1; background-color: #F1F5F9; color: #475569; font-weight: 600; font-size: 0.85rem; border-radius: 0.625rem; padding: 0.65rem 1.25rem; border: 1px solid #E2E8F0; cursor: pointer; transition: all 0.2s; font-family: inherit;" onmouseover="this.style.backgroundColor='#E2E8F0';" onmouseout="this.style.backgroundColor='#F1F5F9';">
                        Batal
                    </button>
                </div>

            </div>
        </div>
    @endif
</x-filament-widgets::widget>
