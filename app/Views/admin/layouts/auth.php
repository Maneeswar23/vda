<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login — Visakha Defence Academy</title>

    <!-- Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <!-- Admin CSS -->
    <link rel="stylesheet" href="<?= base_url('public/admin/css/admin.css') ?>">

    <style>
        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #134b9a 0%, #08a4f5 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', sans-serif;
        }
        .login-wrapper {
            width: 100%;
            max-width: 420px;
            padding: 15px;
        }
        .login-card {
            background: #fff;
            border-radius: 16px;
            padding: 40px 35px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.2);
        }
        .login-logo {
            text-align: center;
            margin-bottom: 30px;
        }
        .login-logo .logo-line1 {
            font-size: 22px;
            font-weight: 900;
            color: #134b9a;
            letter-spacing: 3px;
            line-height: 1;
        }
        .login-logo .logo-line2 {
            font-size: 13px;
            font-weight: 700;
            color: #08a4f5;
            letter-spacing: 2px;
        }
        .login-logo .logo-line3 {
            font-size: 11px;
            color: #6c757d;
            letter-spacing: 1px;
        }
        .login-title {
            font-size: 20px;
            font-weight: 700;
            color: #134b9a;
            text-align: center;
            margin-bottom: 25px;
        }
        .form-control {
            border-radius: 8px;
            padding: 10px 15px;
            border: 1px solid #dee2e6;
            font-size: 14px;
        }
        .form-control:focus {
            border-color: #134b9a;
            box-shadow: 0 0 0 3px rgba(19,75,154,0.1);
        }
        .form-label {
            font-size: 13px;
            font-weight: 600;
            color: #444;
            margin-bottom: 5px;
        }
        .btn-login {
            background: #134b9a;
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 12px;
            font-size: 15px;
            font-weight: 600;
            width: 100%;
            transition: background 0.3s;
        }
        .btn-login:hover {
            background: #0d3a7a;
            color: #fff;
        }
        .input-group-text {
            background: #f8f9fa;
            border-radius: 0 8px 8px 0 !important;
            border-color: #dee2e6;
            cursor: pointer;
        }
        .alert {
            border-radius: 8px;
            font-size: 13px;
            padding: 10px 15px;
        }
        .login-footer {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
            color: rgba(255,255,255,0.7);
        }
    </style>
</head>
<body>

<div class="login-wrapper">
    <!-- Logo -->
    <div class="login-logo mb-4 text-center">
        <div style="background:#fff; display:inline-block; padding:15px 25px; border-radius:12px;">
            <div class="logo-line1">VISAKHA</div>
            <div class="logo-line2">DEFENCE ACADEMY</div>
            <div class="logo-line3">Educational Initiatives</div>
        </div>
    </div>

    <!-- Login Card -->
    <div class="login-card">
        <?= $this->renderSection('content') ?>
    </div>

    <div class="login-footer">
        &copy; <?= date('Y') ?> Visakha Defence Academy. All rights reserved.
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // toggle password visibility
    document.getElementById('togglePassword')?.addEventListener('click', function () {
        const pwd = document.getElementById('password');
        const icon = this.querySelector('i');
        if (pwd.type === 'password') {
            pwd.type = 'text';
            icon.classList.replace('fa-eye', 'fa-eye-slash');
        } else {
            pwd.type = 'password';
            icon.classList.replace('fa-eye-slash', 'fa-eye');
        }
    });
</script>
</body>
</html>