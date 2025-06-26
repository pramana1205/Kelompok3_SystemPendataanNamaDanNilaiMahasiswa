<?php
include '../config/db.php';
$result = $koneksi->query("SELECT 
    n.id AS nilai_id,
    m.nama,
    m.nim,
    n.matkul,
    n.nilai
FROM 
    nilai n
JOIN 
    mahasiswa m ON n.mahasiswa_id = m.id;");

$sql_max = "SELECT m.nama, n.nilai 
            FROM nilai n 
            JOIN mahasiswa m ON n.mahasiswa_id = m.id
            ORDER BY n.nilai DESC 
            LIMIT 1";
$result_max = $koneksi->query($sql_max);
$row_max = $result_max->fetch_assoc();
if ($row_max) {
    $mahasiswa_tertinggi = $row_max['nama'];
    $nilai_tertinggi = $row_max['nilai'];
} else {
    $mahasiswa_tertinggi = 'Tidak ada data';
    $nilai_tertinggi = '-';
}


$sql_min = "SELECT m.nama, n.nilai 
            FROM nilai n 
            JOIN mahasiswa m ON n.mahasiswa_id = m.id
            ORDER BY n.nilai ASC 
            LIMIT 1";
$result_min = $koneksi->query($sql_min);
$row_min = $result_min->fetch_assoc();
if ($row_min) {
    $mahasiswa_terendah = $row_min['nama'];
    $nilai_terendah = $row_min['nilai'];
} else {
    $mahasiswa_terendah = 'Tidak ada data';
    $nilai_terendah = '-';
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Data Nilai</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="p-4">
    <div class="container">
        <h2 class="mb-4">Data Nilai Mahasiswa Mata Kuliah Basis Data Lanjut</h2>
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
                            <a href='edit.php?id=<?= $row['nilai_id'] ?>' class="btn btn-sm btn-warning">Edit</a>
                            <a href="hapus.php?id=<?= $row['nilai_id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin hapus nilai ini?')">Hapus</a>

                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <div class="mt-4">
            <h5>Statistik Nilai Mahasiswa</h5>
            <table class="table table-bordered">
                <tr>
                    <th>Nilai Tertinggi</th>
                    <td><?= $nilai_tertinggi ?></td>
                    <td><?= $mahasiswa_tertinggi ?></td>
                </tr>
                <tr>
                    <th>Nilai Terendah</th>
                    <td><?= $nilai_terendah ?></td> 
                    <td><?= $mahasiswa_terendah ?></td>
                </tr>
            </table>
        </div>
        <a href="../index.php" class="btn btn-primary mb-3">Back</a>
    </div>
</body>
</html>