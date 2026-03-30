<?= $this->extend('admin/layouts/main') ?>
<?= $this->section('content') ?>

<?php
$isEdit   = !empty($facility);
$features = $isEdit ? ($facility['features'] ?? []) : [
    ['icon' => '', 'text' => ''],
    ['icon' => '', 'text' => ''],
    ['icon' => '', 'text' => ''],
];
// ensure 3 features always
while (count($features) < 3) {
    $features[] = ['icon' => '', 'text' => ''];
}
?>

<div class="page-header">
    <div class="page-header-left">
        <h1>
            <i class="fas fa-<?= $isEdit ? 'edit' : 'plus-circle' ?> me-2"
               style="color:var(--adm-primary);"></i>
            <?= $isEdit ? 'Edit Facility' : 'Add New Facility' ?>
        </h1>
        <p>
            <?= $isEdit
                ? 'Update the facility card details below'
                : 'Fill in all 10 fields to add a new facility card' ?>
        </p>
    </div>
    <a href="<?= base_url('admin/facilities') ?>"
       class="btn-vda btn-vda-secondary">
        <i class="fas fa-arrow-left"></i> Back
    </a>
</div>

<?php if (session()->getFlashdata('errors')): ?>
    <div class="vda-alert vda-alert-danger">
        <i class="fas fa-exclamation-circle"></i>
        <ul class="mb-0 ps-3">
            <?php foreach (session()->getFlashdata('errors') as $err): ?>
                <li><?= esc($err) ?></li>
            <?php endforeach; ?>
        </ul>
        <button class="vda-alert-close" onclick="this.parentElement.remove()">
            <i class="fas fa-times"></i>
        </button>
    </div>
<?php endif; ?>

