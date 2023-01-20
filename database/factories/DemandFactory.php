<?php

namespace Database\Factories;

use App\Models\Demand;
use App\Models\DemandStatus;
use App\Models\Priority;
use App\Models\Request;
use App\Models\System;
use Illuminate\Database\Eloquent\Factories\Factory;

class DemandFactory extends Factory
{

    protected $model = Demand::class;



    
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'request_id' => $this->faker->randomElement(Request::pluck('id')),
            'priority_id' => $this->faker->randomElement(Priority::pluck('id')),
            'system_id' => $this->faker->randomElement(System::pluck('id')),
            'created_by' => $this->faker->randomElement([1,2,4]),
            'developer_id' => $this->faker->randomElement([3,5]),
            'title' => $this->faker->text($maxNbChars = 40),
            'description' => $this->faker->paragraph(150),
            'comment' => $this->faker->paragraph(150),
            'date_estimated' => $this->faker->date(),
            'date_expected' => $this->faker->date(),
            'file_document' => $this->faker->date(),
            'status_id' => $this->faker->randomElement(DemandStatus::pluck('id')),
        ];
    }
}
