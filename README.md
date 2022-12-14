<div style="text-align: center;">
  <img src="https://i.postimg.cc/7PC7DqkN/algo-prog-samples.png" alt="alt text">
</div>

# How to Melakukan "Praktikum"

Repositori ini adalah dokumentasi dari proses praktikum dari matakuliah Algoritma dan Pemrograman II. Berikut di bawah ini merupakan langkah - langkah agar dapat mengerjakan praktikum secara lebih efisien.

### Alat dan Bahan

Berikut alat dan bahan yang akan digunakan, antaralain:

- Laptop (Rekomendasi, min : 4GB RAM + SSD)
- Raspberry Pi 3 model B+ & microSD class 10 (usahakan milik sendiri)
- RPi OS (bisa **[download disini](https://downloads.raspberrypi.org/raspios_arm64/images/raspios_arm64-2022-09-26/2022-09-22-raspios-bullseye-arm64.img.xz)**)
- Sensor (DHT11, HC-SR04, BH1750, ... )
- Project Board
- Kabel Jumper
- Multimeter
- VMWare Workstation (Bila ingin simulasi diluar lab. Bisa **[download disini](https://drive.google.com/file/d/1x3dDzJUw83g2zxjhQGPQmYkyewrtXbEB/view?usp=sharing)**)

Oiya, untuk memudahkan dalam pemasangan sensor pada praktikum selanjutnya **usahakan memiliki kabel jumper sendiri**. Dengan melakukan **pelabelan** pada setiap jumper dengan menuliskan nomor pin GPIOnya akan menghemat waktu sekitar 10 s/d 15 menit.

###  Instalasi RPi OS

 1.Install Rapberry Pi imager **[disini](https://downloads.raspberrypi.org/imager/imager_latest.exe)**.
  
 2.Masukkan microSD kemudian buka Rapberry Pi imager klik Choose storage > pilih microSD tadi. Jika ada tulisan "write protected" geser slider yang ada di adapter sampai tulisan tersebut hilang.
  
 3.Kemudian klik Choose OS > Use custom (scroll kebawah) > pilih Raspbian OS yang didownload tadi.

 4.Klik write dan tunggu hingga selesai, setelah itu masukkan microSD kedalam Raspberry Pi.

### Pinout Raspberrry Pi 3 Model B+

<div style="text-align: center;">
  <img src="https://i.postimg.cc/tTDYtmWD/Raspberry-Pi-Pinout.jpg" alt="alt text">
</div>

- Untuk pinout ke sensor bisa dilakukan bebas dikarenakan pin - pin yang berada pada Raspberry Pi bertipe GPIO (General Purpose I/O). 

### Code untuk Sensor

- Sensor HC-SR04
- Sensor DHT11
Silahkan dicari ada diatas, untuk sensor yang working hanya kedua itu saja dan penggabungan kedua sensor tersebut berada di main.py.

### Instalasi Database phpMyAdmin

- Berikut konfigurasi Database dalam Raspberry Pi sebagai server.
```bash
  sudo apt-get install php php-mbstring
  sudo apt-get install mariadb-server php-mysql
  sudo mysql --user=root
  CREATE USER 'nama_user'@'localhost' IDENTIFIED BY 'password';
  GRANT ALL PRIVILEGES ON*.*TO 'nama_user'@'localhost' WITH GRANT OPTION;
```

- Klik Ctrl + D atau Ctrl + C, kemudian
```bash
  sudo apt-get install phpmyadmin
```
- Jika ada pilihan apache2 atau lighttpd pilih apache2 dengan klik spasi.
  Jika ada configure db-config bla bla bla pilih "No".

- Ketikkan ini untuk mengetahui ip Raspberry server
```bash
  hostname -I
```
- Masukkan ip 192.168.XXX.XX tadi dalam browser dengan menulis phpmyadmin untuk mengakses database tadi menggunakan username dan password yang telah dibuat tadi.
```url
  192.168.XXX.xxx/phpmyadmin
```
### Membuat Database dan Tabel MySQL Baru dan Menkonfigurasi Previleges

- Setelah berhasil login, buat database baru dengan klik **"New"**. Kemudian isi field untuk nama dan **Create**. Ingat - ingat untuk kotak biru !

  [![Screenshot-3.png](https://i.postimg.cc/0ycfg3P7/Screenshot-3.png)](https://postimg.cc/JsHJZpyh)

- Setelah database terbuat, cek bagian previlegesnya apakah terdapat error seperti gambar dibawah ini.

  [![Screenshot-4.png](https://i.postimg.cc/XvMBZkjp/Screenshot-4.png)](https://postimg.cc/Hr2kR57g)

- Untuk memperbaiki error tersebut, klik logo **phpMyAdmin** > ganti **server connection collation** sama dengan yang dikotak biru sebelumnya. Cek kembali database tersebut untuk memastikan error pada privilegesnya sudah terselesaikan.

  [![Screenshot-5.png](https://i.postimg.cc/8kF2PR02/Screenshot-5.png)](https://postimg.cc/jCbgM7Kc)

- Cek previleges dengan cara klik database kemudian pilih "Previleges". Jika tidak error maka langkah tersebut berhasil.

   [![Screenshot-5.png](https://i.ibb.co/MhhjFd0/Screenshot-6.png)](https://ibb.co/JddbDZJ)

- Untuk membuat sebuah tabel baru pada database klik New. Kemudian, isikan data sebagai berikut :

    [![Screenshot-8.png](https://i.postimg.cc/Bvb5mcNR/Screenshot-8.png)](https://postimg.cc/QBLWt72q)

### Test koneksi Python MySQL Connector

- Langkah ini berfungsi untuk mengecek apakah python kalian gunakan sudah terhubung dengan MySQL agar dapat memanipulasi database yang telah dibuat dengan menggunakan bahasa python.
- Untuk melakukan test koneksi diperlukan menginstal MySQL driver terlebih dahulu bisa menggunakan perintah dibawah ini.
  ```bash
  sudo python -m pip install mysql-connector-python
  ```
- Untuk mengetesnya kalian tuliskan perintah program dibawah ini (Referensi : [W3Schools](https://www.w3schools.com/python/python_mysql_getstarted.asp)).
  ```bash
  sudo nano demo_mysql_test.py
  ```
  ```python
  import mysql.connector

  mydb = mysql.connector.connect(
    host="localhost",
    user="yourusername",
    password="yourpassword"
  )

  print(mydb) 
  ```
  ```bash
  python demo_mysql_test.py
  ```
- Jika terdapat error pada saat melakukan testing, uninstal driver tadi dan ikuti langkah dibawah ini (Referensi : [StackOverflow](https://stackoverflow.com/questions/73244027/character-set-utf8-unsupported-in-python-mysql-connector)).
  ```bash
  sudo pip uninstall mysql-connector-python
  sudo pip3 install mysql-connector-python==8.0.29
  ```
### Mentransfer Value Sensor kedalam Database MySQL

- Untuk mentransfernya, diperlukan sebuah perintah query SQL. Untuk sintaks programmnya terdapat pada file dengan nama "mysqlinsert_main.py". Dalam sintaks tersebut sensor yang diinputkan berupa sensor HC-SR04 dan DHT11. Dibawah ini merupakan potongan query SQL dari file mysqlinsert_main.py.
  ```sql
  sql = "INSERT INTO tabelSensor (datetimes, hcsr, temp, humi) VALUES (%s, %s, %s, %s)"
  val = ((formatted_date), (dist), (temperature), (humidity))
  ```
- Jika berhasil data yang telah masuk akan terlihat seperti demikian.

  [![Screenshot-9.png](https://i.postimg.cc/VkQZdTf4/Screenshot-9.png)](https://postimg.cc/jLc41MJJ)

### Menampilkan data tabel MySQL dalam Website berupa tabel

- Untuk melakukan ini diperlukan file HTML dengan sintaks PHP untuk merequest data dari database. Untuk mengaksesnya, kalian bisa menyalin file dalam folder website yang dapat kalian modifikasi sendiri.

- Jika kalian menggunakan setelan data sql tabel yang sama (id, datetimes, hcsr, temp, humi) kalian tinggal ganti yang dikotak merah.

  [![Screenshot-15.png](https://i.postimg.cc/Wzr3gJHs/Screenshot-15.png)](https://postimg.cc/bSypjdP5)

  [![Screenshot-17.png](https://i.postimg.cc/y6PY4sCQ/Screenshot-17.png)](https://postimg.cc/xqXSLrCM)

  [![Screenshot-16.png](https://i.postimg.cc/QCn286bt/Screenshot-16.png)](https://postimg.cc/ctw9TBPy)

- Kemudian untuk dapat diakses melalui web kita memperlukan perubahan perizinan pada direktori */var/www/html* . Kita bisa rubah perizinan dengan mengetikan perintah seperti berikut.
  ```bash
  sudo chmod -R a+rwx /var/www
  ``` 
- Pindahkan file tersebut menggunakan SFTP, disini Saya gunakan Bitvise SSH.
  
  [![Screenshot-10.png](https://i.postimg.cc/bN60JC9L/Screenshot-10.png)](https://postimg.cc/XpCB1ghy)

- Kemudian kita pastekan file tersebut kedalam folder /var/www/html lewat VNC Viewer. Namun, sebelum itu kalian bisa cari file kalian terlebih dahulu, berikut contoh lokasi direktori Saya.

  [![Screenshot-11.png](https://i.postimg.cc/SQckkHkF/Screenshot-11.png)](https://postimg.cc/8skqbK7t)

  [![Screenshot-12.png](https://i.postimg.cc/hPCwB0zR/Screenshot-12.png)](https://postimg.cc/tYxDdWNB)

- Berikut tampilan halaman web php untuk memunculkan tabel dari MySQL table.

  [![Screenshot-13.png](https://i.postimg.cc/c4jp3msM/Screenshot-13.png)](https://postimg.cc/TpVNMn5p)

- Berikut tampilan lengkap halaman web php untuk memunculkan tabel dari MySQL table beserta dashboard.

  [![Screenshot-14.png](https://i.postimg.cc/SQYg2NDR/Screenshot-14.png)](https://postimg.cc/hhgLNgFR)

- Jangan kaget bila saat mengetikan perintah hostname -I punya kalian hanya memunculkan 1 alamat ip saja. Di kasus Saya, raspberry pi terhubung dengan bridged lan ip dari laptop dan satunya terhubung dengan hotspot WiFi. Saat kalian temukan alamat ipnya, karena satu network address jadi dapat diakses melalui hp seperti dibawah ini.


<div style="text-align: center;">
  <img src="https://i.postimg.cc/637WdGmy/photo-6129802592600045213-y.jpg" alt="alt text">
</div>

# TERIMA KASIH

<div style="text-align: center;">
  <img src="https://i.postimg.cc/6QgWhJm9/algo-prog-samples-1.png" alt="alt text">
</div>
