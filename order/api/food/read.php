<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/food.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $food = new food($db);

  // Blog food query
  $result = $food->read();
  // Get row count
  $num = $result->rowCount();

  // Check if any foods
  if($num > 0) {
    // food array
    $foods_arr = array();
    // $foods_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);

      $food_item = array(
        'id' => $id,
        'title' => $title,
        'description' => $description,
        'created_by' => $created_by,
        'category_id' => $category_id,
        'category_name' => $category_name
      );

      // Push to "data"
      array_push($foods_arr, $food_item);
      // array_push($foods_arr['data'], $food_item);
    }

    // Turn to JSON & output
    echo json_encode($foods_arr);

  } else {
    // No foods
    echo json_encode(
      array('message' => 'No foods Found')
    );
  }
