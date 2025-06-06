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
        Schema::create('mata_kuliah', function (Blueprint $table) {
            $table->id();
            $table->string('kode_matkul', 10);
            $table->string('nama_matkul', 100);
            $table->integer('sks');
            $table->integer('jam');
            $table->string('semester', 10);
            $table->foreignId('id_ruang')->nullable()->constrained('ruang')->onDelete('cascade');
            $table->enum('jenis', ['P', 'T']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mata_kuliah');
    }
};
