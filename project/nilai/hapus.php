<<<<<<< HEAD
<?php
include '../config/db.php';

$id = $_GET['id'];
$koneksi->query("DELETE FROM nilai WHERE id = $id");

header("Location: index.php");
?>
=======

<?php
include '../config/db.php';
$id = $_GET['id'];
$conn->query("DELETE FROM nilai WHERE id=$id");
header("Location: index.php");
?>
>>>>>>> 1557d6bfc8344706aaadee8f186a70f8ea4cb864
