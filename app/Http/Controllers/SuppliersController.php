<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Models\Material;
use Illuminate\Http\Request;

class SuppliersController extends Controller
{
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
    public function getItems()
    {
        $materials = Material::all();
        $suppliers = Supplier::select('id', 'name', 'email')->get();
        return view('suppliers', ['suppliers' => $suppliers])->with('allMaterials', $materials);
    }

    public function getItemDetails($itemId)
    {
        $materials = Material::select('material.id', 'material.name', 'material.unit_price')
            ->join('supplier_material', 'material.id', '=', 'supplier_material.material_id')
            ->where('supplier_material.supplier_id', '=', $itemId)
            ->get();
        $details = Supplier::where('id', $itemId)->select('id', 'name', 'email', 'phone')->first();

        return $this->getItems()->with('details', $details)->with('materials', $materials);
    }
    public function updateItemDetails($itemId, Request $request)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'telefono' => 'required|numeric|min:0',
        ]);

        $supplier = Supplier::find($itemId);
        $supplier->name = $validatedData['nombre'];
        $supplier->email = $validatedData['email'];
        $supplier->phone = $validatedData['telefono'];

        $supplier->save();
        return $this->getItemDetails($itemId);
    }
    public function deleteItem($itemId)
    {
        Supplier::find($itemId)->delete();
        return redirect()->route('proveedores')->with('success', 'Proveedor eliminado exitosamente.');
    }
}
