<?php
// ── Flash alert partial ── included inside vda-content ──
$success = session()->getFlashdata('success');
$error   = session()->getFlashdata('error');
$errors  = session()->getFlashdata('errors');
$warning = session()->getFlashdata('warning');
$info    = session()->getFlashdata('info');
?>

<?php if ($success): ?>
<div class="vda-alert vda-alert-success alert-dismissible fade show" role="alert">
    <i class="fas fa-check-circle me-2"></i>
    <?= esc($success) ?>
    <button type="button" class="vda-alert-close" data-bs-dismiss="alert">
        <i class="fas fa-times"></i>
    </button>
</div>
<?php endif; ?>

<?php if ($error): ?>
<div class="vda-alert vda-alert-danger alert-dismissible fade show" role="alert">
    <i class="fas fa-exclamation-circle me-2"></i>
    <?= esc($error) ?>
    <button type="button" class="vda-alert-close" data-bs-dismiss="alert">
        <i class="fas fa-times"></i>
    </button>
</div>
<?php endif; ?>

<?php if ($errors && is_array($errors)): ?>
<div class="vda-alert vda-alert-danger alert-dismissible fade show" role="alert">
    <i class="fas fa-exclamation-triangle me-2"></i>
    <strong>Please fix the following errors:</strong>
    <ul class="mb-0 mt-1 ps-3">
        <?php foreach ($errors as $e): ?>
            <li><?= esc($e) ?></li>
        <?php endforeach; ?>
    </ul>
    <button type="button" class="vda-alert-close" data-bs-dismiss="alert">
        <i class="fas fa-times"></i>
    </button>
</div>
<?php endif; ?>

<?php if ($warning): ?>
<div class="vda-alert vda-alert-warning alert-dismissible fade show" role="alert">
    <i class="fas fa-exclamation-triangle me-2"></i>
    <?= esc($warning) ?>
    <button type="button" class="vda-alert-close" data-bs-dismiss="alert">
        <i class="fas fa-times"></i>
    </button>
</div>
<?php endif; ?>

<?php if ($info): ?>
<div class="vda-alert vda-alert-info alert-dismissible fade show" role="alert">
    <i class="fas fa-info-circle me-2"></i>
    <?= esc($info) ?>
    <button type="button" class="vda-alert-close" data-bs-dismiss="alert">
        <i class="fas fa-times"></i>
    </button>
</div>
<?php endif; ?>