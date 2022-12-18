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

// Testing for AJAX REQUEST
/*
  // Query SQL untuk mengambil data untuk dashboard
  $sqldash_result = $conn->query("SELECT id, datetimes, hcsr, temp, humi FROM tabelSensor ORDER by id DESC LIMIT 1");
  // Query SQL untuk mengambil data untuk html tabel
  $sqltable_result = $conn->query("SELECT id, datetimes, hcsr, temp, humi FROM tabelSensor ORDER by id DESC LIMIT 5");
  // Fetch the results and store them in a string
  $dashresults = '';
  while ($dashrow = mysqli_fetch_assoc($sqldash_result)) {
    $sqldash_result .= $dashrow['id'] . ' ' . $dashrow['datetimes'] . $dashrow['hcsr'] . ' ' . $dashrow['temp'] . ' ' . $dashrow['humi'] . '<br>';
  }
  $tableresults = '';
  while ($row = mysqli_fetch_assoc($sqltable_result)) {
    $sqltable_result .= $row['id'] . ' ' . $row['datetimes'] . $row['hcsr'] . ' ' . $row['temp'] . ' ' . $row['humi'] . '<br>';
  }
  echo json_encode($dashresults, $tableresults);
?>
/*
