<<<<<<< HEAD
<?php
$koneksi = new mysqli("localhost", "root", "", "uas_mahasiswa");
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}
?>
=======

<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "uas_mahasiswa";
$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
>>>>>>> 1557d6bfc8344706aaadee8f186a70f8ea4cb864
