<?php


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
            case "Perfume Lujo 30 ML":
                $unidad = [
                    "Unidad" => "10700",
                    "Gramo" => "13",
                    "Capacidad" => "30 ML",
                    "presentacion" => "Perfume Lujo 30 ML",
                ];
                break;
            case "Perfume Lujo 50 ML":
                $unidad = [
                    "Unidad" => "23000",
                    "Gramo" => "18",
                    "Capacidad" => "50 ML",
                    "presentacion" => "Perfume Lujo 50 ML",
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

