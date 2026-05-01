<?php
include "db.php";

// Get inputs
$order_id = $_POST['order_id'] ?? '';
$customer_id = $_POST['customer_id'] ?? '';
$thumbs = $_POST['thumbs'] ?? '';

// Validate inputs
if (empty($order_id) || empty($customer_id) || empty($thumbs)) {
    echo json_encode(["success" => false, "message" => "All fields are required"]);
    exit;
}

// Validate thumbs value
if (!in_array($thumbs, ['up', 'down'])) {
    echo json_encode(["success" => false, "message" => "Invalid rating. Must be up or down"]);
    exit;
}

// Validate that the order belongs to this customer
$check_order = pg_query_params($conn, "SELECT * FROM orders WHERE order_id = $1 AND customer_id = $2", [$order_id, $customer_id]);
if (pg_num_rows($check_order) == 0) {
    echo json_encode(["success" => false, "message" => "Order not found or does not belong to you"]);
    exit;
}

// Check that the order has been collected before rating
$check_status = pg_fetch_assoc($check_order);
if ($check_status['status'] !== 'collected') {
    echo json_encode(["success" => false, "message" => "You can only rate a collected order"]);
    exit;
}

// Check if customer has already rated this order
$check_rating = pg_query_params($conn, "SELECT * FROM ratings WHERE order_id = $1 AND customer_id = $2", [$order_id, $customer_id]);
if (pg_num_rows($check_rating) > 0) {
    echo json_encode(["success" => false, "message" => "You have already rated this order"]);
    exit;
}

// Insert rating
$query = "INSERT INTO ratings (order_id, customer_id, thumbs) VALUES ($1, $2, $3)";
$result = pg_query_params($conn, $query, [$order_id, $customer_id, $thumbs]);

if ($result) {
    echo json_encode(["success" => true, "message" => "Order rated successfully"]);
} else {
    echo json_encode(["success" => false, "message" => "Failed to rate order"]);
}
?>
