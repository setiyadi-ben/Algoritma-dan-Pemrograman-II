<!-- USING BOOTSTRAP CDN, MODIFIED BY BENNY ALIAS SETIYADI_BEN AT POLITEKNIK NEGERI SEMARANG -->
<!-- PRODI SARJANA TERAPAN (S.Tr) TELEKOMUNIKASI | BASc in TELECOMMUNICATION ENGINEERING -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css">
    <style>
        body {
          background-color: #333;
          color: #999;
          font-family: Arial, sans-serif;
          text-align: center;
        }
    </style>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <style>
        .material-symbols-outlined {
          font-variation-settings:
          'FILL' 0,
          'wght' 400,
          'GRAD' 0,
          'opsz' 48
        }
    </style>
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/eos-icons@latest/dist/css/eos-icons.css' />
      <?php
      // Membuat fungsi untuk auto refresh halaman setiap 5 detik
      // Thanks to Bram
      function refreshPage() {
      echo '<meta http-equiv="refresh" content="5">';
      }
        refreshPage();
        ?>

    <title>Web Monitoring TE4B</title>
</head>
<body>
  <!-- FETCH DATA FROM MYSQL -->
  <?php
  // Autentikasi & Login database MySQL
  include "conn_db.php";
  // Query SQL untuk mengambil data untuk dashboard
  $sqldash_result = $conn->query("SELECT id, datetimes, hcsr, temp, humi FROM tabelSensor ORDER by id DESC LIMIT 1");
  // Query SQL untuk mengambil data untuk html tabel
  $sqltable_result = $conn->query("SELECT id, datetimes, hcsr, temp, humi FROM tabelSensor ORDER by id DESC LIMIT 5");
  ?>

  <!-- div for dashboard -->
  <div class="container mt-5">
      <h1>IoT Dashboard Algoritma dan Pemrograman II</h1>
      <h2>Web Monitoring Sensor Raspberry Pi 3</h2>
      <h6>Memonitor Jarak, Suhu dan Temperatur dengan menggunakan styling dari CDN Bootstrap 5 dan Google APIs</h6>
      <div class="d-flex justify-content-center align-items-center flex-wrap mt-3">
      <!-- display data to dashboard -->
      <?php while ($dashrow = mysqli_fetch_assoc($sqldash_result)) {?>
        <div class="card m-3">
          <div class="card-body">
              <h5 class="card-title mb-1">
                  <span class="material-symbols-outlined">straighten</span> Dist</h5>
                  <!-- display hcsr data -->
              <h4 class="card-text mb-0"><?php echo $dashrow["hcsr"]?> cm</h4>
          </div>
        </div>
        <div class="card m-3">
          <div class="card-body">
              <h5 class="card-title mb-1">
                  <span class="material-symbols-outlined">device_thermostat</span>Temp</h5>
                  <!-- display temperature data -->
              <h4 class="card-text mb-0"><?php echo $dashrow["temp"]?> °C</h4>
          </div>
        </div>
        <div class="card m-3">
          <div class="card-body">
              <h5 class="card-title mb-1">
                  <span class="material-symbols-outlined">humidity_percentage</span>Humi</h5>
                  <!-- display humidity data -->
              <h4 class="card-text mb-0"><?php echo $dashrow["humi"]?> %</h4>
          </div>
        </div>
      </div>
    </div>
    <div class="card-text mt-1">Last Updated : <?php
    // Get datetimes from mysql column and convert it into human readable times 
      $datetime = $dashrow['datetimes']; 
      $format = "j F, Y g:i A";
      echo $phpDateTime = date($format, strtotime($datetime));?></div> 
    <?php } ?>

    <!-- div for html table -->
    <div class="container mt-3">
        <table id="mysql-table" class="table table-dark table-hover align-content-end">
            <thead>
                <tr>
                <th>Id</th>
                <th>Datetime</th>
                <th>Sensor Jarak</th>
                <th>Sensor Suhu</th>
                <th>Sensor Kelembapan</th>
                </tr>
            </thead>
            <tbody>
              <!-- Display data to table -->
                <?php while ($row = mysqli_fetch_assoc($sqltable_result)) {?>
            <tr>
                <td><?php echo $row["id"]?></td>
                <td><?php echo $row["datetimes"]?></td>
                <td><?php echo $row["hcsr"]?> cm</td>
                <td><?php echo $row["temp"]?> °C</td>
                <td><?php echo $row["humi"]?> %</td>
            </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
