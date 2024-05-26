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
        Material::factory()->count(15)->create();
        Contract::factory()->count(20)->create();
        Supplier::factory()->count(7)->create();
        Machinery::factory()->count(7)->create();


    }
}
