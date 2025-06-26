<?php
include '../config/db.php';
<<<<<<< HEAD
$result = $koneksi->query("SELECT * FROM mahasiswa");
?>
<!DOCTYPE html>
<html lang="en">
=======
$result = $conn->query("SELECT * FROM mahasiswa");
?>
<!DOCTYPE html>
<html lang="en">

>>>>>>> 1557d6bfc8344706aaadee8f186a70f8ea4cb864
<head>
    <meta charset="UTF-8">
    <title>Data Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="p-4">
    <div class="container">
        <h2 class="mb-4">Data Mahasiswa</h2>
        <a href='tambah.php' class="btn btn-primary mb-3">Tambah Mahasiswa</a>
        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th>Nama</th>
                    <th>NIM</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['nama'] ?></td>
                        <td><?= $row['nim'] ?></td>
                        <td>
<<<<<<< HEAD
                            <a href='edit.php?id=<?= $row['id_mhs'] ?>' class="btn btn-sm btn-warning">Edit</a>
                            <a href='hapus.php?id=<?= $row['id_mhs'] ?>' class="btn btn-sm btn-danger"
                                onclick="return confirm('Hapus?')">Hapus</a>
=======
                            <a href='edit.php?id=<?= $row['id'] ?>' class="btn btn-sm btn-warning">Edit</a>
                            <a href='hapus.php?id=<?= $row['id'] ?>' class="btn btn-sm btn-danger" onclick="return confirm('Hapus?')">Hapus</a>
>>>>>>> 1557d6bfc8344706aaadee8f186a70f8ea4cb864
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <a href="../index.php" class="btn btn-primary mb-3">Back</a>
    </div>
</body>
<<<<<<< HEAD
=======

>>>>>>> 1557d6bfc8344706aaadee8f186a70f8ea4cb864
</html>