<?php

namespace Database\Factories;

use App\Models\Contract_Material;
use App\Models\Contract;
use App\Models\Material;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contract_Material>
 */
class Contract_MaterialFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
     protected $model = Contract_Material::class;

    public function definition()
    {
        return [
            'contract_id' => Contract::factory(),
            'material_id' => Material::factory(),
            'quantity' => $this->faker->numberBetween(1, 100),
        ];
    }

}
