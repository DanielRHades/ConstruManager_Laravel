<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Material;
use App\Models\Contract;
use App\Models\Supplier;
use App\Models\Machinery;
use App\Models\Record;
use App\Models\Contact;
use App\Models\User;
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
        User::factory()->count(20)->create();
        Material::factory()->count(20)->create();
        Contract::factory()->count(20)->create();
        Supplier::factory()->count(20)->create();
        Machinery::factory()->count(20)->create();
        
        $contracts = Contract::all();

        $contracts->each(function ($contract) {
            Record::factory()->count(rand(1, 20))->create([
                'contract_id' => $contract->id,
            ]);
        });

        $contracts->each(function ($contract) {
            Contact::factory()->count(rand(1, 20))->create([
                'contract_id' => $contract->id,
            ]);
        });

        $machineries = Machinery::all();

        $contracts->each(function ($contract) use ($machineries) {
            $selectedMachineries = $machineries->random(rand(1, 20));
            $selectedMachineries->each(function ($machinery) use ($contract) {
                
                if (!$contract->machineries()->where('machinery_id', $machinery->id)->exists()) {
                    $contract->machineries()->attach($machinery->id, [
                        'quantity' => rand(1, $machinery->quantity),
                        'days' => rand(1, 30),
                    ]);
                }
            });
        });
       
        $materials = Material::all();

        $contracts->each(function ($contract) use ($materials) {
            $selectedMaterials = $materials->random(rand(1, 20));
            $selectedMaterials->each(function ($material) use ($contract) {
                
                if (!$contract->materials()->where('material_id', $material->id)->exists()) {
                    $contract->materials()->attach($material->id, [
                        'quantity' => rand(1, 100),
                    ]);
                }
            });
        });
        
        $suppliers = Supplier::all();

        $suppliers->each(function ($supplier) use ($materials) {
            $selectedMaterials = $materials->random(rand(1, 20));
            $selectedMaterials->each(function ($material) use ($supplier) {
              
                if (!$supplier->materials()->where('material_id', $material->id)->exists()) {
                    $supplier->materials()->attach($material->id);
                }
            });
        });
    }
}
