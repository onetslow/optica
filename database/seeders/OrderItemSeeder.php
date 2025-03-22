<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\Product;

class OrderItemSeeder extends Seeder
{
    public function run()
    {
        $order1 = Order::find(1);
        $order2 = Order::find(2);

        $glasses = Product::where('name', 'Оправа Ray-Ban RX7017')->first();
        $lenses = Product::where('name', 'Контактные линзы Acuvue Oasys (6 линз)')->first();
        $case = Product::where('name', 'Футляр для очков')->first();

        $order1->products()->attach([
            $glasses->id => ['quantity' => 1, 'price' => $glasses->price],
            $case->id => ['quantity' => 1, 'price' => $case->price],
        ]);

        $order2->products()->attach([
            $lenses->id => ['quantity' => 2, 'price' => $lenses->price],
        ]);
    }
}
