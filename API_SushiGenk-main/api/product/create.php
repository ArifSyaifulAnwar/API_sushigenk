<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: product');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../moduls/Product.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog product object
  $product = new product($db);

  // Get raw producted data
  $data = json_decode(file_get_contents("php://input"));
  
  $product->id = $data->id;
  $product->menu = $data->menu;
  $product->stock = $data->stock;
  $product->price = $data->price;

  // Create product
  if($product->create()) {
    echo json_encode(
      array('message' => 'Paket Created')
    );
  } else {
    echo json_encode(
      array('message' => 'Paket Not Created')
    );
  }