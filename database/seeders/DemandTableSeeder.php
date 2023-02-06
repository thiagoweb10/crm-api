<?php

namespace Database\Seeders;

use App\Models\Demand;
use Database\Factories\DemandFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DemandTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Demand::factory(5000)->create();
    }
}
