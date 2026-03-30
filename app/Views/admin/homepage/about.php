<?= $this->extend('admin/layouts/main') ?>
<?= $this->section('content') ?>

<div class="page-header">
    <div class="page-header-left">
        <h1><i class="fas fa-info-circle me-2" style="color:var(--adm-primary);"></i> Homepage About Section</h1>
        <p>Edit the about us block displayed on the homepage</p>
    </div>
    <a href="<?= base_url('admin/homepage') ?>" class="btn-vda btn-vda-secondary">
        <i class="fas fa-arrow-left"></i> Back
    </a>
</div>

<?php if (session()->getFlashdata('success')): ?>
    <div class="vda-alert vda-alert-success">
        <i class="fas fa-check-circle"></i>
        <?= session()->getFlashdata('success') ?>
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

    <!-- Form -->
    <div class="col-lg-8">
        <div class="vda-card">
            <div class="vda-card-header">
                <div class="vda-card-title">
                    <i class="fas fa-edit"></i> Edit About Section
                </div>
            </div>
            <div class="vda-card-body">
                <form action="<?= base_url('admin/homepage/about/update') ?>"
                      method="POST"
                      enctype="multipart/form-data">
                    <?= csrf_field() ?>

                    <!-- Heading -->
                    <div class="vda-form-group">
                        <label class="vda-label">
                            Heading <span class="req">*</span>
                        </label>
                        <input type="text"
                               name="heading"
                               class="vda-input"
                               value="<?= old('heading', $about['heading'] ?? '') ?>"
                               placeholder="About Visakha Defence Academy"
                               required>
                    </div>

                    <!-- Subheading -->
                    <div class="vda-form-group">
                        <label class="vda-label">Subheading</label>
                        <input type="text"
                               name="subheading"
                               class="vda-input"
                               value="<?= old('subheading', $about['subheading'] ?? '') ?>"
                               placeholder="Premier Defence Coaching Institute Since 2002">
                    </div>

                    <!-- Description -->
                    <div class="vda-form-group">
                        <label class="vda-label">
                            Description <span class="req">*</span>
                        </label>
                        <textarea name="description"
                                  class="vda-textarea"
                                  rows="7"
                                  placeholder="Enter about section description..."
                                  required><?= old('description', $about['description'] ?? '') ?></textarea>
                    </div>

                    <!-- Image Upload -->
                    <div class="vda-form-group">
                        <label class="vda-label">Section Image</label>

                        <?php if (!empty($about['image'])): ?>
                            <?php
                            if (file_exists(FCPATH . 'public/uploads/about/' . $about['image'])) {
                                $imgUrl = base_url('public/uploads/about/' . $about['image']);
                            } elseif (file_exists(FCPATH . 'public/assets/images/' . $about['image'])) {
                                $imgUrl = base_url('public/assets/images/' . $about['image']);
                            } else {
                                $imgUrl = base_url('public/assets/images/placeholder.jpg');
                            }
                            ?>
                            <div class="mb-3">
                                <p class="vda-form-hint mb-1">Current image:</p>
                                <div class="img-preview-lg">
                                    <img src="<?= $imgUrl ?>"
                                         alt="About Image"
                                         style="max-height:180px;object-fit:cover;width:100%;">
                                </div>
                                <small class="vda-form-hint mt-1 d-block">
                                    Upload a new image to replace the current one.
                                </small>
                            </div>
                        <?php endif; ?>

                        <div class="upload-area" onclick="document.getElementById('aboutImage').click()">
                            <i class="fas fa-cloud-upload-alt"></i>
                            <p>Click to upload section image</p>
                            <small>JPG, PNG, WEBP — Max 5MB</small>
                        </div>
                        <input type="file"
                               id="aboutImage"
                               name="image"
                               accept="image/*"
                               style="display:none;"
                               onchange="previewAboutImage(this)">

                        <div id="aboutImagePreview" class="mt-2" style="display:none;">
                            <p class="vda-form-hint mb-1">New image preview:</p>
                            <div class="img-preview-lg">
                                <img id="aboutPreviewImg" src="" alt="Preview">
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="d-flex gap-2 pt-3" style="border-top:1px solid var(--adm-border);">
                        <button type="submit" class="btn-vda btn-vda-primary">
                            <i class="fas fa-save"></i> Save About Section
                        </button>
                        <a href="<?= base_url('admin/homepage') ?>" class="btn-vda btn-vda-secondary">
                            <i class="fas fa-times"></i> Cancel
                        </a>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <!-- Current Preview -->
    <div class="col-lg-4">
        <div class="vda-card">
            <div class="vda-card-header">
                <div class="vda-card-title">
                    <i class="fas fa-eye"></i> Current Preview
                </div>
            </div>
            <div class="vda-card-body">
                <?php if (!empty($about)): ?>
                    <?php if (!empty($about['image'])): ?>
                        <?php
                        if (file_exists(FCPATH . 'public/uploads/about/' . $about['image'])) {
                            $imgUrl = base_url('public/uploads/about/' . $about['image']);
                        } elseif (file_exists(FCPATH . 'public/assets/images/' . $about['image'])) {
                            $imgUrl = base_url('public/assets/images/' . $about['image']);
                        } else {
                            $imgUrl = base_url('public/assets/images/placeholder.jpg');
                        }
                        ?>
                        <img src="<?= $imgUrl ?>"
                             alt="About"
                             class="w-100 rounded mb-3"
                             style="height:160px;object-fit:cover;">
                    <?php endif; ?>

                    <h6 style="color:var(--adm-primary);font-weight:700;">
                        <?= esc($about['heading'] ?? '—') ?>
                    </h6>
                    <?php if (!empty($about['subheading'])): ?>
                        <p style="font-size:12px;color:var(--adm-text-muted);margin-bottom:8px;">
                            <?= esc($about['subheading']) ?>
                        </p>
                    <?php endif; ?>
                    <p style="font-size:12.5px;color:var(--adm-text);line-height:1.7;">
                        <?= esc(cms_truncate($about['description'] ?? '', 200)) ?>
                    </p>

                    <?php if (!empty($about['updated_at'])): ?>
                        <small class="vda-form-hint">
                            <i class="fas fa-clock me-1"></i>
                            Last updated: <?= cms_date($about['updated_at']) ?>
                        </small>
                    <?php endif; ?>
                <?php else: ?>
                    <div class="empty-state" style="padding:30px 10px;">
                        <i class="fas fa-info-circle"></i>
                        <p>No content saved yet.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

</div>

<?= $this->section('scripts') ?>
<script>
function previewAboutImage(input) {
    if (input.files && input.files[0]) {
        const file = input.files[0];
        if (file.size > 5 * 1024 * 1024) {
            showToast('Image must be under 5MB.', 'danger');
            input.value = '';
            return;
        }
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('aboutPreviewImg').src = e.target.result;
            document.getElementById('aboutImagePreview').style.display = 'block';
        };
        reader.readAsDataURL(file);
    }
}
</script>
<?= $this->endSection() ?>

<?= $this->endSection() ?>