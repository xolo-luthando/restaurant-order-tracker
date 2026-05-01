<?php
include "db.php";

$query = "SELECT * FROM orders";
$result = pg_query($conn, $query);

$orders = [];

while ($row = pg_fetch_assoc($result)) {
    $orders[] = $row;
}

echo json_encode($orders);
?>