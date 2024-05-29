<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;
use PasswordValidationRules;

class UsuariosRegistradosController extends Controller
{
   
public function create(Request $request)
{
    // Verificar si el correo electrónico ya está registrado
    $existingUser = User::where('email', $request->input('email'))->first();
    $existingUserdni = User::where('dni', $request->input('dni'))->first();

    // Si el usuario ya existe, redireccionar de vuelta con un mensaje de error
    if ($existingUser) {
        return redirect()->back()->with('error', '¡El correo electrónico ya está registrado!');
    }

    if ($existingUserdni) {
        return redirect()->back()->with('error', '¡El Dni ya esta registrado!');
    }

    // Si el correo electrónico no está registrado, crear un nuevo usuario
    User::create([
        'name' => $request->input('nombre') . ' ' . $request->input('apellidop') . ' ' . $request->input('apellidom'),
        'email' => $request->input('email'),
        'password' => Hash::make($request->input('password')),
        'acceso_id' => $request->input('acceso_id'),
        'nombre' => $request->input('nombre'),
        'apellidop' => $request->input('apellidop'),
        'apellidom' => $request->input('apellidom'),
        'dni' => $request->input('dni'),
        'celular' => $request->input('celular'),
    ]);

    // Si se crea el usuario con éxito, redireccionar con un mensaje de éxito
    return redirect()->route('usuarios')->with('success', '¡Registro creado correctamente!');
}



}
