<?php
session_start();
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    if ($user === 'admin' && $pass === 'admin') {
        $_SESSION['admin'] = true;
        header('Location: index.php');
        exit;
    } else {
        $error = '❌ Username / Password salah!';
    }
}
?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="light">

<head>
    <meta charset="UTF-8">
    <title>Login Admin</title>
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
        <h4 class="text-center mb-4">🔐 Login Admin</h4>
        <?php if ($error): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>
        <div class="mb-3">
            <label for="username" class="form-label">👤 Username</label>
            <input type="text" name="username" id="username" class="form-control" required autofocus>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">🔑 Password</label>
            <input type="password" name="password" id="password" class="form-control" required>
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