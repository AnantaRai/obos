<?php

namespace Database\Seeders;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now()->toDateTimeString();
        Category::insert([
            ['name' => 'Cakes', 'slug' => 'cakes', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Pies', 'slug' => 'pies', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Cookies', 'slug' => 'cookies', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Cake Truffles', 'slug' => 'cake-truffles', 'created_at' => $now, 'updated_at' => $now],
        ]);

    }
}
