<?php
include "db.php";

$order_id = $_POST['order_id'];
$status = $_POST['status'];

$query = "UPDATE orders SET status='$status' WHERE order_id=$order_id";

$result = pg_query($conn, $query);

echo $result ? "Updated" : "Error";
?>