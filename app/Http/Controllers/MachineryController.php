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
    public function getItems()
    {
        $machinery = Machinery::select('id', 'name')->get();
        return view('machinery', ['machineries' => $machinery]);
    }
    public function getItemDetails($itemId)
    {
        $details = Machinery::where('id', $itemId)->select('id', 'name', 'quantity', 'day_price')->first();
        return $this->getItems()->with('details', $details);
    }
    public function updateItemDetails($itemId, Request $request)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'cantidad' => 'required|integer|min:0',
            'precio' => 'required|numeric|min:0',
        ]);

        $machinery = Machinery::find($itemId);
        $machinery->name = $validatedData['nombre'];
        $machinery->quantity = $validatedData['cantidad'];
        $machinery->day_price = $validatedData['precio'];

        $machinery->save();
        return $this->getItemDetails($itemId);
    }
    public function deleteItem($itemId)
    {
        Machinery::find($itemId)->delete();
        return redirect()->route('maquinarias')->with('success', 'Maquinaria eliminada exitosamente.');
    }
}
