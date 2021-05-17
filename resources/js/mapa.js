import { OpenStreetMapProvider } from 'leaflet-geosearch';
// setup
//const provider = new OpenStreetMapProvider();

document.addEventListener('DOMContentLoaded', () => {

    const provider = new OpenStreetMapProvider();

    if(document.querySelector('#mapa')){
        const lat = 10.50477;
        const lng = -66.91369;
    
        const mapa = L.map('mapa').setView([lat, lng], 16);
    
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(mapa);
    
        let marker;
    
        // agregar el pin
        marker = new L.marker([lat, lng], {
            draggable: true,
            autoPan: true
        }).addTo(mapa);


        //Geocode service
        const geocodeService = L.esri.Geocoding.geocodeService({
            "apikey" :"AAPK7660a91fbfe449b78f06caa33fa997faTBMcfarz0yHFuyR-mpGqE58XjNBvW9snHhVZdCERxEcbEv-M6ibOlbVrv2cRN6MF"
        });

        //Buscado de direcciones 
        const buscador = document.querySelector('#formbuscador');
        buscador.addEventListener('input', buscarDireccion);        

        //Detectar movimiento del marker
        marker.on('moveend' , function(e) {

            console.log('Soltaste el ping');
            //console.log(e.target);

            marker = e.target;
            
            const posicion = marker.getLatLng();
            console.log(marker.getLatLng());
            const longitud = marker.getLatLng().lng;
            const latitud = marker.getLatLng().lat;

            //Centrar automaticamente
            mapa.panTo( new L.LatLng(posicion.lat, posicion.lng)  );

            //Reverse GeoCoding, cuando el usuario reubica el pin
            geocodeService
            .reverse()
            .latlng(marker.getLatLng())
            .run( function(error, result) {
               // console.log('Este es el Error: ' +  JSON.stringify(error)  );

                console.log('Este es el resultado: ' + JSON.stringify(result.address ));

                marker.bindPopup(result.address.LongLabel);
                marker.openPopup();

                //Llenar los campos
                llenarInputs(result);

            });

            
        });


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
            if(e.target.value.length >= 10){
                //Hacemos la consulta
                
            }
            console.log('provider: ', provider);
            console.log(e.target.value.length);
            
        }

    }


});