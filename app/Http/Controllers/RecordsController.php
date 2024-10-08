<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Record;

class RecordsController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'fecha' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'contract_id_record' => 'required|exists:contract,id',

        ]);


        $record = new Record();
        $record->date = $validatedData['fecha'];
        $record->description = $validatedData['descripcion'];
        $record->contract_id = $validatedData['contract_id_record'];

        $record->save();

        return redirect()->route($request->current_route, [
            'id' => $validatedData['contract_id_record'],
            'category' => $request->contract_category_record
        ])->with('success', 'Material agregado exitosamente.');
    }
    public function getItemDetails($itemId)
    {
        $description = Record::select('description', 'date')->where('id', $itemId)->first();
        return response()->json($description);
    }
    public function updateItemDetails(Request $request)
    {
        $validatedData = $request->validate([
            'fecha' => 'required|string|max:255',
            'descripcion' => 'required|string|max:1000',

        ]);


        $record = Record::find($request->record_id);
        $record->date = $validatedData['fecha'];
        $record->description = $validatedData['descripcion'];

        $record->save();

        return redirect()->route($request->current_route, ['id' => $request->contract_id, 'category' => 'records']);
    }
    public function deleteItem(Request $request)
    {
        Record::where('id', $request->record_id)
            ->delete();

        return redirect()->route($request->current_route, ['id' => $request->current_id, 'category' => 'records']);
    }
}
