<?php
include "db.php";

$customer_id = $_POST['customer_id'];
$staff_id = $_POST['staff_id'];
$restaurant_id = $_POST['restaurant_id'];

$query = "INSERT INTO orders (customer_id, staff_id, restaurant_id)
          VALUES ($customer_id, $staff_id, $restaurant_id)";

$result = pg_query($conn, $query);

echo $result ? "Order added" : "Error";
?>