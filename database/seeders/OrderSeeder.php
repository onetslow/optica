<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;

class OrderSeeder extends Seeder
{
    public function run()
    {
        Order::create([
            'user_id' => 1,
            'order_date' => now(), // ➡️ добавляем дату заказа
        ]);

        Order::create([
            'user_id' => 2,
            'order_date' => now()->subDays(1), // ➡️ пример с другой датой
        ]);
    }
}
