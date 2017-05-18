<?php

//Establish a connection
$servername = "127.0.0.1:8889";
$username   = "root";
$password   = "root";
$dbname     = "willie";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
