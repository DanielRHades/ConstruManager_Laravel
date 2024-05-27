<?php

namespace Database\Factories;
use App\Models\Contract;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contact>
 */
class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->name(),
            'role' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'phone' => $this->faker->numerify('##########'),
            'contract_id' => Contract::factory(),
        ];
    }
}
