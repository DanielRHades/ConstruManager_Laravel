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
            'name' => 'Administrador Principal',
            'type' => 'administrador',
            'email' => 'administradorcm@gmail.com',
            'password' => bcrypt('construmanagergod123'),
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
