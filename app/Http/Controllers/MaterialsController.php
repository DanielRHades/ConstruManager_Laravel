<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Material;
use App\Models\Supplier;

class MaterialsController extends Controller
{

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

    public function getItems()
    {
        $suppliers = Supplier::all();
        $material = Material::select('id', 'name')->get();
        return view('materials', ['materials' => $material])->with('allSuppliers', $suppliers);
    }


    public function getItemDetails($itemId)
    {
        $details = Material::where('id', $itemId)->select('id', 'name', 'quantity', 'unit_price')->first();
        $data =  Supplier::select('supplier.*')
            ->join('supplier_material', 'supplier.id', '=', 'supplier_material.supplier_id')
            ->where('supplier_material.material_id', '=', $itemId)
            ->get();
        return $this->getItems()->with('details', $details)->with('suppliers', $data);
    }
    public function updateItemDetails($itemId, Request $request)
    {

        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'cantidad' => 'required|integer|min:0',
            'precio' => 'required|numeric|min:0',
        ]);

        $material = Material::find($itemId);
        $material->name = $validatedData['nombre'];
        $material->quantity = $validatedData['cantidad'];
        $material->unit_price = $validatedData['precio'];

        $material->save();
        return $this->getItemDetails($itemId);
    }
    public function deleteItem($itemId)
    {
        Material::find($itemId)->delete();
        return redirect()->route('materiales')->with('success', 'Material eliminado exitosamente.');
    }
}
