<?php
error_reporting(0);
header("Access-Control-Allow-Origin: *");

if (!isset($_POST)) {
    $response = array('status' => 'failed', 'data' => null);
    sendJsonResponse($response);
    die;
}

include_once("dbconnect.php");

$user_id = $_POST['user_id'];
$user_name = $_POST['user_name'];
$user_phone = $_POST['user_phone'];
$user_address = $_POST['user_address'];

$sqlupdate = "UPDATE `tbl_users` 
              SET `user_name` = '$user_name', 
                  `user_phone` = '$user_phone', 
                  `user_address` = '$user_address' 
              WHERE `user_id` = '$user_id'";

try {
    if ($conn->query($sqlupdate) === TRUE) {
        $response = array('status' => 'success', 'data' => null);
        sendJsonResponse($response);
    } else {
        $response = array('status' => 'failed', 'data' => $conn->error);
        sendJsonResponse($response);
    }
} catch (Exception $e) {
    $response = array('status' => 'failed', 'data' => $e->getMessage());
    sendJsonResponse($response);
    die;
}

function sendJsonResponse($sentArray)
{
    header('Content-Type: application/json');
    echo json_encode($sentArray);
}
?>