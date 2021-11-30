/* function gramos(fila) {
    var gramos = $("#gramos_" + fila).val();
    var cantidad = $("#cantidad_" + fila).val();
    var Total;
    Total = gramos * cantidad;
    console.log(Total);
    $("#totalAftertax").val(Total);
} */
$(document).ready(function() {
    $("#Pnaturales").on("click", function() {
        if ($("#Pnaturales").prop('checked')) {
            var descuento = 1000;
            var total = $("#subTotal").val();
            var total_descuento = total - descuento;
            $("#subTotal").val(total_descuento);
        } else {
            calcular_total_perfumeria();
        }



    });

});

function borrar_total(fila) {
    var total = $("#result_" + fila).val(Total);

}

function calcular_gramos_totales(fila) {
    var gramos_adicionales = $("#gramos_adicionales_" + fila).val();
    var gramos = $("#unitario_" + fila).val();
    var cantidad = $("#cantidad_" + fila).val();
    var Total;
    var gramos;
    if (gramos_adicionales > 0) {
        suma = gramos_adicionales * 500;
        otal = gramos * cantidad;
        Total = suma + otal;

    } else {
        Total = gramos * cantidad;
    }


    console.log(Total);
    $("#result_" + fila).val(Total);
    calcular_total_perfumeria();
}

function calcular_total_perfumeria() {
    var totall = 0;
    var sumatotal = [];
    $("[id^=result]").each(function() {

        sumatotal.push(parseFloat($(this).val()))

    })
    totall = sumatotal.reduce(function(a, b) { return a + b })
    $("#subTotal").val(totall);
    total_perfumeria();
}

function total_perfumeria() {
    var totall = 0;
    var sumatotal = [];
    $("[id^=result]").each(function() {

        sumatotal.push(parseFloat($(this).val()))

    })
    totall = sumatotal.reduce(function(a, b) { return a + b })
    $("#totalAftertax").val(totall);
}

function calcular_gramos_recarga(fila) {
    var Capacidad = $("#Envase_" + fila).val();
    var precio = 0;
    var gramos = 0;
    if (Capacidad >= 1 && Capacidad <= 29) {
        console.log("rango del 1 al 29");
        precio = Capacidad * 430;
    } else if (Capacidad >= 31 && Capacidad <= 49) {
        console.log("rango del 31 al 49");
        precio = Capacidad * 400;
    } else if (Capacidad >= 51) {
        console.log("rango infinito");
        precio = Capacidad * 320;
    }
    gramos = Capacidad * 0.36;

    console.log(gramos);
    $("#unitario_" + fila).val(precio);
    $("#gramos_" + fila).val(gramos);
    calcular_total_perfumeria();
}


function calcular_gramos_adicionales(fila) {
    var gramos_adicionales = $("#gramos_adicionales_" + fila).val();
    var suma = 0;
    suma = gramos_adicionales * 500;
    $("#result_" + fila).val(suma);
}