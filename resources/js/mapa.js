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
        const geocodeService = L.esri.Geocoding.geocodeService();

        //Detectar movimiento del marker
        marker.on('moveend' , function(e) {
            console.log('Soltaste el ping');
            console.log(e.target);

            marker = e.target;
            
            const posicion = marker.getLatLng();
            //console.log(marker.getLatLng());


            //Centrar automaticamente
            mapa.panTo( new L.LatLng(posicion.lat, posicion.lng)  );

            //Reverse GeoCoding, cuando el usuario reubica el pin
            geocodeService.reverse().latlng(posicion, 16).run(function(error, resultado) {
                console.log('Este es el Error: ' + error);

                console.log('Este es el resultado: ' +resultado);
            });
        })
    }


});