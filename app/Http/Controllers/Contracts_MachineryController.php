<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contract_Machinery;

class Contracts_MachineryController extends Controller
{
    public function store(Request $request)
    {
        
        $validatedData = $request->validate([
            'contract_id_machinery' => 'required|exists:contract,id',
            'machinery_id' => 'required|exists:machinery,id',
            'dias' => 'required|integer|min:0',
        ]);
 
        $contract_machinery = new Contract_Machinery();
        $contract_machinery->contract_id = $validatedData['contract_id_machinery'];
        $contract_machinery->machinery_id = $validatedData['machinery_id'];
        $contract_machinery->days = $validatedData['dias'];

        $contract_machinery->save();
    
        return redirect()->route('contratos')->with('success', 'Maquinaria agregada exitosamente.');
    }
}
