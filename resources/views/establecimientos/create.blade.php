@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
  integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
  crossorigin=""/>
  <!--<link rel="stylesheet" href="./esri-leaflet-geocoder.css">-->
  <link
      rel="stylesheet"
      href="https://unpkg.com/esri-leaflet-geocoder/dist/esri-leaflet-geocoder.css"
    />
@endsection

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
                    <div class="form-group">
                        <div id="mapa" style="height: 300px; background-color: gray;"></div> 
                            <p class="informacion">
                                Confirma que los siguientes campos son correctos
                            </p>
                            <div class="form-group">
                                <label for="direccion">Dirección</label>

                                    <input 
                                        class="form-control"
                                        @error('direccion') is-invalid @endError
                                        placeholder="direccion"
                                        value="{{ old('direccion') }}">
                                    </input>
                                    @error('direccion') 
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                    @endError
                                
                            </div>
                        </div>
                        <div class="form-group">
                                <div class="form-group">
                                    <label for="colonia">Colonia</label>
    
                                        <input 
                                            class="form-control"
                                            @error('colonia') is-invalid @endError
                                            placeholder="direccion"
                                            value="{{ old('direccion') }}">
                                        </input>
                                        @error('colonia') 
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                        @endError
                                    
                                </div>
                            </div>
                            <input type="hidden" id="lat" name="lat" value="{{old('lat')}}">
                            <input type="hidden" id="lng" name="lng" value="{{old('lng')}}">
                </fieldset>                                    
            </form>
        </div>
        
    </div>
    
@endsection

@section('scripts')

    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
    integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
    crossorigin=""></script>

    <script src="https://unpkg.com/esri-leaflet@3.0.1/dist/esri-leaflet.js"
    integrity="sha512-JmpptMCcCg+Rd6x0Dbg6w+mmyzs1M7chHCd9W8HPovnImG2nLAQWn3yltwxXRM7WjKKFFHOAKjjF2SC4CgiFBg=="
    crossorigin=""></script>

    
    <!--<script src="./esri-leaflet-geocoder.js"></script>-->

    <script>

    </script>

@endsection
