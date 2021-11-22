<?php
session_start();
$valor = $_POST['opcion'];

switch ($valor) {
    case "1":
        echo "<option>Selecione la capacidad</option>";
        echo "<option value='Splash 120 ML'>120 ML</option>";
        echo "<option value='Splash 250 ML'>250 ML</option>";
        echo "<option value='Splash 3750 ML'>3750 ML</option>";
        break;
    case "2":
        echo "<option>Selecione la capacidad</option>";
        echo "<option value='Crema 30 ML'>30 ML</option>";
        echo "<option value='Crema 60 ML'>60 ML</option>";
        echo "<option value='Crema 120 ML'>120 ML</option>";
        echo "<option value='Crema 250 ML'>250 ML</option>";
        echo "<option value='Crema 1000 ML'>1000 ML</option>";
          echo "<option value='Crema 3750 ML'>3750 ML</option>";
        break;
    case "3":
  if ($_SESSION['id_rol'] == 7) {
            $precio="8000";

        } else {
          $precio="8500";
        }
        $unidad = [
            "Unidad" => $precio,
            "Gramo" => "17",
            "Envase" => "181818",
            "presentacion" => "Onzas",

        ];
        echo json_encode($unidad);
        break;
    case "4":
        $unidad = [
            "Unidad" => "20000",
            "Gramo" => "18",
            "Envase" => "1000",
            "Valvula" => "901",
            "presentacion" => "After shave",
        ];
        echo json_encode($unidad);
        break;
    case "5":
        echo "<option>Selecione la capacidad</option>";
        echo "<option value='Perfume Sencillo 30 ML'>30 ML</option>";
        echo "<option value='Perfume Sencillo 50 ML'>50 ML</option>";
        echo "<option value='Perfume Sencillo 100 ML'>100 ML</option>";
        echo "<option value='Perfume Sencillo 100 ML Familia'>Familia 100 ML</option>";
        echo "<option value='kit'>KIT PERFUMERIA</option>";
        echo "<option value='perfume promo 30 ML'>Perfume Promo 30ml</option>";
        echo "<option value='perfume promo 50 ML'>Perfume Promo 50ml</option>";
        echo "<option value='perfume promo 100 ML'>Perfume Promo 100ml</option>";
        break;
    case "6":
        echo "<option>Selecione la capacidad</option>";
        echo "<option value='Perfume Lujo 30 ML'>30 ML</option>";
        echo "<option value='Perfume Lujo 50 ML'>50 ML</option>";
        echo "<option value='Perfume Lujo 100 ML'>100 ML</option>";
        echo "<option value='Perfumero Recargado 3 ML'>3 ML</option>";
        echo "<option value='Perfumero Recargado 8 ML'>8 ML</option>";
        echo "<option value='Perfumero Recargado 18 ML'>18 ML</option>";
        echo "<option value='Perfumero Lujo Recargado 8 ML'>Lujo 18 ML</option>";
        echo "<option value='Perfumero Esfero Recargado 8 ML'>Esfero 8 ML</option>";
        echo "<option value='Perfumero Recargado 5 ML'>5 ML</option>";
        echo "<option value='Perfumero Recargado 4 ML'>4 ML</option>";
        echo "<option value='Perfumero Recargado 10 ML'>10 ML</option>";
        echo "<option value='Muestra Perfumeria'>Muestra Perfumeria 3ML</option>";
        break;
    case "7":
        echo "<option>Selecione la capacidad</option>";
        echo "<option value='Recarga 30 ML'>30 ML</option>";
        echo "<option value='Recarga 50 ML'>50 ML</option>";
        echo "<option value='Recarga 100 ML'>100 ML</option>";
        echo "<option value='Recarga 3 ML'>3 ML</option>";
        echo "<option value='Recarga 8 ML'>8 ML</option>";
        echo "<option value='Recarga 18 ML'>18 ML</option>";
        echo "<option value='Recarga 5 ML'>5 ML</option>";
        echo "<option value='Recarga 4 ML'>4 ML</option>";
        echo "<option value='Recarga 10 ML'>10 ML</option>";
        echo "<option value='1'>Otra Cantidad</option>";
        break;
    case "8":
        echo "<option>Selecione la capacidad</option>";
        echo "<option value='Premio 50 ML'>50 ML</option>";
        echo "<option value='Premio 100 ML'>100 ML</option>";     
        echo "<option value='aumentar'>Aumentar Premio</option>";
        break;    

}
