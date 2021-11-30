<?php

//values 




if($categoria != 21 || $categoria != 13 || $categoria != 4){
    $doce = 12;
    $cien = 100;
    $mil = 1000;
}else{
    $doce = 63; 
    $cien = 999;
    $mil = 24999;
}

$data = [
    'create' => [
        [
            'name' => $item_name,
            'type' => 'simple',
            'catalog_visibility' => $visibilidad,
            'description' => $descripcion_corta,
            'short_description' => $descripcion_comercial,
            'sku' => $item_code,
            'price' => $unitarios,
            'regular_price' => $unitarios,
            'manage_stock' => false,
            'stock_status' => 'instock',
            'stock_quantity' => $stock,
            'categories' => [
                [
                    'id' => $categoria_woo
                ]
            ],
            'meta_data' => [				            				        	
                '1' =>[
                    'id' => $item_code,
                    
                    'key' => '_fixed_price_rules',	
                    'value' => [
                        $doce => $docenas,
                        $cien => $centenas,
                        $mil => $millars,				        		
                    ],
                ],
            ],
            'images' => [
                [
                 
                    'src' => $src
                ]
            ]
        ]
    ]
];

// print_r($data);

// return;

$result = $woocommerce->post('products/batch', $data);