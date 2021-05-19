@extends('layouts.app')

@section('styles')
    <!-- Load Leaflet from CDN-->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

    <!-- Esri Leaflet Geocoder -->
    <link
      rel="stylesheet"
      href="https://unpkg.com/esri-leaflet-geocoder/dist/esri-leaflet-geocoder.css"
    />
    {{-- DropZone CDN --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/dropzone.min.css" integrity="sha512-jU/7UFiaW5UBGODEopEqnbIAHOI8fO6T99m7Tsmqs2gkdujByJfkCbbfPSN4Wlqlb9TGnsuC0YgUgWkRBK7B9A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

@endsection

@section('content')
    <div class="container">
        <h1 class="text-center mt-4">Registrar establecimiento</h1>

        <div class="mt-5 justify-content-center">
            <form action="" class="col-md-12 card card-body">
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
                            value="{{ old('nombre') }}">
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

                <fieldset class="border p-4 mt-5">
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
                                        id="direccion" 
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
                                            id="colonia" 
                                            class="form-control"
                                            @error('colonia') is-invalid @endError
                                            placeholder="colonia"
                                            value="{{ old('colonia') }}">
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
                <fieldset class="border p-4 mt-5">
                    <legend  class="text-primary">Información Establecimiento: </legend>
                        <div class="form-group">
                            <label for="nombre">Teléfono</label>
                            <input 
                                type="tel" 
                                class="form-control @error('telefono')  is-invalid  @enderror" 
                                id="telefono" 
                                placeholder="Teléfono Establecimiento"
                                name="telefono"
                                value="{{ old('telefono') }}"
                            >
    
                                @error('telefono')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                        </div>
    
                        
    
                        <div class="form-group">
                            <label for="nombre">Descripción</label>
                            <textarea
                                class="form-control  @error('descripcion')  is-invalid  @enderror" 
                                name="descripcion"
                            >{{ old('descripcion') }}</textarea>
    
                                @error('descripcion')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                        </div>
    
                        <div class="form-group">
                            <label for="nombre">Hora Apertura:</label>
                            <input 
                                type="time" 
                                class="form-control @error('apertura')  is-invalid  @enderror" 
                                id="apertura" 
                                name="apertura"
                                value="{{ old('apertura') }}"
                            >
                            @error('apertura')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
    
                        <div class="form-group">
                            <label for="nombre">Hora Cierre:</label>
                            <input 
                                type="time" 
                                class="form-control @error('cierre')  is-invalid  @enderror" 
                                id="cierre" 
                                name="cierre"
                                value="{{ old('cierre') }}"
                            >
                            @error('cierre')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                </fieldset>
                <fieldset class="border p-4 mt-5">
                    <legend  class="text-primary"> Agrega tus imagenes: </legend>
                        <div class="form-group">
                            <label for="imagenes">Imagenes</label>
                            <div id="dropzone" class="dropzone from-control">
                                <div>

                        </div>
                </fieldset>
                <input type="hidden" id="uuid" name="uuid" value="{{ Str::uuid()->toString() }}">
                <input type="Submit" class="btn btn-primary d-block" value="Registrar establecimiento">
            </form>
        </div>
        
    </div>
    
@endsection

@section('scripts')

    <script src="https://unpkg.com/leaflet/dist/leaflet-src.js" defer></script>

    <!-- Load Esri Leaflet from CDN -->
    <script src="https://unpkg.com/esri-leaflet" defer></script>

    <script src="https://unpkg.com/esri-leaflet-geocoder" defer></script>

    {{-- DropZone --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/dropzone.min.js" integrity="sha512-llCHNP2CQS+o3EUK2QFehPlOngm8Oa7vkvdUpEFN71dVOf3yAj9yMoPdS5aYRTy8AEdVtqUBIsVThzUSggT0LQ==" crossorigin="anonymous"  defer></script>

@endsection
