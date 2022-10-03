<?php

// Connection Details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "crime_management";
$port="3308";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname,$port);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


?>