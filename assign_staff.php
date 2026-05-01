<?php
include "db.php";

$staff_id = $_POST['staff_id'] ?? '';
$restaurant_id = $_POST['restaurant_id'] ?? '';
$job_title = $_POST['job_title'] ?? '';

if (empty($staff_id) || empty($restaurant_id)) {
    echo json_encode(["success" => false, "message" => "All fields are required"]);
    exit;
}

// Validate staff exists and is actually staff
$check_staff = pg_query_params($conn, "SELECT * FROM users WHERE user_id = $1 AND role = 'staff'", [$staff_id]);
if (pg_num_rows($check_staff) == 0) {
    echo json_encode(["success" => false, "message" => "Invalid staff member"]);
    exit;
}

// Check not already assigned
$check_existing = pg_query_params($conn, "SELECT * FROM restaurant_staff WHERE staff_id = $1 AND restaurant_id = $2", [$staff_id, $restaurant_id]);
if (pg_num_rows($check_existing) > 0) {
    echo json_encode(["success" => false, "message" => "Staff already assigned to this restaurant"]);
    exit;
}

$query = "INSERT INTO restaurant_staff (restaurant_id, staff_id, job_title) VALUES ($1, $2, $3)";
$result = pg_query_params($conn, $query, [$restaurant_id, $staff_id, $job_title]);

if ($result) {
    echo json_encode(["success" => true, "message" => "Staff assigned to restaurant successfully"]);
} else {
    echo json_encode(["success" => false, "message" => "Failed to assign staff"]);
}
?>