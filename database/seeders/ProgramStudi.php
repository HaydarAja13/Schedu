<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class ProgramStudi extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        // Program studi
        DB::table('program_studi')->insert([
            [
                'id_jurusan' => 1,
                'nama_prodi' => 'D4 Teknologi Rekayasa Komputer',
                'kode_prodi' => 'TI',
                'id_kelompok_prodi' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id_jurusan' => 1,
                'nama_prodi' => 'D3 Teknik Informatika',
                'kode_prodi' => 'IK',
                'id_kelompok_prodi' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);

        // Ruang
        DB::table('ruang')->insert([
            [
                'nama_ruang' => 'GKT 801',
                'keterangan' => '1',
                'id_kelompok_prodi' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama_ruang' => 'GKT 802',
                'keterangan' => '1',
                'id_kelompok_prodi' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama_ruang' => 'GKT 803',
                'keterangan' => '1',
                'id_kelompok_prodi' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama_ruang' => 'GKT 804',
                'keterangan' => '1',
                'id_kelompok_prodi' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama_ruang' => 'GKT 805',
                'keterangan' => '1',
                'id_kelompok_prodi' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama_ruang' => 'GKT 806',
                'keterangan' => '1',
                'id_kelompok_prodi' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama_ruang' => 'GKT 807',
                'keterangan' => '1',
                'id_kelompok_prodi' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama_ruang' => 'GKT 808',
                'keterangan' => '1',
                'id_kelompok_prodi' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama_ruang' => 'GKT 809',
                'keterangan' => '1',
                'id_kelompok_prodi' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama_ruang' => 'GKT 810',
                'keterangan' => '1',
                'id_kelompok_prodi' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama_ruang' => 'MST 201A',
                'keterangan' => '1',
                'id_kelompok_prodi' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama_ruang' => 'MST 201B',
                'keterangan' => '1',
                'id_kelompok_prodi' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama_ruang' => 'MST 201C',
                'keterangan' => '1',
                'id_kelompok_prodi' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama_ruang' => 'MST 303',
                'keterangan' => '1',
                'id_kelompok_prodi' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama_ruang' => 'MST 304',
                'keterangan' => '1',
                'id_kelompok_prodi' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama_ruang' => 'MST 305',
                'keterangan' => '1',
                'id_kelompok_prodi' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama_ruang' => 'MST 306',
                'keterangan' => '1',
                'id_kelompok_prodi' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama_ruang' => 'SA 204',
                'keterangan' => '1',
                'id_kelompok_prodi' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama_ruang' => 'SA 209',
                'keterangan' => '1',
                'id_kelompok_prodi' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama_ruang' => 'Lab Multimedia',
                'keterangan' => '1',
                'id_kelompok_prodi' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama_ruang' => 'Lab Pemrograman',
                'keterangan' => '1',
                'id_kelompok_prodi' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama_ruang' => 'Lab Jaringan Komputer',
                'keterangan' => '1',
                'id_kelompok_prodi' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}
