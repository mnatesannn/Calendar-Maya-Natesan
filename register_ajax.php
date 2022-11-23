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
$first_name = $json_obj['first_name'];
$last_name = $json_obj['last_name'];
$username = $json_obj['username'];
$password = $json_obj['password'];

if( !preg_match('/^[\w_\-]+$/', $username) ){
    $response['success'] = false;
    echo json_encode($response);   
    exit;
}

if( !preg_match('/^[\w_\-]+$/', $password) ){
    $response['success'] = false;
    echo json_encode($response); 
    exit;
}

$pass_hash = password_hash($password, PASSWORD_BCRYPT);

$stmt = $mysqli->prepare("insert into users (username, password, first_name, last_name) values (?, ?, ?, ?)");

if(!$stmt){
    exit;
}

$stmt->bind_param('ssss', $username, $pass_hash, $first_name, $last_name);

$stmt->execute();

$stmt = $mysqli->prepare("select id from users where username=?");

if(!$stmt){
    exit;
}

$stmt->bind_param('s', $username);
$stmt->execute();
$stmt->bind_result($user_id);
$stmt->fetch();
$stmt->close();

$_SESSION['user_id'] = $user_id;

$response['success'] = true;
$response['user_id'] = $user_id;
echo json_encode($response);

?>