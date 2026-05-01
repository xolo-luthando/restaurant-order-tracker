<?php
include "db.php";

// Get inputs
$customer_id = $_POST['customer_id'] ?? '';
$staff_id = $_POST['staff_id'] ?? '';
$restaurant_id = $_POST['restaurant_id'] ?? '';

// Validate inputs
if (empty($customer_id) || empty($staff_id) || empty($restaurant_id)) {
    echo json_encode(["success" => false, "message" => "All fields are required"]);
    exit;
}

// Validate that customer exists and is actually a customer
$check_customer = pg_query_params($conn, "SELECT * FROM users WHERE user_id = $1 AND role = 'customer'", [$customer_id]);
if (pg_num_rows($check_customer) == 0) {
    echo json_encode(["success" => false, "message" => "Invalid customer"]);
    exit;
}

// Validate that staff exists and is actually a staff member
$check_staff = pg_query_params($conn, "SELECT * FROM users WHERE user_id = $1 AND role = 'staff'", [$staff_id]);
if (pg_num_rows($check_staff) == 0) {
    echo json_encode(["success" => false, "message" => "Invalid staff member"]);
    exit;
}

// Validate that staff belongs to the restaurant
$check_restaurant = pg_query_params($conn, "SELECT * FROM restaurant_staff WHERE staff_id = $1 AND restaurant_id = $2", [$staff_id, $restaurant_id]);
if (pg_num_rows($check_restaurant) == 0) {
    echo json_encode(["success" => false, "message" => "Staff does not belong to this restaurant"]);
    exit;
}

// Insert order with parameterized query
$query = "INSERT INTO orders (customer_id, staff_id, restaurant_id, status) VALUES ($1, $2, $3, 'pending') RETURNING order_id";
$result = pg_query_params($conn, $query, [$customer_id, $staff_id, $restaurant_id]);

if ($result) {
    $row = pg_fetch_assoc($result);
    echo json_encode([
        "success" => true,
        "message" => "Order added successfully",
        "order_id" => $row['order_id']
    ]);
} else {
    echo json_encode(["success" => false, "message" => "Failed to add order"]);
}
?>
