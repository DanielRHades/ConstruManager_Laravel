<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contract_Material;

class Contracts_MaterialsController extends Controller
{
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'contract_id_material' => 'required|exists:contract,id',
            'material_id' => 'required|exists:material,id',
            'cantidad' => 'required|integer|min:0'
        ]);


        $contract_material = new Contract_Material();
        $contract_material->contract_id = $validatedData['contract_id_material'];
        $contract_material->material_id = $validatedData['material_id'];
        $contract_material->quantity = $validatedData['cantidad'];

        $contract_material->save();

        return redirect()->route($request->current_route, [
            'id' => $validatedData['contract_id_material'],
            'category' => $request->contract_category_material
        ])->with('success', 'Material agregado exitosamente.');
    }
    public function deleteItem(Request $request)
    {
        Contract_Material::where('material_id', $request->material_id)
            ->where('contract_id', $request->contract_id)
            ->delete();
        return redirect()->route($request->current_route, ['id' => $request->contract_id, 'category' => 'materials']);
    }
}
