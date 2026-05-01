<?php
include "db.php";

// Get inputs
$user_id = $_POST['user_id'] ?? '';
$role = $_POST['role'] ?? '';

// Validate inputs
if (empty($user_id) || empty($role)) {
    echo json_encode(["success" => false, "message" => "All fields are required"]);
    exit;
}

// Validate role
if (!in_array($role, ['staff', 'customer'])) {
    echo json_encode(["success" => false, "message" => "Invalid role"]);
    exit;
}

if ($role === 'customer') {
    // Customers see their own orders with restaurant name and status
    $query = "SELECT o.order_id, o.status, o.timestamp,
                     r.name AS restaurant_name,
                     u.name AS staff_name
              FROM orders o
              JOIN restaurants r ON o.restaurant_id = r.restaurant_id
              JOIN users u ON o.staff_id = u.user_id
              WHERE o.customer_id = $1
              ORDER BY o.timestamp DESC";
    $result = pg_query_params($conn, $query, [$user_id]);

} else if ($role === 'staff') {
    // Staff see orders they created with customer name and average rating
    $query = "SELECT o.order_id, o.status, o.timestamp,
                     u.name AS customer_name,
                     r.name AS restaurant_name,
                     ROUND(AVG(CASE WHEN rt.thumbs = 'up' THEN 1 ELSE 0 END) * 100) AS positive_rating_percent
              FROM orders o
              JOIN users u ON o.customer_id = u.user_id
              JOIN restaurants r ON o.restaurant_id = r.restaurant_id
              LEFT JOIN ratings rt ON o.order_id = rt.order_id
              WHERE o.staff_id = $1
              GROUP BY o.order_id, o.status, o.timestamp, u.name, r.name
              ORDER BY o.timestamp DESC";
    $result = pg_query_params($conn, $query, [$user_id]);
}

if ($result) {
    $orders = [];
    while ($row = pg_fetch_assoc($result)) {
        $orders[] = $row;
    }
    echo json_encode(["success" => true, "orders" => $orders]);
} else {
    echo json_encode(["success" => false, "message" => "Failed to fetch orders"]);
}
?>
