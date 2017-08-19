<?php

use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $order = \App\Models\Order::create([
            'user_id'=>1,
            'date'=>\Carbon\Carbon::create(),
            'comments'=>'This is the initial '
        ]);

        \App\Models\OrderItem::create([
            'order_id'=>$order->id,
            'item_id'=>1,
            'quantity'=>3
        ]);

        \App\Models\OrderItem::create([
            'order_id'=>$order->id,
            'item_id'=>2,
            'quantity'=>5
        ]);

        \App\Models\OrderItem::create([
            'order_id'=>$order->id,
            'item_id'=>3,
            'quantity'=>6
        ]);

        \App\Models\OrderItem::create([
            'order_id'=>$order->id,
            'item_id'=>4,
            'quantity'=>2
        ]);
    }
}
