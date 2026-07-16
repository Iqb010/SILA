<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kehadirans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lansia_id')->constrained('lansias')->cascadeOnDelete();
            $table->foreignId('kegiatan_id')->constrained('kegiatans')->cascadeOnDelete();
            $table->enum('status', ['Hadir', 'Tidak Hadir'])->default('Tidak Hadir');
            $table->timestamps();

            $table->unique(['lansia_id', 'kegiatan_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kehadirans');
    }
};
