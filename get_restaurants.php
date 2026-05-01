<?php
include "db.php";

$query = "SELECT * FROM restaurants ORDER BY name";
$result = pg_query($conn, $query);

$restaurants = [];
while ($row = pg_fetch_assoc($result)) {
    $restaurants[] = $row;
}

echo json_encode(["success" => true, "restaurants" => $restaurants]);
?>