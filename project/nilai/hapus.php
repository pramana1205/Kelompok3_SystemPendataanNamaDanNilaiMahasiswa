
<?php
include '../config/db.php';
$id = $_GET['id'];
$conn->query("DELETE FROM nilai WHERE id=$id");
header("Location: index.php");
?>
