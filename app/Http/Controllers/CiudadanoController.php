<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CiudadanoController extends Controller
{
    public function inicio()
    {
        $consultaPublicaciones= DB::table('tb_publicaciones')->get();
        return view('/inicio/iniciociudadano', compact('consultaPublicaciones'));
    }
}
