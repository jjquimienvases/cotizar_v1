$(document).ready(function() {
    $("#guardando").click(function() {
        var datos = $("#invoice-form").serialize();
        Swal.fire({
            title: "¿Estás seguro?",
            text: "Seguro quiere Crear esta cotización",
            icon: "question",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Aceptar",
            cancelButtonText: "Cancelar",
        }).then((result) => {
            if (result.value) {
                let timerInterval;
                Swal.fire({
                    title: "Aguarde Un momento!",
                    html: "",
                    timer: 1000,
                    timerProgressBar: true,
                    didOpen: () => {
                        Swal.showLoading();
                        timerInterval = setInterval(() => {
                            const content = Swal.getContent();
                            if (content) {
                                const b = content.querySelector("b");
                                if (b) {
                                    b.textContent = Swal.getTimerLeft();
                                }
                            }
                        }, 100);
                    },
                    willClose: () => {
                        clearInterval(timerInterval);
                    },
                }).then((result) => {
                    if (result.dismiss === Swal.DismissReason.timer) {
                        $.ajax({
                            type: "POST",
                            url: "send_ajax_prueba.php",
                            data: datos,
                            success: function(r) {
                                var respuesta = JSON.parse(r);
                                console.log(respuesta);
                                alertas_ajax(respuesta);
                                if(respuesta.bodega == "4"){
                                    window.location.href="search/index.php";
                                }else if(respuesta.acciones == "8"){
                                    window.location.href="try_caja/index.php";
                                }else if(respuesta.acciones == "2"){
                                    window.location.href="search/index.php";
                                }else if(respuesta.acciones == "9"){
                                    window.location.href="try_caja/index.php";
                                }else if(respuesta.acciones == "26"){
                                    window.location.href="try_caja/index.php";
                                }else if(respuesta.acciones == "27"){
                                    window.location.href="try_caja/index.php";
                                }else if(respuesta.bodega == "2"){
                                    window.location.href="search_mostrador/index.php";
                                }else if(respuesta.bodega == "3"){
                                    window.location.href="try_caja/index.php";
                                }else if(respuesta.bodega == "7"){
                                    window.location.href="search_ibague_1/index.php";
                                }

                            },
                        });
                        return false;
                    }
                });
            }
        });
    });

    $("#limpiar").click(function() {
        //document.querySelector(".invoice-form").reset();
        let padre = $("#buscarcliente").parent().parent().parent();
        padre.find("[name^=tele]").val("");
        padre.find("[name^=direccion]").val("");
        padre.find("[name^=idcliente]").val("");
        padre.find("[name^=ciudad]").val("");
        padre.find("[name^=companyName]").val("");
        padre.find("[name^=id_cedula]").val("");
        padre.find("[name^=email]").val("");
        padre.find("[name^=puntosN]").val("");
        padre.find("[name^=puntosE]").val("");
    });
    $("#guardando_call").click(function() {
        var datos = $("#invoice-form").serialize();
        Swal.fire({
            title: "¿Estás seguro?",
            text: "Seguro quiere Crear esta cotización",
            icon: "question",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Aceptar",
            cancelButtonText: "Cancelar",
        }).then((result) => {
            if (result.value) {
                let timerInterval;
                Swal.fire({
                    title: "Aguarde Un momento!",
                    html: "",
                    timer: 1000,
                    timerProgressBar: true,
                    didOpen: () => {
                        Swal.showLoading();
                        timerInterval = setInterval(() => {
                            const content = Swal.getContent();
                            if (content) {
                                const b = content.querySelector("b");
                                if (b) {
                                    b.textContent = Swal.getTimerLeft();
                                }
                            }
                        }, 100);
                    },
                    willClose: () => {
                        clearInterval(timerInterval);
                    },
                }).then((result) => {
                    if (result.dismiss === Swal.DismissReason.timer) {
                        $.ajax({
                            type: "POST",
                            url: "send_ajax_prueba.php",
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
            }
        });
    });
});