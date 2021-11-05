
function ver_datos(id, e) {
    var dato = document.getElementById('cliente' + id);
    e.preventDefault();
}

$("#buscarcliente").on('keyup', function () {
    $.ajax({
        url: '../../methods/conexiones.php',
        type: 'POST',
        dataType: 'json',
        data: {
            key: 'Q1',
            cliente: $(this).val()
        }
    }).done(function (d) {

        let padre = $("#buscarcliente").parent().parent().parent();
    }).fail(function (e) {

    });
})


$("#buscarcomercial").on('change', function () {
    $.ajax({
        url: '../../methods/conexiones.php',
        type: 'POST',
        dataType: 'json',
        data: {
            key: 'Q1',
            cliente: $(this).val()
        }
    }).done(function (d) {

        let padre = $("#buscarcomercial").parent().parent().parent();
    }).fail(function (e) {

    });
})

$("#form_reporte").submit(function (e) {
    var datos = $(this).serialize();
    $.ajax({
        url: '../backend/funciones_php/ajax_consultas.php',
        method: "POST",
        data: datos
    }).done(function (d) {
        $("#lista_metodos").empty()
        $("#table-body").empty();

        console.log(d);
        if (!d || !(d.length > 0)) {
            alert("No se encontarron datos");
            return;
        }

        const result = JSON.parse(d);
        /* console.log(result); */
        const data = [];
        const filas = [];
        for (r of result) {
            var cotizacion = r["order_id"];
            var comercial = r["order_receiver_address"].toUpperCase();
            var cliente = r["order_receiver_name"].toUpperCase();
            var metodo_de_pago = r["metodo_de_pago"];
            var fecha = r["order_date"];
            var monto = r["order_total_after_tax"];




            let fila = `
          <tr>
        <td>${fecha}</td>
        <td>${cotizacion}</td>
        <td>${cliente}</td>
        <td>${comercial}</td>
        <td>${metodo_de_pago}</td>
        <td id="okok">${monto}</td>
    </tr>
          `;



            data.push(r)
            filas.push(fila);

            // document.getElementById("fecha").value = fecha;
        }
        let mysuma = 0;
        mysuma = parseFloat(monto);

        const html2 = data.map(m => {
            const montos = Math.floor(parseFloat(m.order_total_after_tax));
            mysuma += montos
        })
        console.log(mysuma);

        $("#table-body").append(filas);
        // $("#total_count").html(filas.length);
        // $("#total_count").html("El total filas es:" + filas.length + " Filas");

        // $("#total_monto").html("El Monto total es:" + "$" + " " + new Intl.NumberFormat().format(mysuma));
        let total_monto = "$" + new Intl.NumberFormat().format(mysuma);
        let total_filas = filas.length;

        console.log(total_monto);

        document.getElementById("info_monto").value = total_monto;
        document.getElementById("filas").value = total_filas;


        const metodos = [];
        const html = data.map(f => {
            const metodo = f.metodo_de_pago.toUpperCase();
            const monto = Math.floor(parseFloat(f.order_total_after_tax));

            const found = metodos.find(val => val.metodo === metodo);
            if (!found) {
                metodos.push({
                    metodo,
                    total: monto
                });
            } else {
                found.total += monto
            }
        })



        const html_metodos = metodos.map(m => {
            $("#lista_metodos").append(`<li>${m.metodo}: ${m.total}</li>`);
        })
        mysuma += monto;


    }).fail(function (e) {

    })
    e.preventDefault();
})


var dropdown = document.getElementsByClassName("dropdown-btn");
var i;

for (i = 0; i < dropdown.length; i++) {
    dropdown[i].addEventListener("click", function () {
        this.classList.toggle("active");
        var dropdownContent = this.nextElementSibling;
        if (dropdownContent.style.display === "block") {
            dropdownContent.style.display = "none";
        } else {
            dropdownContent.style.display = "block";
        }
    });
}

function abrir_filtro() {
    $("#info_formulario").fadeIn();
    $("#filters").fadeIn();
}

function cerrar_filtro() {
    $("#info_formulario").fadeOut();
    $("#filters").fadeOut();
}

