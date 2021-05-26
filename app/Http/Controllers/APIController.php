<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\Establecimiento;

class APIController extends Controller
{
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
        $establecimientos = Establecimiento::where('categoria_id', '=', $categoria->id)->with('categoria')->get();

        return response()->json($establecimientos);
    }

    //Muestra un establecimiento es especifico
    public function show(Establecimiento $establecimiento)
    {

        return response()->json($establecimiento);


    }
}
