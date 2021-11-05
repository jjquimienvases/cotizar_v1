//funciones para ocultar los div

$(document).on("click", "#try", function cerrarTodo(){
document.getElementById('splash1').style.display = 'none';
document.getElementById('splash2').style.display = 'none';
document.getElementById('cremas').style.display = 'none';
document.getElementById('crema30').style.display = 'none';
document.getElementById('crema60').style.display = 'none';
document.getElementById('crema120').style.display = 'none';
document.getElementById('crema250').style.display = 'none';
document.getElementById('aftershave').style.display = 'none';
document.getElementById('onzasPerfumeria').style.display = 'none';
document.getElementById('preparado').style.display = 'none';
document.getElementById('ifYes3').style.display = 'none';
document.getElementById('preparado30').style.display = 'none';
document.getElementById('Preparado50').style.display = 'none';
document.getElementById('preparado100').style.display = 'none';
document.getElementById('preparado_lujo').style.display = 'none';
document.getElementById('lujo30').style.display = 'none';
document.getElementById('lujo50').style.display = 'none';
document.getElementById('lujo100').style.display = 'none';
document.getElementById('recarga').style.display = 'none';
document.getElementById('recarga30').style.display = 'none';
document.getElementById('recarga50').style.display = 'none';
document.getElementById('recarga100').style.display = 'none';
});


   //cerrar splash
  $(document).on("click", "#close1", function ocultar(){
      document.getElementById('ifYes').style.display = 'none';
    });
       //cantidades 250
       $(document).on("click", "#closesplash1", function ocultar(){
           document.getElementById('splash1').style.display = 'none';
         });
        // 120
      $(document).on("click", "#closesplash2", function ocultar(){
            document.getElementById('splash2').style.display = 'none';
          });


    //cerrar cremas opciones
  $(document).on("click", "#close2", function ocultar(){
      document.getElementById('cremas').style.display = 'none';
    });
          //cremas capacidades

          $(document).on("click", "#closecm30", function ocultar(){
              document.getElementById('crema30').style.display = 'none';
            });

         $(document).on("click", "#closecm60", function ocultar(){
                document.getElementById('crema60').style.display = 'none';
              });

          $(document).on("click", "#closecm120", function ocultar(){
                  document.getElementById('crema120').style.display = 'none';
                });

          $(document).on("click", "#closecm250", function ocultar(){
                  document.getElementById('crema250').style.display = 'none';
                });

  // cerrar after shave
  $(document).on("click", "#close3", function ocultar(){
      document.getElementById('aftershave').style.display = 'none';
    });

  // cerrar onzasPrecio
  $(document).on("click", "#close4", function ocultar(){
      document.getElementById('onzasPerfumeria').style.display = 'none';
    });

  //cerrar perfumes
  $(document).on("click", "#close5", function ocultar(){
      document.getElementById('preparado').style.display = 'none';
    });
  $(document).on("click", "#closespr", function ocultar(){
      document.getElementById('ifYes3').style.display = 'none';
    });

    //preparado 30ML
  $(document).on("click", "#closepp30", function ocultar(){
      document.getElementById('preparado30').style.display = 'none';
    });
  //preparado 50ml
  $(document).on("click", "#closepp50", function ocultar(){
      document.getElementById('Preparado50').style.display = 'none';
    });
//preparado 100ml
  $(document).on("click", "#closepp100", function ocultar(){
      document.getElementById('preparado100').style.display = 'none';
    });

  // perfumes preparados de lujo

  $(document).on("click", "#closeppl", function ocultar(){
      document.getElementById('preparado_lujo').style.display = 'none';
    });
  // capacidades  (30ml)
  $(document).on("click", "#closeppl30", function ocultar(){
      document.getElementById('lujo30').style.display = 'none';
    });
  //capacidades (50ml)
  $(document).on("click", "#closeppl50", function ocultar(){
      document.getElementById('lujo50').style.display = 'none';
    });
  //capacidades (100ml)
  $(document).on("click", "#closeppl100", function ocultar(){
      document.getElementById('lujo100').style.display = 'none';
    });

  //recargas
  $(document).on("click", "#closeppr", function ocultar(){
      document.getElementById('recarga').style.display = 'none';
    });
  // capacidades  (30ml)
  $(document).on("click", "#closeppr30", function ocultar(){
      document.getElementById('recarga30').style.display = 'none';
    });
  //capacidades (50ml)
  $(document).on("click", "#closeppr50", function ocultar(){
      document.getElementById('recarga50').style.display = 'none';
    });
  //capacidades (100ml)
  $(document).on("click", "#closeppr100", function ocultar(){
      document.getElementById('recarga100').style.display = 'none';
    });


