const { default: axios } = require("axios");

document.addEventListener('DOMContentLoaded', () => {

    if(document.querySelector('#dropzone')){
        Dropzone.autoDiscover = false;

        const dropzone = new Dropzone('div#dropzone', {
            url : "http://localhost/establecimientosComerciales/public/imagenes/store",
            dictDefaultMessage: 'Sube hasta 10 imagenes',
            maxFiles: 10,
            required: true,
            acceptedFiles: ".png ,.jpg",
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content
            },
            init: function(){
                const galeria = document.querySelectorAll('#galeria');

                //onsole.log('Esta es la galeria: ', galeria );

                if(galeria.length > 0){
                    galeria.forEach(imagen => {
                        const imagen_publicada = {};
                        imagen_publicada.size = 1;

                        imagen_publicada.nombreServidor = imagen.value;


                        console.log(imagen.value);

                        imagen_publicada.name = imagen.value;

                        this.options.addedfile.call(this, imagen_publicada);
                        this.options.thumbnail.call(this, imagen_publicada, `../storage/${imagen_publicada.name}`);

                        imagen_publicada.previewElement.classList.add('dz-success');
                        imagen_publicada.previewElement.classList.add('dz-complete');


                    });
                }
            },
            success: function ( file, respuesta){
                // console.log(file);
                console.log( respuesta  );
                file.nombreServidor = respuesta.archivo;
            },
            sending: function ( file , xhr, formData ){
                formData.append('uuid', document.querySelector('#uuid').value );
                console.log('enviando la imagen');
            },
            addRemoveLinks : true,
            dictRemoveFile: 'Eliminar imagen',
            removedfile: function (file , respuesta){
                
                const params = {
                    imagen: file.nombreServidor
                }

                axios.post('http://localhost/establecimientosComerciales/public/imagenes/destroy',params )
                .then(respuesta => {
                    console.log('Respuesta del servidor al eliminar imagen', respuesta);

                    file.previewElement.parentNode.removeChild(file.previewElement);
                })
                .catch(error => {
                    console.log('Error al eliminar imagen', error);
                }) 
                
                //Eliminar del DOM
                


                console.log('Eliminar el archivo: ', file);
            }
        });
    }
    
    





})