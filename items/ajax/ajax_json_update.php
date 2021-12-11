<?php

//aqui armo el json 
$ns = new stdClass();
$ns->unitario = round(($unitario), 2) ;
$ns->docena = round(($docena / 1.19), 2) ;
$ns->centena = round(($centena / 1.19), 2) ;
$ns->millar = round(($millar / 1.19), 2) ;
$ns->id = $skus;
$ns->src = $src;
$ns->categoria_woo = $categoria_woo_1;


$json = '[';
				$json .= json_encode($ns);
				$json .= ']';
				
				$items_origin = json_decode($json, true);
$param_sku = '';

foreach ($items_origin as $item) { 
    $param_sku .= $item['id'] . ',';
}
$products = $woocommerce->get('products/?sku=' . $param_sku);

$item_data = [];


foreach ($products as $product) {

    // Filtramos el array de origen por sku
    $sku = $product->sku;
    $search_item = array_filter($items_origin, function ($item) use ($sku) {
        return $item['id'] == $sku;
    });
    $search_item = reset($search_item);
    $meta = $product->meta_data;
    // Formamos el array a actualizar
    $item_data[] = [
        'id' => $product->id,
        'price' => round(($unitarios/1.19),2),
            'regular_price' => round(($unitarios/1.19),2),
            'categories' => [
                [
                  'id' => $categoria_woo_1,
                 'id' => $categoria_woo_2,
                //  'id' => $categoria_woo_3,
                //  'id' => $categoria_woo_4,
                 
                ]
            ],

        'meta_data' => [
    
            '1' => [
                'id' => $meta[1]->id,
                'key' => $meta[1]->key,
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
    ];
}

$data = [
    'update' => $item_data,
];

// echo "<pre>";
//   print_r($data);
// echo "</pre>";

// return;

$result = $woocommerce->post('products/batch', $data);