//---------------------------------------------------->>

function yesnoCheck(that) {
  if (that.value == "splash") {
    document.getElementById("ifYes").style.display = "block";
  } else if(that.value == "crema"){
    document.getElementById("cremas").style.display = "block";
  }else if(that.value == "pp"){
    document.getElementById("ifYes3").style.display = "block";
  }else if(that.value == "after"){
    document.getElementById("aftershave").style.display = "block";
  }else if(that.value == "onzas"){
    document.getElementById("onzasPerfumeria").style.display = "block";
  }else{
    document.getElementById("ifYes").style.display = "none";
  }
}

//splash
function opcion(that) {
  if (that.value == "250") {
    document.getElementById("splash1").style.display = "block";
  }else if(that.value == "120") {
    document.getElementById("splash2").style.display = "block";

  }
}

// splash 250ml
$(document).on('blur', "[id^=cantidad]", function(){
  calcularTotales();
});
// function run_calcular(e, id){
//   calcularTotal(id);
// }

function calcularTotales(){

  var cod = document.getElementById("opcionesPerfumeria").value;
  var combo = document.getElementById("opcionesPerfumeria");
  var presentaciones = combo.options[combo.selectedIndex].text;

  var code = document.getElementById("splash").value;
  var combos = document.getElementById("splash");
  var capacidad = combos.options[combos.selectedIndex].text;
  var presentacion = "Splash 250ml";
  // var cantidad = $('#cantidad'+id1).val();
  var gramos_adicionales =  document.getElementById("AdicionalSplash250").value;

  if (gramos_adicionales != 0) {
  var valor_adicional = 500 * gramos_adicionales;
  }

  var precio =  document.getElementById("precio").value;
  var gramos =  document.getElementById("gramos").value;
  var cantidad =  document.getElementById("cantidad").value;
  if (undefined==cantidad) {cantidad = 0;}
  var q = document.getElementById('quantityP').value = cantidad;
  var presentacionf =  document.getElementById("presentacion").value = presentacion;
  if (gramos_adicionales != 0) {
    var cantidadTotal =  document.getElementById("quantity").value = gramos * cantidad  + parseInt(gramos_adicionales);
  }else{
    var cantidadTotal =  document.getElementById("quantity").value = gramos * cantidad ;
  }
  var price =  document.getElementById("price").value = precio;
  suma = precio * cantidad;
  // document.getElementById("total").value= suma;
  if (gramos_adicionales != 0) {
  document.getElementById("totales").value = suma + parseInt(valor_adicional);
}else {
  document.getElementById("totales").value = suma;

}
}
//splahs 120
$(document).on('blur', "[id^=cantidad2]", function(){
  calcularTotalSplah2();
});
// function run_calcular(e, id){
//   calcularTotalSplah2(id);
// }

function calcularTotalSplah2(){
  var cod = document.getElementById("opcionesPerfumeria").value;
  var combo = document.getElementById("opcionesPerfumeria");
  var presentaciones = combo.options[combo.selectedIndex].text;
  var code = document.getElementById("splash").value;
  var combos = document.getElementById("splash");
  var capacidad = combos.options[combos.selectedIndex].text;
  var presentacion = "Splash 120";
  var precio =  document.getElementById("precio2").value;
  var gramos =  document.getElementById("gramos2").value;
  var cantidad =  document.getElementById("cantidad2").value;
  var gramos_adicionales =  document.getElementById("AdicionalSplash120").value;

  if (gramos_adicionales != 0) {
  var valor_adicional = 500 * gramos_adicionales;
  }

  if (undefined==cantidad2) {cantidad2 = 0;}
  var q = document.getElementById('quantityP').value = cantidad;
  var presentacionf =  document.getElementById("presentacion").value = presentacion;
  if (gramos_adicionales != 0) {
    var cantidadTotal =  document.getElementById("quantity").value = gramos * cantidad  + parseInt(gramos_adicionales);
  }else{
    var cantidadTotal =  document.getElementById("quantity").value = gramos * cantidad ;
  }
    var price =  document.getElementById("price").value = precio;
  suma = precio * cantidad;
  if (gramos_adicionales != 0) {
    document.getElementById("totales").value = suma + parseInt(valor_adicional);

  }else {
    document.getElementById("totales").value = suma;

  }
}

