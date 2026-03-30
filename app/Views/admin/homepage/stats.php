<?= $this->extend('admin/layouts/main') ?>
<?= $this->section('content') ?>

<div class="page-header">
    <div class="page-header-left">
        <h1><i class="fas fa-chart-bar me-2" style="color:var(--adm-primary);"></i> Manage Stats</h1>
        <p>Manage homepage achievement counters</p>
    </div>
</div>

<?php if (session()->getFlashdata('success')): ?>
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
<?php if (session()->getFlashdata('errors')): ?>
    <div class="vda-alert vda-alert-danger">
        <i class="fas fa-exclamation-circle"></i>
        <ul class="mb-0 ps-3">
            <?php foreach (session()->getFlashdata('errors') as $err): ?>
                <li><?= esc($err) ?></li>
            <?php endforeach; ?>
        </ul>
        <button class="vda-alert-close" onclick="this.parentElement.remove()"><i class="fas fa-times"></i></button>
    </div>
<?php endif; ?>

<div class="row g-4">

    <!-- Add / Edit Form -->
    <div class="col-lg-5">
        <div class="vda-card">
            <div class="vda-card-header">
                <div class="vda-card-title">
                    <i class="fas fa-plus-circle"></i>
                    <span id="formTitle">Add New Stat</span>
                </div>
            </div>
            <div class="vda-card-body">
                <form action="<?= base_url('admin/homepage/stats/store') ?>"
                      method="POST"
                      id="statForm">
                    <?= csrf_field() ?>
                    <input type="hidden" name="id" id="statId" value="">

                    <div class="vda-form-group">
                        <label class="vda-label">
                            Number / Value <span class="req">*</span>
                        </label>
                        <input type="text"
                               name="number"
                               id="statNumber"
                               class="vda-input"
                               placeholder="500+"
                               required>
                        <small class="vda-form-hint">e.g. 500+, 95%, 20+, 10+</small>
                    </div>

                    <div class="vda-form-group">
                        <label class="vda-label">
                            Label <span class="req">*</span>
                        </label>
                        <input type="text"
                               name="label"
                               id="statLabel"
                               class="vda-input"
                               placeholder="Students Selected"
                               required>
                    </div>

                    <div class="vda-form-group">
                        <label class="vda-label">Font Awesome Icon Class</label>
                        <input type="text"
                               name="icon"
                               id="statIcon"
                               class="vda-input"
                               placeholder="fas fa-user-graduate">
                        <small class="vda-form-hint">
                            e.g. fas fa-award, fas fa-chart-line, fas fa-chalkboard-teacher
                        </small>
                        <!-- icon preview -->
                        <div class="mt-2" id="iconPreviewWrap" style="display:none;">
                            <span style="font-size:13px;color:var(--adm-text-muted);">Preview: </span>
                            <i id="iconPreview" style="font-size:20px;color:var(--adm-primary);margin-left:6px;"></i>
                        </div>
                    </div>

                    <div class="vda-form-group">
                        <label class="vda-label">Sort Order</label>
                        <input type="number"
                               name="sort_order"
                               id="statOrder"
                               class="vda-input"
                               value="0">
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn-vda btn-vda-primary">
                            <i class="fas fa-save"></i>
                            <span id="submitText">Add Stat</span>
                        </button>
                        <button type="button"
                                class="btn-vda btn-vda-secondary"
                                onclick="resetStatForm()">
                            <i class="fas fa-undo"></i> Reset
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <!-- Stats List -->
    <div class="col-lg-7">
        <div class="vda-card">
            <div class="vda-card-header">
                <div class="vda-card-title">
                    <i class="fas fa-list"></i> Current Stats
                </div>
                <span class="vda-badge vda-badge-primary"><?= count($stats) ?> items</span>
            </div>
            <div class="vda-card-body" style="padding:0;">
                <?php if (!empty($stats)): ?>
                    <div class="vda-table-wrap">
                        <table class="vda-table">
                            <thead>
                                <tr>
                                    <th width="50">Icon</th>
                                    <th width="80">Number</th>
                                    <th>Label</th>
                                    <th width="60">Order</th>
                                    <th width="90">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($stats as $stat): ?>
                                    <tr>
                                        <td>
                                            <?php if (!empty($stat['icon'])): ?>
                                                <i class="<?= esc($stat['icon']) ?>"
                                                   style="font-size:18px;color:var(--adm-primary);"></i>
                                            <?php else: ?>
                                                <span class="vda-badge vda-badge-gray">—</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <strong style="font-size:16px;color:var(--adm-dark);">
                                                <?= esc($stat['number']) ?>
                                            </strong>
                                        </td>
                                        <td style="font-size:13px;"><?= esc($stat['label']) ?></td>
                                        <td>
                                            <span class="vda-badge vda-badge-gray">
                                                <?= $stat['sort_order'] ?>
                                            </span>
                                        </td>
                                        <td>
                                            <div class="d-flex gap-1">
                                                <button class="btn-vda btn-vda-secondary btn-sm"
                                                        title="Edit"
                                                        onclick='editStat(<?= json_encode($stat) ?>)'>
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <a href="<?= base_url('admin/homepage/stats/delete/' . $stat['id']) ?>"
                                                   class="btn-vda btn-vda-danger btn-sm"
                                                   title="Delete"
                                                   data-confirm-delete="Delete this stat?">
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
                        <i class="fas fa-chart-bar"></i>
                        <h4>No Stats Found</h4>
                        <p>Add your first stat using the form on the left.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

</div>

<?= $this->section('scripts') ?>
<script>
function editStat(stat) {
    document.getElementById('statId').value     = stat.id;
    document.getElementById('statNumber').value = stat.number;
    document.getElementById('statLabel').value  = stat.label;
    document.getElementById('statIcon').value   = stat.icon   ?? '';
    document.getElementById('statOrder').value  = stat.sort_order;
    document.getElementById('submitText').textContent = 'Update Stat';
    document.getElementById('formTitle').textContent  = 'Edit Stat';

    // show icon preview
    updateIconPreview(stat.icon);

    // scroll to form
    document.getElementById('statForm').scrollIntoView({ behavior: 'smooth', block: 'start' });
}

function resetStatForm() {
    document.getElementById('statId').value     = '';
    document.getElementById('statNumber').value = '';
    document.getElementById('statLabel').value  = '';
    document.getElementById('statIcon').value   = '';
    document.getElementById('statOrder').value  = '0';
    document.getElementById('submitText').textContent = 'Add Stat';
    document.getElementById('formTitle').textContent  = 'Add New Stat';
    document.getElementById('iconPreviewWrap').style.display = 'none';
}

function updateIconPreview(iconClass) {
    const wrap    = document.getElementById('iconPreviewWrap');
    const preview = document.getElementById('iconPreview');
    if (iconClass && iconClass.trim()) {
        preview.className = iconClass.trim();
        wrap.style.display = 'block';
    } else {
        wrap.style.display = 'none';
    }
}

// live icon preview on input
document.getElementById('statIcon').addEventListener('input', function() {
    updateIconPreview(this.value);
});
</script>
<?= $this->endSection() ?>

<?= $this->endSection() ?>