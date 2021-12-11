var obtener_informacion;
$(document).ready(function() {
    obtener_datos_ordenes();
    $('#guardando').click(function() {
        var datos = $('#formulario').serialize();
        $.ajax({
            type: "POST",
            url: "send_new_solicitud.php",
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
    $("#finalizar_solicitud").click(function() {
        var datos = $('#fmActualizar').serialize();
        $.ajax({
            url: "./ordenesAjax.php",
            method: "POST",
            data: datos,
            success: function(data) {
                console.log(data);
                obtener_datos();
            }
        })
    });
    $("#btnConsultar").click(function() {
        var datos = $('#consultar_ordenes').serialize();
        $.ajax({
            url: "./ordenesAjax.php",
            method: "POST",
            data: datos,
            success: function(data) {
                console.log(data);
                $("#tabla").html(data)
            }
        })


    });


    //obtener los datos
    function obtener_datos() {
        $.ajax({
            url: "./elementos/mostrar_datos1.php",
            method: "POST",
            success: function(data) {
                $("#responses").html(data)
            }
        })
    }
    obtener_datos();
    //  Eliminar producto de traspasos
    $(document).on("click", "#eliminar", function(e) {
        if (confirm("¿Estas seguro de eliminar este producto de tu solicitud de mercancia?")) {
            e.preventDefault();
            var id = $(this).data("id");
            $.ajax({
                url: "./elementos/eliminar.php",
                method: "POST",
                data: { id: id },
                success: function(data) {

                    obtener_datos();
                    // alert(data);
                }
            })

        } else {
            console.log("no se confirmo la elimnacion de este producto");
        }
    })






    //fin del jquery
});

function obtener_datos_ordenes() {
    $.ajax({
        url: "./ordenesAjax.php",
        method: "POST",
        data: { metodo: "consultar" },
        success: function(data) {
            $("#tabla").html(data)
        }
    })
}

function actualizar_estado_pendiente(id) {
    Swal.fire({
        title: '¿Estás seguro?',
        text: "¿ Seguro  ?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Aceptar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: "./ordenesAjax.php",
                method: "POST",
                data: { metodo: "update_pendiente", id_orden: id },
                success: function(data) {
                    obtener_datos_ordenes();
                }
            })
            return false;
        }
    });

}