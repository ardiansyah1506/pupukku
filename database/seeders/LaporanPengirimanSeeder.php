<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class LaporanPengirimanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        $data = [];
        for ($i = 0; $i < 30; $i++) {
            $data[] = [
                'uang_makan' => $faker->numberBetween(5, 15) * 10000,
                'uang_bensin' => $faker->numberBetween(10, 30) * 10000,
                'uang_tol' => $faker->numberBetween(2, 10) * 10000,
                'file' => Str::random(10) . '.pdf',
                'id_user' => $faker->numberBetween(1, 10),
                'id_pekerjaan' => $faker->numberBetween(1, 20),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('laporan_pengiriman')->insert($data);
    }
}
