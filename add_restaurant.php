<?php
include "db.php";

$name = $_POST['name'] ?? '';

if (empty($name)) {
    echo json_encode(["success" => false, "message" => "Restaurant name is required"]);
    exit;
}

$query = "INSERT INTO restaurants (name) VALUES ($1) RETURNING restaurant_id";
$result = pg_query_params($conn, $query, [$name]);

if ($result) {
    $row = pg_fetch_assoc($result);
    echo json_encode([
        "success" => true,
        "message" => "Restaurant added successfully",
        "restaurant_id" => $row['restaurant_id']
    ]);
} else {
    echo json_encode(["success" => false, "message" => "Failed to add restaurant"]);
}
?>