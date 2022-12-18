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
    <script>
        // function getData() {
        // // Create an AJAX request
        // var xhr = new XMLHttpRequest();
        // xhr.open("GET", "index.php", true);
        // xhr.onreadystatechange = function() {
        //     if (xhr.readyState == 4 && xhr.status == 200) {
        //     // Parse the JSON data
        //     var data = JSON.parse(xhr.responseText);

        //     // Get a reference to the table
        //     var table = document.getElementById("mysql-table");

        //     // Loop through the data and add it to the table
        //     for (var i = 0; i < data.length; i++) {
        //         var row = table.insertRow();
        //         var cell1 = row.insertCell(0);
        //         var cell2 = row.insertCell(1);
        //         var cell2 = row.insertCell(2);
        //         var cell2 = row.insertCell(3);
        //         var cell2 = row.insertCell(4);
        //         cell1.innerHTML = data[i].column1;
        //         cell2.innerHTML = data[i].column2;
        //         cell1.innerHTML = data[i].column3;
        //         cell2.innerHTML = data[i].column4;
        //         cell1.innerHTML = data[i].column5;
        //     }
        //     }
        // }
        // xhr.send();
        // }

        // // Send the AJAX request every 10 seconds
        // setTimeout(function() {
        // getData();
        // }, 5000);

    </script>
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

    <div class="container mt-3">
        <h2>Web Monitoring Sensor Raspberry Pi 3</h2>
        <p>Memonitor Jarak, Suhu dan Temperatur dan menggunakan styling dengan CDN Bootstrap 5</p>

        <table id="mysql-table" class="table table-dark table-hover align-content-end">
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
