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
        Schema::create('enrollment_mk_mhs_dsn_rng', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_mata_kuliah')->constrained('mata_kuliah')->onDelete('cascade');
            $table->foreignId('id_enrollment_kelas')->constrained('enrollment_kelas')->onDelete('cascade');
            $table->foreignId('id_dosen')->constrained('dosen')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enrollment_mk_mhs_dsn_rng');
    }
};
