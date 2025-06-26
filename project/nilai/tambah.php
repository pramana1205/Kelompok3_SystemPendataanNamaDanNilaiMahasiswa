
<?php
include '../config/db.php';
$mahasiswa = $koneksi->query("SELECT * FROM mahasiswa");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $mhs = $_POST['mahasiswa_id'];
    $matkul = $_POST['matkul'];
    $nilai = $_POST['nilai'];
    $koneksi->query("INSERT INTO nilai (mahasiswa_id, matkul, nilai) VALUES ($mhs, '$matkul', $nilai)");
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Nilai</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
<div class="container">
<h2>Tambah Nilai</h2>
<form method="post">
    <div class="mb-3">
        <label>Mahasiswa</label>
        <select name="mahasiswa_id" class="form-control">
            <?php while($row = $mahasiswa->fetch_assoc()): ?>
                <option value="<?= $row['id'] ?>"><?= $row['nama'] ?> (<?= $row['nim'] ?>)</option>
            <?php endwhile; ?>
        </select>
    </div>
    <div class="mb-3">
        <label>Mata Kuliah</label>
        <input type="text" name="matkul" class="form-control">
    </div>
    <div class="mb-3">
        <label>Nilai</label>
        <input type="number" step="0.01" name="nilai" class="form-control">
    </div>
    <button type="submit" class="btn btn-success">Simpan</button>
</form>
</div>
</body>
</html>
