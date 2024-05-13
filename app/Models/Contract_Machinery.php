<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract_Machinery extends Model
{
    use HasFactory;
    protected $table = 'contract_machinery';

    protected $fillable = ['contract_id', 'machinery_id', 'quantity', 'days'];

    public $timestamps = false;
}
