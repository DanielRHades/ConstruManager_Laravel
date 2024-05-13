<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contract_Machinery;
use App\Models\Machinery;
use Illuminate\Database\QueryException;
use PDOException;

class Contracts_MachineryController extends Controller
{
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'contract_id_machinery' => 'required|exists:contract,id',
            'machinery_id' => 'required|exists:machinery,id',
            'cantidad' => 'required|integer|min:0',
            'dias' => 'required|integer|min:0',
        ]);

        $contract_machinery = new Contract_Machinery();
        $contract_machinery->contract_id = $validatedData['contract_id_machinery'];
        $contract_machinery->machinery_id = $validatedData['machinery_id'];
        $contract_machinery->quantity = $validatedData['cantidad'];
        $contract_machinery->days = $validatedData['dias'];

        $machinery = Machinery::find($validatedData['machinery_id']);
        $currentQuantity = $machinery->quantity;
        $machinery->quantity = $currentQuantity - $validatedData['cantidad'];

        try {
            $machinery->save();
        } catch (PDOException $e) {
            if ($e->errorInfo[1] == 1264) {
                return redirect()->back()->withInput()->with('error', 'El valor ingresado está fuera de rango para la cantidad.');
            } else {
                return redirect()->back()->withInput()->with('error', 'Hubo un error al agregar el material.');
            }
        } 

        try {
            $contract_machinery->save();
        } catch (QueryException $e) {
            if ($e->errorInfo[1] == 1062) { 
                return redirect()->back()->withInput()->with('error', 'El material ya ha sido agregado anteriormente.');
            } else {
                return redirect()->back()->withInput()->with('error', 'Hubo un error al agregar el material.');
            }
        }

        return redirect()->route($request->current_route, [
            'id' => $validatedData['contract_id_machinery'],
            'category' => $request->contract_category_machinery
        ])->with('success', 'Material agregado exitosamente.');
    }
    public function deleteItem(Request $request)
    {
        $contract_machinery = Contract_Machinery::where('contract_id', $request->contract_id)
        ->where('machinery_id', $request->machinery_id)
        ->first();
        
        $machinery = Machinery::find($request->machinery_id);
        
        $actualQuantity = $machinery->quantity;

        $currentQuantity = $contract_machinery->quantity;

        $machinery->quantity = $actualQuantity + $currentQuantity;

        $machinery->save();
        
        Contract_Machinery::where('machinery_id', $request->machinery_id)
            ->where('contract_id', $request->contract_id)
            ->delete();
        return redirect()->route($request->current_route, ['id' => $request->contract_id, 'category' => 'machinery']);
    }

}
