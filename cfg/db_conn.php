<?php

$server = "localhost";
$username = "root";
$password = "";
$database_name = "purrfectpetsdb";

$db = mysqli_connect($server, $username, $password, $database_name);

if(!$db) {
    echo "Connection failed!";
    exit();
}
?>