//perfumes preparados
function perfumes_preparados(that) {
  if (that.value == "1") {
    alert("escogiste un envase sencillo");
    document.getElementById("preparado").style.display = "block";
  }else if(that.value == "2") {
    alert("escogiste un perfume de lujo");
    document.getElementById("preparado_lujo").style.display = "block";
  }else if(that.value == "3"){
    alert("escogiste recargar un perfume");
    document.getElementById("recarga").style.display = "block";
  }else{
    alert("escoger una opcion valida");
  }
}
//perfumes preparados
function perfumes_preparados_opcion(that) {
  if (that.value == "30") {
    document.getElementById("preparado30").style.display = "block";
  }else if(that.value == "50") {
    document.getElementById("Preparado50").style.display = "block";
  }else if(that.value == "100"){
    document.getElementsByName("preparado100")[0].style.display = "block";
  }
}
// calcular 30ml general
$(document).on('blur', "[id^=cantidad3]", function(){
  calcularTotalperfumes();
});
// function run_calcular(e, id){
//   calcularTotalperfumes(id);
// }
function calcularTotalperfumes(){
  var cod = document.getElementById("opcionesPerfumeria").value;
  var combo = document.getElementById("opcionesPerfumeria");
  var presentaciones = combo.options[combo.selectedIndex].text;
  var envasex = 1801;
  var gramos_adicionales =  document.getElementById("gramosAdicionalesS30ml").value;

    if (gramos_adicionales != 0) {
     var valor_adicional = 500 * gramos_adicionales;
       }

  var presentacion = "Perfume Preparado 30ml";
  var precio =  document.getElementById("precio3").value;
  var gramos =  document.getElementById("gramos3").value;
  var cantidad =  document.getElementById("cantidad3").value;
  if (undefined==cantidad) {cantidad = 0;}
  var q = document.getElementById('quantityP').value = cantidad;
  var presentacionf =  document.getElementById("presentacion").value = presentacion;
  if (gramos_adicionales > 0) {
    var cantidadTotal =  document.getElementById("quantity").value = gramos * cantidad  + parseInt(gramos_adicionales);
  }else{
    var cantidadTotal =  document.getElementById("quantity").value = gramos * cantidad;
  }
  var price =  document.getElementById("price").value = precio;
  var  suma = precio * cantidad;
  if (gramos_adicionales > 0) {
     document.getElementById("totales").value = suma + parseInt(valor_adicional);

   }else {
     document.getElementById("totales").value = suma;

   }
  document.getElementById("envase").value = envasex;


}
// calcular 50ml general
$(document).on('blur', "[id^=cantidad4]", function(){
  calcularTotalperfumes50ml();
});
// function run_calcular(e, id){
//   calcularTotalperfumes50ml(id);
// }

function calcularTotalperfumes50ml(){
  var cod = document.getElementById("opcionesPerfumeria").value;
  var combo = document.getElementById("opcionesPerfumeria");
  var presentaciones = combo.options[combo.selectedIndex].text;
  var envasex = 1500;

  var presentacion = "Perfume preparado 50ml";
  var precio =  document.getElementById("precio4").value;
  var gramos =  document.getElementById("gramos4").value;
  var cantidad =  document.getElementById("cantidad4").value;
  var gramos_adicionales =  document.getElementById("gramosAdicionalesS50ml").value;

  if (gramos_adicionales != 0) {
  var valor_adicional = 500 * gramos_adicionales;
  }

  if (undefined==cantidad4) {cantidad4 = 0;}
  var q = document.getElementById('quantityP').value = cantidad;
  var presentacionf =  document.getElementById("presentacion").value = presentacion;
  if (gramos_adicionales != 0) {
    var cantidadTotal =  document.getElementById("quantity").value = gramos * cantidad  + parseInt(gramos_adicionales);
  }else{
    var cantidadTotal =  document.getElementById("quantity").value = gramos * cantidad ;
  }
    var price =  document.getElementById("price").value = precio;

  suma = precio * cantidad;
  if (gramos_adicionales != 0) {
    document.getElementById("totales").value = suma + parseInt(valor_adicional);

  }else {
    document.getElementById("totales").value = suma;

  }
    document.getElementById("envase").value = envasex;

}
//calcular 100ml general
$(document).on('blur', "[id^=cantidad5]", function(){
  calcularTotalperfumes100ml();
});
// function run_calcular(e, id){
//   calcularTotalperfumes100ml(id);
// }

