<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Accesos;
use App\Models\Carnet;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Gremio;
use App\Models\Operacion;
use App\Models\Operacione;
use PSpell\Config;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $acceso = new Accesos();
        $modulos = $acceso->moduloPorPermiso($user->acceso_id);
        $slugs = $modulos->pluck('slug');

        $gremios = Gremio::all();
        $carnet = Carnet::all();
        $usuarios = User::all();
        // Obtener los datos de los carnets del usuario logeado
        $carnetsUsuarioLogeado = User::with('carnet')->get(); 
        // dd($carnetsUsuarioLogeado);

        return view('dashboard')
        ->with('slugs', $slugs)
        ->with('gremios', $gremios)
        ->with('carnets', $carnet)
        ->with('usuarios', $usuarios)
        ->with('usuario', $user)
        ->with('usuariocarnet', $carnetsUsuarioLogeado)
        ;

    }

    public function usuarios()
{
    $user = Auth::user();
    $acceso = new Accesos();
    $modulos = $acceso->moduloPorPermiso($user->acceso_id);
    $slugs = $modulos->pluck('slug');
    
    // Obtener los datos de los usuarios con sus carnets
    $usuariosConCarnets = User::with('carnet')->get(); 

    return view('modulos.usuarios')->with('slugs', $slugs)->with('usuarios', $usuariosConCarnets);
}

    public function operacion()
    {
        $user = Auth::user();
        $acceso = new Accesos();
        $modulos = $acceso->moduloPorPermiso($user->acceso_id);
        $slugs = $modulos->pluck('slug');

        // Verificar si hay registros en la tabla Operaciones
        $operacionesCount = Operacione::count();
        
        // Si hay al menos un registro, $estadoTrue será true, de lo contrario, será false
        $estadoTrue = $operacionesCount > 0;
       
        return view('modulos.operacion', [
            'slugs' => $slugs,
            'estadoTrue' => $estadoTrue,
        ]);

        
    }
    public function gremios()
    {
        $user = Auth::user();
        $acceso = new Accesos();
        $modulos = $acceso->moduloPorPermiso($user->acceso_id);
        $slugs = $modulos->pluck('slug');
        $gremios = Gremio::all();
        
        return view('modulos.gremios')->with('slugs', $slugs)->with('gremios', $gremios);

    }
    public function carnet()
    {
      
        $user = Auth::user();
        $acceso = new Accesos();
        $modulos = $acceso->moduloPorPermiso($user->acceso_id);
        $slugs = $modulos->pluck('slug');
        return view('modulos.carnets')->with('slugs', $slugs);

    }
}
