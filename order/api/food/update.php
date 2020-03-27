<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/food.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog food object
  $food = new food($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  // Set ID to update
  $food->id = $data->id;

  $food->title = $data->title;
  $food->description = $data->description;
  $food->created_by = $data->created_by;
  $food->category_id = $data->category_id;

  // Update post
  if($food->update()) {
    echo json_encode(
      array('message' => 'Food Updated')
    );
  } else {
    echo json_encode(
      array('message' => 'Food Not Updated')
    );
  }

