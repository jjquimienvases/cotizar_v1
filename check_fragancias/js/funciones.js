
$(document).ready(function () {
    
    $("#generate_consulta").hide();
  $("#generate_consulta").trigger("click");
});

function getInformation(){
    $.ajax({
        url: "ajax/consultando.php",
        type: "POST",
        dataType: "json",
        data: {
            key: "Q2",
        },
    })
    .done(function (d) {
        /*     console.log(d); */
        d.retornolosdatos.forEach((item) => {
            let item_id = item.id;
            let contratipo = item.contratipo;
            let name_prov = item.name_prov;
            let stock = item.stock;
            let generos = item.genero;

            var capa = document.getElementById("info_fragancias");
            let td = document.createElement("td");
            var tr = document.createElement("tr");
            var td_item = document.createElement("td");
            var td_item_name = document.createElement("td");
            var td_item_prov = document.createElement("td");
            var td_stock = document.createElement("td");
            var td_genero = document.createElement("td");


            td_item.innerHTML = item_id;
            td_item_name.innerHTML = contratipo.toUpperCase();
            td_item_prov.innerHTML = name_prov.toUpperCase();
               td_genero.innerHTML = generos.toUpperCase();
            td_stock.innerHTML = stock;

            //capa imprime la informacion
            capa.appendChild(tr);
            capa.appendChild(td_item);
            capa.appendChild(td_item_prov);
            capa.appendChild(td_item_name);
                 capa.appendChild(td_genero);
            capa.appendChild(td_stock);

        });

    })
    .fail(function (e) {});
}


function getInformation_filter(data){

    $.ajax({
        url: "../ajax/consultando.php",
        type: "POST",
        dataType: "json",
        data: {
            key: "Q3",
            dato: data
        },
    })
    .done(function (d) {
        /*     console.log(d); */
        d.retornolosdatos.forEach((item) => {
            let item_id = item.id;
            let contratipo = item.contratipo;
            let name_prov = item.name_prov;
            let stock = item.stock;

            var capa = document.getElementById("info_fragancias");
            let td = document.createElement("td");
            var tr = document.createElement("tr");
            var td_item = document.createElement("td");
            var td_item_name = document.createElement("td");
            var td_item_prov = document.createElement("td");
            var td_stock = document.createElement("td");


            td_item.innerHTML = item_id;
            td_item_name.innerHTML = contratipo;
            td_item_prov.innerHTML = name_prov;
            td_stock.innerHTML = stock;

            //capa imprime la informacion
            capa.appendChild(tr);
            capa.appendChild(td_item);
            capa.appendChild(td_item_name);
            capa.appendChild(td_item_prov);
            capa.appendChild(td_stock);

        });

    })
    .fail(function (e) {});
}