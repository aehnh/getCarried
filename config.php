<?php
$db = mysqli_connect("localhost","root","determinist0518","mydb");
if (!$db) {
    die('Could not connect: ' . mysqli_error($db));
}
?>