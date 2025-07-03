<?php
$koneksi = new mysqli("localhost", "root", "", "uas_mahasiswa");
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}
