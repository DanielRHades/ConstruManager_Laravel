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

        return redirect()->route($request->current_route, [
            'id' => $validatedData['contract_id_machinery'],
            'category' => $request->contract_category_machinery
        ])->with('success', 'Material agregado exitosamente.');
    }
    public function deleteItem(Request $request)
    {
        Contract_Machinery::where('machinery_id', $request->machinery_id)
            ->where('contract_id', $request->contract_id)
            ->delete();
        return redirect()->route($request->current_route, ['id' => $request->contract_id, 'category' => 'machinery']);
    }
}
