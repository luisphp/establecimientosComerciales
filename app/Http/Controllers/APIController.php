<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\Establecimiento;
use App\Models\Imagen;

class APIController extends Controller
{
    //Method para retornar todos los establecimientos
    public function index()
    {
        $establecimientos = Establecimiento::with('categoria')->get(); //Ha esto se le llama onner loading


        return response()->json($establecimientos);


    }

    //Method para obtener todas las categorias
    public function categorias()
    {
        $categorias = Categoria::all();


        return response()->json($categorias);


    }

    //Mostrar los establecimientos de la categoria en especifico
    public function categoria( Categoria $categoria )
    {
        //dd($categoria);
        $establecimientos = Establecimiento::where('categoria_id', '=', $categoria->id)->with('categoria')->take(3)->get();

        return response()->json($establecimientos);
    }

    //Muestra un establecimiento es especifico
    public function show(Establecimiento $establecimiento)
    {

        $imagenes = Imagen::where('id_establecimiento', $establecimiento->uuid)->get();
        $establecimiento->imagenes = $imagenes;
        return response()->json($establecimiento);


    }

    //Muestra todos los establecimientos de una categoria pasada por parametro
    public function estableCat(Categoria $categoria){

        //dd($categoria);
        $establecimientos = Establecimiento::where('categoria_id', '=', $categoria->id)->with('categoria')->get();

        return response()->json($establecimientos);

    }
}
