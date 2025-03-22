<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        Category::create(['name' => 'Очки для зрения']);
        Category::create(['name' => 'Солнцезащитные очки']);
        Category::create(['name' => 'Контактные линзы']);
        Category::create(['name' => 'Аксессуары']);
    }
}
