<<<<<<< HEAD
<?php
include '../config/db.php';
$id = $_GET['id'];
$koneksi->query("DELETE FROM nilai WHERE mahasiswa_id = $id");
$koneksi->query("DELETE FROM mahasiswa WHERE id = $id");
=======

<?php
include '../config/db.php';
$id = $_GET['id'];
$conn->query("DELETE FROM mahasiswa WHERE id=$id");
>>>>>>> 1557d6bfc8344706aaadee8f186a70f8ea4cb864
header("Location: index.php");
?>
