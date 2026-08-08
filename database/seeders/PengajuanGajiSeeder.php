<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class PengajuanGajiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        $data = [];
        for ($i = 0; $i < 15; $i++) {
            $data[] = [
                'bank' => $faker->randomElement(['BCA', 'BNI', 'BRI', 'Mandiri']),
                'no_rekening' => $faker->numberBetween(100000000, 999999999),
                'nama' => $faker->name,
                'total_pengajuan' => $faker->numberBetween(1, 10) * 1000000,
                'file' => null,
                'id_daftar_gaji' => (string) $faker->numberBetween(1, 10),
                'id_perusahaan' => $faker->numberBetween(1, 5),
                'status' => $faker->boolean(80) ? 1 : 0,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('pengajuan_gaji')->insert($data);
    }
}
