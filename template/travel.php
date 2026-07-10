<?php
// Database connection (update with your database details)
$servername = "localhost";
$username = "travbblp_admin";
$password = "_Um3HO&,s];g";
$dbname = "travbblp_main";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>