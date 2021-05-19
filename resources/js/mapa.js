import { OpenStreetMapProvider } from 'leaflet-geosearch';
// setup
//const provider = new OpenStreetMapProvider();

document.addEventListener('DOMContentLoaded', () => {

    const provider = new OpenStreetMapProvider();

    if(document.querySelector('#mapa')){
        const lat = 10.50477;
        const lng = -66.91369;
    
        const mapa = L.map('mapa').setView([lat, lng], 16);

        //Eliminar pines previos
        //let markers = new L.FeatureGroup().addTo(mapa);
        let markers = new L.LayerGroup().addTo(mapa);
    
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(mapa);
    
        let marker;
    
        // agregar el pin
        marker = new L.marker([lat, lng], {
            draggable: true,
            autoPan: true
        }).addTo(mapa);
        //}).addTo(markers);

        markers.addLayer(marker);


        //Geocode service
        const geocodeService = L.esri.Geocoding.geocodeService({
            "apikey" :"AAPK7660a91fbfe449b78f06caa33fa997faTBMcfarz0yHFuyR-mpGqE58XjNBvW9snHhVZdCERxEcbEv-M6ibOlbVrv2cRN6MF"
        });

        //Buscado de direcciones 
        const buscador = document.querySelector('#formbuscador');
        buscador.addEventListener('blur', buscarDireccion);        

        reubicarPin(marker);

        function reubicarPin(marker){
                    //Detectar movimiento del marker
        marker.on('moveend' , function(e) {
            // console.log('Soltaste el ping');
            //console.log(e.target);
            marker = e.target;
            
            const posicion = marker.getLatLng();
            // console.log(marker.getLatLng());
            const longitud = marker.getLatLng().lng;
            const latitud = marker.getLatLng().lat;

            //Centrar automaticamente
            mapa.panTo( new L.LatLng(posicion.lat, posicion.lng)  );

            //Reverse GeoCoding, cuando el usuario reubica el pin
            geocodeService.reverse().latlng(marker.getLatLng()).run( function(error, result) {
               // console.log('Este es el Error: ' +  JSON.stringify(error)  );

                // console.log('Este es el resultado: ' + JSON.stringify(result.address ));

                marker.bindPopup(result.address.LongLabel);
                marker.openPopup();

                //Llenar los campos
                llenarInputs(result);
            });
        });
        }


        //Llenar inputs
        function llenarInputs(result){
            //console.log('Desde llenar inputs', result);
            //document.querySelector('#direccion').value() = resultado.Address;
            document.querySelector('#direccion').value = result.address.Address || '';
            document.querySelector('#colonia').value = result.address.City || '';
            document.querySelector('#lat').value = result.latlng.lat || '';
            document.querySelector('#lng').value = result.latlng.lng || '';
        }

        function buscarDireccion(e){
            if(e.target.value.length >= 5){
                //Hacemos la consulta
                provider.search({query: e.target.value  + ' Caracas VE '})
                .then(resultado => {
                    if(resultado[0]){
                        // console.log('La query', resultado[0]);

                        //Limpiamos los pines previos
                        markers.clearLayers();

                        //Reverse GeoCoding, cuando el usuario reubica el pin
                    geocodeService
                    .reverse()
                    .latlng(resultado[0].bounds[0], 16)
                    .run( function(error, result) {
                    // console.log('Este es el Error: ' +  JSON.stringify(error)  );

                        //console.log('Este es el resultado: ' + JSON.stringify(result) );

                       // Llenar los inputs
                       llenarInputs(result);

                       // Mover el pin
                        mapa.setView(resultado[0].bounds[0], 16);

                        // Agregar el pin
                        let marker;
    
                        // Agregar el pin
                        marker = new L.marker(resultado[0].bounds[0], {
                            draggable: true,
                            autoPan: true
                        }).addTo(mapa);

                        // Asignar el contenedor de markers el nuevo pin
                        markers.addLayer(marker);

                       // Permitir al usuario mover el pin
                       reubicarPin(marker);
                       
                    });

                    }
                
                }).catch(error => {
                    console.log('Error buscarDireccion: ' , error);
                })
            }
            //console.log('provider: ', provider);
            //console.log(e.target.value.length);
            
        }

    }


});