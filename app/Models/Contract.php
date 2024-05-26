<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;

    protected $table = 'contract';

    protected $fillable = ['description', 'date'];

    public $timestamps = false;

    public function materials()
    {
        return $this->belongsToMany(Material::class, 'contract_material')->withPivot('quantity');
    }

    public function machineries()
    {
        return $this->belongsToMany(Machinery::class, 'contract_machinery')->withPivot('quantity', 'days');
    }
}
