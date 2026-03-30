<?= $this->extend('admin/layouts/main') ?>
<?= $this->section('content') ?>

<div class="page-header">
    <div class="page-header-left">
        <h1>
            <i class="fas fa-building me-2" style="color:var(--adm-primary);"></i>
            Facilities
        </h1>
        <p>Manage all facility cards shown on the facilities page</p>
    </div>
    <a href="<?= base_url('admin/facilities/add') ?>" class="btn-vda btn-vda-primary">
        <i class="fas fa-plus"></i> Add Facility
    </a>
</div>

<?php if (session()->getFlashdata('success')): ?>
    <div class="vda-alert vda-alert-success">
        <i class="fas fa-check-circle"></i>
        <?= session()->getFlashdata('success') ?>
        <button class="vda-alert-close" onclick="this.parentElement.remove()">
            <i class="fas fa-times"></i>
        </button>
    </div>
<?php endif; ?>
<?php if (session()->getFlashdata('error')): ?>
    <div class="vda-alert vda-alert-danger">
        <i class="fas fa-exclamation-circle"></i>
        <?= session()->getFlashdata('error') ?>
        <button class="vda-alert-close" onclick="this.parentElement.remove()">
            <i class="fas fa-times"></i>
        </button>
    </div>
<?php endif; ?>

<div class="vda-card">
    <?php if (!empty($facilities)): ?>
        <div class="vda-table-wrap">
            <table class="vda-table">
                <thead>
                    <tr>
                        <th width="50">#</th>
                        <th width="60">Icon</th>
                        <th>Title</th>
                        <th width="60">Badge Icon</th>
                        <th>Badge</th>
                        <th>Features</th>
                        <th width="70">Order</th>
                        <th width="90">Status</th>
                        <th width="110">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($facilities as $i => $facility): ?>
                        <?php
                        $features = cms_json_decode($facility['features']);
                        ?>
                        <tr>
                            <td><?= $i + 1 ?></td>

                            <!-- Card Icon -->
                            <td>
                                <div style="width:38px;height:38px;border-radius:8px;
                                            background:var(--adm-primary-lt);
                                            display:flex;align-items:center;
                                            justify-content:center;">
                                    <i class="<?= esc($facility['icon']) ?>"
                                        style="color:var(--adm-primary);font-size:16px;"></i>
                                </div>
                            </td>

                            <!-- Title -->
                            <td>
                                <strong style="font-size:13.5px;">
                                    <?= esc($facility['title']) ?>
                                </strong>
                            </td>

                            <!-- Badge Icon -->
                            <td>
                                <i class="<?= esc($facility['badge_icon'] ?? '') ?>"
                                    style="color:var(--adm-accent);font-size:16px;"
                                    title="<?= esc($facility['badge_icon'] ?? '') ?>"></i>
                            </td>

                            <!-- Badge Text -->
                            <td>
                                <span class="vda-badge vda-badge-info">
                                    <i class="<?= esc($facility['badge_icon'] ?? '') ?> me-1"></i>
                                    <?= esc($facility['badge']) ?>
                                </span>
                            </td>

                            <!-- Features -->
                            <td>
                                <?php if (!empty($features)): ?>
                                    <div style="display:flex;flex-direction:column;gap:3px;">
                                        <?php foreach ($features as $feature): ?>
                                            <div style="font-size:12px;color:var(--adm-text);">
                                                <i class="<?= esc($feature['icon'] ?? '') ?>"
                                                    style="color:var(--adm-primary);
                                                          width:14px;text-align:center;
                                                          margin-right:5px;"></i>
                                                <?= esc($feature['text'] ?? '') ?>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                <?php else: ?>
                                    <span class="vda-badge vda-badge-gray">No features</span>
                                <?php endif; ?>
                            </td>

                            <!-- Sort Order -->
                            <td>
                                <span class="vda-badge vda-badge-gray">
                                    <?= $facility['sort_order'] ?>
                                </span>
                            </td>

                            <!-- Status -->
                            <td>
                                <span class="vda-badge <?= $facility['status'] ? 'vda-badge-success' : 'vda-badge-danger' ?>">
                                    <?= $facility['status'] ? 'Active' : 'Inactive' ?>
                                </span>
                            </td>

                            <!-- Actions -->
                            <td>
                                <div class="d-flex gap-1">
                                    <a href="<?= base_url('admin/facilities/edit/' . $facility['id']) ?>"
                                        class="btn-vda btn-vda-secondary btn-sm"
                                        title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="<?= base_url('admin/facilities/delete/' . $facility['id']) ?>"
                                        class="btn-vda btn-vda-danger btn-sm"
                                        title="Delete"
                                        data-confirm-delete="Delete this facility?">
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
            <i class="fas fa-building"></i>
            <h4>No Facilities Found</h4>
            <p>You haven't added any facilities yet.</p>
            <a href="<?= base_url('admin/facilities/add') ?>"
                class="btn-vda btn-vda-primary">
                <i class="fas fa-plus"></i> Add First Facility
            </a>
        </div>
    <?php endif; ?>
