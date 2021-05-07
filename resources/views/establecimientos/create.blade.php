@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center mt-4">Registrar establecimiento</h1>

        <div class="mt-5 justify-content-center">
            <form action="col-md-12 card card-body">
                <fieldset class="border p-4">
                    <legend class="text-primary">Nombre, Categoría e imagen principal</legend>

                    <div class="form-group">
                        <label for="nombre">Nombre establecimiento</label>
                        <input 
                            type="text" 
                            id="nombre" 
                            class="form-control @error('nombre') is-invalid @endError"
                            placeholder="Nombre de establecimiento"
                            name="nombre"
                            valie="{{ old('nombre') }}">
                            @error('nombre') 
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @endError
                    </div>
                    
                    <div class="form-group">
                        <label for="categoria">Categoria</label>
                        <select 
                            class="form-control @error('categoria_id') is-invalid @endError" 
                            name="categoria_id"
                            id="categoria"> 

                                <option value="" selected disabled>-- Seleccione --</option>
                            @foreach ($categorias as $categoria)
                                <option 
                                    value="{{$categoria->id}}"
                                           {{old('categoria_id') == $categoria->id ? 'selected' : ''}}
                                    >{{$categoria->nombre}}</option>    
                            @endforeach
                            
                            
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="imagen_principal">Imagen principal</label>
                        <input 
                            type="file" 
                            id="imagen_principal" 
                            class="form-control @error('imagen_principal') is-invalid @endError"
                            name="imagen_principal"
                            valie="{{ old('imagen_principal') }}">
                            @error('imagen_principal') 
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @endError
                    </div>
                    
                </fieldset>

                <fieldset class="border p-4">
                    <legend class="text-primary">Ubicación</legend>

                    <div class="form-group">
                        <label for="formbuscador">Coloca la dirección de tu establecimiento</label>
                        <input 
                            type="text" 
                            id="formbuscador" 
                            placeholder="Calle del negocio o establecimiento"
                            class="form-control">
                            <p class="text-secondary mt-5 mb-3 text-center">El asistente colocara una dirección estimada, mueve el pin hacia el lugar correcto</p>
                    </div>
                </fieldset>                                    
            </form>
        </div>
        
    </div>
    
@endsection