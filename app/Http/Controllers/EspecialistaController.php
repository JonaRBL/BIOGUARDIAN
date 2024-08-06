<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EspecialistaController extends Controller
{
    public function inicio()
    {
        $consultaPublicaciones= DB::table('tb_publicaciones')->get();
        return view('/inicio/inicioesp', compact('consultaPublicaciones'));
    }

    public function show()
    {
        $userId = Auth::id(); // Obtén el ID del usuario autenticado

        // Obtén los datos del usuario desde la base de datos
        $user = DB::table('users')->where('id', $userId)->first();

        return view('perfil3', ['user' => $user]); // Pasa el usuario a la vista
    }
}
