<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Exhibition;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UsersTableSeeder::class,
            CategoriesTableSeeder::class,
            ConditionsTableSeeder::class,
            ExhibitionsTableSeeder::class,
            FavoritesTableSeeder::class,
            CommentsTableSeeder::class
        ]);

        $item = Exhibition::find(1);
        $item->categories()->attach([1, 5, 12]);
        $item = Exhibition::find(2);
        $item->categories()->attach([2]);
        $item = Exhibition::find(3);
        $item->categories()->attach([10]);
        $item = Exhibition::find(4);
        $item->categories()->attach([1, 5]);
        $item = Exhibition::find(5);
        $item->categories()->attach([2]);
        $item = Exhibition::find(6);
        $item->categories()->attach([2]);
        $item = Exhibition::find(7);
        $item->categories()->attach([1, 4]);
        $item = Exhibition::find(8);
        $item->categories()->attach([10]);
        $item = Exhibition::find(9);
        $item->categories()->attach([10]);
        $item = Exhibition::find(10);
        $item->categories()->attach([4, 6]);

    }
}
