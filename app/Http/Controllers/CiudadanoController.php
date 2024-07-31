<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CiudadanoController extends Controller
{
    public function inicio(){
        return view('/inicio/iniciociudadano');
    }
}
