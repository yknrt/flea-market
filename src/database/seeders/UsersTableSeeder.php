<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $content = [
            'name' => '出品太郎',
            'email' => 'seller01@example.com',
            'email_verified_at' => now(),
            'password' => bcrypt('abcd1234'),
            'created_at' => now(),
            'updated_at' => now(),
        ];
        DB::table('users')->insert($content);

        $content = [
            'name' => '出品次郎',
            'email' => 'seller02@example.com',
            'email_verified_at' => now(),
            'password' => bcrypt('abcd1234'),
            'created_at' => now(),
            'updated_at' => now(),
        ];
        DB::table('users')->insert($content);

        $content = [
            'name' => 'ユーザー花子',
            'email' => 'test@example.com',
            'email_verified_at' => now(),
            'password' => bcrypt('wasd5678'),
            'created_at' => now(),
            'updated_at' => now(),
        ];
        DB::table('users')->insert($content);
    }

}
