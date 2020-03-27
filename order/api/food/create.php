<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/food.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $food = new food($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  $post->title = $data->title;
  $post->description = $data->description;
  $post->created_by = $data->created_by;
  $post->category_id = $data->category_id;

  // Create food
  if($food->create()) {
    echo json_encode(
      array('message' => 'Food Created')
    );
  } else {
    echo json_encode(
      array('message' => 'Food Not Created')
    );
  }

