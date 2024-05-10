<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Models\Contract;
use App\Models\Material;
use App\Models\Machinery;
use App\Models\Record;

class ContractsController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'descripcion' => 'required|string|max:255',
            'fecha' => 'required|string|max:255',
        ]);


        $contract = new Contract();
        $contract->description = $validatedData['descripcion'];
        $contract->date = $validatedData['fecha'];

        $contract->save();

        return redirect()->route('contratos')->with('success', 'Contrato agregado exitosamente.');
    }
    public function getItems()
    {
        $materials = Material::all();
        $machineries = Machinery::all();
        $contracts = Contract::select('contract.id', 'contract.date', 'customer.name')
            ->leftJoin('customer', 'customer.contract_id', '=', 'contract.id')
            ->get();
        return view('contracts', ['contracts' => $contracts])->with('materials', $materials)->with('machineries', $machineries);
    }

    public function getItemRelationInfo($itemId, $category)
    {
        $data = null;
        switch ($category) {
            case 'contacts':
                $data = Contact::select('name', 'role', 'email', 'phone')->where('contract_id', $itemId)->get();
                break;
            case 'materials':
                $data = Material::select('material.name', 'contract_material.quantity', 'material.unit_price')
                    ->join('contract_material', 'material.id', '=', 'contract_material.material_id')
                    ->where('contract_material.contract_id', $itemId)
                    ->get();
                break;
            case 'machinery':
                $data = Machinery::join('contract_machinery', 'machinery.id', '=', 'contract_machinery.machinery_id')
                    ->where('contract_machinery.contract_id', $itemId)
                    ->select('machinery.name', 'contract_machinery.days', 'machinery.day_price')
                    ->get();
                break;
            case 'records':
                $data = Record::select('id', 'date')->where('contract_id', $itemId)->get();
                break;
        }
        return response()->json($data);
    }
    public function getItemDetails($itemId)
    {
        $details =
            Contract::select('contract.id', 'contract.date', 'contract.description', 'customer.name', 'customer.email', 'customer.type', 'customer.phone')
            ->leftJoin('customer', 'customer.contract_id', '=', 'contract.id')
            ->where('contract.id', $itemId)
            ->get();


        return response()->json($details);
    }
    public function updateItemDetails($itemId, Request $request)
    {
        $validatedData = $request->validate([
            'descripcion' => 'required|string|max:255',
            'fecha' => 'required|string|max:255',
        ]);


        $contract = Contract::find($itemId);
        $contract->description = $validatedData['descripcion'];
        $contract->date = $validatedData['fecha'];

        $contract->save();
        return response();
    }
    public function deleteItem(Request $request)
    {
        $itemId = $request->input('elementId');
        Contract::find($itemId)->delete();
        return redirect()->route('contratos')->with('success', 'Contrato eliminado exitosamente.');
    }
}
