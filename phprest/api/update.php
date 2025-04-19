<?php
    header('Access-Control-Allow_Origin:*');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST'); 
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-Width'); 
    include_once("../controller/init.php");
    $product = new Product($db);
    $data = json_decode(file_get_contents("php://input"));
    $product->id = $data->id;
    $product->item = $data->item;
    $product->price = $data->price;
    $product->quantity = $data->quantity;
    if ($product->update()){
        echo json_encode(array("message"=> "Product Updated"));
    }else{
        echo json_encode(array("message"=> "Product Not Updated"));
    }

?>