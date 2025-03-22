<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $optical = Category::where('name', 'Очки для зрения')->first();
        $sunglasses = Category::where('name', 'Солнцезащитные очки')->first();
        $lenses = Category::where('name', 'Контактные линзы')->first();
        $accessories = Category::where('name', 'Аксессуары')->first();

        Product::create([
            'name' => 'Оправа Ray-Ban RX7017',
            'price' => 4500,
            'category_id' => $optical->id,
        ]);

        Product::create([
            'name' => 'Солнцезащитные очки Polaroid PLD 1015/S',
            'price' => 3200,
            'category_id' => $sunglasses->id,
        ]);

        Product::create([
            'name' => 'Контактные линзы Acuvue Oasys (6 линз)',
            'price' => 1500,
            'category_id' => $lenses->id,
        ]);

        Product::create([
            'name' => 'Футляр для очков',
            'price' => 500,
            'category_id' => $accessories->id,
        ]);
    }
}
