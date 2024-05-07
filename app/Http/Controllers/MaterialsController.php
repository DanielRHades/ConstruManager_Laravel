<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Material;
use App\Models\Supplier;

class MaterialsController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::all();
        return view('materials')->with('suppliers', $suppliers);
    }
    public function store(Request $request)
    {
    
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255', 
            'cantidad' => 'required|integer|min:0', 
            'precio' => 'required|numeric|min:0', 
        ]);

    
        $material = new Material();
        $material->name = $validatedData['nombre']; 
        $material->quantity = $validatedData['cantidad']; 
        $material->unit_price = $validatedData['precio']; 

        $material->save();
        
        return redirect()->route('materiales')->with('success', 'Material agregado exitosamente.');
    }
}
