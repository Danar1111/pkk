<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Add nullable tanggal_laporan column
        Schema::table('lkp_reports', function (Blueprint $table) {
            $table->date('tanggal_laporan')->nullable()->after('user_id');
        });

        // 2. Populate existing records using the date part of created_at
        DB::table('lkp_reports')->update([
            'tanggal_laporan' => DB::raw('DATE(created_at)')
        ]);

        // 3. Alter the column to make it NOT nullable
        Schema::table('lkp_reports', function (Blueprint $table) {
            $table->date('tanggal_laporan')->nullable(false)->change();
        });
    }

    public function down(): void
    {
        Schema::table('lkp_reports', function (Blueprint $table) {
            $table->dropColumn('tanggal_laporan');
        });
    }
};
