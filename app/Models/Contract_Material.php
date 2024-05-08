<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract_Material extends Model
{
    protected $table = 'contract_material';

    protected $fillable = ['contract_id', 'material_id', 'quantity'];

    public $timestamps = false;
}
