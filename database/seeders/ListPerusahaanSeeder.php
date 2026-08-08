<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ListPerusahaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        $data = [];
        for ($i = 0; $i < 10; $i++) {
            $data[] = [
                'nama' => $faker->company,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('list_perusahaan')->insert($data);
    }
}
