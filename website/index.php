<!-- USING BOOTSTRAP CDN, MODIFIED BY SETIYADI_BEN AT POLINES -->
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
    <style>
        .dashboard{
            height: 200px;
            background: dark;
        }
    </style>

    <title>Web Monitoring TE4B</title>
</head>
<body>
    <div class="container mt-3">
        <h2>Web Monitoring Sensor Raspberry Pi 3</h2>
        <p>Memonitor Jarak, Suhu dan Temperatur dan menggunakan styling dengan CDN Bootstrap 5</p>

        <table class="table table-dark table-hover align-content-end">
            <thead>
                <tr>
                <th>Id</th>
                <th>Datetime</th>
                <th>Sensor Jarak</th>
                <th>Sensor Suhu</th>
                <th>Sensor Kelembapan</th>
                </tr>

                <!-- FETCH DATA FROM MYSQL -->
                <?php
                include "conn_db.php";
                $sql = "SELECT id, datetimes, hcsr, temp, humi FROM tabelSensor ORDER by id DESC LIMIT 5";
                $result = $conn->query($sql);
                ?>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) {?>
            <tr>
                <td><?php echo $row["id"]?></td>
                <td><?php echo $row["datetimes"]?></td>
                <td><?php echo $row["hcsr"]?>cm</td>
                <td><?php echo $row["temp"]?>C</td>
                <td><?php echo $row["humi"]?>%</td>
            </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
