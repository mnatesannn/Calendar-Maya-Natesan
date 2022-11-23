<?php

require 'connect.php';
session_start();
// login_ajax.php

header("Content-Type: application/json"); // Since we are sending a JSON response here (not an HTML document), set the MIME Type to application/json

$stmt = $mysqli->prepare("SELECT date_time FROM events");

// Bind the results
$stmt->bind_result($date_time);
$stmt->fetch();
$stmt->close();

$data = ["date_time" => $datetime]
echo json_encode($data)

?>
