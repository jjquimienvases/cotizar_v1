//este es mi script para solicitar el traslados_inmediatos
var obtener_informacion;
$(document).ready(function() {
    $('#guardando').click(function() {
        var datos = $('#formulario').serialize();
        $.ajax({
            type: "POST",
            url: "new_send_traspaso.php",
            data: datos,
            success: function(r) {
                console.log(r);
                if (r != 0 && !isNaN(r)) { //SI ES DISTINTO A 0 Y ES UN NUMERO
                    alert("agregado con exito");
                    obtener_informacion = setTimeout(obtener_datos(), 3000);
                } else { //ES 0(NO SE EJECUTO LA CONSULTA) O EXISTE UN ERROR EXPLICATIVO(STRING)
                    alert("el string no funciona correctamente");
                    obtener_informacion = setTimeout(obtener_datos(), 3000);
                }
            }
        });
        return false;
    });


    $('#bodega').on('change', function() {
        var datos = $('#bodega').val();
        $.ajax({
            type: "POST",
            url: "send_end_solicitud.php",
            data: { metodo: "consultar", bodega: datos },
            success: function(r) {
                $('#solicitud').html(r);
            }
        });
        return false;
    });
    //consulta para mostrar tabla de datos insertados en la tarjeta 2

    //obtener los datos
    function obtener_datos() {
        $.ajax({
            url: "./element/mostrar_datos.php",
            method: "POST",
            success: function(data) {
                $("#responses").html(data)
            }
        })
    }
    

    //obtener_data_pedido_aprobado();
    
    //okay aqui vamos a cambiar el estado por 

    //  Eliminar producto de traspasos
    $(document).on("click", "#eliminar", function(e) {
        if (confirm("¿Estas seguro de eliminar este producto de tu solicitud de traspaso?")) {
            e.preventDefault();
            var id = $(this).data("id");
            $.ajax({
                url: "./element/eliminar.php",
                method: "POST",
                data: { id: id },
                success: function(data) {

                    obtener_datos();
                    alert(data);
                }
            })

        } else {
            console.log("no se confirmo la elimnacion de este producto");
        }
    })


    //envio de la finalizar_solicitud
    var obtener_informacion;
    $(document).ready(function() {

        $('#finalizar_solicitud').click(function() {
            var datos = $('#fmActualizar').serialize();

            $.ajax({
                type: "POST",
                url: "send_end_solicitud.php",
                data: datos,
                success: function(r) {
                    consultar_traspasos();
                    obtener_informacion = setTimeout(obtener_datos(), 3000);
                }
            });
            return false;
        });


        // Con esta function se actualiza el estado de traspaso a Transito
        $('#EnviarTraspasos').click(function() {
            var datos = $('#formularioTraspasos').serialize();
            Swal.fire({
                title: '¿Estás seguro?',
                text: "¿ Seguro quiere hacer este traspaso ?",
                type: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Aceptar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: "POST",
                        url: "send_end_solicitud.php",
                        data: datos,
                        success: function(r) {

                            consultar_traspasos();
                        }
                    });
                    return false;
                }
            });

        });

    });

    consultar_traspasos();


    // ----- Consultar Traspasos Finalizados
    function consultar_traspasos() {
        var datos = $('#responses').serialize();
        console.log(datos);
        $.ajax({
            type: "POST",
            url: "send_end_solicitud.php",
            data: { metodo: "consultar" },
            success: function(r) {
                $('#solicitud').html(r);
                obtener_informacion = setTimeout(obtener_datos(), 3000);
            }
        });
        return false;
    }
    // ----- Con esta funcion se actualiza la cantidad en aprobar -----//

    //----- Con esta funcion se muestra la mercancia ------//
    var obtener_informacion;
    var mensaje;
    $(document).ready(function() {
        $('#obtener').click(function() {
            function obtener_data() {
                $.ajax({
                    url: "./element/mostrar_mercancia.php",
                    method: "POST",
                    success: function(data) {

                        $("#respuestas").html(data);
                        console.log(data);
                    }
                })
            }
            obtener_data();

            //actualizar estado si no llego la mercancia 
            $(document).on("click", "#no_llego", function(e) {
                if (confirm("¿Estas seguro que este producto no llego en el pedido?")) {
                    e.preventDefault();
                    var id = $(this).data("id");
                    $.ajax({
                        url: "./element/update_status.php",
                        method: "POST",
                        data: { id: id },
                        success: function(data) {
                            obtener_data();
                            alert("Este producto se reporto como no recibido, gracias por avisar");
                        }
                    })
                } else {
                    console.log("no se confirmo la elimnacion de este producto");
                }
            });
        });
    });
});
var obtener_tabla;

function change_cantidad(id) {
    Swal.fire({
        title: '¿Quiere Cambiar La cantidad?',
        input: 'text',
        inputAttributes: {
            autocapitalize: 'off'
        },
        showCancelButton: true,
        confirmButtonText: 'Cambiar',
        showLoaderOnConfirm: true,


    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "POST",
                url: "send_end_solicitud.php",
                data: { id: id, cantidad: result.value, metodo: "UpdateCantidad" },
                success: function(r) {
                    consultar_traspasos2();
                }
            });

        }
    })

}
function pendiente(id){
   
      $.ajax({
           type: "POST",
          url: "send_end_solicitud.php",
           data: { metodo: "Cancelar",idtraspaso:id },
          success: function(r) {
              consultar_traspasos2();
             
        }
       });
     
}
function consultar_traspasos2() {
    var datos = $('#responses').serialize();
    console.log(datos);
    $.ajax({
        type: "POST",
        url: "send_end_solicitud.php",
        data: { metodo: "consultar" },
        success: function(r) {
            $('#solicitud').html(r);
           
        }
    });
    return false;
}