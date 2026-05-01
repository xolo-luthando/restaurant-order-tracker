<?php
include "db.php";

// Get inputs
$name = $_POST['name'] ?? '';
$password = $_POST['password'] ?? '';

// Validate inputs
if (empty($name) || empty($password)) {
    echo json_encode(["success" => false, "message" => "All fields are required"]);
    exit;
}

// Use parameterized query to prevent SQL injection
$query = "SELECT * FROM users WHERE name = $1";
$result = pg_query_params($conn, $query, [$name]);

if ($result && pg_num_rows($result) > 0) {
    $user = pg_fetch_assoc($result);

    // Verify hashed password
    if (password_verify($password, $user['password'])) {
        echo json_encode([
            "success" => true,
            "message" => "Login successful",
            "user_id" => $user['user_id'],
            "name" => $user['name'],
            "role" => $user['role']
        ]);
    } else {
        echo json_encode(["success" => false, "message" => "Invalid credentials"]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Invalid credentials"]);
}
?>
