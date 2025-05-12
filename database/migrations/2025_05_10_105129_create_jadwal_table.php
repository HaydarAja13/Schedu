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
        Schema::create('jadwal', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_enrollment_mk_mhs_dsn_rng')->constrained('enrollment_mk_mhs_dsn_rng')->onDelete('cascade');
            $table->string('hari', 10);
            $table->foreignId('id_jam_awal')->constrained('jam_awal')->onDelete('cascade');
            $table->foreignId('id_jam_akhir')->constrained('jam_akhir')->onDelete('cascade');
            $table->foreignId('id_ruang')->constrained('ruang')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal');
    }
};
