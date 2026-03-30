<?= $this->extend('admin/layouts/main') ?>
<?= $this->section('content') ?>

<div class="page-header">
    <div class="page-header-left">
        <h1><i class="fas fa-home me-2" style="color:var(--adm-primary);"></i> Homepage Management</h1>
        <p>Manage all homepage sections from here</p>
    </div>
</div>

<div class="row g-4">

    <!-- Banners Card -->
    <div class="col-md-4">
        <div class="vda-card h-100">
            <div class="vda-card-body">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="stat-icon" style="background:rgba(19,75,154,0.1);">
                        <i class="fas fa-images" style="color:var(--adm-primary);"></i>
                    </div>
                    <div>
                        <h5 class="mb-0 fw-700" style="color:var(--adm-dark);">Banner Slides</h5>
                        <small class="text-muted">Homepage slider</small>
                    </div>
                </div>
                <p style="font-size:13px;color:var(--adm-text-muted);">
                    Manage homepage banner slides, images, titles and call-to-action buttons.
                </p>
                <div class="d-flex gap-2 mb-3">
                    <span class="vda-badge vda-badge-primary">
                        <i class="fas fa-layer-group"></i> <?= count($banners) ?> Total
                    </span>
                    <span class="vda-badge vda-badge-success">
                        <i class="fas fa-check"></i> <?= count(array_filter($banners, fn($b) => $b['status'] == 1)) ?> Active
                    </span>
                </div>
                <div class="d-flex gap-2">
                    <a href="<?= base_url('admin/homepage/banners') ?>" class="btn-vda btn-vda-primary btn-sm">
                        <i class="fas fa-list"></i> Manage
                    </a>
                    <a href="<?= base_url('admin/homepage/banner/add') ?>" class="btn-vda btn-vda-outline btn-sm">
                        <i class="fas fa-plus"></i> Add
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Card -->
    <div class="col-md-4">
        <div class="vda-card h-100">
            <div class="vda-card-body">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="stat-icon" style="background:rgba(0,165,78,0.1);">
                        <i class="fas fa-chart-bar" style="color:var(--adm-accent);"></i>
                    </div>
                    <div>
                        <h5 class="mb-0" style="color:var(--adm-dark);">Stats / Counters</h5>
                        <small class="text-muted">Achievement numbers</small>
                    </div>
                </div>
                <p style="font-size:13px;color:var(--adm-text-muted);">
                    Manage homepage achievement counters like students selected, success rate, years of experience.
                </p>
                <div class="d-flex gap-2 mb-3">
                    <span class="vda-badge vda-badge-primary">
                        <i class="fas fa-layer-group"></i> <?= count($stats) ?> Stats
                    </span>
                </div>
                <div class="d-flex gap-2">
                    <a href="<?= base_url('admin/homepage/stats') ?>" class="btn-vda btn-vda-primary btn-sm">
                        <i class="fas fa-list"></i> Manage
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- About Section Card -->
    <div class="col-md-4">
        <div class="vda-card h-100">
            <div class="vda-card-body">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="stat-icon" style="background:rgba(241,90,36,0.1);">
                        <i class="fas fa-info-circle" style="color:var(--adm-cta);"></i>
                    </div>
                    <div>
                        <h5 class="mb-0" style="color:var(--adm-dark);">About Section</h5>
                        <small class="text-muted">Homepage about block</small>
                    </div>
                </div>
                <p style="font-size:13px;color:var(--adm-text-muted);">
                    Edit the about us section displayed on the homepage with image, heading and description.
                </p>
                <div class="d-flex gap-2 mb-3">
                    <?php if (!empty($about['image'])): ?>
                        <span class="vda-badge vda-badge-success"><i class="fas fa-image"></i> Image set</span>
                    <?php else: ?>
                        <span class="vda-badge vda-badge-warning"><i class="fas fa-exclamation"></i> No image</span>
                    <?php endif; ?>
                </div>
                <div class="d-flex gap-2">
                    <a href="<?= base_url('admin/homepage/about') ?>" class="btn-vda btn-vda-primary btn-sm">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Banner Quick Preview -->
<?php if (!empty($banners)): ?>
<div class="vda-card mt-4">
    <div class="vda-card-header">
        <div class="vda-card-title">
            <i class="fas fa-eye"></i> Banner Quick Preview
        </div>
        <a href="<?= base_url('admin/homepage/banners') ?>" class="btn-vda btn-vda-secondary btn-sm">
            <i class="fas fa-list"></i> View All
        </a>
    </div>
    <div class="vda-card-body">
        <div class="row g-3">
            <?php foreach ($banners as $banner): ?>
                <?php
                if (!empty($banner['image'])) {
                    if (file_exists(FCPATH . 'public/uploads/banners/' . $banner['image'])) {
                        $imgUrl = base_url('public/uploads/banners/' . $banner['image']);
                    } elseif (file_exists(FCPATH . 'public/assets/images/' . $banner['image'])) {
                        $imgUrl = base_url('public/assets/images/' . $banner['image']);
                    } else {
                        $imgUrl = base_url('public/assets/images/placeholder.jpg');
                    }
                } else {
                    $imgUrl = base_url('public/assets/images/placeholder.jpg');
                }
                ?>
                <div class="col-md-4">
                    <div class="position-relative rounded overflow-hidden" style="height:140px;">
                        <img src="<?= $imgUrl ?>"
                             alt="<?= esc($banner['title']) ?>"
                             class="w-100 h-100"
                             style="object-fit:cover;">
                        <div class="position-absolute bottom-0 start-0 end-0 p-2"
                             style="background:rgba(0,0,0,0.55);">
                            <small class="text-white fw-bold d-block"
                                   style="font-size:11px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">
                                <?= esc($banner['title']) ?>
                            </small>
                            <?php if (!empty($banner['subtitle'])): ?>
                                <small class="text-white-50" style="font-size:10px;">
                                    <?= esc(cms_truncate($banner['subtitle'], 40)) ?>
                                </small>
                            <?php endif; ?>
                        </div>
                        <span class="position-absolute top-0 end-0 m-1 vda-badge <?= $banner['status'] ? 'vda-badge-success' : 'vda-badge-gray' ?>">
                            <?= $banner['status'] ? 'Active' : 'Inactive' ?>
                        </span>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<?php endif; ?>

<?= $this->endSection() ?>
