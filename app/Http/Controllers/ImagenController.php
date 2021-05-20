<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// import the Intervention Image Manager Class
//use Intervention\Image\ImageManagerStatic as Image;
 use Intervention\Image\Facades\Image;
 use App\Models\Imagen;
 use Illuminate\Support\Facades\File;
 use Illuminate\Support\Facades\Storage;



class ImagenController extends Controller
{
    public function store(Request $request)
    {
        //Almacenamos la imagen tal cual viene
        $ruta_imagen = $request->file('file')->store('establecimientos', 'public');



        //Resize a la imagen
        //$imagen = Image::make( public_path("storage/{$ruta_imagen}") )->fit(800, 450);
        $imagen = Image::make( public_path("storage/{$ruta_imagen}") );
        $imagen->fit(500, 250);
        
        $imagen->save();

        //Almacenar con modelo
        $imagenDB = new Imagen();
        $imagenDB->id_establecimiento = $request['uuid'];
        $imagenDB->ruta_imagen = $ruta_imagen;
        $imagenDB->save();

        $respuesta = array(
            "archivo" => $ruta_imagen
        );


        // return $request->all();
        return response()->json($respuesta);
    }

    //Eliminar imagen de la base de datos y servidor via javascript ajax request
    public function destroy(Request $request)
    {

        $imagen =  $request->get('imagen') ;

        if(File::exists( 'storage/'.$imagen )){
           File::delete( 'storage/'.$imagen );

            $respuesta = [
                'mensaje' => 'Imagen eliminada',
                'imagen' => $imagen
            ];

            Imagen::where('ruta_imagen', '=' ,$imagen )->delete();


        }else{
            $respuesta = [
                'mensaje' => 'No se elimino',
                'imagen' => $imagen
            ];
        }



        return response()->json($respuesta);
    }
}
