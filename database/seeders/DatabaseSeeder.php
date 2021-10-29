<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        for($i = 1; $i <= 50; $i++){
            // insert data ke table siswa menggunakan Faker
            DB::table('barang')->insert([
                // 'id' => $faker->randomDigit,
                'nama_barang' => $faker->name,
                'deskripsi' => $faker->text,
                'stok' => $faker->numberBetween(1,100),
                'harga' => $faker->numberBetween(0,10000)
            ]);
        }
    }
}
