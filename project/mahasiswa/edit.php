<?php
include '../config/db.php';
$id = $_GET['id'];
$data = $koneksi->query("SELECT * FROM mahasiswa WHERE id=$id")->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $koneksi->real_escape_string($_POST['nama']);
    $nim = $koneksi->real_escape_string($_POST['nim']);
    
    $koneksi->query("UPDATE mahasiswa SET nama='$nama', nim='$nim' WHERE id=$id");
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/mahasiswa.css">
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
        
        .form-control {
            padding: 0.75rem 1rem;
            border-radius: 10px;
            border: 1px solid #d1d3e2;
        }
        
        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(78, 115, 223, 0.25);
        }
        
        .btn-update {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            border-radius: 50px;
            padding: 0.5rem 2rem;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: all 0.3s;
        }
        
        .btn-update:hover {
            background-color: #3a5bc7;
            border-color: #3a5bc7;
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
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="form-card card">
            <div class="card-header text-center">
                <h3 class="m-0"><i class="fas fa-user-edit me-2"></i>Edit Data Mahasiswa</h3>
            </div>
            <div class="card-body p-4">
                <form method="post">
                    <div class="mb-4">
                        <label for="nama" class="form-label">Nama Lengkap</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                            <input type="text" id="nama" name="nama" class="form-control" 
                                   value="<?= htmlspecialchars($data['nama']) ?>" required>
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <label for="nim" class="form-label">Nomor Induk Mahasiswa (NIM)</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                            <input type="text" id="nim" name="nim" class="form-control" 
                                   value="<?= htmlspecialchars($data['nim']) ?>" required>
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-between align-items-center mt-5">
                        <a href="index.php" class="btn btn-outline-secondary btn-back">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>
                        <button type="submit" class="btn btn-update">
                            <i class="fas fa-save me-2"></i>Update Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>