<?php
include '../config/db.php';

$id = $_GET['id']; // ID dari tabel nilai
$koneksi->query("DELETE FROM nilai WHERE id = $id");

header("Location: index.php");
?>
