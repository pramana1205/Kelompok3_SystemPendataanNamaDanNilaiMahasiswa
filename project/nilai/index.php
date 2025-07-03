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
    mahasiswa m ON n.mahasiswa_id = m.id");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Nilai Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #4e73df;
            --secondary-color: #1cc88a;
            --accent-color: #f6c23e;
            --danger-color: #e74a3b;
            --dark-color: #5a5c69;
        }

        body {
            background-color: #f8f9fc;
            font-family: 'Nunito', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
        }

        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
        }

        .card-header {
            background-color: var(--primary-color);
            color: white;
            border-radius: 15px 15px 0 0 !important;
            padding: 1.25rem 1.5rem;
            border-bottom: none;
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            border-radius: 50px;
            padding: 0.5rem 1.5rem;
            font-weight: 600;
        }

        .btn-primary:hover {
            background-color: #3a5bc7;
            border-color: #3a5bc7;
        }

        .table {
            margin-bottom: 0;
        }

        .table thead th {
            border-bottom: 2px solid #e3e6f0;
            color: var(--dark-color);
            font-weight: 700;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
        }

        .table td,
        .table th {
            padding: 1rem;
            vertical-align: middle;
        }

        .table tbody tr:nth-child(odd) {
            background-color: #f8f9fc;
        }

        .table tbody tr:nth-child(even) {
            background-color: white;
        }

        .table tbody tr:hover {
            background-color: #f0f3ff;
        }

        .badge-score {
            display: inline-block;
            padding: 0.35em 0.65em;
            font-size: 0.9em;
            font-weight: 700;
            line-height: 1;
            text-align: center;
            white-space: nowrap;
            vertical-align: baseline;
            border-radius: 50px;
            min-width: 60px;
        }

        .score-A {
            background-color: #1cc88a;
            color: white;
        }

        .score-B {
            background-color: #36b9cc;
            color: white;
        }

        .score-C {
            background-color: #f6c23e;
            color: white;
        }

        .score-D {
            background-color: #e74a3b;
            color: white;
        }

        .btn-action {
            border-radius: 50px;
            padding: 0.35rem 1rem;
            font-size: 0.85rem;
            margin: 0 0.2rem;
        }

        .btn-edit {
            background-color: var(--accent-color);
            border-color: var(--accent-color);
            color: white;
        }

        .btn-edit:hover {
            background-color: #e0b52a;
            border-color: #e0b52a;
            color: white;
        }

        .btn-delete {
            background-color: var(--danger-color);
            border-color: var(--danger-color);
            color: white;
        }

        .btn-delete:hover {
            background-color: #d52a1a;
            border-color: #d52a1a;
            color: white;
        }

        .action-buttons {
            white-space: nowrap;
        }

        .student-name {
            font-weight: 600;
            color: var(--dark-color);
        }

        .course-name {
            color: #858796;
        }
    </style>
</head>

<body>
    <div class="container py-5">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="m-0"><i class="fas fa-chart-bar me-2"></i>Data Nilai Mahasiswa - Basis Data Lanjut</h4>
                <div>
                    <a href='tambah.php' class="btn btn-light">
                        <i class="fas fa-plus me-2"></i>Tambah Nilai
                    </a>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Nama Mahasiswa</th>
                                <th>Mata Kuliah</th>
                                <th>Nilai</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = $result->fetch_assoc()):
                                $scoreClass = '';
                                if ($row['nilai'] >= 85) $scoreClass = 'score-A';
                                elseif ($row['nilai'] >= 70) $scoreClass = 'score-B';
                                elseif ($row['nilai'] >= 55) $scoreClass = 'score-C';
                                else $scoreClass = 'score-D';
                            ?>
                                <tr>
                                    <td>
                                        <span class="student-name"><?= htmlspecialchars($row['nama']) ?></span>
                                    </td>
                                    <td>
                                        <span class="course-name"><?= htmlspecialchars($row['matkul']) ?></span>
                                    </td>
                                    <td>
                                        <span class="badge-score <?= $scoreClass ?>">
                                            <?= number_format($row['nilai'], 2) ?>
                                        </span>
                                    </td>
                                    <td class="action-buttons text-center">
                                        <a href='edit.php?id=<?= $row['nilai_id'] ?>' class="btn btn-sm btn-action btn-edit">
                                            <i class="fas fa-edit me-1"></i>Edit
                                        </a>
                                        <a href='hapus.php?id=<?= $row['nilai_id'] ?>' class="btn btn-sm btn-action btn-delete"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus nilai ini?')">
                                            <i class="fas fa-trash-alt me-1"></i>Hapus
                                        </a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer bg-white border-top-0 text-end">
                <a href="../index.php" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Kembali ke Dashboard
                </a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>