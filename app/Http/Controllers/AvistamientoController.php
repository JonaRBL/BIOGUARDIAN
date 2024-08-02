<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Avistamiento;

class AvistamientoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $consultaAvistamientos = DB::table('avistamientos')->orderBy('created_at', 'desc')->get();
        
        // Determina qué vista mostrar basándose en el tipo de usuario
        $vista = $this->determinarVista();
        
        return view($vista, compact('consultaAvistamientos'));
    }

    private function determinarVista()
    {
        // Asumiendo que tienes un campo 'role' en tu tabla de usuarios
        $tipoUsuario = Auth::user()->role ?? 'default';
        
        switch($tipoUsuario) {
            case 'admin':
                return 'avistamientos.avisadmin';
            case 'ciudadano':
                return 'avistamientos.avisciudadano';
            case 'especialista':
                return 'avistamientos.avisesp';
            case 'ambientalista':
                return 'avistamientos.avisamb';
            default:
                return 'index'; // Vista por defecto
        }
    }

    public function guardara(Request $req)
    {
        $idUsuario = Auth::id(); // Obtiene el ID del usuario autenticado
        
        $req->validate([
            'foto' => 'required',
        ]);

        // Verifica si el archivo es válido y lo guarda en 'public/fotos'
        $fotoPath = null;
        if ($req->hasFile('foto') && $req->file('foto')->isValid()) {
            $fotoPath = $req->file('foto')->store('public/imagenes');
        }
    
        // Inserta los datos en la tabla 'tb_publicaciones'
        DB::table('avistamientos')->insert([
            'ubicacion' => $req->input('ubicacion'),
            'informacion' => $req->input('informacion'),
            'fecha' => Carbon::now(),
            'foto' => $fotoPath ? str_replace('public/', '', $fotoPath) : null, // Guarda la ruta relativa
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    
        // Determina la ruta de redirección basándose en el tipo de usuario
        $ruta = $this->determinarRutaRedirección();

        // Redirige con mensaje de confirmación
        return redirect($ruta)->with('confirmacion', 'El registro se guardó en la base de datos');
    }

    private function determinarRutaRedirección()
    {
        $tipoUsuario = Auth::user()->role ?? 'default';
        
        switch($tipoUsuario) {
            case 'admin':
                return '/avistamientos/avisadmin';
            case 'ciudadano':
                return '/avistamientos/avisciudadano';
            case 'especialista':
                return '/avistamientos/avisesp';
            case 'ambientalista':
                return '/avistamientos/avisamb';
            default:
                return '/'; // Ruta por defecto
        }
    }

    public function editarAvistamiento(Request $req, string $id)
    {
        DB::table('avistamientos')->where('id',$id)->update([
            'ubicacion'=>$req->input('txtUbicacion'),
            'informacion'=>$req->input('txtInformacion'),
            'updated_at'=>Carbon::now(),
        ]);
        return back()->with('confirmacion','Avistamiento editado correctamente');

    }

    public function eliminarAvistamiento(Request $req, string $id)
    {
        DB::table('avistamientos')->where('id', $id)->delete();

        return back()->with('confirmacion', 'Avistamiento eliminado correctamente');
    }

    public function destroy($id)
    {
        try {
            $avistamiento = Avistamiento::findOrFail($id);
            $avistamiento->delete();
            return redirect()->back()->with('success', 'Avistamiento eliminado correctamente');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al eliminar el avistamiento');
        }
    }
}
