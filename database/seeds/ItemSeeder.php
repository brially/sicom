<?php

use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Item::create([
            'name'=>'Lemon Juice Packets'
        ]);
        \App\Models\Item::create([
            'name'=>'Beef Mini Burger'
        ]);
        \App\Models\Item::create([
            'name'=>'Onions CHP Crispy'
        ]);
        \App\Models\Item::create([
            'name'=>'Bun Speciality'
        ]);
        \App\Models\Item::create([
            'name'=>'Pub Fries'
        ]);
        \App\Models\Item::create([
            'name'=>'Cesar Salad'
        ]);
        \App\Models\Item::create([
            'name'=>'Fountain Drink'
        ]);
        \App\Models\Item::create([
            'name'=>'Ice Cream'
        ]);
        \App\Models\Item::create([
            'name'=>'Fruit Juice'
        ]);
        \App\Models\Item::create([
            'name'=>'Mac & Cheese'
        ]);
        \App\Models\Item::create([
            'name'=>'Green Beans'
        ]);
        \App\Models\Item::create([
            'name'=>'Chili'
        ]);
        \App\Models\Item::create([
            'name'=>'Cheese Cake'
        ]);
    }
}
