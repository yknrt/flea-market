<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfilesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $content = [
            'user_id' => 1,
            'zip' => '163-8001',
            'address' => '東京都新宿区西新宿2-8-1',
            'created_at' => now(),
            'updated_at' => now(),
        ];
        DB::table('profiles')->insert($content);

        $content = [
            'user_id' => 2,
            'zip' => '812-8577',
            'address' => '福岡県福岡市博多区東公園7-7',
            'created_at' => now(),
            'updated_at' => now(),
        ];
        DB::table('profiles')->insert($content);

        $content = [
            'user_id' => 3,
            'zip' => '540-8570',
            'address' => '大阪府大阪市中央区大手前2-1-22',
            'created_at' => now(),
            'updated_at' => now(),
        ];
        DB::table('profiles')->insert($content);
    }

}
