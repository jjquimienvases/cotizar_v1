<?php


// if ($id_categoria != 21 || $id_categoria != 13 || $id_categoria != 4) {
//     $doce = 12;
//     $cien = 100;
//     $mil = 1000;
// } else if ($id_categoria == 4) {
//     $doce = 63;
//     $cien = 999;
//     $mil = 24999;
// }


   $doce = 63;
    $cien = 999;
    $mil = 24999;
$data = [
    'update' => [
        [
            
            'sku' => $sku,
            'price' => round($unitarios/1000,2),
            'regular_price' => round($unitarios/1000,2),
            'categories' => [
                [
                    'id' => $categoria_woo_1,
                ]
            ],
            'meta_data' => [				            				        	
                '1' =>[
                    'id' => $sku,
                    
                    'key' => '_fixed_price_rules',	
                    'value' => [
                        $doce => round($unitarios/1000,2),
                        $cien => round($centenas/1000,2),
                        $mil => round($millars/1000,2),				        		
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


$result = $woocommerce->post('products/batch', $data);
if($result){
echo "<pre>";
print_r($data);
echo "</pre>";
}else{
    echo "no funciona";
}

return;
