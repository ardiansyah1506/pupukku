<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class DaftarGajiSeeder extends Seeder
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
                'total_gaji' => $faker->numberBetween(2, 6) * 1000000,
                'id_user' => $faker->numberBetween(1, 10),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('daftar_gaji')->insert($data);
    }
}
