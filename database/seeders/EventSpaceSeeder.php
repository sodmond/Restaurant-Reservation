<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventSpaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('event_centers')->insert([
            ['title' => 'Table of 2', 'price' => '40000', 'capacity' => '2', 'created_at' => now()],
            ['title' => 'Table of 4', 'price' => '60000', 'capacity' => '4', 'created_at' => now()],
            ['title' => 'Table of 6', 'price' => '90000', 'capacity' => '6', 'created_at' => now()],
            ['title' => 'VIP Lounge (8 Person)', 'price' => '120000', 'capacity' => '8', 'created_at' => now()],
        ]);
    }
}
