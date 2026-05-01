<?php
include "db.php";

// Get inputs
$order_id = $_POST['order_id'] ?? '';
$status = $_POST['status'] ?? '';
$staff_id = $_POST['staff_id'] ?? '';

// Validate inputs
if (empty($order_id) || empty($status) || empty($staff_id)) {
    echo json_encode(["success" => false, "message" => "All fields are required"]);
    exit;
}

// Validate status value
if (!in_array($status, ['pending', 'ready', 'collected'])) {
    echo json_encode(["success" => false, "message" => "Invalid status. Must be pending, ready or collected"]);
    exit;
}

// Validate that the order belongs to this staff member
$check_order = pg_query_params($conn, "SELECT * FROM orders WHERE order_id = $1 AND staff_id = $2", [$order_id, $staff_id]);
if (pg_num_rows($check_order) == 0) {
    echo json_encode(["success" => false, "message" => "Order not found or you are not authorized to update it"]);
    exit;
}

// Update order status
$query = "UPDATE orders SET status = $1 WHERE order_id = $2";
$result = pg_query_params($conn, $query, [$status, $order_id]);

if ($result) {
    echo json_encode(["success" => true, "message" => "Order status updated to $status"]);
} else {
    echo json_encode(["success" => false, "message" => "Failed to update order status"]);
}
?>
