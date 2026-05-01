<?php
include "db.php";

$name = $_POST['name'];
$password = $_POST['password'];

$query = "SELECT * FROM users WHERE name='$name' AND password='$password'";
$result = pg_query($conn, $query);

if (pg_num_rows($result) > 0) {
    echo "Login success";
} else {
    echo "Login failed";
}
?>