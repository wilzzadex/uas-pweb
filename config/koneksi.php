<?php
// $host = "host.docker.internal"; // Hostname
$host = "194.233.89.11"; // Hostname
$username = "root"; // Username
$password = "bismillah123"; // Password (Isi jika menggunakan password)
$database = "rasabersama"; // Nama databasenya

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

?>
