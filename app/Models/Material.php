<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;

    protected $table = 'material';
    protected $fillable = ['name', 'quantity', 'unit_price'];

    public $timestamps = false;

    public function contracts()
    {
        return $this->belongsToMany(Contract::class, 'contract_material')->withPivot('quantity');
    }

    public function suppliers()
    {
        return $this->belongsToMany(Supplier::class, 'supplier_material');
    }
}
