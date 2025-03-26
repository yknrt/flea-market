<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExhibitionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $content = [
            'user_id' => 1,
            'name' => '腕時計',
            'brand' => 'Armani',
            'price' => 15000,
            'description' => 'スタイリッシュなデザインのメンズ腕時計',
            'condition_id' => 1,
            'img' => '/storage/images/items/Armani+Mens+Clock.jpg',
            'created_at' => now(),
            'updated_at' => now()
        ];
        DB::table('exhibitions')->insert($content);

        $content = [
            'user_id' => 2,
            'name' => 'HDD',
            'price' => 5000,
            'description' => '高速で信頼性の高いハードディスク',
            'condition_id' => 2,
            'img' => '/storage/images/items/HDD+Hard+Disk.jpg',
            'created_at' => now(),
            'updated_at' => now()
        ];
        DB::table('exhibitions')->insert($content);
        $content = [
            'user_id' => 3,
            'name' => '玉ねぎ3束',
            'price' => 300,
            'description' => '新鮮な玉ねぎ3束のセット',
            'condition_id' => 3,
            'img' => '/storage/images/items/iLoveIMG+d.jpg',
            'created_at' => now(),
            'updated_at' => now()
        ];
        DB::table('exhibitions')->insert($content);
        $content = [
            'user_id' => 1,
            'name' => '革靴',
            'price' => 4000,
            'description' => 'クラシックなデザインの革靴',
            'condition_id' => 4,
            'img' => '/storage/images/items/Leather+Shoes+Product+Photo.jpg',
            'created_at' => now(),
            'updated_at' => now()
        ];
        DB::table('exhibitions')->insert($content);
        $content = [
            'user_id' => 2,
            'name' => 'ノートPC',
            'brand' => 'SONY',
            'price' => 45000,
            'description' => '高性能なノートパソコン',
            'condition_id' => 1,
            'img' => '/storage/images/items/Living+Room+Laptop.jpg',
            'created_at' => now(),
            'updated_at' => now()
        ];
        DB::table('exhibitions')->insert($content);
        $content = [
            'user_id' => 2,
            'name' => 'マイク',
            'price' => 8000,
            'description' => '高音質のレコーディング用マイク',
            'condition_id' => 2,
            'img' => '/storage/images/items/Music+Mic+4632231.jpg',
            'created_at' => now(),
            'updated_at' => now()
        ];
        DB::table('exhibitions')->insert($content);
        $content = [
            'user_id' => 1,
            'name' => 'ショルダーバッグ',
            'price' => 3500,
            'description' => 'おしゃれなショルダーバッグ',
            'condition_id' => 3,
            'img' => '/storage/images/items/Purse+fashion+pocket.jpg',
            'created_at' => now(),
            'updated_at' => now()
        ];
        DB::table('exhibitions')->insert($content);
        $content = [
            'user_id' => 3,
            'name' => 'タンブラー',
            'price' => 500,
            'description' => '使いやすいタンブラー',
            'condition_id' => 4,
            'img' => '/storage/images/items/Tumbler+souvenir.jpg',
            'created_at' => now(),
            'updated_at' => now()
        ];
        DB::table('exhibitions')->insert($content);
        $content = [
            'user_id' => 3,
            'name' => 'コーヒーミル',
            'price' => 4000,
            'description' => '手動のコーヒーミル',
            'condition_id' => 1,
            'img' => '/storage/images/items/Waitress+with+Coffee+Grinder.jpg',
            'created_at' => now(),
            'updated_at' => now()
        ];
        DB::table('exhibitions')->insert($content);
        $content = [
            'user_id' => 1,
            'name' => 'メイクセット',
            'brand' => '資生堂',
            'price' => 2500,
            'description' => '便利なメイクアップセット',
            'condition_id' => 2,
            'img' => '/storage/images/items/外出メイクアップセット.jpg',
            'created_at' => now(),
            'updated_at' => now()
        ];
        DB::table('exhibitions')->insert($content);
    }
}
