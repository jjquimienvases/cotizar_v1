$(document).ready(function(){
  $('#guardando').click(function(){
    var datos=$('#invoice-form').serialize();
    $.ajax({
      type:"POST",
      url:"send_orden.php",
      data:datos,
      success:function(r){
        console.log(r);
        if(r!=0 && !isNaN(r)){//SI ES DISTINTO A 0 Y ES UN NUMERO
          alert("Exitosa");
           window.location="orden_lista.php";

        }else{//ES 0(NO SE EJECUTO LA CONSULTA) O EXISTE UN ERROR EXPLICATIVO(STRING)
          alert("no funciona el string, contactar con el desarrollador");
        }
      }
    });
    return false;
  });
});
