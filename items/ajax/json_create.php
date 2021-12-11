<?php



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
                        '12' => $docenas,
                        '100' => $centenas,
                        '1000' => $millars,				        		
                    ],
                ],
            ],
            'images' => [
                [
                    // 'src' => 'http://demo.woothemes.com/woocommerce/wp-content/uploads/sites/56/2013/06/cd_4_angle.jpg'
                    'src' => $src
                ]
            ]
        ]
    ]
];

// print_r($data);

// return;

$result = $woocommerce->post('products/batch', $data);