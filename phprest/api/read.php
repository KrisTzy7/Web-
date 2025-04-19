<?php
    header('Access-Control-Allow_Origin:*');
    header('Content-Type: application/json');
    include_once("../controller/init.php");
    $product = new Product($db);
    $result = $product->read();
    $num = $result->rowCount(); 
    if($num>0){
        $product_arr = array();
        $product_arr['products'] = array();
        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $product_item = array(
                'id'=>$id,
                'item'=>$item,
                'price'=>$price,
                'quantity'=>$quantity,
                'create_at'=>$create_at,
            );
            array_push($product_arr['products'], $product_item);
        }
        echo json_encode($product_arr);    
    }else{
        echo json_decode(array("msg"=> "not found products "));
    }
?>