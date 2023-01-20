<?php

namespace Database\Seeders;

use App\Models\Priority;
use Illuminate\Database\Seeder;

class PrioritySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (['Baixa','Normal','Alta', 'Urgente', 'Crítica'] as $key => $value)
        {
            Priority::create(
                [
                    'description' => $value,
                    'status' => 'active'
                ]
            );
        }
    }
}
