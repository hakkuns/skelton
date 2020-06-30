<?php

use App\Models\OrderStatus;
use Illuminate\Database\Seeder;

class OrderStatusTableSeeder extends Seeder
{
    public function run()
    {
        factory(OrderStatus::class)->create([
            'name' => '支払い済',
            'color' => 'green'
        ]);

        factory(OrderStatus::class)->create([
            'name' => '保留',
            'color' => 'yellow'
        ]);

        factory(OrderStatus::class)->create([
            'name' => 'エラー',
            'color' => 'red'
        ]);

        factory(OrderStatus::class)->create([
            'name' => '出荷済',
            'color' => 'blue'
        ]);

        factory(OrderStatus::class)->create([
            'name' => '注文済',
            'color' => 'violet'
        ]);
    }
}