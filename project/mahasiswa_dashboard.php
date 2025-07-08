<?php
session_start();

if (!isset($_SESSION['role']) || !isset($_SESSION['nim'])) {
    header('Location: login.php');
    exit;
}

include('config/db.php');
$nim_mahasiswa = $_SESSION['nim'];

$stmt_max = $koneksi->prepare("
    SELECT nilai, matkul FROM view_nilai_mahasiswa 
    WHERE nim = ? 
    ORDER BY nilai DESC 
    LIMIT 1
");
$stmt_max->bind_param("s", $nim_mahasiswa);
$stmt_max->execute();
$result_max = $stmt_max->get_result();
$nilai_tertinggi = $result_max->num_rows > 0 ? $result_max->fetch_assoc() : ['nilai' => null, 'mata_kuliah' => null];
$stmt_max->close();

$stmt_min = $koneksi->prepare("
    SELECT nilai, matkul FROM view_nilai_mahasiswa 
    WHERE nim = ? 
    ORDER BY nilai ASC 
    LIMIT 1
");
$stmt_min->bind_param("s", $nim_mahasiswa);
$stmt_min->execute();
$result_min = $stmt_min->get_result();
$nilai_terendah = $result_min->num_rows > 0 ? $result_min->fetch_assoc() : ['nilai' => null, 'matkul' => null];
$stmt_min->close();

$stmt_avg = $koneksi->prepare("SELECT AVG(nilai) AS rata_nilai FROM view_nilai_mahasiswa WHERE nim = ?");
$stmt_avg->bind_param("s", $nim_mahasiswa);
$stmt_avg->execute();
$result_avg = $stmt_avg->get_result();
$rata_nilai = $result_avg->fetch_assoc();
$stmt_avg->close();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/index.css">
    <style>
        .stat-sub-value {
            font-size: 1rem;
            color: #6c757d;
            margin-top: 0.25rem;
            font-weight: 500;
        }
    </style>
</head>

<body>
    <div class="container py-5">
        <div class="dashboard-header text-center mb-5">
            <h1 class="display-4 fw-bold mb-2"><i class="fas fa-user-graduate me-2"></i>Dasbor Nilai</h1>
            <p class="h5 text-muted">Selamat datang, <?= htmlspecialchars($_SESSION['username']) ?>!</p>
            <a href="logout.php" class="btn btn-danger mt-3">
                <i class="fas fa-sign-out-alt me-2"></i>Logout
            </a>
        </div>

        <div class="row justify-content-center g-4">
            <div class="col-md-4">
                <div class="stat-card highlight">
                    <div class="stat-icon">
                        <i class="fas fa-trophy"></i>
                    </div>
                    <h3>Nilai Tertinggi</h3>
                    <div class="stat-value text-success">
                        <?= !is_null($nilai_tertinggi['nilai']) ? number_format($nilai_tertinggi['nilai'], 0) : 'N/A' ?>
                    </div>
                    <div class="stat-sub-value">
                        <?= !is_null($nilai_tertinggi['matkul`']) ? htmlspecialchars($nilai_tertinggi['matkul']) : 'Belum ada data' ?>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-arrow-down-short-wide"></i>
                    </div>
                    <h3>Nilai Terendah</h3>
                    <div class="stat-value text-warning">
                        <?= !is_null($nilai_terendah['nilai']) ? number_format($nilai_terendah['nilai'], 0) : 'N/A' ?>
                    </div>
                    <div class="stat-sub-value">
                        <?= !is_null($nilai_terendah['matkul']) ? htmlspecialchars($nilai_terendah['matkul']) : 'Belum ada data' ?>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-balance-scale"></i>
                    </div>
                    <h3>Rata-rata Nilai</h3>
                    <div class="stat-value text-info">
                        <?= !is_null($rata_nilai['rata_nilai']) ? number_format($rata_nilai['rata_nilai'], 2) : '0.00' ?>
                    </div>
                    <div class="stat-sub-value invisible">Mata Kuliah</div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>