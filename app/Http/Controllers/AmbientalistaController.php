<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AmbientalistaController extends Controller
{
    
    public function inicio()
    {
        $consultaPublicaciones= DB::table('tb_publicaciones')->get();
        return view('/inicio/inicioamb', compact('consultaPublicaciones'));
    }

    public function guardarp(Request $req)
    {
        $idUsuario = 2; // Cambia esto para obtener el ID del usuario autenticado
    
        // Verifica si el archivo es válido y lo guarda en 'public/fotos'
        $fotoPath = null;
        if ($req->hasFile('foto') && $req->file('foto')->isValid()) {
            $fotoPath = $req->file('foto')->store('public/fotos');
        }
    
        // Inserta los datos en la tabla 'tb_publicaciones'
        DB::table('tb_publicaciones')->insert([
            'titulo' => $req->input('titulo'),
            'id_usuario' => $idUsuario,
            'comentario' => $req->input('comentarios'),
            'foto_publi' => $fotoPath,
            'fecha' => Carbon::now(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    
        // Redirige con mensaje de confirmación
        return redirect('/publicar')->with('confirmacion', 'La publicacion se guardó en la base de datos');
    }

    public function editarpublicacion(Request $req, string $id)
    {
        DB::table('tb_publicaciones')->where('id',$id)->update([
            'titulo'=>$req->input('txtTitulo'),
            'comentario'=>$req->input('txtComentario'),
            'updated_at'=>Carbon::now(),
        ]);
        return redirect('/')->with('confirmacion','Publicación editada correctamente');

    }

    public function eliminarpublicacion(Request $req, string $id)
    {
        DB::table('tb_publicaciones')->where('id', $id)->delete();

        return redirect('/')->with('confirmacion', 'Publicación eliminada correctamente');
    }

    public function index()
    {
        // Llamar a la API para obtener los artículos
        $response = Http::get('https://newsapi.org/v2/everything', [
            'q' => 'medioambiente OR "cambio climatico" OR "especies en peligro" OR biodiversidad OR "medio ambiente"',
            'apiKey' => 'b4fc6c61ae1a4bffa57fc654c3e96bdb',  // Reemplaza con tu clave API
            'language' => 'es',
        ]);

        // Registrar el contenido de la respuesta de la API
        Log::info('Respuesta de la API:', $response->json());

        // Verificar si la llamada a la API fue exitosa
        if ($response->successful()) {
            $articles = $response->json()['articles'] ?? [];
        } else {
            $articles = [];
        }

        // Pasar la variable $articles a la vista
        return view('/noticias/noticiasamb', compact('articles'));
    }
}
