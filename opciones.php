<?php
if (isset($_POST['Capacidad'])) {
    switch ($_POST['Capacidad']) {
        case "Splash 120 ML":
            $unidad = [
                "Unidad" => "15000",
                "Gramo" => "7",
                "Envase" => "600",
                "Valvula" => "908",
                "Capacidad" => "0",
                "presentacion" => "Splash 120 ML",
            ];

            break;
        case "Splash 250 ML":
            $unidad = [
                "Unidad" => "20000",
                "Gramo" => "12",
                "Envase" => "603",
                "Valvula" => "908",
                "Capacidad" => "0",
                "presentacion" => "Splash 250 ML",
            ];

            break;
            
                case "Splash 3750 ML":
            $unidad = [
                "Unidad" => "45000",
                "Gramo" => "180",
                "Envase" => "724",
                "Valvula" => "1995251",
                "Capacidad" => "0",
                "presentacion" => "Splash 3750 ML",
            ];

            break;
        case "Crema 30 ML":
            $unidad = [
                "Unidad" => "5000",
                "Gramo" => "2",
                "Envase" => "696",
                "Capacidad" => "0",
                "presentacion" => "Crema 30 ML",
            ];

            break;
        case "Crema 60 ML":
            $unidad = [
                "Unidad" => "7000",
                "Gramo" => "3",
                "Envase" => "697",
                "Capacidad" => "0",
                "presentacion" => "Crema 60 ML",
            ];

            break;
        case "Crema 120 ML":
            $unidad = [
                "Unidad" => "10000",
                "Gramo" => "6",
                "Envase" => "600",
                "Valvula" => "908",
                "Capacidad" => "0",
                "presentacion" => "Crema 120 ML",
            ];

            break;
        case "Crema 250 ML":
            $unidad = [
                "Unidad" => "15000",
                "Gramo" => "10",
                "Envase" => "694",
                "Capacidad" => "0",
                "presentacion" => "Crema 250 ML",
            ];

            break;
            
        case "Crema 1000 ML":
            $unidad = [
                "Unidad" => "25000",
                "Gramo" => "60",
                "Envase" => "599",
                "Capacidad" => "0",
                "presentacion" => "Crema 1000 ML",
            ];

            break;
            
              case "Crema 3750 ML":
            $unidad = [
                "Unidad" => "68000",
                "Gramo" => "222",
                "Envase" => "599",
                "Capacidad" => "0",
                "presentacion" => "Crema 3750 ML",
            ];

            break;

        case "Perfume Sencillo 30 ML":
            $unidad = [
                "Unidad" => "13000",
                "Gramo" => "11",
                "Envase" => "1801",
                "Capacidad" => "30 ML",
                "presentacion" => "Perfume Sencillo 30 ML",

            ];
            break;
        case "Perfume Sencillo 50 ML":
            $unidad = [
                "Unidad" => "20000",
                "Gramo" => "18",
                "Envase" => "1500",
                "Capacidad" => "50 ML",
                "presentacion" => "Perfume Sencillo 50 ML",

            ];
            break;
        case "Perfume Sencillo 100 ML":
            $unidad = [
                "Unidad" => "32000",
                "Gramo" => "36",
                "Envase" => "1000",
                "Capacidad" => "100 ML",
                "presentacion" => "Perfume Sencillo 100 ML",
            ];
            break;
        case "Perfume Sencillo 100 ML Familia":
            $unidad = [
                "Unidad" => "25000",
                "Gramo" => "36",
                "Envase" => "1000",
                "Capacidad" => "100 ML",
                "presentacion" => "Perfume Sencillo 100 ML Familia",
            ];
            break;
               case "kit":
            $unidad = [
                "Unidad" => "50000",
                "Gramo" => "54",
                "Envase" => "0",
                "Capacidad" => "1 ML",
                "presentacion" => "KIT DE PERFUMERIA",
            ];
            break;
        case "Muestra Perfumeria":
            $unidad = [
                "Unidad" => "1",
                "Gramo" => "3",
                "Capacidad" => "3 ML",
                "presentacion" => "Muestra Perfumeria 3ML",
            ];
            break;
        case "Perfume Lujo 30 ML":
            $unidad = [
                "Unidad" => "15000",
                "Gramo" => "11",
                "Capacidad" => "30 ML",
                "presentacion" => "Perfume Lujo 30 ML",
            ];
            break;
        case "Perfume Lujo 50 ML":
            $unidad = [
                "Unidad" => "25500",
                "Gramo" => "18",
                "Capacidad" => "50 ML",
                "presentacion" => "Perfume Lujo 50 ML",
            ];
            break;
        case "Perfume Lujo 100 ML":
            $unidad = [
                "Unidad" => "37500",
                "Gramo" => "36",
                "Capacidad" => "100 ML",
                "presentacion" => "Perfume Lujo 100 ML",
            ];
            break;
        case "Perfumero Recargado 3 ML":
            $unidad = [
                "Unidad" => "2500",
                "Gramo" => "1",
                "Capacidad" => "3 ML",
                "presentacion" => "Perfumero Recargado 3 ML",
            ];
            break;
        case "Perfumero Recargado 8 ML":
            $unidad = [
                "Unidad" => "8000",
                "Gramo" => "3",
                "Capacidad" => "3 ML",
                "presentacion" => "Perfumero Recargado 8 ML",
            ];
            break;
        case "Perfumero Recargado 18 ML":
            $unidad = [
                "Unidad" => "1000",
                "Gramo" => "5",
                "Capacidad" => "18 ML",
                "presentacion" => "Perfumero Recargado 18 ML",
            ];
            break;
        case "Perfumero Lujo Recargado 8 ML":
            $unidad = [
                "Unidad" => "10000",
                "Gramo" => "3",
                "Capacidad" => "8 ML",
                "presentacion" => "Perfumero Lujo Recargado 18 ML",
            ];
            break;
        case "Perfumero Esfero Recargado 8 ML":
            $unidad = [
                "Unidad" => "8000",
                "Gramo" => "3",
                "Capacidad" => "8 ML",
                "presentacion" => "Perfumero Esfero Recargado 8 ML",
            ];
            break;
        case "Perfumero Recargado 5 ML":
            $unidad = [
                "Unidad" => "4500",
                "Gramo" => "2",
                "Capacidad" => "5 ML",
                "presentacion" => "Perfumero Recargado 5 ML",
            ];
            break;
        case "Perfumero Recargado 10 ML":
            $unidad = [
                "Unidad" => "8000",
                "Gramo" => "4",
                "Capacidad" => "10 ML",
                "presentacion" => "Perfumero Recargado 10 ML",
            ];
            break;
        case "Perfumero Recargado 4 ML":
            $unidad = [
                "Unidad" => "6000",
                "Gramo" => "2",
                "Capacidad" => "4 ML",
                "presentacion" => "Perfumero Recargado 4 ML",
            ];
            break;
       
        case "Recarga 30 ML":
            $unidad = [
                "Unidad" => "12000",
                "Gramo" => "11",
                "Capacidad" => "30 ML",
                "presentacion" => "Recarga 30 ML",
            ];
            break;
        case "Recarga 50 ML":
            $unidad = [
                "Unidad" => "19000",
                "Gramo" => "18",
                "Capacidad" => "50 ML",
                "presentacion" => "Recarga 50 ML",
            ];
            break;
        case "Recarga 100 ML":
            $unidad = [
                "Unidad" => "31000",
                "Gramo" => "36",
                "Capacidad" => "100 ML",
                "presentacion" => "Recarga 100 ML",
            ];
            break;
        case "Recarga 3 ML":
            $unidad = [
                "Unidad" => "1500",
                "Gramo" => "1",
                "Capacidad" => "3 ML",
                "presentacion" => "Recarga 3 ML",
            ];
            break;
        case "Recarga 8 ML":
            $unidad = [
                "Unidad" => "6000",
                "Gramo" => "3",
                "Capacidad" => "8 ML",
                "presentacion" => "Recarga 8 ML",
            ];
            break;
        case "Recarga 18 ML":
            $unidad = [
                "Unidad" => "8000",
                "Gramo" => "5",
                "Capacidad" => "18 ML",
                "presentacion" => "Recarga 18 ML",
            ];
            break;
        case "Recarga 5 ML":
            $unidad = [
                "Unidad" => "3000",
                "Gramo" => "2",
                "Capacidad" => "5 ML",
                "presentacion" => "Recarga 5 ML",
            ];
            break;
        case "Recarga 10 ML":
            $unidad = [
                "Unidad" => "6000",
                "Gramo" => "4",
                "Capacidad" => "10 ML",
                "presentacion" => "Recarga 10 ML",
            ];
            break;
        case "Recarga 4 ML":
            $unidad = [
                "Unidad" => "4000",
                "Gramo" => "2",
                "Capacidad" => "4 ML",
                "presentacion" => "Recarga 4 ML",
            ];
            break;
            
         case "Premio 50 ML":
            $unidad = [
                "Unidad" => "1",
                "Gramo" => "18",
                "presentacion" => "50ML Premio",
                "Capacidad" => "50ML Premio",
                "Envase" => "1500",
            ];
            break;
            
        case "Premio 100 ML":
            $unidad = [
                "Unidad" => "1",
                "Gramo" => "36",
                "presentacion" => "100ML Premio",
                "Capacidad" => "100ML Premio",
                "Envase" => "1000",
            ];
            break;    
         case "aumentar":
            $unidad = [
                "Unidad" => "14000",
                "Gramo" => "36",
                "presentacion" => "100ML aumentar",
                "Capacidad" => "100ML aumentar",
                "Envase" => "1000",
            ];
            break;  

    }
    echo json_encode($unidad);
}
if (isset($_POST['Capacidad_D'])) {

    switch ($_POST['Capacidad_D']) {
        case "Splash 120 ML":
            $unidad = [
                "Unidad" => "10000",
                "Gramo" => "7",
                "Envase" => "600",
                "Valvula" => "908",
                "Capacidad" => "120 ML",
                "presentacion" => "Splash 120 ML",
            ];

            break;
        case "Splash 250 ML":
            $unidad = [
                "Unidad" => "16000",
                "Gramo" => "12",
                "Envase" => "603",
                "Valvula" => "908",
                "Capacidad" => "250 ML",
                "presentacion" => "Splash 250 ML",
            ];

            break;
        case "Crema 120 ML":
            $unidad = [
                "Unidad" => "12000",
                "Gramo" => "6",
                "Envase" => "600",
                "Valvula" => "908",
                "Capacidad" => "120 ML",
                "presentacion" => "Crema 120 ML",
            ];
            break;
        case "Crema 250 ML":
            $unidad = [
                "Unidad" => "15000",
                "Gramo" => "10",
                "Envase" => "694",
                "Capacidad" => "250 ML",
                "presentacion" => "Crema 250 ML",
            ];
            break;
        case "3":
            $unidad = [
                "Unidad" => "8500",
                "Gramo" => "17",
                "Envase" => "181818",
                "Capacidad" => "Onzas",
                "presentacion" => "Onzas",

            ];
       
            break;
        case "4":
            $unidad = [
                "Unidad" => "17000",
                "Gramo" => "18",
                "Envase" => "1000",
                "Valvula" => "901",
                "presentacion" => "After shave",
            ];
         
            break;
            case "Perfume Lujo 30 ML":
                $unidad = [
                    "Unidad" => "12000",
                    "Gramo" => "11",
                    "Capacidad" => "30 ML",
                    "presentacion" => "Perfume Lujo 30 ML",
                ];
                break;
            case "Perfume Lujo 50 ML":
                $unidad = [
                    "Unidad" => "23000",
                    "Gramo" => "18",
                    "Capacidad" => "50 ML",
                    "presentacion" => "Perfume Lujo 52 ML",
                ];
                break;
            case "Perfume Lujo 100 ML":
                $unidad = [
                    "Unidad" => "33000",
                    "Gramo" => "36",
                    "Capacidad" => "100 ML",
                    "presentacion" => "Perfume Lujo 100 ML",
                ];
                break;
    }
    echo json_encode($unidad);
}
