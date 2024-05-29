<?php

namespace App\Http\Controllers;

use App\Models\Carnet;
use App\Models\Gremio;
use App\Models\Operacion;
use App\Models\Operacione;
use App\Models\User;
use Illuminate\Http\Request;

class GremioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         // Validar los datos del formulario si es necesario
        $request->validate([
            'nombre' => 'required|string',
            'abreviatura' => 'required|string',
            'descripcion' => 'nullable|string',
        ]);

        // Crear un nuevo objeto del modelo y asignar los valores
        $nuevoRegistro = new Gremio();
        $nuevoRegistro->nombre = $request->input('nombre');
        $nuevoRegistro->abreviatura = $request->input('abreviatura');
        $nuevoRegistro->descripcion = $request->input('descripcion');

        // Guardar el registro en la base de datos
        $nuevoRegistro->save();

        // Redirigir a la página deseada con un mensaje de éxito
        return redirect()->route('gremios')->with('success', '¡Registro creado correctamente!');
    }
    public function operacion(Request $request)
    {
         // Validar los datos del formulario si es necesario
        
        // dd($request->all());
        // Crear un nuevo objeto del modelo y asignar los valores
        $nuevoRegistro = new Operacione();
        $nuevoRegistro->descripcion = $request->input('descripcion');
        $nuevoRegistro->año = 2024;
        $nuevoRegistro->gremio_id = 1;

        // Guardar el registro en la base de datos
        $nuevoRegistro->save();

        // Redirigir a la página deseada con un mensaje de éxito
        return redirect()->route('operacion')->with('success', '¡Registro creado correctamente!');
    }

    public function carnet(Request $request)
    {
        $request->validate([
            'gremio' => 'required',
            'fechasoat' => 'required|date',
            'placanumero' => 'required',
            'pdf' => 'required|file|mimes:pdf',
            'fotocarnet' => 'required|image|mimes:jpg,jpeg,png',
            'user_id' => 'required',
           
            'estado' => 'required',
        ]);
        if ($request->hasFile('pdf')) {
            $pdfPath = $request->file('pdf')->store('pdfs', 'public'); // Guardar el archivo PDF en el sistema de archivos público
        } else {
            $pdfPath = ''; // Establecer una cadena vacía si no se proporciona un archivo PDF
        }

        if ($request->hasFile('fotocarnet')) {
            $pdfPathcarnet = $request->file('fotocarnet')->store('fotocarnet', 'public'); // Guardar el archivo PDF en el sistema de archivos público
        } else {
            $pdfPathcarnet = ''; // Establecer una cadena vacía si no se proporciona un archivo PDF
        }

        // Crear un nuevo registro en la tabla 'carnet'
        Carnet::create([
            'user_id' => $request->user_id,
            'placa' => $request->placanumero,
            'fecha_soat' => $request->fechasoat,
            'gremio' => $request->gremio,
            'estado' => $request->estado,
            'fotocarnet' =>$pdfPathcarnet,
            'pdf' => $pdfPath, // Guardar la ruta del archivo PDF en la base de datos
        ]);

        // Redirigir a la página deseada con un mensaje de éxito
        return redirect()->route('carnet')->with('success', '¡Registro creado correctamente!');
    }

    public function updatecarnet(Request $request)
{
    $request->validate([
        'fechasoat' => 'required|date',
    ]);

    // Obtener el carnet existente a actualizar
    $carnet = Carnet::findOrFail($request->carnet_id);

    // Actualizar los campos del carnet con los valores proporcionados en la solicitud
    $carnet->update([
        'fecha_soat' => $request->fechasoat,
       
        // También puedes actualizar otros campos si es necesario
    ]);

    // Redirigir a la página deseada con un mensaje de éxito
    return redirect()->route('usuarios')->with('success', '¡Registro actualizado correctamente!');
}

    public function obtenerDatosSocio(Request $request)
    {
        // Obtener el DNI enviado desde la solicitud GET
        $dni = $request->query('dni');
   
        // Buscar al socio en la base de datos utilizando el DNI
        $socio = User::where('dni', $dni)->first();
        $carnet = Carnet::where('user_id', $socio->id)->first();
        // Retornar los datos del socio como una respuesta JSON
        return response()->json([
            'nombre' => $socio ? $socio->nombre : '', // Nombre del socio si se encuentra, cadena vacía si no
            'apellidop' => $socio ? $socio->apellidop : '', // Apellido paterno del socio si se encuentra, cadena vacía si no
            'apellidom' => $socio ? $socio->apellidom : '', 
            'user_id' => $carnet ? $carnet->user_id : '',
            'user_socio' => $socio ? $socio->id : '', 
           // Apellido materno del socio si se encuentra, cadena vacía si no
        ]);
        
    }
    public function verificarDatos(Request $request)
{
    // Obtener los datos del DNI y correo electrónico de la solicitud
    $dni = $request->input('dni');

    // Buscar si el DNI o correo electrónico ya están registrados en la base de datos
    $usuario = User::where('dni', $dni)->first();

    // Devolver la respuesta
    return response()->json([
        'registrado' => $usuario !== null,
        'nombre' => $usuario ? $usuario->nombre : null,
        'apellidop' => $usuario ? $usuario->apellidop : null,
        'apellidom' => $usuario ? $usuario->apellidom : null,
        'user_id' => $usuario ? $usuario->id : null,
    ]);
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
