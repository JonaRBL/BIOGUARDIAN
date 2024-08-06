<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class ProfileController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show()
    {
        $userId = Auth::id(); // Obtén el ID del usuario autenticado

        // Obtén los datos del usuario desde la base de datos
        $user = DB::table('users')->where('id', $userId)->first();

        return view('perfil', ['user' => $user]); // Pasa el usuario a la vista
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'updated_at' => Carbon::now(),
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        DB::table('users')->where('id', $user->id)->update($data);

        return redirect()->back()->with('confirmacion', 'Perfil actualizado correctamente');
    }

    public function destroy(Request $request)
    {
        $user = Auth::user();

        // Aquí podrías agregar lógica adicional antes de eliminar la cuenta
        // Por ejemplo, eliminar datos relacionados, etc.

        DB::table('users')->where('id', $user->id)->delete();
        Auth::logout();

        return redirect()->route('login')->with('confirmacion2', 'Tu cuenta ha sido eliminada correctamente');
    }
}
