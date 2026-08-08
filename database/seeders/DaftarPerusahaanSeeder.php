<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class DaftarPerusahaanSeeder extends Seeder
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
                'nama' => $faker->name,
                'alamat' => $faker->address,
                'no_hp' => $faker->phoneNumber,
                'perusahaan' => $faker->company,
                'username' => $faker->userName,
                'password' => Hash::make('password'),
                'bukti_bayar' => 'bukti_dummy.jpg',
                'norek' => (string) $faker->numberBetween(100000000, 999999999),
                'jenis_bank' => $faker->randomElement(['BCA', 'BNI', 'BRI', 'Mandiri']),
                'status' => $faker->randomElement(['0', '1']),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('daftar_perusahaan')->insert($data);
    }
}
