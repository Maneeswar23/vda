<?= $this->extend('admin/layouts/auth') ?>
<?= $this->section('content') ?>

<div class="login-title">
    <i class="fas fa-shield-alt me-2" style="color:#134b9a;"></i> Admin Panel 
</div>

<!-- Flash Messages -->
<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger">
        <i class="fas fa-exclamation-circle me-2"></i>
        <?= session()->getFlashdata('error') ?>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success">
        <i class="fas fa-check-circle me-2"></i>
        <?= session()->getFlashdata('success') ?>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('errors')): ?>
    <div class="alert alert-danger">
        <ul class="mb-0 ps-3">
            <?php foreach (session()->getFlashdata('errors') as $error): ?>
                <li><?= esc($error) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<!-- Login Form -->
<form action="<?= base_url('admin/login') ?>" method="POST">
    <?= csrf_field() ?>

    <div class="mb-3">
        <label for="email" class="form-label">
            <i class="fas fa-envelope me-1"></i> Email Address
        </label>
        <input
            type="email"
            class="form-control"
            id="email"
            name="email"
            value="<?= old('email') ?>"
            placeholder="admin@vda.com"
            required
            autofocus
        >
    </div>

    <div class="mb-4">
        <label for="password" class="form-label">
            <i class="fas fa-lock me-1"></i> Password
        </label>
        <div class="input-group">
            <input
                type="password"
                class="form-control"
                id="password"
                name="password"
                placeholder="Enter your password"
                required
            >
            <span class="input-group-text" id="togglePassword">
                <i class="fas fa-eye"></i>
            </span>
        </div>
    </div>

    <button type="submit" class="btn-login">
        <i class="fas fa-sign-in-alt me-2"></i> Login to Admin Panel
    </button>
</form>

<?= $this->endSection() ?>