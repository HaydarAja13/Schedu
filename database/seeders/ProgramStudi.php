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
            //Elektro
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
                'nama_prodi' => 'D4 Teknologi Rekayasa Elektronika',
                'kode_prodi' => 'RE',
                'id_kelompok_prodi' => 3,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id_jurusan' => 1,
                'nama_prodi' => 'D4 Teknologi Rekayasa Instalasi Listrik',
                'kode_prodi' => 'IL',
                'id_kelompok_prodi' => 4,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id_jurusan' => 1,
                'nama_prodi' => 'D4 Teknik Telekomunikasi',
                'kode_prodi' => 'TE',
                'id_kelompok_prodi' => 2,
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
            [
                'id_jurusan' => 1,
                'nama_prodi' => 'D3 Teknik Elektronika',
                'kode_prodi' => 'EK',
                'id_kelompok_prodi' => 3,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id_jurusan' => 1,
                'nama_prodi' => 'D3 Teknik Listrik',
                'kode_prodi' => 'LT',
                'id_kelompok_prodi' => 4,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id_jurusan' => 1,
                'nama_prodi' => 'D3 Teknik Telekomunikasi',
                'kode_prodi' => 'TK',
                'id_kelompok_prodi' => 2,
                'created_at' => $now,
                'updated_at' => $now,
            ]
        ]);

        // Jam awal
        DB::table('jam_awal')->insert([
            [
                'nama_jam' => 1,
                'keterangan' => '07:00-07:45',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama_jam' => 2,
                'keterangan' => '07:45-08:30',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama_jam' => 3,
                'keterangan' => '08:30-09:15',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama_jam' => 4,
                'keterangan' => '09:35-10:20',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama_jam' => 5,
                'keterangan' => '10:20-11:05',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama_jam' => 6,
                'keterangan' => '11:05-11:50',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama_jam' => 7,
                'keterangan' => '12:30-13:15',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama_jam' => 8,
                'keterangan' => '13:15-14:00',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama_jam' => 9,
                'keterangan' => '14:00-14:45',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama_jam' => 10,
                'keterangan' => '14:45-15:30',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama_jam' => 11,
                'keterangan' => '16:00-16:45',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama_jam' => 12,
                'keterangan' => '16:45-17:30',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama_jam' => 13,
                'keterangan' => '17:30-18:15',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama_jam' => 14,
                'keterangan' => '18:45-19:30',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama_jam' => 15,
                'keterangan' => '19:30-20:15',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama_jam' => 16,
                'keterangan' => '20:15-21:00',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);

        // Ruang
        DB::table('ruang')->insert([
            //RUANG INFORMATIKA
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

            //Ruang Elektronika
            [
                'nama_ruang' => 'Lab Analog',
                'keterangan' => '1',
                'id_kelompok_prodi' => 3,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama_ruang' => 'SA 203',
                'keterangan' => '1',
                'id_kelompok_prodi' => 3,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama_ruang' => 'Lab EK Digital',
                'keterangan' => '1',
                'id_kelompok_prodi' => 3,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama_ruang' => 'Ruang Gambar SB2',
                'keterangan' => '1',
                'id_kelompok_prodi' => 3,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama_ruang' => 'Bengkel ME/EK',
                'keterangan' => '1',
                'id_kelompok_prodi' => 3,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama_ruang' => 'Lab Instrumen',
                'keterangan' => '1',
                'id_kelompok_prodi' => 3,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama_ruang' => 'Labkom EK',
                'keterangan' => '1',
                'id_kelompok_prodi' => 3,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama_ruang' => 'SA 209',
                'keterangan' => '1',
                'id_kelompok_prodi' => 3,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama_ruang' => 'SA 208',
                'keterangan' => '1',
                'id_kelompok_prodi' => 3,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama_ruang' => 'Lab Mikro',
                'keterangan' => '1',
                'id_kelompok_prodi' => 3,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama_ruang' => 'Lab Kendali',
                'keterangan' => '1',
                'id_kelompok_prodi' => 3,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama_ruang' => 'SA 207',
                'keterangan' => '1',
                'id_kelompok_prodi' => 3,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama_ruang' => 'GKT 308',
                'keterangan' => '1',
                'id_kelompok_prodi' => 3,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama_ruang' => 'GKT 809',
                'keterangan' => '1',
                'id_kelompok_prodi' => 3,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            //Ruang Listrik
            [
                'nama_ruang' => 'GKT 710',
                'keterangan' => '1',
                'id_kelompok_prodi' => '4',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama_ruang' => 'GKT 711',
                'keterangan' => '1',
                'id_kelompok_prodi' => '4',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama_ruang' => 'Lab LT Barat',
                'keterangan' => '1',
                'id_kelompok_prodi' => '4',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama_ruang' => 'Lab Komputer',
                'keterangan' => '1',
                'id_kelompok_prodi' => '4',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama_ruang' => 'Lab Mekatronika',
                'keterangan' => '1',
                'id_kelompok_prodi' => '4',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama_ruang' => 'Lab Kendali Mikro',
                'keterangan' => '1',
                'id_kelompok_prodi' => '4',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama_ruang' => 'Lab PLC',
                'keterangan' => '1',
                'id_kelompok_prodi' => '4',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama_ruang' => 'Lab LT Timur',
                'keterangan' => '1',
                'id_kelompok_prodi' => '4',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama_ruang' => 'Ruang Multimedia',
                'keterangan' => '1',
                'id_kelompok_prodi' => '4',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama_ruang' => 'SB1 06',
                'keterangan' => '1',
                'id_kelompok_prodi' => '4',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama_ruang' => 'SB1 08',
                'keterangan' => '1',
                'id_kelompok_prodi' => '4',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama_ruang' => 'SB1 09',
                'keterangan' => '1',
                'id_kelompok_prodi' => '4',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama_ruang' => 'SB2 01',
                'keterangan' => '1',
                'id_kelompok_prodi' => '4',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama_ruang' => 'UPA Bahasa',
                'keterangan' => '1',
                'id_kelompok_prodi' => '4',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama_ruang' => 'Workshop Timur',
                'keterangan' => '1',
                'id_kelompok_prodi' => '4',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama_ruang' => 'Workshop Barat',
                'keterangan' => '1',
                'id_kelompok_prodi' => '4',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama_ruang' => 'Lab Gambar',
                'keterangan' => '1',
                'id_kelompok_prodi' => '4',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama_ruang' => 'Ruang Maintenance-Repair',
                'keterangan' => '1',
                'id_kelompok_prodi' => '4',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama_ruang' => 'RPL Bengkel Maintenance',
                'keterangan' => '1',
                'id_kelompok_prodi' => '4',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}
