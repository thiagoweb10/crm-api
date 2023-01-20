<?php

namespace Database\Seeders;

use App\Models\DemandStatus;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (['Disponível','Cancelada','Estimada', 'Em Desenvolvimento', 'Em Homologação','Recusada', 'Finalizada'] as $key => $value)
        {
            DemandStatus::create(
                [
                    'description' => $value,
                    'status' => 'active'
                ]
            );
        }
    }
}