<form action="<?= $isEdit
        ? base_url('admin/facilities/update/' . $facility['id'])
        : base_url('admin/facilities/store') ?>"
      method="POST">
    <?= csrf_field() ?>

    <div class="row g-4">

        <!-- LEFT: Main Details -->
        <div class="col-lg-6">

            <!-- ── CARD ICON + TITLE ── -->
            <div class="vda-card mb-4">
                <div class="vda-card-header">
                    <div class="vda-card-title">
                        <i class="fas fa-star"></i>
                        Card Icon & Title
                    </div>
                </div>
                <div class="vda-card-body">

                    <!-- Input 1: Card Icon -->
                    <div class="vda-form-group">
                        <label class="vda-label">
                            1. Card Icon Class
                            <span class="req">*</span>
                        </label>
                        <div class="d-flex gap-2 align-items-center">
                            <div id="cardIconPreview"
                                 style="width:42px;height:42px;border-radius:8px;
                                        background:var(--adm-primary-lt);
                                        display:flex;align-items:center;
                                        justify-content:center;flex-shrink:0;">
                                <i id="cardIconEl"
                                   class="<?= esc(old('icon', $facility['icon'] ?? 'fas fa-building')) ?>"
                                   style="color:var(--adm-primary);font-size:18px;"></i>
                            </div>
                            <input type="text"
                                   name="icon"
                                   id="iconInput"
                                   class="vda-input"
                                   value="<?= esc(old('icon', $facility['icon'] ?? '')) ?>"
                                   placeholder="fas fa-venus-mars"
                                   required
                                   oninput="updateIconPreview(this.value,'cardIconEl')">
                        </div>
                        <small class="vda-form-hint">
                            e.g. fas fa-venus-mars, fas fa-dumbbell, fas fa-utensils
                        </small>
                    </div>

                    <!-- Input 2: Title -->
                    <div class="vda-form-group">
                        <label class="vda-label">
                            2. Facility Title
                            <span class="req">*</span>
                        </label>
                        <input type="text"
                               name="title"
                               class="vda-input"
                               value="<?= esc(old('title', $facility['title'] ?? '')) ?>"
                               placeholder="BOYS HOSTEL"
                               required>
                    </div>

                </div>
            </div>

            <!-- ── BADGE ── -->
            <div class="vda-card mb-4">
                <div class="vda-card-header">
                    <div class="vda-card-title">
                        <i class="fas fa-tag"></i>
                        Badge
                    </div>
                    <!-- Live preview -->
                    <span class="vda-badge vda-badge-info" id="badgePreview">
                        <i id="badgeIconEl"
                           class="<?= esc(old('badge_icon', $facility['badge_icon'] ?? 'fas fa-tag')) ?> me-1"></i>
                        <span id="badgeTextEl">
                            <?= esc(old('badge', $facility['badge'] ?? 'Badge text')) ?>
                        </span>
                    </span>
                </div>
                <div class="vda-card-body">

                    <!-- Input 3: Badge Icon -->
                    <div class="vda-form-group">
                        <label class="vda-label">
                            3. Badge Icon Class
                            <span class="req">*</span>
                        </label>
                        <div class="d-flex gap-2 align-items-center">
                            <i id="badgeIconPreview"
                               class="<?= esc(old('badge_icon', $facility['badge_icon'] ?? 'fas fa-tag')) ?>"
                               style="color:var(--adm-accent);font-size:20px;width:24px;
                                      text-align:center;flex-shrink:0;"></i>
                            <input type="text"
                                   name="badge_icon"
                                   class="vda-input"
                                   value="<?= esc(old('badge_icon', $facility['badge_icon'] ?? '')) ?>"
                                   placeholder="fas fa-bed"
                                   required
                                   oninput="updateIconPreview(this.value,'badgeIconPreview');
                                            updateIconPreview(this.value,'badgeIconEl')">
                        </div>
                        <small class="vda-form-hint">
                            e.g. fas fa-bed, fas fa-lock, fas fa-heartbeat
                        </small>
                    </div>

                    <!-- Input 4: Badge Text -->
                    <div class="vda-form-group">
                        <label class="vda-label">
                            4. Badge Text
                            <span class="req">*</span>
                        </label>
                        <input type="text"
                               name="badge"
                               class="vda-input"
                               value="<?= esc(old('badge', $facility['badge'] ?? '')) ?>"
                               placeholder="200+ capacity"
                               required
                               oninput="document.getElementById('badgeTextEl').textContent = this.value">
                    </div>

                </div>
            </div>

            <!-- ── SORT + STATUS ── -->
            <div class="vda-card">
                <div class="vda-card-header">
                    <div class="vda-card-title">
                        <i class="fas fa-cog"></i> Settings
                    </div>
                </div>
                <div class="vda-card-body">
                    <div class="row g-3">
                        <div class="col-6">
                            <label class="vda-label">Sort Order</label>
                            <input type="number"
                                   name="sort_order"
                                   class="vda-input"
                                   value="<?= esc(old('sort_order', $facility['sort_order'] ?? 0)) ?>">
                        </div>
                        <div class="col-6">
                            <label class="vda-label">Status</label>
                            <select name="status" class="vda-select">
                                <option value="1" <?= (old('status', $facility['status'] ?? 1) == 1) ? 'selected' : '' ?>>
                                    Active
                                </option>
                                <option value="0" <?= (old('status', $facility['status'] ?? 1) == 0) ? 'selected' : '' ?>>
                                    Inactive
                                </option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- RIGHT: Features -->
        <div class="col-lg-6">
            <div class="vda-card">
                <div class="vda-card-header">
                    <div class="vda-card-title">
                        <i class="fas fa-list-ul"></i>
                        3 Feature Points
                    </div>
                    <!-- Live preview -->
                    <div id="featurePreviewWrap"
                         style="display:flex;flex-direction:column;gap:4px;">
                        <?php foreach ($features as $fi => $feat): ?>
                            <div id="featurePreview<?= $fi ?>"
                                 style="font-size:12px;color:var(--adm-text);
                                        display:flex;align-items:center;gap:6px;">
                                <i id="fIcon<?= $fi ?>"
                                   class="<?= esc($feat['icon'] ?? 'fas fa-circle') ?>"
                                   style="color:var(--adm-primary);width:14px;
                                          text-align:center;font-size:11px;"></i>
                                <span id="fText<?= $fi ?>">
                                    <?= esc($feat['text'] ?? 'Feature ' . ($fi + 1)) ?>
                                </span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="vda-card-body">

                    <?php
                    $featureLabels = [
                        1 => ['num' => 5, 'iconNum' => 5, 'textNum' => 6],
                        2 => ['num' => 7, 'iconNum' => 7, 'textNum' => 8],
                        3 => ['num' => 9, 'iconNum' => 9, 'textNum' => 10],
                    ];
                    ?>

                    <?php for ($fi = 0; $fi < 3; $fi++):
                        $label    = $featureLabels[$fi + 1];
                        $curFeat  = $features[$fi] ?? ['icon' => '', 'text' => ''];
                    ?>
                        <div class="vda-card mb-3"
                             style="border:1px solid var(--adm-border);">
                            <div class="vda-card-header"
                                 style="padding:10px 14px;">
                                <div class="vda-card-title"
                                     style="font-size:13px;">
                                    <span class="vda-badge vda-badge-primary"
                                          style="margin-right:6px;">
                                        <?= $label['iconNum'] ?>–<?= $label['textNum'] ?>
                                    </span>
                                    Feature <?= $fi + 1 ?>
                                </div>
                                <!-- mini preview -->
                                <div style="font-size:12px;color:var(--adm-text-muted);">
                                    <i id="fPrevIcon<?= $fi ?>"
                                       class="<?= esc($curFeat['icon'] ?? 'fas fa-circle') ?>"
                                       style="color:var(--adm-primary);margin-right:4px;"></i>
                                    <span id="fPrevText<?= $fi ?>">
                                        <?= esc($curFeat['text'] ?? '') ?>
                                    </span>
                                </div>
                            </div>
                            <div class="vda-card-body"
                                 style="padding:14px;">

                                <!-- Feature Icon -->
                                <div class="vda-form-group">
                                    <label class="vda-label">
                                        <?= $label['iconNum'] ?>. Feature <?= $fi + 1 ?> Icon
                                    </label>
                                    <div class="d-flex gap-2 align-items-center">
                                        <i id="fIcon<?= $fi ?>"
                                           class="<?= esc($curFeat['icon'] ?? 'fas fa-circle') ?>"
                                           style="color:var(--adm-primary);font-size:18px;
                                                  width:22px;text-align:center;
                                                  flex-shrink:0;"></i>
                                        <input type="text"
                                               name="feature_icon[]"
                                               class="vda-input"
                                               value="<?= esc(old("feature_icon.{$fi}", $curFeat['icon'] ?? '')) ?>"
                                               placeholder="fas fa-wifi"
                                               oninput="updateIconPreview(this.value,'fIcon<?= $fi ?>');
                                                        updateIconPreview(this.value,'fPrevIcon<?= $fi ?>')">
                                    </div>
                                    <small class="vda-form-hint">
                                        Font Awesome icon class
                                    </small>
                                </div>

                                <!-- Feature Text -->
                                <div class="vda-form-group mb-0">
                                    <label class="vda-label">
                                        <?= $label['textNum'] ?>. Feature <?= $fi + 1 ?> Text
                                    </label>
                                    <input type="text"
                                           name="feature_text[]"
                                           class="vda-input"
                                           value="<?= esc(old("feature_text.{$fi}", $curFeat['text'] ?? '')) ?>"
                                           placeholder="<?= ['24/7 Wi-Fi & study halls', 'CCTV & wardens', 'Hot/cold water'][$fi] ?>"
                                           oninput="document.getElementById('fPrevText<?= $fi ?>').textContent = this.value;
                                                    document.getElementById('fText<?= $fi ?>').textContent = this.value">
                                </div>

                            </div>
                        </div>
                    <?php endfor; ?>

                </div>
            </div>
        </div>

    </div>

    <!-- Form Actions -->
    <div class="d-flex gap-2 mt-4 pt-3"
         style="border-top:1px solid var(--adm-border);">
        <button type="submit" class="btn-vda btn-vda-primary">
            <i class="fas fa-save"></i>
            <?= $isEdit ? 'Update Facility' : 'Save Facility' ?>
        </button>
        <a href="<?= base_url('admin/facilities') ?>"
           class="btn-vda btn-vda-secondary">
            <i class="fas fa-times"></i> Cancel
        </a>
    </div>

