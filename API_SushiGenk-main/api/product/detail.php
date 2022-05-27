<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../moduls/Product.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog product object
  $product = new product($db);

  // Get ID
  $product->id = isset($_GET['id']) ? $_GET['id'] : die();

  // Get product
  $product->read_single();

  // Create array
  $product_arr = array(
    'id' => $product->id,
    'menu' => $product->$menu,
    // 'uom' => $product->uom,
    'stock' => $product->stock,
    'price' => $product->price
  );

  // Make JSON
  print_r(json_encode($product_arr));
