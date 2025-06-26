<?php
include '../config/db.php';
$id = $_GET['id'];
$koneksi->query("DELETE FROM nilai WHERE mahasiswa_id = $id");
$koneksi->query("DELETE FROM mahasiswa WHERE id = $id");
header("Location: index.php");
?>
