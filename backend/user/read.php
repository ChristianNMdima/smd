<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../config/Database.php';
  include_once '../models/User.php';


  $database = new Database();
  $db = $database->connect();

  $user = new User($db);
  $data = $user->read();

  $num = $data->rowCount();

  $arr = array();

  if($num > 0) {

    while($row = $data->fetch(PDO::FETCH_ASSOC)) {
      extract($row);

      $results = array(
        'user_id' => $user_id,
        'name' => $name,
        'email' => $email,
        'phone_number' => $phone_number,
        'car_make' => $car_make,
        'car_colour' => $car_colour,
        'dob' => $dob,
        'age' => $age,
        'gender' => $gender,
        'created' => $created
      );
      
      // Push to "data"
      array_push($arr, $results);
    }

    $msg = 'success';

  } else {
    // No users
    $msg = '0';
  }

   // Turn to JSON & output
   echo json_encode(['results' => [
    'list'      =>  $arr,
    'message'   =>  $msg
  ]]);