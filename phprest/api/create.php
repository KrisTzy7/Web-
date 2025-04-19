<?php
    header('Access-Control-Allow_Origin:*');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST'); 
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-Width'); 
    include_once("../controller/init.php");
    $product = new Product($db);
    $data = json_decode(file_get_contents("php://input"));
    if (isset($data->item) && isset($data->price) && isset($data->quantity)) {
        $product->item = $data->item;
        $product->price = $data->price;
        $product->quantity = $data->quantity;
        if($product->create()){
            echo json_encode(array("message"=> "Product Created"));
        }else{
            echo json_encode(array("message"=> "Product Not Created"));
        }
    }
?>