function calcularTotalperfumes100ml(){
  var cod = document.getElementById("opcionesPerfumeria").value;
  var combo = document.getElementById("opcionesPerfumeria");
  var presentaciones = combo.options[combo.selectedIndex].text;
  var envasex = 1000;
  var presentacion = "Perfume preparado 100ml";
  var precio =  document.getElementById("precio5").value;
  var gramos =  document.getElementById("gramos5").value;
  var cantidad =  document.getElementById("cantidad5").value;
  var gramos_adicionales =  document.getElementById("gramosAdicionalesS100ml").value;

  if (gramos_adicionales != 0) {
  var valor_adicional = 500 * gramos_adicionales;
  }


  if (undefined==cantidad5) {cantidad5 = 0;}
  var q = document.getElementById('quantityP').value = cantidad;
  var presentacionf =  document.getElementById("presentacion").value = presentacion;
  if (gramos_adicionales != 0) {
    var cantidadTotal =  document.getElementById("quantity").value = gramos * cantidad  + parseInt(gramos_adicionales);
  }else{
    var cantidadTotal =  document.getElementById("quantity").value = gramos * cantidad ;
  }
    var price =  document.getElementById("price").value = precio;
  suma = precio * cantidad;
  if (gramos_adicionales != 0) {
     document.getElementById("totales").value = suma + parseInt(valor_adicional);

   }else {
     document.getElementById("totales").value = suma;

   }
     document.getElementById("envase").value = envasex;
}
//perfumes de lujo
function perfumes_preparados_opcion_lujo(that) {
  if (that.value == "30") {
    document.getElementById("lujo30").style.display = "block";
  }else if(that.value == "50") {
    document.getElementById("lujo50").style.display = "block";
  }else if(that.value == "100"){
    document.getElementsByName("lujo100")[0].style.display = "block";
  }
}
//carcular 100ml lujo
$(document).on('blur', "[id^=cantidadlujo3]", function(){
  calcularTotalperfumesLujo30();
});
// function run_calcular(e, id){
//   calcularTotalperfumesLujo30(id);
// }

function calcularTotalperfumesLujo30(){
  var cod = document.getElementById("opcionesPerfumeria").value;
  var combo = document.getElementById("opcionesPerfumeria");
  var presentaciones = combo.options[combo.selectedIndex].text;


  var presentacion = "Preparado Lujo 30ml";
  var precio =  document.getElementById("preciolujo3").value;
  var gramos =  document.getElementById("gramoslujo3").value;
  var cantidad =  document.getElementById("cantidadlujo3").value;
  var gramos_adicionales =  document.getElementById("gramosAdicionalesL30ml").value;

  if (gramos_adicionales != 0) {
  var valor_adicional = 500 * gramos_adicionales;
  }
  if (undefined==cantidadlujo3) {cantidadlujo3 = 0;}
  var q = document.getElementById('quantityP').value = cantidad;
  var presentacionf =  document.getElementById("presentacion").value = presentacion;
  if (gramos_adicionales != 0) {
    var cantidadTotal =  document.getElementById("quantity").value = gramos * cantidad  + parseInt(gramos_adicionales);
  }else{
    var cantidadTotal =  document.getElementById("quantity").value = gramos * cantidad ;
  }
    var price =  document.getElementById("price").value = precio;
  suma = precio * cantidad;

  if (gramos_adicionales != 0) {
    document.getElementById("totales").value = suma + parseInt(valor_adicional);

  }else {
    document.getElementById("totales").value = suma;

  }
}
// calcular p lujo 50ml
$(document).on('blur', "[id^=cantidadlujo4]", function(){
  calcularTotalperfumesLujo50();
});
// function run_calcular(e, id){
//   calcularTotalperfumesLujo50(id);
// }

