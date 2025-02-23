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
            'category_id' => 1,
            'img' => '/storage/images/Armani+Mens+Clock.jpg',
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
            'category_id' => 2,
            'img' => '/storage/images/HDD+Hard+Disk.jpg',
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
            'category_id' => 2,
            'img' => '/storage/images/iLoveIMG+d.jpg',
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
            'category_id' => 2,
            'img' => '/storage/images/Leather+Shoes+Product+Photo.jpg',
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
            'category_id' => 2,
            'img' => '/storage/images/Living+Room+Laptop.jpg',
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
            'category_id' => 13,
            'img' => '/storage/images/Music+Mic+4632231.jpg',
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
            'category_id' => 1,
            'img' => '/storage/images/Purse+fashion+pocket.jpg',
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
            'category_id' => 10,
            'img' => '/storage/images/Tumbler+souvenir.jpg',
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
            'category_id' => 10,
            'img' => '/storage/images/Waitress+with+Coffee+Grinder.jpg',
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
            'category_id' => 6,
            'img' => '/storage/images/外出メイクアップセット.jpg',
            'created_at' => now(),
            'updated_at' => now()
        ];
        DB::table('exhibitions')->insert($content);
    }
}
