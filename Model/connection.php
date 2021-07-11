<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "quick-computer-db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// $servername = 'mysql-36994-0.cloudclusters.net';
// $dbname   = 'system_management_school_db';
// $username = 'admin';
// $password = '4vae6PyH';
// $dbServerPort = "36994";
// $charset = 'utf8mb4';

// Create connection
// $conn = new mysqli($servername, $username, $password, $dbname, $dbServerPort);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
// echo "Connected successfully"

?>