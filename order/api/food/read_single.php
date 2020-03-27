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

  // Get ID
  $food->id = isset($_GET['id']) ? $_GET['id'] : die();

  // Get post
  $food->read_single();

  // Create array
  $food_arr = array(
    'id' => $food->id,
    'title' => $food->title,
    'description' => $food->description,
    'created_by' => $food->created_by,
    'category_id' => $food->category_id,
    'category_name' => $food->category_name
  );

  // Make JSON
  print_r(json_encode($food_arr));