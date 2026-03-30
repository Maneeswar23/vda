<?= $this->extend('admin/layouts/main') ?>
<?= $this->section('content') ?>

<div class="page-header">
    <div class="page-header-left">
        <h1><i class="fas fa-briefcase me-2" style="color:var(--adm-primary);"></i> <?= esc($pageTitle) ?></h1>
        <p>Fill the card details shown on homepage job selections slider</p>
    </div>
    <a href="<?= base_url('admin/homepage-selection-cards') ?>" class="btn-vda btn-vda-secondary">
        <i class="fas fa-arrow-left"></i> Back
    </a>
</div>

<div class="vda-card">
    <div class="vda-card-body">
        <form action="<?= $card ? base_url('admin/homepage-selection-cards/update/' . $card['id']) : base_url('admin/homepage-selection-cards/store') ?>" method="post">
            <?= csrf_field() ?>

            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label fw-bold">Title</label>
                    <input type="text" name="title" class="form-control" value="<?= old('title', $card['title'] ?? '') ?>" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-bold">Count</label>
                    <input type="text" name="count_value" class="form-control" value="<?= old('count_value', $card['count_value'] ?? '') ?>" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-bold">Label</label>
                    <input type="text" name="label" class="form-control" value="<?= old('label', $card['label'] ?? 'jobs') ?>" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Location</label>
                    <input type="text" name="location" class="form-control" value="<?= old('location', $card['location'] ?? '') ?>" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-bold">Badge</label>
                    <input type="text" name="badge" class="form-control" value="<?= old('badge', $card['badge'] ?? '') ?>">
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-bold">Sort Order</label>
                    <input type="number" name="sort_order" class="form-control" value="<?= old('sort_order', $card['sort_order'] ?? 0) ?>">
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-bold d-block">Status</label>
                    <div class="form-check mt-2">
                        <input class="form-check-input" type="checkbox" name="status" value="1" <?= old('status', $card['status'] ?? 1) ? 'checked' : '' ?>>
                        <label class="form-check-label">Active</label>
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn-vda btn-vda-primary">
                    <i class="fas fa-save"></i> Save
                </button>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>
