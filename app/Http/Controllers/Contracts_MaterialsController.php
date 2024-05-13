<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contract_Material;
use App\Models\Material;
use Illuminate\Database\QueryException;
use PDOException;

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

        $material = Material::find($validatedData['material_id']);
        $currentQuantity = $material->quantity;
        $material->quantity = $currentQuantity - $validatedData['cantidad'];

        try {
            $material->save();
        } catch (PDOException $e) {
            if ($e->errorInfo[1] == 1264) {
                return redirect()->back()->withInput()->with('error', 'El valor ingresado está fuera de rango para la cantidad.');
            } else {
                return redirect()->back()->withInput()->with('error', 'Hubo un error al agregar el material.');
            }
        } 

        try {
            $contract_material->save();
        } catch (QueryException $e) {
            if ($e->errorInfo[1] == 1062) { 
                return redirect()->back()->withInput()->with('error', 'El material ya ha sido agregado anteriormente.');
            } else {

                return redirect()->back()->withInput()->with('error', 'Hubo un error al agregar el material.');
            }
        }

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
