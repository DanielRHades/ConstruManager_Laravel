<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset;
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
        $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'tipo' => ['required', 'string', 'in:usuario,administrador'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password_edit' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);


        User::where('id', $itemId)->update([
            'name' => $request->nombre,
            'type' => $request->tipo,
            'email' => $request->email,
            
        ]);

        Password::reset(
            $request->only('email', 'password_edit', 'password_confirmation_edit', 'token'),
            function ($user) use ($request) {
                $user->forceFill([
                    'password' => Hash::make($request->password_edit),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        return $this->getItemDetails($itemId);
    }
    public function deleteItem($itemId)
    {
        User::find($itemId)->delete();
        return redirect()->route('usuarios')->with('success', 'Usuario eliminada exitosamente.');
    }
}
