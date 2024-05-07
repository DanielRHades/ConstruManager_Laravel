<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Material;
use PhpParser\Node\Stmt\Switch_;
use App\Models\Supplier;

class MaterialsController extends Controller
{
    public function getItems()
    {
        $material = Material::select('id', 'name')->get();
        return view('materials', ['materials' => $material]);
    }
    public function getItemRelationInfo($itemId, $category)
    {
        $suppliers = null;
        switch ($category) {
            case 'suppliers':
                $suppliers =  Supplier::select('supplier.*')
                    ->join('supplier_material', 'supplier.id', '=', 'supplier_material.supplier_id')
                    ->where('supplier_material.material_id', '=', $itemId)
                    ->get();
                break;
        }
        return response()->json($suppliers);
    }
    public function getItemDetails($itemId)
    {
        $details = Material::where('id', $itemId)->select('name', 'quantity', 'unit_price')->get();
        return response()->json($details);
    }
}
