<?php

namespace Database\Factories;

use App\Models\Contract_Machinery;
use App\Models\Contract;
use App\Models\Machinery;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contract_Machinery>
 */
class Contract_MachineryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

     protected $model = Contract_Machinery::class;
    public function definition()
    {
        return [
            'contract_id' => Contract::factory(),
            'machinery_id' => Machinery::factory(),
            'quantity' => $this->faker->numberBetween(1, 100),
            'days' => $this->faker->numberBetween(1, 30),
        ];
    }

}
