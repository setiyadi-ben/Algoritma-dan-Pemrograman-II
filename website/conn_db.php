<!-- THANKS TO MAS DHEA AFRIZAL YOUTUBE -->
<!-- MODIFIED BY SETIYADI_BEN AT POLINES -->
<?php
$servername = "localhost";
$username = "admin";
$password = "admin";
$dbname = "latihan_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}