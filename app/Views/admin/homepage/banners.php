<?= $this->extend('admin/layouts/main') ?>
<?= $this->section('content') ?>

<div class="page-header">
    <div class="page-header-left">
        <h1><i class="fas fa-images me-2" style="color:var(--adm-primary);"></i> Manage Banners</h1>
        <p>Add, edit, delete and reorder homepage banner slides</p>
    </div>
    <a href="<?= base_url('admin/homepage/banner/add') ?>" class="btn-vda btn-vda-primary">
        <i class="fas fa-plus"></i> Add Banner
    </a>
</div>

<?php
// flash alerts
if (session()->getFlashdata('success')): ?>
    <div class="vda-alert vda-alert-success">
        <i class="fas fa-check-circle"></i>
        <?= session()->getFlashdata('success') ?>
        <button class="vda-alert-close" onclick="this.parentElement.remove()"><i class="fas fa-times"></i></button>
    </div>
<?php endif; ?>
<?php if (session()->getFlashdata('error')): ?>
    <div class="vda-alert vda-alert-danger">
        <i class="fas fa-exclamation-circle"></i>
        <?= session()->getFlashdata('error') ?>
        <button class="vda-alert-close" onclick="this.parentElement.remove()"><i class="fas fa-times"></i></button>
    </div>
<?php endif; ?>

<div class="vda-card">
    <?php if (!empty($banners)): ?>
        <div class="vda-table-wrap">
            <table class="vda-table">
                <thead>
                    <tr>
                        <th width="50">#</th>
                        <th width="110">Image</th>
                        <th>Title</th>
                        <th>Subtitle</th>
                        <th width="130">Button</th>
                        <th width="70">Order</th>
                        <th width="90">Status</th>
                        <th width="110">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($banners as $i => $banner): ?>
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
                        <tr>
                            <td><?= $i + 1 ?></td>
                            <td>
                                <div class="img-preview-box">
                                    <img src="<?= $imgUrl ?>" alt="<?= esc($banner['title']) ?>">
                                </div>
                            </td>
                            <td>
                                <strong style="font-size:13.5px;"><?= esc($banner['title']) ?></strong>
                            </td>
                            <td>
                                <span style="font-size:12.5px;color:var(--adm-text-muted);">
                                    <?= esc(cms_truncate($banner['subtitle'] ?? '', 50)) ?>
                                </span>
                            </td>
                            <td>
                                <?php if (!empty($banner['button_text'])): ?>
                                    <span class="vda-badge vda-badge-info">
                                        <?= esc($banner['button_text']) ?>
                                    </span>
                                <?php else: ?>
                                    <span class="vda-badge vda-badge-gray">No button</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <span class="vda-badge vda-badge-gray"><?= $banner['sort_order'] ?></span>
                            </td>
                            <td>
                                <span class="vda-badge <?= $banner['status'] ? 'vda-badge-success' : 'vda-badge-danger' ?>">
                                    <?= $banner['status'] ? 'Active' : 'Inactive' ?>
                                </span>
                            </td>
                            <td>
                                <div class="d-flex gap-1">
                                    <a href="<?= base_url('admin/homepage/banner/edit/' . $banner['id']) ?>"
                                       class="btn-vda btn-vda-secondary btn-sm" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="<?= base_url('admin/homepage/banner/delete/' . $banner['id']) ?>"
                                       class="btn-vda btn-vda-danger btn-sm"
                                       title="Delete"
                                       data-confirm-delete="Are you sure you want to delete this banner?">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <div class="empty-state">
            <i class="fas fa-images"></i>
            <h4>No Banners Found</h4>
            <p>You haven't added any banners yet.</p>
            <a href="<?= base_url('admin/homepage/banner/add') ?>" class="btn-vda btn-vda-primary">
                <i class="fas fa-plus"></i> Add First Banner
            </a>
        </div>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>