<?php
include '../config/db.php';

$id = $_GET['id'];
$koneksi->query("DELETE FROM nilai WHERE id = $id");

$result = $koneksi->query("SELECT MAX(id) as max_id FROM nilai");
$row = $result->fetch_assoc();
$next_id = $row['max_id'] + 1;
$koneksi->query("ALTER TABLE nilai AUTO_INCREMENT = $next_id");

header("Location: index.php");
exit();
?>