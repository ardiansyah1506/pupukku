<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class PekerjaanSeeder extends Seeder
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
                'kendaraan' => $faker->lexify('Truk ?????'),
                'no_pol' => strtoupper($faker->bothify('B #### ???')),
                'alamat' => $faker->address,
                'lokasi' => $faker->city,
                'total_karung' => $faker->numberBetween(10, 100),
                'id_perusahaan' => $faker->numberBetween(1, 4),
                'status' => $faker->boolean(80) ? 1 : 0,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('pekerjaan')->insert($data);
    }
}
