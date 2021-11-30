$(document).ready(function() {
    $("#btnAddClientes").on("click", function() {
        var datos = $("#invoice-form").serialize();
        Swal.fire({
            title: "¿Estás seguro?",
            text: "Seguro quiere Crear este nuevo cliente",
            icon: "question",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Aceptar",
            cancelButtonText: "Cancelar",
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "POST",
                    url: "ClientesAjax.php",
                    data: datos,
                    success: function(r) {
                        var respuesta = JSON.parse(r);
                        console.log(respuesta);
                        alertas_ajax(respuesta);
                    },
                });
                return false;

            }
        });
    });

});