function calcularTotalperfumesLujo50(){
  var cod = document.getElementById("opcionesPerfumeria").value;
  var combo = document.getElementById("opcionesPerfumeria");
  var presentaciones = combo.options[combo.selectedIndex].text;
  // var cods = document.getElementById("Preparado1").value;
  // var combs = document.getElementById("Preparado1");
  // var capacidad = combs.options[combs.selectedIndex].text;
  var presentacion = "Preparado Lujo 50ml";
  var precio =  document.getElementById("preciolujo4").value;
  var gramos =  document.getElementById("gramoslujo4").value;
  var cantidad =  document.getElementById("cantidadlujo4").value;
  var gramos_adicionales =  document.getElementById("gramosAdicionalesL50ml").value;

     if (gramos_adicionales != 0) {
     var valor_adicional = 500 * gramos_adicionales;
                              }

  if (undefined==cantidadlujo4) {cantidadlujo4 = 0;}
  var q = document.getElementById('quantityP').value = cantidad;
  var presentacionf =  document.getElementById("presentacion").value = presentacion;
  if (gramos_adicionales != 0) {
    var cantidadTotal =  document.getElementById("quantity").value = gramos * cantidad  + parseInt(gramos_adicionales);
  }else{
    var cantidadTotal =  document.getElementById("quantity").value = gramos * cantidad ;
  }
    var price =  document.getElementById("price").value = precio;
  suma = precio * cantidad;
  if (gramos_adicionales != 0) {
    document.getElementById("totales").value = suma + parseInt(valor_adicional);

  }else {
    document.getElementById("totales").value = suma;
  }
}// calcular p lujo 100ml

$(document).on('blur', "[id^=cantidadlujo5]", function(){
  calcularTotalperfumesLujo100();
});
// function run_calcular(e, id){
//   calcularTotalperfumesLujo100(id);
// }

function calcularTotalperfumesLujo100(){
  var cod = document.getElementById("opcionesPerfumeria").value;
  var combo = document.getElementById("opcionesPerfumeria");
  var presentaciones = combo.options[combo.selectedIndex].text;

  var presentacion = "Preparado Lujo 100ml";
  var precio =  document.getElementById("preciolujo5").value;
  var gramos =  document.getElementById("gramoslujo5").value;
  var cantidad =  document.getElementById("cantidadlujo5").value;
  if (undefined==cantidadlujo5) {cantidadlujo5 = 0;}
  var gramos_adicionales =  document.getElementById("gramosAdicionalesL100ml").value;

  if (gramos_adicionales != 0) {
  var valor_adicional = 500 * gramos_adicionales;
  }

  var q = document.getElementById('quantityP').value = cantidad;
  var presentacionf =  document.getElementById("presentacion").value = presentacion;
  if (gramos_adicionales != 0) {
    var cantidadTotal =  document.getElementById("quantity").value = gramos * cantidad  + parseInt(gramos_adicionales);
  }else{
    var cantidadTotal =  document.getElementById("quantity").value = gramos * cantidad ;
  }
    var price =  document.getElementById("price").value = precio;
  suma = precio * cantidad;
  if (gramos_adicionales != 0) {
    document.getElementById("totales").value = suma + parseInt(valor_adicional);

  }else {
    document.getElementById("totales").value = suma;

  }
}
//recargas
function perfumes_preparados_opcion_recarga(that) {
  if (that.value == "30") {
    document.getElementById("recarga30").style.display = "block";
  }else if(that.value == "50") {
    document.getElementById("recarga50").style.display = "block";
  }else if(that.value == "100"){
    document.getElementsByName("recarga100")[0].style.display = "block";
  }
}//calcular recarga 30ML
$(document).on('blur', "[id^=cantidadrecarga3]", function(){
  calcularTotalRecarga30();
});
// function run_calcular(e, id){
//   calcularTotalRecarga30(id);
// }

