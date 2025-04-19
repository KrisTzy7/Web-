<?php
// Use the correct header for Access-Control-Allow-Origin
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST'); 
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With'); 

include_once("../controller/init.php");
$product = new Product($db);

// Capture the input data
$data = json_decode(file_get_contents("php://input"));

// Check if the ID is set in the request data
if (isset($data->id)) {
    // Set the ID to the product object
    $product->id = $data->id;

    // Attempt to delete the product
    if ($product->delete($product->id)) { // Pass the ID to the delete method
        echo json_encode(array("message" => "Product Deleted"));
    } else {
        echo json_encode(array("message" => "Product Not Deleted"));
    }
} else {
    // Return a 400 Bad Request response if ID is not provided
    http_response_code(400); // Bad Request
    echo json_encode(array("message" => "Product ID is required"));
}
?>