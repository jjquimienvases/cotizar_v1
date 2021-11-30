function ocultar_new_methods() {
    document.getElementById('all_info').style.display = 'none';
    document.getElementById('filters').style.display = 'none';
    document.getElementById('filter').style.display = 'block';
    document.getElementById('app').style.display = 'block';
}
function show_new_methods() {
    document.getElementById('all_info').style.display = 'block';
    document.getElementById('filters').style.display = 'block';
    document.getElementById('filter').style.display = 'none';
    document.getElementById('app').style.display = 'none';
}

const formatear = new Intl.NumberFormat('en-US', {

    style: 'currency',

    currency: 'USD',

    minimumFractionDigits: 2

});

function totales_principales() {
    let sumatotales = [];
    $("[id^=totales_principal]").each(function () {
        sumatotales.push(parseFloat($(this).val()))
    })
    if (sumatotales != 0) { totales = sumatotales.reduce(function (a, b) { return a + b }) } else {
        totales = 0;
    }
    return totales;
    // document.getElementById("okok").value = totales;
    // console.log("esta es mi suma" + totales);
}

const caracteres = ["&nbsp;"];
function reemplazarCaracteresEspeciales(datos, llaves, uppercase = true) {
    datos.map(d => {
        llaves.map(llave => {
            caracteres.map(c => {
                if (llave in d) {
                    const valor = d[llave].toLowerCase();
                    if (valor.includes(c)) {
                        const nuevo = valor.replace(c, " ");
                        d[llave] = uppercase ? nuevo.toUpperCase() : nuevo;
                        return;
                    }
                    return;
                }
            })
            return;
        })
    })

}

    function detalles(){
            windowObjectReference = window.open(

"../../abonos/table_info.php",

  "DescriptiveWindowName",

  "resizable,scrollbars,status"

);
    }

// alert(new Intl.NumberFormat().format(number));
// function formatear(monto) {
//     new Intl.NumberFormat().format(monto);
// }