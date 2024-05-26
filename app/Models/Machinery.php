<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Machinery extends Model
{
    use HasFactory;

    protected $table = 'machinery';

    protected $fillable = ['name', 'quantity', 'day_price'];

    public $timestamps = false;

    public function contracts()
    {
        return $this->belongsToMany(Contract::class, 'contract_machinery')->withPivot('quantity', 'days');
    }
}
