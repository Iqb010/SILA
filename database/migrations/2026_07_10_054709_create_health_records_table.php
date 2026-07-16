<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('health_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lansia_id')->constrained('lansias')->onDelete('cascade');
            $table->date('tanggal_pemeriksaan');
            $table->decimal('berat_badan', 5, 2)->nullable();
            $table->decimal('tinggi_badan', 5, 2)->nullable();
            $table->decimal('tekanan_darah_sistolik', 5, 2)->nullable();
            $table->decimal('tekanan_darah_diastolik', 5, 2)->nullable();
            $table->decimal('gula_darah', 5, 2)->nullable();
            $table->decimal('kolesterol', 5, 2)->nullable();
            $table->decimal('asam_urat', 5, 2)->nullable();
            $table->text('keluhan')->nullable();
            $table->text('diagnosa')->nullable();
            $table->text('tindakan')->nullable();
            $table->text('obat_diberikan')->nullable();
            $table->text('catatan')->nullable();
            $table->foreignId('pemeriksa_id')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();

            $table->index('lansia_id');
            $table->index('tanggal_pemeriksaan');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('health_records');
    }
};
