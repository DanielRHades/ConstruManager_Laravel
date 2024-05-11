<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier_Material;

class Suppliers_MaterialsController extends Controller
{
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'supplier_id' => 'required|exists:supplier,id',
            'material_id' => 'required|exists:material,id',
        ]);

        $supplier_material = new Supplier_Material();
        $supplier_material->supplier_id = $validatedData['supplier_id'];
        $supplier_material->material_id = $validatedData['material_id'];

        $supplier_material->save();

        return redirect()->route($request->current_route)->with('success', 'Material agregado exitosamente.');
    }
    public function deleteRelation($supplierId, $materialId)
    {
        Supplier_Material::where('material_id', $materialId)
            ->where('supplier_id', $supplierId)
            ->delete();
        return response(0);
    }
}
