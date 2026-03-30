<?= $this->extend('admin/layouts/main') ?>
<?= $this->section('content') ?>

<?php $isEdit = !empty($banner); ?>

<div class="page-header">
    <div class="page-header-left">
        <h1>
            <i class="fas fa-<?= $isEdit ? 'edit' : 'plus-circle' ?> me-2" style="color:var(--adm-primary);"></i>
            <?= $isEdit ? 'Edit Banner' : 'Add New Banner' ?>
        </h1>
        <p><?= $isEdit ? 'Update banner details below' : 'Fill in the details to add a new banner' ?></p>
    </div>
    <a href="<?= base_url('admin/homepage/banners') ?>" class="btn-vda btn-vda-secondary">
        <i class="fas fa-arrow-left"></i> Back to Banners
    </a>
</div>

<?php if (session()->getFlashdata('errors')): ?>
    <div class="vda-alert vda-alert-danger">
        <i class="fas fa-exclamation-circle"></i>
        <ul class="mb-0 ps-3">
            <?php foreach (session()->getFlashdata('errors') as $error): ?>
                <li><?= esc($error) ?></li>
            <?php endforeach; ?>
        </ul>
        <button class="vda-alert-close" onclick="this.parentElement.remove()"><i class="fas fa-times"></i></button>
    </div>
<?php endif; ?>

<div class="vda-card">
    <div class="vda-card-header">
        <div class="vda-card-title">
            <i class="fas fa-image"></i>
            <?= $isEdit ? 'Edit Banner Details' : 'Banner Details' ?>
        </div>
    </div>
    <div class="vda-card-body">
        <form action="<?= $isEdit
                ? base_url('admin/homepage/banner/update/' . $banner['id'])
                : base_url('admin/homepage/banner/store') ?>"
              method="POST"
              enctype="multipart/form-data">
            <?= csrf_field() ?>

            <div class="row g-3">

                <!-- Title -->
                <div class="col-md-6">
                    <div class="vda-form-group">
                        <label class="vda-label">
                            Title <span class="req">*</span>
                        </label>
                        <input type="text"
                               name="title"
                               class="vda-input"
                               value="<?= old('title', $banner['title'] ?? '') ?>"
                               placeholder="Welcome to Visakha Defence Academy"
                               required>
                    </div>
                </div>

                <!-- Subtitle -->
                <div class="col-md-6">
                    <div class="vda-form-group">
                        <label class="vda-label">Subtitle</label>
                        <input type="text"
                               name="subtitle"
                               class="vda-input"
                               value="<?= old('subtitle', $banner['subtitle'] ?? '') ?>"
                               placeholder="Your journey to serve the nation starts here">
                    </div>
                </div>

                <!-- Button Text -->
                <div class="col-md-4">
                    <div class="vda-form-group">
                        <label class="vda-label">Button Text</label>
                        <input type="text"
                               name="button_text"
                               class="vda-input"
                               value="<?= old('button_text', $banner['button_text'] ?? '') ?>"
                               placeholder="Explore Courses">
                    </div>
                </div>

                <!-- Button Link -->
                <div class="col-md-4">
                    <div class="vda-form-group">
                        <label class="vda-label">Button Link</label>
                        <input type="text"
                               name="button_link"
                               class="vda-input"
                               value="<?= old('button_link', $banner['button_link'] ?? '') ?>"
                               placeholder="course">
                        <small class="vda-form-hint">Enter relative path e.g. course, contact, about</small>
                    </div>
                </div>

                <!-- Sort Order -->
                <div class="col-md-2">
                    <div class="vda-form-group">
                        <label class="vda-label">Sort Order</label>
                        <input type="number"
                               name="sort_order"
                               class="vda-input"
                               value="<?= old('sort_order', $banner['sort_order'] ?? 0) ?>">
                    </div>
                </div>

                <!-- Status -->
                <div class="col-md-2">
                    <div class="vda-form-group">
                        <label class="vda-label">Status</label>
                        <select name="status" class="vda-select">
                            <option value="1" <?= (old('status', $banner['status'] ?? 1) == 1) ? 'selected' : '' ?>>
                                Active
                            </option>
                            <option value="0" <?= (old('status', $banner['status'] ?? 1) == 0) ? 'selected' : '' ?>>
                                Inactive
                            </option>
                        </select>
                    </div>
                </div>

                <!-- Image Upload -->
                <div class="col-12">
                    <div class="vda-form-group">
                        <label class="vda-label">Banner Image</label>

                        <!-- Current image (edit mode) -->
                        <?php if ($isEdit && !empty($banner['image'])): ?>
                            <?php
                            if (file_exists(FCPATH . 'public/uploads/banners/' . $banner['image'])) {
                                $imgUrl = base_url('public/uploads/banners/' . $banner['image']);
                            } elseif (file_exists(FCPATH . 'public/assets/images/' . $banner['image'])) {
                                $imgUrl = base_url('public/assets/images/' . $banner['image']);
                            } else {
                                $imgUrl = base_url('public/assets/images/placeholder.jpg');
                            }
                            ?>
                            <div class="mb-3">
                                <p class="vda-form-hint mb-1">Current image:</p>
                                <div class="img-preview-lg">
                                    <img src="<?= $imgUrl ?>"
                                         alt="Current Banner"
                                         style="max-height:180px;object-fit:cover;width:100%;">
                                </div>
                                <small class="vda-form-hint mt-1 d-block">
                                    Upload a new image below to replace the current one.
                                </small>
                            </div>
                        <?php endif; ?>

                        <!-- Upload area -->
                        <div class="upload-area" onclick="document.getElementById('bannerImage').click()">
                            <i class="fas fa-cloud-upload-alt"></i>
                            <p>Click to upload banner image</p>
                            <small>JPG, PNG, WEBP — Max 5MB — Recommended: 1920×600px</small>
                        </div>
                        <input type="file"
                               id="bannerImage"
                               name="image"
                               accept="image/*"
                               style="display:none;"
                               onchange="previewBannerImage(this)">

                        <!-- New image preview -->
                        <div id="newImagePreview" class="mt-2" style="display:none;">
                            <p class="vda-form-hint mb-1">New image preview:</p>
                            <div class="img-preview-lg">
                                <img id="previewImg" src="" alt="Preview">
                            </div>
                        </div>

                    </div>
                </div>

            </div>

            <!-- Form Actions -->
            <div class="d-flex gap-2 mt-4 pt-3" style="border-top:1px solid var(--adm-border);">
                <button type="submit" class="btn-vda btn-vda-primary">
                    <i class="fas fa-save"></i>
                    <?= $isEdit ? 'Update Banner' : 'Save Banner' ?>
                </button>
                <a href="<?= base_url('admin/homepage/banners') ?>" class="btn-vda btn-vda-secondary">
                    <i class="fas fa-times"></i> Cancel
                </a>
            </div>

        </form>
    </div>
</div>

<?= $this->section('scripts') ?>
<script>
function previewBannerImage(input) {
    if (input.files && input.files[0]) {
        const file = input.files[0];

        // size check
        if (file.size > 5 * 1024 * 1024) {
            showToast('Image must be under 5MB.', 'danger');
            input.value = '';
            return;
        }

        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('previewImg').src = e.target.result;
            document.getElementById('newImagePreview').style.display = 'block';
        };
        reader.readAsDataURL(file);
    }
}
</script>
<?= $this->endSection() ?>

<?= $this->endSection() ?>