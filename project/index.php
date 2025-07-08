<?php
include('config/db.php');

$query = mysqli_query($koneksi, "SELECT jumlah_mahasiswa() AS total");
$data = mysqli_fetch_assoc($query);

$query_sum = mysqli_query($koneksi, "SELECT SUM(nilai) AS total_nilai FROM view_nilai_mahasiswa");
$total_nilai = mysqli_fetch_assoc($query_sum);

$query_count = mysqli_query($koneksi, "SELECT COUNT(*) AS jumlah_nilai FROM view_nilai_mahasiswa");
$jumlah_nilai = mysqli_fetch_assoc($query_count);

$query_max = mysqli_query($koneksi, "
    SELECT * FROM view_nilai_mahasiswa 
    ORDER BY nilai DESC 
    LIMIT 1
");
$nilai_tertinggi = mysqli_num_rows($query_max) > 0 ? mysqli_fetch_assoc($query_max) : ['nilai' => null];

$query_min = mysqli_query($koneksi, "
    SELECT * FROM view_nilai_mahasiswa 
    ORDER BY nilai ASC 
    LIMIT 1
");
$nilai_terendah = mysqli_num_rows($query_min) > 0 ? mysqli_fetch_assoc($query_min) : ['nilai' => null];

$query_avg = mysqli_query($koneksi, "SELECT AVG(nilai) AS rata_nilai FROM view_nilai_mahasiswa");
$rata_nilai = mysqli_fetch_assoc($query_avg);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pendataan Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/index.css">
</head>

<body>
    <div class="container py-5">
        <div class="dashboard-header text-center">
            <h1 class="display-4 fw-bold mb-3"><i class="fas fa-user-graduate me-2"></i>Dashboard Pendataan Mahasiswa</h1>
            <div class="d-flex justify-content-center flex-wrap">
                <a href="mahasiswa/index.php" class="btn btn-light btn-dashboard">
                    <i class="fas fa-users me-2"></i>Data Mahasiswa
                </a>
                <a href="nilai/index.php" class="btn btn-light btn-dashboard">
                    <i class="fas fa-chart-bar me-2"></i>Data Nilai Mahasiswa
                </a>
            </div>
        </div>
        <h2 class="mb-4 text-center"><i class="fas fa-chart-pie me-2"></i>Statistik Nilai Mahasiswa</h2>

        <div class="row justify-content-center">
            <!-- Jumlah Mahasiswa -->
            <div class="col-md-4">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3>Jumlah Mahasiswa</h3>
                    <div class="stat-value text-primary"><?= intval($data['total']) ?></div>
                </div>
            </div>

            <!-- Nilai Tertinggi -->
            <div class="col-md-4">
                <div class="stat-card highlight">
                    <div class="stat-icon">
                        <i class="fas fa-trophy"></i>
                    </div>
                    <h3>Nilai Tertinggi</h3>
                    <div class="stat-value text-success">
                        <?= !empty($nilai_tertinggi['nilai']) ? number_format($nilai_tertinggi['nilai'], 0) : 'Belum ada data' ?>
                    </div>
                </div>
            </div>

            <!-- Nilai Terendah -->
            <div class="col-md-4">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h3>Nilai Terendah</h3>
                    <div class="stat-value text-warning">
                        <?= !empty($nilai_terendah['nilai']) ? number_format($nilai_terendah['nilai'], 0) : 'Belum ada data' ?>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-balance-scale"></i>
                    </div>
                    <h3>Rata-rata Nilai</h3>
                    <div class="stat-value text-danger">
                        <?= !empty($rata_nilai['rata_nilai']) ? number_format($rata_nilai['rata_nilai'], 2) : '0' ?>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-calculator"></i>
                    </div>
                    <h3>Total Nilai</h3>
                    <div class="stat-value text-info">
                        <?= !empty($total_nilai['total_nilai']) ? number_format($total_nilai['total_nilai'], 0) : '0' ?>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-list-ol"></i>
                    </div>
                    <h3>Jumlah Nilai</h3>
                    <div class="stat-value text-secondary">
                        <?= !empty($jumlah_nilai['jumlah_nilai']) ? $jumlah_nilai['jumlah_nilai'] : '0' ?>
                        <small class="stat-matkul">dari <?= intval($data['total']) ?> mahasiswa</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        .stat-matkul {
            font-size: 0.9rem;
            color: #6c757d;
            margin-top: 0.5rem;
        }
    </style>
</body>

</html>