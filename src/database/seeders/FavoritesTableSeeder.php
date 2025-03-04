<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FavoritesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create('ja_JP');
        for ($i = 1; $i < 4; $i++) {
            $content = [
                'user_id' => $i,
                'exhibition_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ];
            DB::table('favorites')->insert($content);
        }
    }
}
