<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->has('search')) {
            $searchTerm = $request->search;
            $query->where('name', 'LIKE', "%{$searchTerm}%")
                ->orWhere('email', 'LIKE', "%{$searchTerm}%");
        }

        $users = $query->paginate(10);
        return view('consultas', compact('users'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'role' => 'required|in:admin,especialista,ambientalista,ciudadano',
        ]);

        try {
            $user->update($request->all());
            return redirect()->route('consultas')->with('success', 'Usuario actualizado correctamente');
        } catch (\Exception $e) {
            return redirect()->route('consultas')->with('error', 'Error al actualizar el usuario');
        }
    }

    public function destroy(User $user)
    {
        try {
            $user->delete();
            return redirect()->route('consultas')->with('success', 'Usuario eliminado correctamente');
        } catch (\Exception $e) {
            return redirect()->route('consultas')->with('error', 'Error al eliminar el usuario');
        }
    }
}