</form>

<!-- Live Preview Card -->
<div class="vda-card mt-4">
    <div class="vda-card-header">
        <div class="vda-card-title">
            <i class="fas fa-eye"></i> Live Card Preview
        </div>
    </div>
    <div class="vda-card-body">
        <div style="background:#f8fafc;border-radius:12px;padding:24px;
                    max-width:280px;border:1px solid var(--adm-border);">

            <!-- Card Icon -->
            <div style="width:56px;height:56px;border-radius:12px;
                        background:var(--adm-primary-lt);
                        display:flex;align-items:center;
                        justify-content:center;margin-bottom:12px;">
                <i id="previewCardIcon"
                   class="<?= esc($facility['icon'] ?? 'fas fa-building') ?>"
                   style="color:var(--adm-primary);font-size:24px;"></i>
            </div>

            <!-- Title -->
            <h5 id="previewTitle"
                style="font-weight:700;color:#1a1a2e;margin-bottom:8px;">
                <?= esc($facility['title'] ?? 'FACILITY TITLE') ?>
            </h5>

            <!-- Badge -->
            <span class="vda-badge vda-badge-info mb-3 d-inline-flex"
                  style="margin-bottom:12px;">
                <i id="previewBadgeIcon"
                   class="<?= esc($facility['badge_icon'] ?? 'fas fa-tag') ?> me-1"></i>
                <span id="previewBadgeText">
                    <?= esc($facility['badge'] ?? 'Badge') ?>
                </span>
            </span>

            <!-- Features -->
            <ul style="list-style:none;padding:0;margin:0;margin-top:8px;">
                <?php for ($fi = 0; $fi < 3; $fi++):
                    $f = $features[$fi] ?? ['icon' => '', 'text' => ''];
                ?>
                    <li id="previewFeature<?= $fi ?>"
                        style="display:flex;align-items:center;gap:8px;
                               font-size:13px;color:#334155;margin-bottom:6px;">
                        <i id="previewFIcon<?= $fi ?>"
                           class="<?= esc($f['icon'] ?? 'fas fa-circle') ?>"
                           style="color:var(--adm-primary);width:14px;
                                  text-align:center;font-size:12px;"></i>
                        <span id="previewFText<?= $fi ?>">
                            <?= esc($f['text'] ?? 'Feature ' . ($fi + 1)) ?>
                        </span>
                    </li>
                <?php endfor; ?>
            </ul>
        </div>
    </div>
