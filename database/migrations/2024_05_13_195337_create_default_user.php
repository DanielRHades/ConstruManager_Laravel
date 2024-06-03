<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;

class CreateDefaultUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        User::create([
            'name' => 'Libardo Hernandez',
            'type' => 'administrador',
            'email' => 'administradorcm@gmail.com',
            'password' => '$2y$10$bNw.WasPUeJ1.aLKVvDq.uJ7mSeCUO3D3beJ0TXp48ug9g6Jrt5mG',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
        User::where('email', 'daniel@gmail.com')->delete();
    }
}
