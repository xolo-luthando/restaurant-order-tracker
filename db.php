<?php
$host = "localhost";
$port = "5432";
$dbname = "restaurant_tracker";
$user = "postgres";
$password = "";

$conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");

if (!$conn) {
    die(json_encode(["success" => false, "message" => "Connection failed"]));
}
?>