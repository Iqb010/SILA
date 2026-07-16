<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['admin', 'lansia'])->default('admin')->after('email');
            $table->foreignId('lansia_id')->nullable()->after('role')->constrained('lansias')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['lansia_id']);
            $table->dropColumn(['role', 'lansia_id']);
        });
    }
};
