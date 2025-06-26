<?php
include '../config/db.php';
$id = $_GET['id'];

// Hapus dulu data nilai yang berkaitan dengan mahasiswa ini
$koneksi->query("DELETE FROM nilai WHERE mahasiswa_id = $id");

// Baru hapus data mahasiswa
$koneksi->query("DELETE FROM mahasiswa WHERE id = $id");

header("Location: index.php");
?>
