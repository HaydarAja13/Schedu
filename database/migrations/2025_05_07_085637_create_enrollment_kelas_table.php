<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('enrollment_kelas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_tahun_akademik')->constrained('tahun_akademik')->onDelete('cascade');
            $table->foreignId('id_program_studi')->constrained('program_studi')->onDelete('cascade');
            $table->foreignId('id_kelas')->constrained('kelas')->onDelete('cascade');
            $table->foreignId('id_angkatan')->constrained('angkatan')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enrollment_kelas');
    }
};
