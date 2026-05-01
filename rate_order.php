<?php
include "db.php";

$order_id = $_POST['order_id'];
$rating = $_POST['rating'];

$query = "INSERT INTO ratings (order_id, rating)
          VALUES ($order_id, '$rating')";

$result = pg_query($conn, $query);

echo $result ? "Rated" : "Error";
?>