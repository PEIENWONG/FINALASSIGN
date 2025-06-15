<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

require_once("dbconnect.php");

$response = ['status' => 'error', 'data' => null];

try {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception("Only POST requests are allowed.");
    }

    $worker_id = $_POST['worker_id'] ?? null;
    if (!$worker_id || !is_numeric($worker_id)) {
        throw new Exception("A valid worker ID is required.");
    }

    $sql = "SELECT 
                s.id,
                s.work_id,
                s.user_id,
                s.submission_text,
                DATE_FORMAT(s.submitted_at, '%Y-%m-%d %H:%i:%s') AS submitted_at,
                DATE_FORMAT(s.updated_on, '%Y-%m-%d %H:%i:%s') AS updated_on,
                w.title AS work_title,
                w.description AS work_description,
                DATE_FORMAT(w.due_date, '%Y-%m-%d') AS due_date,
                w.status
            FROM tbl_submissions s
            JOIN tbl_works w ON s.work_id = w.id
            WHERE s.user_id = ?
            ORDER BY s.submitted_at DESC";

    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        throw new Exception("Failed to prepare SQL: " . $conn->error);
    }

    $stmt->bind_param("i", $worker_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $submissions = [];
    while ($row = $result->fetch_assoc()) {
        $submissions[] = [
            'id' => (int)$row['id'],
            'work_id' => (int)$row['work_id'],
            'user_id' => (int)$row['user_id'],
            'submission_text' => $row['submission_text'],
            'submitted_at' => $row['submitted_at'],
            'updated_on' => $row['updated_on'], // now included
            'work_title' => $row['work_title'],
            'work_description' => $row['work_description'],
            'due_date' => $row['due_date'],
            'status' => $row['status']
        ];
    }

    $response = [
        'status' => 'success',
        'data' => $submissions
    ];

} catch (Exception $e) {
    $response['message'] = $e->getMessage();
    http_response_code(400);
} finally {
    if (isset($stmt)) $stmt->close();
    if (isset($conn)) $conn->close();

    echo json_encode($response);
    exit;
}
?>
