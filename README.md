
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

Oiya, untuk memudahkan dalam pemasangan sensor pada praktikum selanjutnya **usahakan memiliki kabel jumper sendiri**. Dengan melakukan **pelabelan** pada setiap jumper dengan menuliskan nomor pin GPIOnya akan menghemat waktu sekitar 10 s/d 15 menit.

###  Instalasi RPi OS

 1.Install Rapberry Pi imager **[disini](https://downloads.raspberrypi.org/imager/imager_latest.exe)**.
  
 2.Masukkan microSD kemudian buka Rapberry Pi imager klik Choose storage > pilih microSD tadi. Jika ada tulisan "write protected" geser slider yang ada di adapter sampai tulisan tersebut hilang.
  
 3.Kemudian klik Choose OS > Use custom (scroll kebawah) > pilih Raspbian OS yang didownload tadi.

 4.Klik write dan tunggu hingga selesai, setelah itu masukkan microSD kedalam Raspberry Pi.

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
  Hostname -I
```
- Masukkan ip 192.168.XXX.XX tadi dalam browser dengan menulis phpmyadmin untuk mengakses database tadi menggunakan username dan password yang telah dibuat tadi.
```url
  192.168.XXX.xxx/phpmyadmin
```