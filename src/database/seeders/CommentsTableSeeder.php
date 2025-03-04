<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create('ja_JP');
        $content = [
            'user_id' => 1,
            'exhibition_id' => '1',
            'comment' => $faker->realText(255),
            'created_at' => now(),
            'updated_at' => now()
        ];
        DB::table('comments')->insert($content);
    }
}
