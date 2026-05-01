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

// Hash the password
$hashed_password = password_hash($password, PASSWORD_BCRYPT);

// Use parameterized query to prevent SQL injection
$query = "INSERT INTO users (name, password, role) VALUES ($1, $2, $3)";
$result = pg_query_params($conn, $query, [$name, $hashed_password, $role]);

if ($result) {
    echo json_encode(["success" => true, "message" => "User registered successfully"]);
} else {
    echo json_encode(["success" => false, "message" => "Registration failed"]);
}
?>
