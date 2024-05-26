<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Material;
use App\Models\Contract;
use App\Models\Supplier;
use App\Models\Machinery;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Crear los modelos principales
        Material::factory()->count(15)->create();
        Contract::factory()->count(20)->create();
        Supplier::factory()->count(7)->create();
        Machinery::factory()->count(7)->create();

        // Poblar contract_machinery
        $contracts = Contract::all();
        $machineries = Machinery::all();

        $contracts->each(function ($contract) use ($machineries) {
            $selectedMachineries = $machineries->random(rand(1, 5));
            $selectedMachineries->each(function ($machinery) use ($contract) {
                // Verificar si la combinación ya existe
                if (!$contract->machineries()->where('machinery_id', $machinery->id)->exists()) {
                    $contract->machineries()->attach($machinery->id, [
                        'quantity' => rand(1, $machinery->quantity),
                        'days' => rand(1, 30),
                    ]);
                }
            });
        });

        // Poblar contract_material
        $materials = Material::all();

        $contracts->each(function ($contract) use ($materials) {
            $selectedMaterials = $materials->random(rand(1, 5));
            $selectedMaterials->each(function ($material) use ($contract) {
                // Verificar si la combinación ya existe
                if (!$contract->materials()->where('material_id', $material->id)->exists()) {
                    $contract->materials()->attach($material->id, [
                        'quantity' => rand(1, 100),
                    ]);
                }
            });
        });

        // Poblar supplier_material
        $suppliers = Supplier::all();

        $suppliers->each(function ($supplier) use ($materials) {
            $selectedMaterials = $materials->random(rand(1, 5));
            $selectedMaterials->each(function ($material) use ($supplier) {
                // Verificar si la combinación ya existe
                if (!$supplier->materials()->where('material_id', $material->id)->exists()) {
                    $supplier->materials()->attach($material->id);
                }
            });
        });
    }
}
