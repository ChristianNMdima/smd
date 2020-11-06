<?php 
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../config/Database.php';
include_once '../models/User.php';

// Get current date and timezone
date_default_timezone_set("Africa/Johannesburg");

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate blog post object
$user = new User($db);

$user->name = $data->name;
$user->email = $data->email;
$user->phone_number = $data->phone_number;
$user->created = date("Y-m-d H:i:s");
(isset($data->dob)) ? $user->dob = $data->dob : $user->dob = '';
(isset($data->age)) ? $user->age = $data->age : $user->age = 0;
(isset($data->gender)) ? $user->gender = $data->gender : $user->gender = '';
(isset($data->car_make)) ? $user->car_make = $data->car_make : $user->car_make = '';
(isset($data->car_colour)) ? $user->car_colour = $data->car_colour : $user->car_colour = '';

($user->create()) ? $msg = 'Request successfully submitted' : $msg = 'Record updated';

// Turn to JSON & output
echo json_encode(['results' => [
    'message'   =>  $msg
  ]]);