<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class PekerjaanAktifSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        $data = [];
        for ($i = 0; $i < 20; $i++) {
            $data[] = [
                'id_pekerjaan' => (string) $faker->numberBetween(1, 20),
                'id_user' => (string) $faker->numberBetween(1, 10),
                'status' => $faker->boolean(80) ? 1 : 0,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('pekerjaan_aktif')->insert($data);
    }
}
