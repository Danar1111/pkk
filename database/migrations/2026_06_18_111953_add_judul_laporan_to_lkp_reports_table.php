<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('lkp_reports', function (Blueprint $table) {
            $table->string('judul_laporan')->nullable()->after('bidang_id');
        });
    }

    public function down(): void
    {
        Schema::table('lkp_reports', function (Blueprint $table) {
            $table->dropColumn('judul_laporan');
        });
    }
};
