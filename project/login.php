<?php
session_start();
include('config/db.php');
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $role = $_POST['role'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($role === 'admin') {
        if ($username === 'admin' && $password === 'admin') {
            $_SESSION['role'] = 'admin';
            $_SESSION['username'] = 'admin';
            header('Location: index.php');
            exit;
        } else {
            $error = '❌ Username / Password salah!';
        }
    } elseif ($role === 'mahasiswa') {
        $stmt = $koneksi->prepare("SELECT nim, nama FROM mahasiswa WHERE nim = ? AND nama = ?");
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            $_SESSION['role'] = 'mahasiswa';
            $_SESSION['username'] = $user['nama'];
            $_SESSION['nim'] = $user['nim']; // <-- BARIS PENTING DITAMBAHKAN
            header('Location: mahasiswa_dashboard.php');
            exit;
        } else {
            $error = '❌ NIM / Nama salah!';
        }
        $stmt->close();
    } else {
        $error = '❌ Peran tidak valid!';
    }
}
?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="light">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/login.css">
</head>

<body class="vh-100 d-flex align-items-center justify-content-center position-relative">
    <div class="theme-toggle form-check form-switch">
        <input class="form-check-input" type="checkbox" id="darkModeToggle">
        <label class="form-check-label text-white" for="darkModeToggle">
            <span id="toggleIcon">🌙</span>
        </label>
    </div>
    <form method="post" class="login-box">
        <h4 class="text-center mb-4">🔐 Login</h4>
        <?php if ($error): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>
        <div class="mb-3">
            <label for="username" class="form-label">👤 Username/NIM</label>
            <input type="text" name="username" id="username" class="form-control" required autofocus>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">🔑 Password/Nama</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="role" class="form-label">👥 Login sebagai</label>
            <select name="role" id="role" class="form-select">
                <option value="admin">Admin</option>
                <option value="mahasiswa">Mahasiswa</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary w-100">Login</button>
    </form>
    <script>
        const html = document.documentElement;
        const toggle = document.getElementById('darkModeToggle');
        const icon = document.getElementById('toggleIcon');

        let theme = localStorage.getItem('theme') || 'light';
        html.setAttribute('data-bs-theme', theme);
        toggle.checked = theme === 'dark';
        icon.textContent = theme === 'dark' ? '☀️' : '🌙';

        toggle.addEventListener('change', () => {
            const mode = toggle.checked ? 'dark' : 'light';
            html.setAttribute('data-bs-theme', mode);
            localStorage.setItem('theme', mode);
            icon.textContent = mode === 'dark' ? '☀️' : '🌙';
        });
    </script>
</body>

</html>