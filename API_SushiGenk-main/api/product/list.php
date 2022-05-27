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

  // Blog product query
  $result = $product->read();
  // Get row count
  $num = $result->rowCount();

  // Check if any products
  if($num > 0) {
    // product array
    $products_arr = array();
    // $products_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);
      
      $product_item = array(
        'id' => $id,
        'menu' => $menu,
        
        'stock' => $stock,
        'price' => $price
      );

      // Push to "data"
      array_push($products_arr, $product_item);
      // array_push($products_arr['data'], $product_item);
    }

    // Turn to JSON & output
    echo json_encode($products_arr);

  } else {
    // No products
    echo json_encode(
      array('message' => 'No products Found')
    );
  }
