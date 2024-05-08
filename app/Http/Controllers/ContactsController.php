<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactsController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'rol' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telefono' => 'nullable|string|max:20',
            'contract_id_contact' => 'required|exists:contract,id',
        ]);


        $contact = new Contact();
        $contact->name = $validatedData['nombre'];
        $contact->role = $validatedData['rol'];
        $contact->email = $validatedData['email'];
        $contact->phone = $validatedData['telefono'];
        $contact->contract_id = $validatedData['contract_id_contact'];

        $contact->save();

        return redirect()->route('contratos')->with('success', 'Customer agregado exitosamente.');
    }
}
