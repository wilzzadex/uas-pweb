<?php
// $host = "host.docker.internal"; // Hostname
$host = "localhost"; // Hostname
$username = "root"; // Username
$password = "root"; // Password (Isi jika menggunakan password)
$database = "rasabersama"; // Nama databasenya

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

?>
