<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Models\Material;
use Illuminate\Http\Request;

class SuppliersController extends Controller
{
    public function index()
    {
        $materials = Material::all();
        return view('suppliers')->with('materials', $materials);
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255', 
            'email' => 'required|string|max:255', 
            'telefono' => 'required|numeric|min:0', 
        ]);

        $supplier = new Supplier();
        $supplier->name = $validatedData['nombre']; 
        $supplier->email = $validatedData['email']; 
        $supplier->phone = $validatedData['telefono']; 

        $supplier->save();

        return redirect()->route('proveedores')->with('success', 'Proveedor agregado exitosamente.');
    }
}
