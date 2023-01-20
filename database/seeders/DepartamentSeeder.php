<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartamentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (['Atendimento','Financeiro','Marketing', 'Recursos Humanos', 'Vendas','Tecnologia'] as $key => $value)
        {
            Department::create(
                [
                    'description' => $value,
                    'status' => 'active'
                ]
            );
        }
    }
}