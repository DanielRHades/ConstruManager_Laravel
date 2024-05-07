<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier_Material extends Model
{
    protected $table = 'supplier_material';
    protected $fillable = ['supplier_id', 'material_id'];

    public $timestamps = false;
}
