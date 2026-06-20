<x-filament-widgets::widget>
    <style>
        .pkk-stats-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 0.75rem;
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

        /* Custom modal details animations and responsive bottom sheet */
        .custom-details-modal-overlay {
            animation: custom-fade-in 0.25s ease-out;
        }

        .custom-details-modal-card {
            animation: custom-zoom-in 0.25s ease-out;
        }

        @keyframes custom-fade-in {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes custom-zoom-in {
            from { transform: scale(0.95); opacity: 0; }
            to { transform: scale(1); opacity: 1; }
        }

        @keyframes custom-slide-up {
            from { transform: translateY(100%); }
            to { transform: translateY(0); }
        }

        @media (max-width: 639px) {
            .custom-details-modal-overlay {
                align-items: flex-end !important;
            }
            .custom-details-modal-card {
                border-radius: 1.5rem 1.5rem 0 0 !important;
                margin-bottom: 0 !important;
                max-height: 90vh !important;
                width: 100% !important;
                max-width: 100% !important;
                animation: custom-slide-up 0.3s cubic-bezier(0.16, 1, 0.3, 1) !important;
            }
            .pkk-stat-card {
                padding: 1rem !important;
                gap: 0.5rem !important;
            }
            .pkk-stat-icon-wrapper {
                width: 2.25rem !important;
                height: 2.25rem !important;
                border-radius: 0.5rem !important;
            }
            .pkk-stat-icon-wrapper svg {
                width: 1.25rem !important;
                height: 1.25rem !important;
            }
            .pkk-stat-title {
                font-size: 0.75rem !important;
            }
            .pkk-stat-value {
                font-size: 1.5rem !important;
                margin-top: 0.125rem !important;
            }
            .pkk-stat-footer {
                display: none !important;
            }
            .pkk-stat-detail-badge {
                font-size: 0.6rem !important;
                padding: 0.2rem 0.35rem !important;
                border-radius: 0.375rem !important;
            }
        }
    </style>

    <div class="pkk-stats-grid">
        
        <!-- Card 1: Total Laporan -->
        <div class="pkk-stat-card" style="background: #ffffff; border: 1px solid #E2E8F0; border-radius: 1rem; padding: 1.5rem; display: flex; flex-direction: column; gap: 0.75rem; box-shadow: 0px 4px 20px rgba(18, 26, 33, 0.04);">
            <div style="display: flex; justify-content: flex-start; align-items: center; width: 100%;">
                <div class="pkk-stat-icon-wrapper" style="width: 2.75rem; height: 2.75rem; border-radius: 0.75rem; background-color: #E3F2FD; display: flex; align-items: center; justify-content: center;">
                    <svg style="width: 1.5rem; height: 1.5rem; color: #1E88E5;" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                    </svg>
                </div>
            </div>
            <div>
                <p class="pkk-stat-title" style="font-size: 0.875rem; font-weight: 600; color: #64748B; margin: 0;">Total Laporan</p>
                <h3 class="pkk-stat-value" style="font-size: 2rem; font-weight: 800; color: #0F172A; margin: 0.25rem 0 0 0; letter-spacing: -0.03em;">{{ $totalReports }}</h3>
            </div>
        </div>

        <!-- Card 2: Laporan Bulan Ini / Terfilter -->
        <div class="pkk-stat-card" style="background: #ffffff; border: 1px solid #E2E8F0; border-radius: 1rem; padding: 1.5rem; display: flex; flex-direction: column; gap: 0.75rem; box-shadow: 0px 4px 20px rgba(18, 26, 33, 0.04);">
            <div style="display: flex; justify-content: space-between; align-items: center; width: 100%;">
                <div class="pkk-stat-icon-wrapper" style="width: 2.75rem; height: 2.75rem; border-radius: 0.75rem; background-color: #FFF8E1; display: flex; align-items: center; justify-content: center;">
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
                <p class="pkk-stat-title" style="font-size: 0.875rem; font-weight: 600; color: #64748B; margin: 0;">{{ $monthlyLabel }}</p>
                <h3 class="pkk-stat-value" style="font-size: 2rem; font-weight: 800; color: #0F172A; margin: 0.25rem 0 0 0; letter-spacing: -0.03em;">{{ $monthlyReports }}</h3>
            </div>
        </div>

        <!-- Card 3: Total Kecamatan -->
        <div class="pkk-stat-card" style="background: #ffffff; border: 1px solid #E2E8F0; border-radius: 1rem; padding: 1.5rem; display: flex; flex-direction: column; gap: 0.75rem; box-shadow: 0px 4px 20px rgba(18, 26, 33, 0.04);">
            <div style="display: flex; justify-content: flex-start; align-items: center; width: 100%;">
                <div class="pkk-stat-icon-wrapper" style="width: 2.75rem; height: 2.75rem; border-radius: 0.75rem; background-color: #E0F7FA; display: flex; align-items: center; justify-content: center;">
                    <svg style="width: 1.5rem; height: 1.5rem; color: #00ACC1;" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                    </svg>
                </div>
            </div>
            <div>
                <p class="pkk-stat-title" style="font-size: 0.875rem; font-weight: 600; color: #64748B; margin: 0;">Total Kecamatan</p>
                <h3 class="pkk-stat-value" style="font-size: 2rem; font-weight: 800; color: #0F172A; margin: 0.25rem 0 0 0; letter-spacing: -0.03em;">{{ $totalKecamatan }}</h3>
            </div>
        </div>

        <!-- Card 4: Bidang Terlapor (Clickable) -->
        <div class="pkk-stat-card" wire:click="openDetails" style="background: #ffffff; border: 1px solid #E2E8F0; border-radius: 1rem; padding: 1.5rem; display: flex; flex-direction: column; gap: 0.75rem; box-shadow: 0px 4px 20px rgba(18, 26, 33, 0.04); cursor: pointer; transition: all 0.25s ease;" onmouseover="this.style.transform='translateY(-2px)'; this.style.borderColor='#90CAF9'; this.style.boxShadow='0px 8px 30px rgba(30, 136, 229, 0.1)';" onmouseout="this.style.transform='none'; this.style.borderColor='#E2E8F0'; this.style.boxShadow='0px 4px 20px rgba(18, 26, 33, 0.04)';">
            <div style="display: flex; justify-content: space-between; align-items: center; width: 100%;">
                <div class="pkk-stat-icon-wrapper" style="width: 2.75rem; height: 2.75rem; border-radius: 0.75rem; background-color: #F1F5F9; display: flex; align-items: center; justify-content: center;">
                    <svg style="width: 1.5rem; height: 1.5rem; color: #475569;" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-3.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
                    </svg>
                </div>
                <div class="pkk-stat-detail-badge" style="color: #1E88E5; padding: 0.35rem 0.5rem; border-radius: 0.5rem; background-color: #E3F2FD; border: 1px solid #BBDEFB; display: flex; align-items: center; justify-content: center; font-size: 0.7rem; font-weight: 800; letter-spacing: 0.05em; text-transform: uppercase;">
                    Detail
                </div>
            </div>
            <div>
                <p class="pkk-stat-title" style="font-size: 0.875rem; font-weight: 600; color: #64748B; margin: 0;">{{ $bidangLabel }}</p>
                <h3 class="pkk-stat-value" style="font-size: 2rem; font-weight: 800; color: #0F172A; margin: 0.25rem 0 0 0; letter-spacing: -0.03em;">{{ $reportedBidangCount }} / {{ $totalBidangCount }}</h3>
                <span class="pkk-stat-footer" style="font-size: 0.75rem; color: #94A3B8; font-weight: 500; display: block; margin-top: 0.125rem;">Klik untuk melihat status bidang</span>
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

    <!-- Modal Detail Bidang -->
    @if($showDetailsModal)
        <div class="custom-details-modal-overlay" style="position: fixed; inset: 0; background-color: rgba(15, 23, 42, 0.4); backdrop-filter: blur(4px); display: flex; align-items: center; justify-content: center; z-index: 9999;">
            <div class="custom-details-modal-card" style="background-color: #ffffff; border-radius: 1rem; box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04); border: 1px solid #E2E8F0; width: 100%; max-width: 36rem; padding: 1.75rem; display: flex; flex-direction: column; gap: 1.25rem; position: relative; max-height: 85vh;">
                
                <!-- Close Button -->
                <button wire:click="closeDetails" type="button" style="position: absolute; top: 1.25rem; right: 1.25rem; color: #94A3B8; cursor: pointer; background: transparent; border: none; padding: 0; outline: none; transition: color 0.15s;" onmouseover="this.style.color='#475569'" onmouseout="this.style.color='#94A3B8'">
                    <svg style="width: 1.25rem; height: 1.25rem;" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>

                <!-- Header -->
                <div>
                    <h4 style="font-size: 1.125rem; font-weight: 700; color: #0F172A; margin: 0;">Status Laporan Bidang</h4>
                    <p style="font-size: 0.8125rem; color: #64748B; margin: 0.25rem 0 0 0;">
                        Periode: <strong style="color: #0F172A;">{{ $activeMonthLabel }}</strong>
                    </p>
                </div>

                <!-- Bidang List -->
                <div style="overflow-y: auto; display: flex; flex-direction: column; gap: 0.75rem; padding-right: 0.25rem; max-height: 50vh;" class="custom-dropdown-list">
                    @php
                        $targetDay = (now()->month == $activeMonth && now()->year == $activeYear) ? now()->day : 1;
                        $targetDateStr = sprintf('%04d-%02d-%02d', $activeYear, $activeMonth, $targetDay);
                    @endphp

                    @foreach($bidangList as $bidang)
                        @php
                            $reports = $bidang->lkpReports;
                            $hasReported = $reports->isNotEmpty();
                        @endphp
                        <div style="background-color: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 0.75rem; padding: 1rem; display: flex; flex-direction: column; gap: 0.75rem; transition: border-color 0.2s;" onmouseover="this.style.borderColor='#CBD5E1';" onmouseout="this.style.borderColor='#E2E8F0';">
                            <!-- Bidang Header -->
                            <div style="display: flex; justify-content: space-between; align-items: flex-start; gap: 1rem; width: 100%;">
                                <div style="display: flex; flex-direction: column; gap: 0.125rem;">
                                    <span style="font-size: 0.875rem; font-weight: 700; color: #1E293B;">{{ $bidang->nama_bidang }}</span>
                                </div>
                                <div>
                                    @if($hasReported)
                                        <span style="display: inline-flex; align-items: center; gap: 0.25rem; font-size: 0.7rem; font-weight: 700; color: #15803D; background-color: #DCFCE7; border: 1px solid #BBF7D0; padding: 0.25rem 0.5rem; border-radius: 9999px;">
                                            <span style="width: 0.375rem; height: 0.375rem; border-radius: 9999px; background-color: #16A34A;"></span>
                                            Sudah Lapor
                                        </span>
                                    @else
                                        <span style="display: inline-flex; align-items: center; gap: 0.25rem; font-size: 0.7rem; font-weight: 700; color: #B91C1C; background-color: #FEE2E2; border: 1px solid #FCA5A5; padding: 0.25rem 0.5rem; border-radius: 9999px;">
                                            <span style="width: 0.375rem; height: 0.375rem; border-radius: 9999px; background-color: #DC2626;"></span>
                                            Belum Lapor
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <!-- Bidang Content / Actions -->
                            <div style="border-top: 1px dashed #E2E8F0; padding-top: 0.75rem; margin-top: 0.125rem; display: flex; flex-direction: column; gap: 0.5rem;">
                                @if($hasReported)
                                    <div style="display: flex; flex-direction: column; gap: 0.375rem;">
                                        @foreach($reports as $report)
                                            <div style="display: flex; justify-content: space-between; align-items: center; gap: 1rem; background-color: #ffffff; padding: 0.5rem 0.75rem; border-radius: 0.5rem; border: 1px solid #F1F5F9;">
                                                <div style="display: flex; align-items: center; gap: 0.375rem; flex: 1; min-width: 0;">
                                                    <svg style="width: 0.875rem; height: 0.875rem; color: #64748B; flex-shrink: 0;" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                                    </svg>
                                                    <span style="font-size: 0.75rem; font-weight: 500; color: #334155; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;" title="{{ $report->judul_laporan }}">{{ $report->judul_laporan }}</span>
                                                </div>
                                                <a href="{{ \App\Filament\Resources\LkpReportResource::getUrl('view', ['record' => $report->id]) }}" style="font-size: 0.75rem; font-weight: 600; color: #1E88E5; text-decoration: none; display: inline-flex; align-items: center; gap: 0.125rem; transition: color 0.15s;" onmouseover="this.style.color='#1565C0'" onmouseout="this.style.color='#1E88E5'">
                                                    Lihat
                                                    <svg style="width: 0.75rem; height: 0.75rem;" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
                                                    </svg>
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div style="display: flex; justify-content: flex-end;">
                                        <a href="{{ \App\Filament\Resources\LkpReportResource::getUrl('create', ['bidang_id' => $bidang->id, 'tanggal_laporan' => $targetDateStr]) }}" style="background: linear-gradient(135deg, #1E88E5 0%, #1565C0 100%); color: #ffffff; font-weight: 700; font-size: 0.75rem; border-radius: 0.5rem; padding: 0.4rem 0.8rem; border: none; text-decoration: none; display: inline-flex; align-items: center; gap: 0.25rem; box-shadow: 0 2px 6px rgba(30, 136, 229, 0.15); transition: all 0.2s;" onmouseover="this.style.transform='translateY(-1px)';" onmouseout="this.style.transform='none';">
                                            <svg style="width: 0.875rem; height: 0.875rem;" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                            </svg>
                                            Tulis Laporan
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Footer Buttons -->
                <div style="display: flex; gap: 0.75rem; margin-top: 0.5rem; justify-content: flex-end;">
                    <button wire:click="closeDetails" type="button" style="background-color: #F1F5F9; color: #475569; font-weight: 600; font-size: 0.85rem; border-radius: 0.625rem; padding: 0.65rem 1.25rem; border: 1px solid #E2E8F0; cursor: pointer; transition: all 0.2s; font-family: inherit;" onmouseover="this.style.backgroundColor='#E2E8F0';" onmouseout="this.style.backgroundColor='#F1F5F9';">
                        Tutup
                    </button>
                </div>

            </div>
        </div>
    @endif
</x-filament-widgets::widget>
