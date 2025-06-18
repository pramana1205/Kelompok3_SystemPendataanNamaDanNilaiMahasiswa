<?php
include '../config/db.php';
$result = $conn->query("SELECT n.*, m.nama FROM nilai n JOIN mahasiswa m ON n.mahasiswa_id = m.id");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Data Nilai Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="p-4">
    <div class="container">
        <h2 class="mb-4">Data Nilai Mahasiswa</h2>
        <a href="tambah.php" class="btn btn-primary mb-3">Tambah Nilai</a>
        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th>Nama Mahasiswa</th>
                    <th>Mata Kuliah</th>
                    <th>Nilai</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['nama'] ?></td>
                        <td><?= $row['matkul'] ?></td>
                        <td><?= $row['nilai'] ?></td>
                        <td>
                            <a href='edit.php?id=<?= $row['id'] ?>' class="btn btn-sm btn-warning">Edit</a>
                            <a href='hapus.php?id=<?= $row['id'] ?>' class="btn btn-sm btn-danger" onclick="return confirm('Hapus?')">Hapus</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <a href="../index.php" class="btn btn-primary mb-3">Back</a>
    </div>
</body>

</html>