</div>

<!-- ============================================================
     HIGHLIGHTS SECTION
============================================================ -->
<!-- HIGHLIGHTS SECTION -->
<div class="vda-card mt-4" id="highlights">
    <div class="vda-card-header">
        <div class="vda-card-title">
            <i class="fas fa-star"></i> Facility Highlights
        </div>
        <a href="<?= base_url('admin/facilities/highlight/add') ?>"
            class="btn-vda btn-vda-outline btn-sm">
            <i class="fas fa-plus"></i> Add Highlight
        </a>
    </div>
    <div class="vda-card-body">
        <div class="row g-4">
            <?php foreach ($highlights as $num => $hl): ?>
                <div class="col-md-6">
                    <div class="vda-card" style="border:1px solid var(--adm-border);">
                        <div class="vda-card-header" style="padding:10px 14px;">
                            <div class="vda-card-title" style="font-size:13px;">
                                <i class="<?= esc($hl['icon']) ?>"
                                    style="color:var(--adm-primary);margin-right:6px;"></i>
                                Highlight <?= $num ?>
                            </div>
                            <?php if ($num > 2): ?>
                                <a href="<?= base_url('admin/facilities/highlight/delete/' . $num) ?>"
                                    class="btn-vda btn-vda-danger btn-sm"
                                    data-confirm-delete="Remove this highlight?">
                                    <i class="fas fa-trash"></i>
                                </a>
                            <?php endif; ?>
                        </div>
                        <div class="vda-card-body" style="padding:14px;">
                            <form action="<?= base_url('admin/facilities/highlight/update') ?>"
                                method="POST">
                                <?= csrf_field() ?>
                                <input type="hidden" name="highlight_num" value="<?= $num ?>">

                                <div class="vda-form-group">
                                    <label class="vda-label">Icon Class</label>
                                    <div class="d-flex gap-2 align-items-center">
                                        <i id="hlIcon<?= $num ?>"
                                            class="<?= esc($hl['icon']) ?>"
                                            style="color:var(--adm-primary);font-size:20px;
                                                  width:24px;text-align:center;flex-shrink:0;"></i>
                                        <input type="text"
                                            name="icon"
                                            class="vda-input"
                                            value="<?= esc($hl['icon']) ?>"
                                            placeholder="fas fa-person-booth"
                                            oninput="document.getElementById('hlIcon<?= $num ?>').className = this.value">
                                    </div>
                                    <small class="vda-form-hint">
                                        e.g. fas fa-person-booth, fas fa-bowl-food
                                    </small>
                                </div>

                                <div class="vda-form-group">
                                    <label class="vda-label">Heading</label>
                                    <input type="text"
                                        name="heading"
                                        class="vda-input"
                                        value="<?= esc($hl['heading']) ?>"
                                        placeholder="Separate hostels for boys & girls">
                                </div>

                                <div class="vda-form-group">
                                    <label class="vda-label">Description</label>
                                    <textarea name="description"
                                        class="vda-textarea"
                                        rows="3"><?= esc($hl['description']) ?></textarea>
                                </div>

                                <button type="submit"
                                    class="btn-vda btn-vda-primary btn-sm w-100">
                                    <i class="fas fa-save"></i> Save Highlight <?= $num ?>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<?= $this->endSection() ?>