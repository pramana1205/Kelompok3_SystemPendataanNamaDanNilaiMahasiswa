
<?php
include '../config/db.php';
$id = $_GET['id'];
$data = $koneksi->query("SELECT * FROM nilai WHERE id=$id")->fetch_assoc();
$mahasiswa = $koneksi->query("SELECT * FROM mahasiswa");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $mhs = $_POST['mahasiswa_id'];
    $matkul = $_POST['matkul'];
    $nilai = $_POST['nilai'];
    $koneksi->query("UPDATE nilai SET mahasiswa_id=$mhs, matkul='$matkul', nilai=$nilai WHERE id=$id");
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Nilai</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
<div class="container">
<h2>Edit Nilai</h2>
<form method="post">
    <div class="mb-3">
        <label>Mahasiswa</label>
        <select name="mahasiswa_id" class="form-control">
            <?php while($row = $mahasiswa->fetch_assoc()): ?>
                <option value="<?= $row['id'] ?>" <?= $row['id'] == $data['mahasiswa_id'] ? 'selected' : '' ?>>
                    <?= $row['nama'] ?> (<?= $row['nim'] ?>)
                </option>
            <?php endwhile; ?>
        </select>
    </div>
    <div class="mb-3">
        <label>Mata Kuliah</label>
        <input type="text" name="matkul" class="form-control" value="<?= $data['matkul'] ?>">
    </div>
    <div class="mb-3">
        <label>Nilai</label>
        <input type="number" step="0.01" name="nilai" class="form-control" value="<?= $data['nilai'] ?>">
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>
</div>
</body>
</html>
