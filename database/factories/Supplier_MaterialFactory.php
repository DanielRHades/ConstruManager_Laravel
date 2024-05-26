<?php

namespace Database\Factories;

use App\Models\Supplier_Material;
use App\Models\Supplier;
use App\Models\Material;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Supplier_Material>
 */
class Supplier_MaterialFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

     protected $model = Supplier_Material::class;

    public function definition()
    {
        return [
            'supplier_id' => Supplier::factory(),
            'material_id' => Material::factory(),
        ];
    }

}
