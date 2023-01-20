<?php

namespace Database\Seeders;

use App\Models\Request;
use Illuminate\Database\Seeder;

class RequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (['Erro','Melhoria','Novo Sistema', 'Relatórios', 'Serviço'] as $key => $value)
        {
            Request::create(
                [
                    'description' => $value,
                    'status' => 'active'
                ]
            );
        }
    }
}
