

//generando boton
function generate_e(datas){
    
  let order_id = datas;
 let button_add = '<td><button class="btn btn-info rounded-pill"><a href="../etiquetas/print_etiquetas_.php?invoice_id='+order_id+'" target="_blank">Etiquetas</a></button></td>';
     document.getElementById("btn_etiquetas").innerHTML = "";
  $("#btn_etiquetas").append(button_add);
}
    



// esta es la consulta ajax pero buena es que cmo estaba haciend opruebas no tiene los datos como son

function imprimir() {

    let cotizacion = $(cotizaciones).val();

    console.log(cotizacion);

    windowObjectReference = window.open(

        "https://www.cotizar.jjquimienvases.com/imprimir.php?invoice_id=" + cotizacion,

        "DescriptiveWindowName",

        "resizable,scrollbars,status"

    );

    setTimeout(function () {

        windowObjectReference.print();

        // windowObjectReference.close()

    }, 8000);
}


var options2 = {
    style: 'currency',
    currency: 'USD'
};

var numberFormat2 = new Intl.NumberFormat('en-US', options2);




// Eventos




function sumar() {
    var inicial = $("#txt_campo_2").val();
    var pago = $("#txt_campo_3").val();
    resta = Math.abs(pago - inicial);

    if (pago < inicial) {

        document.getElementById('resultado').innerHTML = "Hacen falta: " + numberFormat2.format(resta);

    } else {

        document.getElementById('resultado').innerHTML = "Debes Regresar: " + numberFormat2.format(resta);

    }

}



let multiple = 0;
function ocultar_new_methods() {
    document.getElementById('nuevos_metodos_de_pago').style.display = 'none';
    document.getElementById('closse').style.display = 'none';
    document.getElementById('select_metodo_de_pago').style.display = 'block';
    document.getElementById('openn').style.display = 'block';
 multiple = 0;
 Swal.fire(
  'AVISO!',
  'Te cambiaste a metodo de pago unico!'+ " "+ multiple,
  'success'
)

    var inputNombre = document.getElementById("nuevo_method");
    inputNombre.value = "0";
}

function show_new_methods() {
    document.getElementById('nuevos_metodos_de_pago').style.display = 'block';
    document.getElementById('closse').style.display = 'block';
    document.getElementById('select_metodo_de_pago').style.display = 'none';
    document.getElementById('openn').style.display = 'none';
 multiple = 1;
  Swal.fire(
  'AVISO!',
  'Te cambiaste a metodo multiple!'+ " "+ multiple,
  'success'
)
    var inputNombre = document.getElementById("nuevo_method");
    inputNombre.value = "leiner_master";
}
function show_descuento() {
    document.getElementById('hide_desc').style.display = 'flex';
    document.getElementById('desc').style.display = 'flex';
    document.getElementById('apli_descuento').style.display = 'flex';
    document.getElementById('open_desc').style.display = 'none';
       document.getElementById('desc_btn').style.display = 'flex';

  Swal.fire(
  'AVISO!',
  'Esta opcion esta diseñada para aplicar descuentos!',
  'success'
)

onkeydescuento();
}
function hide_descuento() {
    document.getElementById('hide_desc').style.display = 'none';
    document.getElementById('desc').style.display = 'none';
    document.getElementById('open_desc').style.display = 'flex';
    document.getElementById('desc_btn').style.display = 'none';
    // document.getElementById('openn').style.display = 'none';
  Swal.fire(
  'AVISO!',
  'Cerraste la aplicacion de descuentos!',
  'info'
)
}

function descuento(){

}
function getdescuento(arg) {

    if (undefined == arg) { return 0; }

    if (undefined == arg.porcentaje || undefined == arg.subtotal) { return 0; }

    let total = 0;

    let porcentajeparsed = parseFloat(arg.porcentaje) / 100;

    let descuento = parseFloat(arg.subtotal) * porcentajeparsed;

    return descuento;

}



function onkeydescuento() {

    $("#porcentaje").on('keyup', function(evt) {

        let subtotal = parseFloat($("#txt_campo_2").val());

        let descuento = getdescuento({ porcentaje: parseFloat($(this).val()), subtotal: subtotal })

        $("#ahorro").val(descuento);

        $("#total_desc").val(subtotal - descuento);

        evt.preventDefault();

    });

}


function sumar_pintar() {


    let efectivo,
        datafono,
        bancolombia,
        davivienda;

    efectivo = $("#monto_efectivo").val();
    datafono = $("#monto_datafono").val();
    bancolombia = $("#monto_bancolombia").val();
    davivienda = $("#monto_davivienda").val();

    efectivo2 = parseInt(efectivo || 0);
    datafono2 = parseInt(datafono || 0);
    bancolombia2 = parseInt(bancolombia || 0);
    davivienda2 = parseInt(davivienda || 0);

    var sumita = efectivo2 + datafono2 + bancolombia2 + davivienda2;
    document.getElementById('txt_campo_3').value = sumita;

    console.log("esta funcionando la sumita" + sumita);

    var inicial = $("#txt_campo_2").val();
    var pago = sumita;
    resta = Math.abs(pago - inicial);

    if (pago < inicial) {
        document.getElementById('resultado').innerHTML = "Hacen falta: " + numberFormat2.format(resta);
    } else {
        document.getElementById('resultado').innerHTML = "Debes Regresar: " + numberFormat2.format(resta);
    }


}
