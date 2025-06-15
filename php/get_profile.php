<?php
include_once("dbconnect.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['user_id'])) {
        $userid = $_POST['user_id'];

        $stmt = $conn->prepare("SELECT * FROM tbl_users WHERE user_id = ?");
        $stmt->bind_param("s", $userid);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            $response = array(
                'status' => 'success',
                'data' => array(
                    'user_id' => $row['user_id'],
                    'user_name' => $row['user_name'],
                    'user_email' => $row['user_email'],
                    'user_phone' => $row['user_phone'],
                    'user_address' => $row['user_address']
                )
            );
        } else {
            $response = array(
                'status' => 'failed',
                'message' => 'User not found'
            );
        }
        $stmt->close();
    } else {
        $response = array(
            'status' => 'failed',
            'message' => 'Missing user_id'
        );
    }
} else {
    $response = array(
        'status' => 'failed',
        'message' => 'Invalid request method'
    );
}

header('Content-Type: application/json');
echo json_encode($response);
?>