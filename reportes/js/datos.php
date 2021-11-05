<?php

$data = ["data" => []];
$response = file_get_contents("http://jsonplaceholder.typicode.com/posts");
$response = json_decode($response);


$data["data"] = $response;


echo json_encode($data);

// echo json_encode([
//     "data" => [[
//         "id" => 1,
//         "userId" => "test",
//         "title" => "This is a test",
//         "body" => "a body"
//     ]]
// ]);