function calcularTotalRecarga30(){
  var cod = document.getElementById("opcionesPerfumeria").value;
  var combo = document.getElementById("opcionesPerfumeria");
  var presentaciones = combo.options[combo.selectedIndex].text;
  // var cods = document.getElementById("Preparado1").value;
  // var combs = document.getElementById("Preparado1");
  // var capacidad = combs.options[combs.selectedIndex].text;
  var presentacion = "Recarga 30ml";
  var precio =  document.getElementById("preciorecarga3").value;
  var gramos =  document.getElementById("recarga3").value;
  var cantidad =  document.getElementById("cantidadrecarga3").value;
  if (undefined==cantidad) {cantidad = 0;}
  var gramos_adicionales =  document.getElementById("gramosAdicionalesR30ml").value;

  if (gramos_adicionales != 0) {
  var valor_adicional = 500 * gramos_adicionales;
  }

  var q = document.getElementById('quantityP').value = cantidad;
  var presentacionf =  document.getElementById("presentacion").value = presentacion;
  if (gramos_adicionales != 0) {
    var cantidadTotal =  document.getElementById("quantity").value = gramos * cantidad  + parseInt(gramos_adicionales);
  }else{
    var cantidadTotal =  document.getElementById("quantity").value = gramos * cantidad ;
  }
    var price =  document.getElementById("price").value = precio;
  suma = precio * cantidad;
  if (gramos_adicionales != 0) {
    document.getElementById("totales").value = suma + parseInt(valor_adicional);

  }else {
    document.getElementById("totales").value = suma;

  }
}// calcular recargas 50ml

$(document).on('blur', "[id^=cantidadrecarga4]", function(){
  calcularTotalRecarga50();
});
// function run_calcular(e, id){
//   calcularTotalRecarga50(id);
// }
function calcularTotalRecarga50(){
  var cod = document.getElementById("opcionesPerfumeria").value;
  var combo = document.getElementById("opcionesPerfumeria");
  var presentaciones = combo.options[combo.selectedIndex].text;
  var gramos_adicionales =  document.getElementById("gramosAdicionalesR50ml").value;
  if (gramos_adicionales != 0) {
  var valor_adicional = 500 * gramos_adicionales;
  }
  var presentacion = "Recarga 50ml";
  var precio =  document.getElementById("preciorecarga4").value;
  var gramos =  document.getElementById("recarga4").value;
  var cantidad =  document.getElementById("cantidadrecarga4").value;
  if (undefined==cantidad) {cantidad = 0;}
  var q = document.getElementById('quantityP').value = cantidad;
  var presentacionf =  document.getElementById("presentacion").value = presentacion;
  if (gramos_adicionales != 0) {
    var cantidadTotal =  document.getElementById("quantity").value = gramos * cantidad  + parseInt(gramos_adicionales);
  }else{
    var cantidadTotal =  document.getElementById("quantity").value = gramos * cantidad ;
  }
  var price =  document.getElementById("price").value = precio;
  suma = precio * cantidad;
  if (gramos_adicionales != 0) {
    document.getElementById("totales").value = suma + parseInt(valor_adicional);

  }else {
    document.getElementById("totales").value = suma;

  }
} // calcular recarga 100ml

$(document).on('blur', "[id^=cantidadrecarga5]", function(){
  calcularTotalRecarga100();
});
// function run_calcular(e, id){
//   calcularTotalRecarga100(id);
// }

function calcularTotalRecarga100(){
  var cod = document.getElementById("opcionesPerfumeria").value;
  var combo = document.getElementById("opcionesPerfumeria");
  var presentaciones = combo.options[combo.selectedIndex].text;
  // var cods = document.getElementById("Preparado1").value;
  // var combs = document.getElementById("Preparado1");
  // var capacidad = combs.options[combs.selectedIndex].text;
  var presentacion = "Recarga 100ml";
  var precio =  document.getElementById("preciorecarga5").value;
  var gramos =  document.getElementById("recarga5").value;
  var cantidad =  document.getElementById("cantidadrecarga5").value;
  var gramos_adicionales =  document.getElementById("gramosAdicionalesR100ml").value;

  if (gramos_adicionales != 0) {
  var valor_adicional = 500 * gramos_adicionales;
  }

  if (undefined==cantidad) {cantidad = 0;}
  var q = document.getElementById('quantityP').value = cantidad;
  var presentacionf =  document.getElementById("presentacion").value = presentacion;
  if (gramos_adicionales != 0) {
    var cantidadTotal =  document.getElementById("quantity").value = gramos * cantidad  + parseInt(gramos_adicionales);
  }else{
    var cantidadTotal =  document.getElementById("quantity").value = gramos * cantidad ;
  }  var price =  document.getElementById("price").value = precio;
  suma = precio * cantidad;
  if (gramos_adicionales != 0) {
    document.getElementById("totales").value = suma + parseInt(valor_adicional);

  }else {
    document.getElementById("totales").value = suma;

  }
}
//cremas
function crema_opciones(that) {
  if (that.value == "30") {
    document.getElementById("crema30").style.display = "block";
  }else if(that.value == "60") {
    document.getElementById("crema60").style.display = "block";
  }else if(that.value == "120"){
    document.getElementById("crema120").style.display = "block";
  }else if(that.value == "250"){
    document.getElementById("crema250").style.display = "block";
  }
}
//calcular cremas 30ml
$(document).on('blur', "[id^=cantidadcrema3]", function(){
  calcularTotalCrema30();
});
// function run_calcular(e, id){
//   calcularTotalCrema30(id);
// }

