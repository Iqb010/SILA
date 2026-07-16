<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lansias', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nik', 16)->unique();
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->date('tanggal_lahir');
            $table->text('alamat');
            $table->string('nomor_telepon', 20)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lansias');
    }
};
