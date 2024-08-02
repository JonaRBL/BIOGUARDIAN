<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class controlpublicaciones extends Controller
{

    public function index()
    {
        $consultaPublicaciones = DB::table('tb_publicaciones')->orderBy('created_at', 'desc')->get();
        
        // Determina qué vista mostrar basándose en el tipo de usuario
        $vista = $this->determinarVista();
        
        return view($vista, compact('consultaPublicaciones'));
    }

    private function determinarVista()
    {
        // Asumiendo que tienes un campo 'role' en tu tabla de usuarios
        $tipoUsuario = Auth::user()->role ?? 'default';
        
        switch($tipoUsuario) {
            case 'admin':
                return 'inicio.inicioadmin';
            case 'ciudadano':
                return 'inicio.iniciociudadano';
            case 'especialista':
                return 'inicio.inicioesp';
            case 'ambientalista':
                return 'inicio.inicioamb';
            default:
                return 'index'; // Vista por defecto
        }
    }

    public function guardarp(Request $req)
    {
        $idUsuario = Auth::id(); // Obtiene el ID del usuario autenticado
    
        // Verifica si el archivo es válido y lo guarda en 'public/fotos'
        $fotoPath = null;
        if ($req->hasFile('foto') && $req->file('foto')->isValid()) {
            $fotoPath = $req->file('foto')->store('public/imagenes');
        }
    
        // Inserta los datos en la tabla 'tb_publicaciones'
        DB::table('tb_publicaciones')->insert([
            'titulo' => $req->input('titulo'),
            'id_usuario' => $idUsuario,
            'comentario' => $req->input('comentarios'),
            'foto_publi' => $fotoPath ? str_replace('public/', '', $fotoPath) : null, // Guarda la ruta relativa
            'fecha' => Carbon::now(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    
        // Determina la ruta de redirección basándose en el tipo de usuario
        $ruta = $this->determinarRutaRedirección();

        // Redirige con mensaje de confirmación
        return redirect($ruta)->with('confirmacion', 'La publicación se guardó en la base de datos');
    }

    private function determinarRutaRedirección()
    {
        $tipoUsuario = Auth::user()->role ?? 'default';
        
        switch($tipoUsuario) {
            case 'admin':
                return '/inicio/inicioadmin';
            case 'ciudadano':
                return '/inicio/iniciociudadano';
            case 'especialista':
                return '/inicio/inicioesp';
            case 'ambientalista':
                return '/inicio/inicioamb';
            default:
                return '/'; // Ruta por defecto
        }
    }

    public function editarpublicacion(Request $req, string $id)
    {
        DB::table('tb_publicaciones')->where('id',$id)->update([
            'titulo'=>$req->input('txtTitulo'),
            'comentario'=>$req->input('txtComentario'),
            'updated_at'=>Carbon::now(),
        ]);

        if ($req->ajax()) {
            return response()->json(['success' => true]);
        }

        return back()->with('success', 'Publicación editada correctamente');
    }

    public function eliminarpublicacion(Request $req, string $id)
    {
        DB::table('tb_publicaciones')->where('id', $id)->delete();

        return redirect()->back()->with('success', 'Publicación eliminada exitosamente');
    }
}
