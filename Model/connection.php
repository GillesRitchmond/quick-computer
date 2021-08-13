<?php
// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "quick-computer-db";

// Create connection
// $conn = new mysqli($servername, $username, $password, $dbname);

$servername = 'mysql-42515-0.cloudclusters.net';
$dbname   = 'quick_computer_db';
$username = 'admin';
$password = 'Hl62SW6d';
$dbServerPort = "19457";
$charset = 'utf8mb4';

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname, $dbServerPort);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
// echo "Connected successfully"

?>