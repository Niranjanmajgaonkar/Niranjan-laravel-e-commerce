<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\OrderState; // Correct namespace
class OrderStateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $orderStates = [
            "order in process",
            "order is shipped",
            "order is delivered",
            "order is canceled"
        ];

        foreach ($orderStates as $state) {
            $obj = new OrderState();
            $obj->order_stage = $state;
            $obj->save();
        }
    }
}
