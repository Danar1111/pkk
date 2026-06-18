<?php

namespace App\Filament\Pages;

class Dashboard extends \Filament\Pages\Dashboard
{
    /**
     * Sembunyikan header "Dasbor" dan sejajarkan penataan search bar di widget.
     */
    public function getHeading(): string|\Illuminate\Contracts\Support\Htmlable
    {
        return new \Illuminate\Support\HtmlString('
            <style>
                header.fi-header { display: none !important; }
                
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
                        margin-top: 6px !important; /* Visual offset to align perfectly with the button row */
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
            </style>
        ');
    }
}
