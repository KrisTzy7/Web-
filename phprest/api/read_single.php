<?php
    header('Access-Control-Allow_Origin:*');
    header('Content-Type: application/json');

    include_once("../controller/init.php");

    $product = new Product($db);
    $product->id = isset($_GET["id"]) ? ($_GET["id"]) :die();
    $product->read_single();
    $product_arr = array(
        'id'=>$product->id,
        'item'=>$product->item,
        'price'=>$product->price,
        'quantity'=>$product->quantity,
        'create_at'=>$product->create_at 
    );
    print_r(json_encode($product_arr));
   
?>