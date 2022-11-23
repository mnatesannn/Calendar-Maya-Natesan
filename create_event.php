<?php

session_start();
require 'connect.php';
$response = array();

header("Content-Type: application/json"); // Since we are sending a JSON response here (not an HTML document), set the MIME Type to application/json

//Because you are posting the data via fetch(), php has to retrieve it elsewhere.
$json_str = file_get_contents('php://input');
//This will store the data into an associative array
$json_obj = json_decode($json_str, true);

//Variables can be accessed as such:
$event_name = $json_obj['event_name'];
$event_date = $json_obj['event_date'];
$user_id = $_SESSION['user_id'];

if( !preg_match('/^[\w_\-]+$/', $event_name) ){
    $response['success'] = false;
    echo json_encode($response);   
    exit;
}

$stmt = $mysqli->prepare("insert into events (user_id, date_time, event_name) values (?, ?, ?)");

if(!$stmt){
    exit;
}

$stmt->bind_param('iss', $user_id, $event_date, $event_name);

$stmt->execute();

$stmt->close();

$response['success'] = true;
$response['event_date'] = $event_date;
$response['event_name'] = $event_name;
echo json_encode($response);

?>