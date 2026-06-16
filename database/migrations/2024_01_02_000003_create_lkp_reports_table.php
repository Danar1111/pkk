<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lkp_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('skala_lkp'); // 'Kabupaten' or 'Kecamatan'
            $table->foreignId('kecamatan_id')->nullable()->constrained('master_kecamatan')->nullOnDelete();
            $table->foreignId('bidang_id')->constrained('master_bidang')->restrictOnDelete();
            $table->text('isi_laporan');
            $table->json('dokumentasi_foto')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lkp_reports');
    }
};
