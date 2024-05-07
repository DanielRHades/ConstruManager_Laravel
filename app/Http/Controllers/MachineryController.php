<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Machinery;

class MachineryController extends Controller
{
    public function store(Request $request)
    {
        
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255', 
            'cantidad' => 'required|integer|min:0', 
            'precio' => 'required|numeric|min:0', 
        ]);
    
        $machinery = new Machinery();
        $machinery->name = $validatedData['nombre']; 
        $machinery->quantity = $validatedData['cantidad']; 
        $machinery->day_price = $validatedData['precio']; 

        $machinery->save();

        return redirect()->route('maquinarias')->with('success', 'Maquinaria agregado exitosamente.');
    }
}
