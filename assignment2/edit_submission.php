<?php
include_once("dbconnect.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $submission_id = $_POST['submission_id'];
    $updated_text = $_POST['updated_text'];

    $sql = "UPDATE tbl_submissions SET submission_text = ?, updated_on = NOW() WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $updated_text, $submission_id);

    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Submission updated."]);
    } else {
        echo json_encode(["status" => "failed", "message" => "Failed to update."]);
    }

    $stmt->close();
    $conn->close();
}
?>
