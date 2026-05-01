<?php
$conn = pg_connect("host=localhost port=5432 dbname=restaurant_tracker user=postgres password= !U2h@nd0");

if (!$conn) {
    echo "Connection failed";
} else {
    echo "Connected successfully";
}
?>