function calcularTotalCrema30(){
  var cod = document.getElementById("opcionesPerfumeria").value;
  var combo = document.getElementById("opcionesPerfumeria");
  var presentaciones = combo.options[combo.selectedIndex].text;
  // var cods = document.getElementById("Preparado1").value;
  // var combs = document.getElementById("Preparado1");
  // var capacidad = combs.options[combs.selectedIndex].text;
  var presentacion = "Crema 30ml";
  var precio =  document.getElementById("preciocrema3").value;
  var gramos =  document.getElementById("crema3").value;
  var cantidad =  document.getElementById("cantidadcrema3").value;
  if (undefined==cantidad) {cantidad = 0;}
  var q = document.getElementById('quantityP').value = cantidad;
  var presentacionf =  document.getElementById("presentacion").value = presentacion;
  var cantidadTotal =  document.getElementById("quantity").value = gramos * cantidad ;
  var price =  document.getElementById("price").value = precio;
  suma = precio * cantidad;
  document.getElementById("totales").value = suma;
} //calcular cremas 60ml
$(document).on('blur', "[id^=cantidadcrema4]", function(){
  calcularTotalCrema60();
});
// function run_calcular(e, id){
//   calcularTotalCrema60(id);
// }

function calcularTotalCrema60(){
  var cod = document.getElementById("opcionesPerfumeria").value;
  var combo = document.getElementById("opcionesPerfumeria");
  var presentaciones = combo.options[combo.selectedIndex].text;
  // var cods = document.getElementById("Preparado1").value;
  // var combs = document.getElementById("Preparado1");
  // var capacidad = combs.options[combs.selectedIndex].text;
  var presentacion = "Crema 60ml";
  var precio =  document.getElementById("preciocrema4").value;
  var gramos =  document.getElementById("crema4").value;
  var cantidad =  document.getElementById("cantidadcrema4").value;
  if (undefined==cantidad) {cantidad = 0;}
  var q = document.getElementById('quantityP').value = cantidad;
  var presentacionf =  document.getElementById("presentacion").value = presentacion;
  var cantidadTotal =  document.getElementById("quantity").value = gramos * cantidad ;
  var price =  document.getElementById("price").value = precio;
  suma = precio * cantidad;
  document.getElementById("totales").value = suma;
} // calcular crema 120
$(document).on('blur', "[id^=cantidadcrema5]", function(){
  calcularTotalCrema120();
});
// function run_calcular(e, id){
//   calcularTotalCrema120(id);
// }

function calcularTotalCrema120(){
  var cod = document.getElementById("opcionesPerfumeria").value;
  var combo = document.getElementById("opcionesPerfumeria");
  var presentaciones = combo.options[combo.selectedIndex].text;
  // var cods = document.getElementById("Preparado1").value;
  // var combs = document.getElementById("Preparado1");
  // var capacidad = combs.options[combs.selectedIndex].text;
  var presentacion = "Crema 120ml";
  var precio =  document.getElementById("preciocrema5").value;
  var gramos =  document.getElementById("crema5").value;
  var cantidad =  document.getElementById("cantidadcrema5").value;
  if (undefined==cantidad) {cantidad = 0;}
  var q = document.getElementById('quantityP').value = cantidad;
  var presentacionf =  document.getElementById("presentacion").value = presentacion;
  var cantidadTotal =  document.getElementById("quantity").value = gramos * cantidad ;
  var price =  document.getElementById("price").value = precio;
  suma = precio * cantidad;
  document.getElementById("totales").value = suma;
}// calcular crema 250ml
$(document).on('blur', "[id^=cantidadcrema6]", function(){
  calcularTotalCrema250();
});
// function run_calcular(e, id){
//   calcularTotalCrema250(id);
// }

