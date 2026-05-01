<?php
include "db.php";

$name = $_POST['name'];
$password = $_POST['password'];
$role = $_POST['role'];

$query = "INSERT INTO users (name, password, role)
          VALUES ('$name', '$password', '$role')";

$result = pg_query($conn, $query);

echo $result ? "Success" : "Error";
?>