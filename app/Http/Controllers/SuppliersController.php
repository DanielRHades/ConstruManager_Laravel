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
        return view('suppliers', ['suppliers' => $suppliers])->with('materials', $materials);
    }

    public function getItemRelationInfo($itemId, $category)
    {
        $data = null;
        switch ($category) {
            case 'materials':
                $data = Material::select('material.name', 'material.unit_price')
                    ->join('supplier_material', 'material.id', '=', 'supplier_material.material_id')
                    ->where('supplier_material.supplier_id', '=', $itemId)
                    ->get();
                break;
        }
        return response()->json($data);
    }
    public function getItemDetails($itemId)
    {
        $details = Supplier::where('id', $itemId)->select('name', 'email', 'phone')->get();
        return response()->json($details);
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
        return response(0);
    }
    public function deleteItem(Request $request)
    {
        $itemId = $request->input('elementId');
        Supplier::find($itemId)->delete();
        return redirect()->route('proveedores')->with('success', 'Proveedor eliminado exitosamente.');
    }
}
