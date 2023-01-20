<?php

namespace Database\Seeders;

use App\Models\System;
use Illuminate\Database\Seeder;

class SystemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (['Prova Online','Food-Delivery','Plus Imoveis', 'Spaceflight API'] as $key => $value)
        {
            System::create(
                [
                    'description' => $value,
                    'status' => 'active'
                ]
            );
        }
    }
}
