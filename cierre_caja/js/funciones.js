$(document).ready(function() {
const hoy = new Date();
let date = hoy.toDateString();

    $('#close').click(function() {
        Swal.fire({
            title: '¿Cerrar Caja?',
            text:'¿Estas Seguro De Cerrar La Caja del dia '+date+'?',
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: `Cerrar Caja`,
            denyButtonText: `Verificar Informacion`,
          }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                var datos = $('#form_1').serialize();
                // console.log(datos);
                $.ajax({
                    type: "POST",
                    url: "./ajax/ajax_cerrar_caja.php",
                    data: datos,
                    success: function(r) {
                        console.log(r);
                        if (r != 0 && !isNaN(r)) { //SI ES DISTINTO A 0 Y ES UN NUMERO
                            Swal.fire({
                                position:'top-end',
                                icon: 'success',
                                title: 'Hemos cerrado la caja correctamente!',
                                showConfirmButton: false,
                                timer: 1500
                              })
        
                            console.log(datos);
                        } else { //ES 0(NO SE EJECUTO LA CONSULTA) O EXISTE UN ERROR EXPLICATIVO(STRING)
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'La caja de este punto ya esta cerrada!',
                                footer: '<a href="https://api.whatsapp.com/send?phone=573045393941">Contactar Al desarrollador</a>'
                              })
                            console.log(datos);
                        }
                    }
                });
                return false;
            } else if (result.isDenied) {
              Swal.fire('Decidiste Verificar la informacion', '', 'info')
            }
          })
        
    });

    $('#send_novedad').click(function() {
        Swal.fire({
            title: '¿Subir Novedad?',
            text:'¿Estas Seguro De Declarar este gasto?',
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: `Subir Novedad`,
            denyButtonText: `No Subir`,
          }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                var datos = $('#form_2').serialize();
                // console.log(datos);
                $.ajax({
                    type: "POST",
                    url: "./ajax/ajax_crear_novedad.php",
                    data: datos,
                    success: function(r) {
                        console.log(r);
                        if (r != 0 && !isNaN(r)) { //SI ES DISTINTO A 0 Y ES UN NUMERO
                            Swal.fire({
                                position:'top-end',
                                icon: 'success',
                                title: 'Hemos generado la novedad correctamente!',
                                showConfirmButton: false,
                                timer: 1500
                              })
        
                            console.log(datos);
                        } else { //ES 0(NO SE EJECUTO LA CONSULTA) O EXISTE UN ERROR EXPLICATIVO(STRING)
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Algo salio mal!',
                                footer: '<a href="https://api.whatsapp.com/send?phone=573045393941">Contactar Al desarrollador</a>'
                              })
                            console.log(datos);
                        }
                    }
                });
                return false;
            } else if (result.isDenied) {
              Swal.fire('Decidiste Verificar la informacion', '', 'info')
            }
          })
        
    });
    
    $('#open_cuadre').click(function(){
   var locale = {
    OK: 'I Suppose',
    CONFIRM: 'Ingresar',
    CANCEL: 'NO estoy autorizado'
};
            
bootbox.addLocale('custom', locale);
            
bootbox.prompt({ 
    title: "Escribe la clave de ingreso", 
    locale: 'custom',
    callback: function (result) {
        
        let pwd = "santi2021";
        
        if(result == pwd){
            //generar redireccon
            location.href = '../novedades/index.php';
        }else{
            Swal.fire('NO ESTAS AUTORIZAD PARA INGRESAR A ESTE APARTADO','','error');
        }
        
        console.log('This was logged in the callback: ' + result);
    }
});
    });
});