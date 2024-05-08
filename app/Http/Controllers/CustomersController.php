<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class CustomersController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'tipo_cliente' => 'required|in:natural,juridico',
            'email' => 'required|email|max:255',
            'telefono' => 'nullable|string|max:20',
            'contract_id_customer' => 'required|exists:contract,id',
        ]);

        $customer = new Customer();
        $customer->name = $validatedData['nombre'];
        $customer->type = $validatedData['tipo_cliente'];
        $customer->email = $validatedData['email'];
        $customer->phone = $validatedData['telefono'];
        $customer->contract_id = $validatedData['contract_id_customer'];

        $customer->save();

        return redirect()->route('contratos')->with('success', 'Customer agregado exitosamente.');
    }
}
