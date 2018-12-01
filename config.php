<?php
$db = mysqli_connect("localhost","root","password123","mydb");
if (!$db) {
    die('Could not connect: ' . mysqli_error($db));
}
?>