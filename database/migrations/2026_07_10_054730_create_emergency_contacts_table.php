<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('emergency_contacts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lansia_id')->constrained('lansias')->onDelete('cascade');
            $table->string('nama_kontak');
            $table->enum('hubungan', ['anak', 'cucu', 'pasangan', 'saudara', 'lainnya']);
            $table->string('nomor_telepon');
            $table->string('alamat')->nullable();
            $table->boolean('is_primary')->default(false);
            $table->timestamps();

            $table->index('lansia_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('emergency_contacts');
    }
};
