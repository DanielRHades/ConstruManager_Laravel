<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier_Material;
use Illuminate\Database\QueryException;

class Suppliers_MaterialsController extends Controller
{
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'current_id' => 'required|integer|min:0',
            'supplier_id' => 'required|exists:supplier,id',
            'material_id' => 'required|exists:material,id',
        ]);

        $supplier_material = new Supplier_Material();
        $supplier_material->supplier_id = $validatedData['supplier_id'];
        $supplier_material->material_id = $validatedData['material_id'];

        try {
            $supplier_material->save();
        } catch (QueryException $e) {
            if ($e->errorInfo[1] == 1062) { 
                return redirect()->back()->withInput()->with('error', 'El material ya ha sido agregado anteriormente.');
            } else {
                return redirect()->back()->withInput()->with('error', 'Hubo un error al agregar el material.');
            }
        }

        return redirect()->route($request->current_route, ['id' => $validatedData['current_id']])->with('success', 'Material agregado exitosamente.');
    }
    public function deleteRelation(Request $request)
    {
        $validatedData = $request->validate([
            'supplier_id' => 'required|exists:supplier,id',
            'material_id' => 'required|exists:material,id',
        ]);

        Supplier_Material::where('material_id', $validatedData['material_id'])
            ->where('supplier_id', $validatedData['supplier_id'])
            ->delete();
        return redirect()->route($request->current_route, ['id' => $request->current_id]);
    }
}
