
<?php
include '../config/db.php';
$id = $_GET['id'];
<<<<<<< HEAD
$data = $koneksi->query("SELECT * FROM mahasiswa WHERE id=$id")->fetch_assoc();
=======
$data = $conn->query("SELECT * FROM mahasiswa WHERE id=$id")->fetch_assoc();
>>>>>>> 1557d6bfc8344706aaadee8f186a70f8ea4cb864
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $nim = $_POST['nim'];
    $sql = "UPDATE mahasiswa SET nama='$nama', nim='$nim' WHERE id=$id";
<<<<<<< HEAD
    $koneksi->query($sql);
=======
    $conn->query($sql);
>>>>>>> 1557d6bfc8344706aaadee8f186a70f8ea4cb864
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
<div class="container">
    <h2 class="mb-4">Edit Mahasiswa</h2>
    <form method="post">
        <div class="mb-3">
            <label class="form-label">Nama</label>
            <input type="text" name="nama" class="form-control" value="<?= $data['nama'] ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">NIM</label>
            <input type="text" name="nim" class="form-control" value="<?= $data['nim'] ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
</body>
<<<<<<< HEAD
</html>
=======
</html>
>>>>>>> 1557d6bfc8344706aaadee8f186a70f8ea4cb864