function calcularTotalCrema250(){
  var cod = document.getElementById("opcionesPerfumeria").value;
  var combo = document.getElementById("opcionesPerfumeria");
  var presentaciones = combo.options[combo.selectedIndex].text;
  // var cods = document.getElementById("Preparado1").value;
  // var combs = document.getElementById("Preparado1");
  // var capacidad = combs.options[combs.selectedIndex].text;
  var presentacion = "Crema 250ml";
  var precio =  document.getElementById("preciocrema6").value;
  var gramos =  document.getElementById("crema6").value;
  var cantidad =  document.getElementById("cantidadcrema6").value;
  if (undefined==cantidad) {cantidad = 0;}
  var q = document.getElementById('quantityP').value = cantidad;
  var presentacionf =  document.getElementById("presentacion").value = presentacion;
  var cantidadTotal =  document.getElementById("quantity").value = gramos * cantidad ;
  var price =  document.getElementById("price").value = precio;
  suma = precio * cantidad;
  document.getElementById("totales").value = suma;
}
//AFTERSHAVE
$(document).on('blur', "[id^=cantidadAfter]", function(){
  calcularTotalAfter();
});
// function run_calcular(e, id){
//   calcularTotalAfter(id);
// }

function calcularTotalAfter(){
  var cod = document.getElementById("opcionesPerfumeria").value;
  var combo = document.getElementById("opcionesPerfumeria");
  var presentaciones = combo.options[combo.selectedIndex].text;
  var presentacion = "After Shave";
  var precio =  document.getElementById("precioAfter").value;
  var gramos =  document.getElementById("aftergramos").value;
  var cantidad =  document.getElementById("cantidadAfter").value;
  var gramos_adicionales =  document.getElementById("AdicionalAfter").value;
  if (gramos_adicionales != 0) {
  var valor_adicional = 500 * gramos_adicionales;
  }
  if (undefined==cantidad) {cantidad = 1;}
  var q = document.getElementById('quantityP').value = cantidad;
  var presentacionf =  document.getElementById("presentacion").value = presentacion;
  if (gramos_adicionales != 0) {
    var cantidadTotal =  document.getElementById("quantity").value = gramos * cantidad  + parseInt(gramos_adicionales);
  }else{
    var cantidadTotal =  document.getElementById("quantity").value = gramos * cantidad ;
  }
  var price =  document.getElementById("price").value = precio;
  suma = precio * cantidad;
  if (gramos_adicionales != 0) {
    document.getElementById("totales").value = suma + parseInt(valor_adicional);

  }else {
    document.getElementById("totales").value = suma;

  }
} // onzas de perfumeria

$(document).on('blur', "[id^=cantidadOnzas]", function(){
  calcularTotalOnzas();
});
// function run_calcular(e, id){
//   calcularTotalOnzas(id);
// }

function calcularTotalOnzas(){
  var cod = document.getElementById("opcionesPerfumeria").value;
  var combo = document.getElementById("opcionesPerfumeria");
  var presentaciones = combo.options[combo.selectedIndex].text;

  var gramos_adicionales =  document.getElementById("AdicionalOnzas").value;

  if (gramos_adicionales != 0) {
  var valor_adicional = 500 * gramos_adicionales;
  }

  var presentacion = "Onza de perfumeria";
  var precio =  document.getElementById("onzasPrecio").value;
  var gramos =  document.getElementById("onzasgramos").value;
  var cantidad =  document.getElementById("cantidadOnzas").value;
  if (undefined==cantidad) {cantidad = 1;}
  var q = document.getElementById('quantityP').value = cantidad;
  var presentacionf =  document.getElementById("presentacion").value = presentacion;
  if (gramos_adicionales != 0) {
    var cantidadTotal =  document.getElementById("quantity").value = gramos * cantidad  + parseInt(gramos_adicionales);
  }else{
    var cantidadTotal =  document.getElementById("quantity").value = gramos * cantidad ;
  }
  var price =  document.getElementById("price").value = precio;
  suma = precio * cantidad;
  if (gramos_adicionales != 0) {
    document.getElementById("totales").value = suma + parseInt(valor_adicional);

  }else {
    document.getElementById("totales").value = suma;

  }
}
