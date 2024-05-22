<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function getItems()
    {
        $user = User::select('id', 'name')->get();
        return view('users', ['users' => $user]);
    }
    public function getItemDetails($itemId)
    {
        $details = User::where('id', $itemId)->select('id', 'name', 'type', 'email', 'password')->first();
        return $this->getItems()->with('details', $details);
    }
    public function updateItemDetails($itemId, Request $request)
    {
        $validatedData = $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'tipo' => ['required', 'string', 'in:usuario,administrador'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password_edit' => ['nullable'],
        ]);

        $user = User::findOrFail($itemId);

        $user->name = $validatedData['nombre'];
        $user->type = $validatedData['tipo'];
        $user->email = $validatedData['email'];
        if (!empty($validatedData['password_edit'])) {
            $user->password = Hash::make($validatedData['password_edit']);
        }

        try {
            $user->save();
        } catch (\Illuminate\Database\QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {
                return redirect()->back()->withInput()->with('error', 'El email ingresado ya está registrado.');
            } else {
                return redirect()->back()->withInput()->with('error', 'Hubo un error al actualizar el usuario.');
            }
        }

        return $this->getItemDetails($itemId);
    }
    public function deleteItem($itemId)
    {
        User::find($itemId)->delete();
        return redirect()->route('usuarios')->with('success', 'Usuario eliminada exitosamente.');
    }
}
