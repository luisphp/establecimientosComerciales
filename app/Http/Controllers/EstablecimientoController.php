<?php

namespace App\Http\Controllers;

use App\Models\Establecimiento;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;


class EstablecimientoController extends Controller
{


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias = Categoria::all();

        return view('establecimientos.create', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre'            => 'required',
            'categoria_id'      => 'required|numeric|exists:App\Models\Categoria,id',
            'imagen_principal'  => 'required|image|max:1000',
            'direccion'         => 'required',
            'colonia'           => 'required',
            'lat'               => 'required',
            'lng'               => 'required',
            'telefono'          => 'required|numeric',
            'descripcion'       => 'required|min:50',
            'apertura'          => 'required|date_format:H:i',
            'cierre'            => 'required|date_format:H:i|after:apertura', // La hora de cierre es despues de la aprtura
            'uuid'              => 'required|uuid'
        ]);

        $ruta_imagen = $request['imagen_principal']->store('principales', 'public');

        //Cambiar tamaño de la imagen
        $img = Image::make(public_path("storage/{$ruta_imagen}"))->fit(800,600); 
        $img->save();
        

        
        //Guardar en la base de datos
        // auth()->user()->establecimiento()->create([
        //     'nombre'            => $data['nombre'],
        //     'categoria_id'      => $data['categoria_id'],
        //     'imagen_principal'  => $ruta_imagen,
        //     'direccion'         => $data['direccion'],
        //     'colonia'           => $data['colonia'],
        //     'lat'               => $data['lat'],
        //     'lng'               => $data['lng'],
        //     'telefono'          => $data['telefono'],
        //     'descripcion'       => $data['descripcion'],
        //     'apertura'          => $data['apertura'],
        //     'cierre'            => $data['cierre'],
        //     'uuid'              => $data['uuid'], 
        // ]);

        //Otra forma de guardar el establecimiento
        $establecimiento = new Establecimiento($data);
        $establecimiento->imagen_principal = $ruta_imagen;
        $establecimiento->user_id = auth()->user()->id;
        $establecimiento->save(); 


        //dd('Desde el store de establecmientos');
        return back()->with('estado', 'Se guardo el establecimiento!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Establecimiento  $establecimiento
     * @return \Illuminate\Http\Response
     */
    public function show(Establecimiento $establecimiento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Establecimiento  $establecimiento
     * @return \Illuminate\Http\Response
     */
    public function edit(Establecimiento $establecimiento)
    {
        return "Desde EDIT";
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Establecimiento  $establecimiento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Establecimiento $establecimiento)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Establecimiento  $establecimiento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Establecimiento $establecimiento)
    {
        //
    }
}
