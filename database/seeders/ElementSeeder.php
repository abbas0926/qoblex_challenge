<?php

namespace Database\Seeders;

use App\Domains\Product\Models\Element;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ElementSeeder extends Seeder
{
    public function run()
    {
        $seat = Element::create(['name' => 'Seat', 'inventory' => 50, 'type' => 'part']);
        $pedals = Element::create(['name' => 'Pedals', 'inventory' => 60, 'type' => 'part']);
        $frame = Element::create(['name' => 'Frame', 'inventory' => 60, 'type' => 'part']);
        $tube = Element::create(['name' => 'Tube', 'inventory' => 35, 'type' => 'part']);
      

        $wheel = Element::create(['name' => 'Wheel', 'type' => 'bundle']);
        $wheel->children()->attach($tube->id, ['quantity' => 1]);
        $wheel->children()->attach($frame->id, ['quantity' => 1]);

        $bike = Element::create(['name' => 'Bike', 'type' => 'bundle']);
        $bike->children()->attach($seat->id, ['quantity' => 1]);
        $bike->children()->attach($pedals->id, ['quantity' => 2]);
        $bike->children()->attach($wheel->id, ['quantity' => 2]);


         //Elements for 3-level tree structure
         $handlebar = Element::create(['name' => 'Handlebar', 'inventory' => 40, 'type' => 'part']);
         $brake = Element::create(['name' => 'Brake', 'inventory' => 70, 'type' => 'part']);
         $gear = Element::create(['name' => 'Gear', 'inventory' => 50, 'type' => 'part']);
         $chain = Element::create(['name' => 'Chain', 'inventory' => 80, 'type' => 'part']);
 
         $brake_system = Element::create(['name' => 'Brake System', 'type' => 'bundle']);
         $brake_system->children()->attach($brake->id, ['quantity' => 2]);
         $brake_system->children()->attach($gear->id, ['quantity' => 1]);
 
         $handlebar_assembly = Element::create(['name' => 'Handlebar Assembly', 'type' => 'bundle']);
         $handlebar_assembly->children()->attach($handlebar->id, ['quantity' => 1]);
         $handlebar_assembly->children()->attach($brake_system->id, ['quantity' => 1]);
 
         $advanced_bike = Element::create(['name' => 'Advanced Bike', 'type' => 'bundle']);
         $advanced_bike->children()->attach($handlebar_assembly->id, ['quantity' => 1]);
         $advanced_bike->children()->attach($chain->id, ['quantity' => 1]);
         $advanced_bike->children()->attach($seat->id, ['quantity' => 1]);
         $advanced_bike->children()->attach($pedals->id, ['quantity' => 2]);
         $advanced_bike->children()->attach($wheel->id, ['quantity' => 2]);
    }
}
