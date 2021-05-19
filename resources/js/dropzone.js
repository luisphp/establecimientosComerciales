document.addEventListener('DOMContentLoaded', () => {

    if(document.querySelector('#dropzone')){
        Dropzone.autoDiscover = false;

        const dropzone = new Dropzone('div#dropzone', {
            url : "/imagenes/store",
            dictDefaultMessage: 'Sube hasta o imagenes',
            maxFiles: 10,
            require: true,
            acceptedFiles: ".png , .jpg",
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content
            }
        });
    }
    
    





})