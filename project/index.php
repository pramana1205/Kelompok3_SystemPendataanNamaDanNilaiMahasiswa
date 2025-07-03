<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pendataan Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #3498db;
            --secondary-color: #2ecc71;
            --dark-color: #2c3e50;
            --light-color: #ecf0f1;
        }

        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .dashboard-header {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
            padding: 30px 0;
        }

        .stat-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s, box-shadow 0.3s;
            margin-bottom: 20px;
            padding: 20px;
            border-top: 5px solid var(--primary-color);
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .stat-card.highlight {
            border-top-color: var(--secondary-color);
        }

        .stat-value {
            font-size: 2.5rem;
            font-weight: bold;
            color: var(--dark-color);
        }

        .btn-dashboard {
            border-radius: 50px;
            padding: 12px 30px;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: all 0.3s;
            margin: 10px;
            min-width: 220px;
        }

        .btn-dashboard:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .stat-icon {
            font-size: 2rem;
            margin-bottom: 15px;
            color: var(--primary-color);
        }

        .highlight .stat-icon {
            color: var(--secondary-color);
        }
    </style>
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

        <?php
        include('config/db.php');

        $query = mysqli_query($koneksi, "SELECT jumlah_mahasiswa() AS total");
        $data = mysqli_fetch_assoc($query);

        $query_max = mysqli_query($koneksi, "
            SELECT * FROM view_nilai_mahasiswa 
            ORDER BY nilai DESC 
            LIMIT 1
        ");
        $nilai_tertinggi = mysqli_fetch_assoc($query_max);

        $query_min = mysqli_query($koneksi, "
            SELECT * FROM view_nilai_mahasiswa 
            ORDER BY nilai ASC 
            LIMIT 1
        ");
        $nilai_terendah = mysqli_fetch_assoc($query_min);
        ?>

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
                    <p class="text-muted mt-2">Perlu peningkatan</p>
                </div>
            </div>

            <!-- Nilai Tertinggi -->
            <div class="col-md-4">
                <div class="stat-card highlight">
                    <div class="stat-icon">
                        <i class="fas fa-trophy"></i>
                    </div>
                    <h3>Nilai Tertinggi</h3>
                    <div class="stat-value text-success"><?= number_format($nilai_tertinggi['nilai'], 0) ?></div>
                    <p class="text-muted mt-2">Pencapaian terbaik mahasiswa</p>
                </div>
            </div>

            <!-- Nilai Terendah -->
            <div class="col-md-4">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h3>Nilai Terendah</h3>
                    <div class="stat-value text-warning"><?= number_format($nilai_terendah['nilai'], 0) ?></div>
                    <p class="text-muted mt-2">Perlu perhatian khusus</p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>