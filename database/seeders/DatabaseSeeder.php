<?php

namespace Database\Seeders;

use App\Models\Demand;
use App\Models\Priority;
use App\Models\Request;
use Database\Factories\DemandFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $this->call([
            DepartamentSeeder::class,
            PrioritySeeder::class,
            RequestSeeder::class,
            StatusSeeder::class,
            SystemSeeder::class,
            RoleSeeder::class,
            UserSeeder::class
        ]);

        
        Demand::factory(50000)->create();

    }
}
