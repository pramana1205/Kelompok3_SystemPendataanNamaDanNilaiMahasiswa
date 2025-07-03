<?php
include '../config/db.php';
$mahasiswa = $koneksi->query("SELECT * FROM mahasiswa");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $mhs = $koneksi->real_escape_string($_POST['mahasiswa_id']);
    $matkul = $koneksi->real_escape_string($_POST['matkul']);
    $nilai = $koneksi->real_escape_string($_POST['nilai']);
    
    $koneksi->query("INSERT INTO nilai (mahasiswa_id, matkul, nilai) VALUES ($mhs, '$matkul', $nilai)");
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Nilai</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #4e73df;
            --secondary-color: #1cc88a;
            --dark-color: #5a5c69;
        }
        
        body {
            background-color: #f8f9fc;
            font-family: 'Nunito', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
        }
        
        .form-card {
            max-width: 600px;
            margin: 2rem auto;
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
        
        .form-label {
            font-weight: 600;
            color: var(--dark-color);
            margin-bottom: 0.5rem;
        }
        
        .form-control, .form-select {
            padding: 0.75rem 1rem;
            border-radius: 10px;
            border: 1px solid #d1d3e2;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(78, 115, 223, 0.25);
        }
        
        .btn-submit {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
            border-radius: 50px;
            padding: 0.5rem 2rem;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: all 0.3s;
        }
        
        .btn-submit:hover {
            background-color: #17a673;
            border-color: #17a673;
            transform: translateY(-2px);
        }
        
        .btn-back {
            border-radius: 50px;
            padding: 0.5rem 1.5rem;
            margin-right: 1rem;
        }
        
        .input-group-text {
            background-color: #e9ecef;
            border-radius: 10px 0 0 10px;
        }
        
        .student-option {
            display: flex;
            justify-content: space-between;
        }
        
        .student-name {
            font-weight: 600;
        }
        
        .student-nim {
            color: #6c757d;
            font-size: 0.9em;
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="form-card card">
            <div class="card-header text-center">
                <h3 class="m-0"><i class="fas fa-plus-circle me-2"></i>Tambah Nilai Mahasiswa</h3>
            </div>
            <div class="card-body p-4">
                <form method="post">
                    <div class="mb-4">
                        <label for="mahasiswa" class="form-label">Mahasiswa</label>
                        <select name="mahasiswa_id" id="mahasiswa" class="form-select" required>
                            <?php while($row = $mahasiswa->fetch_assoc()): ?>
                                <option value="<?= $row['id'] ?>">
                                    <span class="student-name"><?= htmlspecialchars($row['nama']) ?></span>
                                    <span class="student-nim">(<?= htmlspecialchars($row['nim']) ?>)</span>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    
                    <div class="mb-4">
                        <label for="matkul" class="form-label">Mata Kuliah</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-book"></i></span>
                            <input type="text" id="matkul" name="matkul" class="form-control" placeholder="Masukkan nama mata kuliah" required>
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <label for="nilai" class="form-label">Nilai</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-star"></i></span>
                            <input type="number" id="nilai" name="nilai" step="0.01" min="0" max="100" class="form-control" placeholder="Masukkan nilai (0-100)" required>
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-between align-items-center mt-5">
                        <a href="index.php" class="btn btn-outline-secondary btn-back">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>
                        <button type="submit" class="btn btn-submit">
                            <i class="fas fa-save me-2"></i>Simpan Nilai
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>