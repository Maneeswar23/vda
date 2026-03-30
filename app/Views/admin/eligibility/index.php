<?= $this->extend('admin/layouts/main') ?>
<?= $this->section('content') ?>

<div class="container-fluid">

    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Eligibility Conditions</h5>
        </div>

        <div class="card-body">

            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success"><?= session('success') ?></div>
            <?php endif; ?>

            <form action="<?= base_url('admin/eligibility/update') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>

                <input type="hidden" name="id" value="<?= $eligibility['id'] ?? '' ?>">

                <div class="row">

                    <!-- Image Preview -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Image</label>

                        <?php if (!empty($eligibility['image'])): ?>
                            <?php
                            if (file_exists(FCPATH . 'public/uploads/eligibility/' . $eligibility['image'])) {
                                $imgUrl = base_url('public/uploads/eligibility/' . $eligibility['image']);
                            } elseif (file_exists(FCPATH . 'public/assets/images/' . $eligibility['image'])) {
                                $imgUrl = base_url('public/assets/images/' . $eligibility['image']);
                            } else {
                                $imgUrl = base_url('public/assets/images/placeholder.jpg');
                            }
                            ?>
                            <div class="mb-3">
                                <p class="vda-form-hint mb-1">Current image:</p>
                                <div class="img-preview-lg">
                                    <img src="<?= $imgUrl ?>" style="max-height:180px;object-fit:cover;width:100%;">
                                </div>
                            </div>
                        <?php endif; ?>

                        <input type="file" name="image" class="form-control">
                    </div>

                    <!-- Campus -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Campus</label>
                        <input type="text" name="campus" class="form-control"
                            value="<?= $eligibility['campus'] ?? '' ?>">
                    </div>

                    <!-- Caption -->
                    <div class="col-md-12 mb-3">
                        <label class="form-label fw-bold">Caption</label>
                        <input type="text" name="caption" class="form-control"
                            value="<?= $eligibility['caption'] ?? '' ?>">
                    </div>

                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Update
                </button>

            </form>

        </div>
    </div>

</div>

<?= $this->endSection() ?>