<?php
include "db.php";

// Get and sanitize inputs
$name = $_POST['name'] ?? '';
$password = $_POST['password'] ?? '';
$role = $_POST['role'] ?? '';

// Validate inputs
if (empty($name) || empty($password) || empty($role)) {
    echo json_encode(["success" => false, "message" => "All fields are required"]);
    exit;
}

// Validate role
if (!in_array($role, ['staff', 'customer'])) {
    echo json_encode(["success" => false, "message" => "Invalid role"]);
    exit;
}

// Check if user already exists
$checkQuery = "SELECT user_id FROM users WHERE name = $1";
$checkResult = pg_query_params($conn, $checkQuery, [$name]);

if ($checkResult && pg_num_rows($checkResult) > 0) {
    echo json_encode(["success" => false, "message" => "Username already taken"]);
    exit;
}

// Hash the password
$hashed_password = password_hash($password, PASSWORD_BCRYPT);

// FIXED: Add RETURNING clause to get the user_id
$query = "INSERT INTO users (name, password, role) VALUES ($1, $2, $3) RETURNING user_id";
$result = pg_query_params($conn, $query, [$name, $hashed_password, $role]);

if ($result) {
    $row = pg_fetch_assoc($result);
    echo json_encode([
        "success" => true, 
        "message" => "User registered successfully",
        "user_id" => $row['user_id']
    ]);
} else {
    echo json_encode(["success" => false, "message" => "Registration failed: " . pg_last_error($conn)]);
}
?>