</div>

<?= $this->section('scripts') ?>
<script>
// Update any icon element by id
function updateIconPreview(iconClass, elId) {
    const el = document.getElementById(elId);
    if (el && iconClass.trim()) {
        el.className = iconClass.trim();
    }
}

// Sync all preview elements on input
document.addEventListener('DOMContentLoaded', function () {

    // Card icon → main preview
    document.querySelector('input[name="icon"]')?.addEventListener('input', function () {
        updateIconPreview(this.value, 'previewCardIcon');
    });

    // Title → preview
    document.querySelector('input[name="title"]')?.addEventListener('input', function () {
        const el = document.getElementById('previewTitle');
        if (el) el.textContent = this.value || 'FACILITY TITLE';
    });

    // Badge icon → preview
    document.querySelector('input[name="badge_icon"]')?.addEventListener('input', function () {
        updateIconPreview(this.value, 'previewBadgeIcon');
    });

    // Badge text → preview
    document.querySelector('input[name="badge"]')?.addEventListener('input', function () {
        const el = document.getElementById('previewBadgeText');
        if (el) el.textContent = this.value || 'Badge';
    });

    // Feature icons & texts → preview
    document.querySelectorAll('input[name="feature_icon[]"]').forEach(function (input, idx) {
        input.addEventListener('input', function () {
            updateIconPreview(this.value, 'previewFIcon' + idx);
        });
    });

    document.querySelectorAll('input[name="feature_text[]"]').forEach(function (input, idx) {
        input.addEventListener('input', function () {
            const el = document.getElementById('previewFText' + idx);
            if (el) el.textContent = this.value || 'Feature ' + (idx + 1);
        });
    });

});
</script>
<?= $this->endSection() ?>

<?= $this->endSection() ?>