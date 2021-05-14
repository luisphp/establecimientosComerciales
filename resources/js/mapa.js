document.addEventListener('DOMContentLoaded', () => {

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
                console.log('Este es el Error: ' +  JSON.stringify(error)  );

                console.log('Este es el resultado: ' + JSON.stringify(result.address ));

                marker.bindPopup(result.address.LongLabel);
                marker.openPopup();
            });

            
        })
    }


});