<?= $this->extend('admin/layouts/main') ?>
<?= $this->section('content') ?>

<div class="page-header">
    <div class="page-header-left">
        <h1><i class="fas fa-info-circle me-2" style="color:var(--adm-primary);"></i> About Page</h1>
        <p>Manage all about page sections</p>
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

<!-- ============================================================
     SECTION 1: BANNER
============================================================ -->

<!-- ============================================================
     SECTION 2: ABOUT US
============================================================ -->
<!-- ============================================================
     SECTION 2: ABOUT US
============================================================ -->
<div class="vda-card mb-4">
    <div class="vda-card-header">
        <div class="vda-card-title">
            <i class="fas fa-align-left"></i> About Us Section
        </div>
    </div>
    <div class="vda-card-body">

        <!-- Text fields — separate form, NO enctype -->
        <form action="<?= base_url('admin/about/update/about_multi') ?>" method="POST">
            <?= csrf_field() ?>
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="vda-label">Main Title <span class="req">*</span></label>
                    <input type="text" name="about_main_title" class="vda-input"
                        value="<?= esc($d['about_main_title']['heading'] ?? '') ?>"
                        placeholder="About Us" required>
                </div>
                <div class="col-md-6">
                    <label class="vda-label">Subtitle</label>
                    <input type="text" name="about_subtitle" class="vda-input"
                        value="<?= esc($d['about_subtitle']['heading'] ?? '') ?>"
                        placeholder="Premier Defence Coaching Institute Since 2002">
                </div>
                <div class="col-md-12">
                    <label class="vda-label">Text / Tagline</label>
                    <input type="text" name="about_text" class="vda-input"
                        value="<?= esc($d['about_text']['heading'] ?? '') ?>"
                        placeholder="Welcome to Visakha Defence Academy">
                </div>
                <div class="col-md-12">
                    <label class="vda-label">Description <span class="req">*</span></label>
                    <textarea name="about_description" class="vda-textarea" rows="6"
                        required><?= esc($d['about_description']['heading'] ?? '') ?></textarea>
                </div>
            </div>
            <div class="mt-3">
                <button type="submit" class="btn-vda btn-vda-primary">
                    <i class="fas fa-save"></i> Save About Text
                </button>
            </div>
        </form>

        <hr style="border-color:var(--adm-border); margin:20px 0;">

        <!-- About Image — SEPARATE form with enctype -->
        <form action="<?= base_url('admin/about/update/about_image') ?>"
            method="POST" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <label class="vda-label">About Section Image</label>
            <?php
            $aboutImg = $d['about_image']['image'] ?? '';
            if (!empty($aboutImg)) {
                if (file_exists(FCPATH . 'public/uploads/about/' . $aboutImg)) {
                    $aboutImgUrl = base_url('public/uploads/about/' . $aboutImg);
                } elseif (file_exists(FCPATH . 'public/assets/images/' . $aboutImg)) {
                    $aboutImgUrl = base_url('public/assets/images/' . $aboutImg);
                } else {
                    $aboutImgUrl = base_url('public/assets/images/placeholder.jpg');
                }
            } else {
                $aboutImgUrl = base_url('public/assets/images/placeholder.jpg');
            }
            ?>
            <div class="row g-3 align-items-end mt-1">
                <div class="col-md-3">
                    <img src="<?= $aboutImgUrl ?>"
                        alt="About Image"
                        id="aboutImgPreview"
                        class="w-100 rounded"
                        style="height:100px;object-fit:cover;">
                </div>
                <div class="col-md-6">
                    <div class="upload-area"
                        onclick="document.getElementById('aboutImageInput').click()">
                        <i class="fas fa-cloud-upload-alt"></i>
                        <p>Click to upload</p>
                        <small>JPG, PNG, WEBP — Max 5MB</small>
                    </div>
                    <input type="file"
                        id="aboutImageInput"
                        name="image"
                        accept="image/*"
                        style="display:none;"
                        onchange="previewImg(this,'aboutImgPreview')">
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn-vda btn-vda-primary w-100">
                        <i class="fas fa-save"></i> Save Image
                    </button>
                </div>
            </div>
        </form>

    </div>
</div>

<!-- ============================================================
     SECTION 3: 4 FEATURE POINTS
============================================================ -->
<div class="vda-card mb-4">
    <div class="vda-card-header">
        <div class="vda-card-title"><i class="fas fa-star"></i> 4 Feature Points</div>
    </div>
    <div class="vda-card-body">
        <div class="row g-3">
            <?php for ($i = 1; $i <= 4; $i++): ?>
                <div class="col-md-6">
                    <div class="vda-card" style="border:1px solid var(--adm-border);">
                        <div class="vda-card-header" style="padding:10px 14px;">
                            <div class="vda-card-title" style="font-size:13px;">
                                <i class="fas fa-check-circle" style="color:var(--adm-accent);"></i>
                                Feature <?= $i ?>
                            </div>
                        </div>
                        <div class="vda-card-body" style="padding:14px;">
                            <form action="<?= base_url('admin/about/update/feature_' . $i) ?>" method="POST">
                                <?= csrf_field() ?>
                                <div class="vda-form-group">
                                    <label class="vda-label">Title</label>
                                    <input type="text" name="heading" class="vda-input"
                                        value="<?= esc($d['feature_' . $i]['heading'] ?? '') ?>">
                                </div>
                                <button type="submit" class="btn-vda btn-vda-primary btn-sm">
                                    <i class="fas fa-save"></i> Save
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endfor; ?>
        </div>
    </div>
</div>

<!-- ============================================================
     SECTION 4: 3 STATS
============================================================ -->
<div class="vda-card mb-4">
    <div class="vda-card-header">
        <div class="vda-card-title"><i class="fas fa-chart-bar"></i> About Page Stats (3)</div>
    </div>
    <div class="vda-card-body">
        <div class="row g-3">
            <?php for ($i = 1; $i <= 3; $i++): ?>
                <div class="col-md-4">
                    <form action="<?= base_url('admin/about/update/stat_' . $i) ?>" method="POST">
                        <?= csrf_field() ?>
                        <div class="vda-card" style="border:1px solid var(--adm-border);">
                            <div class="vda-card-header" style="padding:10px 14px;">
                                <div class="vda-card-title" style="font-size:13px;">
                                    <i class="fas fa-hashtag" style="color:var(--adm-primary);"></i>
                                    Stat <?= $i ?>
                                </div>
                            </div>
                            <div class="vda-card-body" style="padding:14px;">
                                <div class="vda-form-group">
                                    <label class="vda-label">Number</label>
                                    <input type="text" name="heading" class="vda-input"
                                        value="<?= esc($d['stat_' . $i]['heading'] ?? '') ?>"
                                        placeholder="500+">
                                </div>
                                <div class="vda-form-group">
                                    <label class="vda-label">Label</label>
                                    <input type="text" name="description" class="vda-input"
                                        value="<?= esc($d['stat_' . $i]['description'] ?? '') ?>"
                                        placeholder="Students Selected">
                                </div>
                                <button type="submit" class="btn-vda btn-vda-primary btn-sm w-100">
                                    <i class="fas fa-save"></i> Save
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            <?php endfor; ?>
        </div>
    </div>
</div>

<!-- ============================================================
     SECTION 5: OUR SECTION TITLE
============================================================ -->
<div class="vda-card mb-4">
    <div class="vda-card-header">
        <div class="vda-card-title"><i class="fas fa-th-large"></i> Our Section</div>
    </div>
    <div class="vda-card-body">
        <form action="<?= base_url('admin/about/update/our_section_multi') ?>" method="POST">
            <?= csrf_field() ?>
            <div class="row g-3 align-items-end">
                <div class="col-md-5">
                    <label class="vda-label">Section Title</label>
                    <input type="text" name="our_section_title" class="vda-input"
                        value="<?= esc($d['our_section_title']['heading'] ?? '') ?>">
                </div>
                <div class="col-md-5">
                    <label class="vda-label">Subtitle</label>
                    <input type="text" name="our_section_subtitle" class="vda-input"
                        value="<?= esc($d['our_section_subtitle']['heading'] ?? '') ?>">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn-vda btn-vda-primary w-100">
                        <i class="fas fa-save"></i> Save
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- ============================================================
     SECTION 6: MISSION, VISION, VALUES
============================================================ -->
<div class="vda-card mb-4">
    <div class="vda-card-header">
        <div class="vda-card-title"><i class="fas fa-bullseye"></i> Mission, Vision & Values</div>
    </div>
    <div class="vda-card-body">
        <div class="row g-4">

            <!-- Mission -->
            <div class="col-md-6">
                <h6 class="fw-bold mb-3" style="color:var(--adm-primary);">
                    <i class="fas fa-rocket me-1"></i> Our Mission
                </h6>
                <form action="<?= base_url('admin/about/update/mission_multi') ?>" method="POST">
                    <?= csrf_field() ?>
                    <div class="vda-form-group">
                        <label class="vda-label">Title</label>
                        <input type="text" name="mission_title" class="vda-input"
                            value="<?= esc($d['mission_title']['heading'] ?? '') ?>">
                    </div>
                    <div class="vda-form-group">
                        <label class="vda-label">Description</label>
                        <textarea name="mission_description" class="vda-textarea" rows="4"><?= esc($d['mission_description']['heading'] ?? '') ?></textarea>
                    </div>
                    <button type="submit" class="btn-vda btn-vda-primary btn-sm">
                        <i class="fas fa-save"></i> Save Mission
                    </button>
                </form>
            </div>

            <!-- Vision -->
            <div class="col-md-6">
                <h6 class="fw-bold mb-3" style="color:var(--adm-accent);">
                    <i class="fas fa-eye me-1"></i> Our Vision
                </h6>
                <form action="<?= base_url('admin/about/update/vision_multi') ?>" method="POST">
                    <?= csrf_field() ?>
                    <div class="vda-form-group">
                        <label class="vda-label">Title</label>
                        <input type="text" name="vision_title" class="vda-input"
                            value="<?= esc($d['vision_title']['heading'] ?? '') ?>">
                    </div>
                    <div class="vda-form-group">
                        <label class="vda-label">Description</label>
                        <textarea name="vision_description" class="vda-textarea" rows="4"><?= esc($d['vision_description']['heading'] ?? '') ?></textarea>
                    </div>
                    <button type="submit" class="btn-vda btn-vda-primary btn-sm">
                        <i class="fas fa-save"></i> Save Vision
                    </button>
                </form>
            </div>

            <!-- Values -->
            <div class="col-12">
                <hr style="border-color:var(--adm-border);">
                <h6 class="fw-bold mb-3" style="color:var(--adm-cta);">
                    <i class="fas fa-gem me-1"></i> Our Values (4 Points)
                </h6>
                <div class="row g-3">
                    <?php for ($i = 1; $i <= 4; $i++): ?>
                        <div class="col-md-6">
                            <form action="<?= base_url('admin/about/update/value_' . $i) ?>" method="POST">
                                <?= csrf_field() ?>
                                <div class="vda-card" style="border:1px solid var(--adm-border);">
                                    <div class="vda-card-header" style="padding:10px 14px;">
                                        <div class="vda-card-title" style="font-size:13px;">
                                            <i class="fas fa-gem" style="color:var(--adm-cta);"></i>
                                            Value <?= $i ?>
                                        </div>
                                    </div>
                                    <div class="vda-card-body" style="padding:14px;">
                                        <div class="vda-form-group">
                                            <label class="vda-label">Title</label>
                                            <input type="text" name="heading" class="vda-input"
                                                value="<?= esc($d['value_' . $i]['heading'] ?? '') ?>">
                                        </div>
                                        <button type="submit" class="btn-vda btn-vda-primary btn-sm">
                                            <i class="fas fa-save"></i> Save
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    <?php endfor; ?>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- ============================================================
     SECTION 7: DIRECTORS
============================================================ -->
<div class="vda-card mb-4" id="directors">
    <div class="vda-card-header">
        <div class="vda-card-title"><i class="fas fa-user-tie"></i> From the Director's Desk</div>
        <div class="d-flex gap-2">
            <a href="<?= base_url('admin/about/director/add') ?>" class="btn-vda btn-vda-outline btn-sm">
                <i class="fas fa-plus"></i> Add Director
            </a>
        </div>
    </div>
    <div class="vda-card-body">

        <!-- Director Subtitle -->
        <form action="<?= base_url('admin/about/update/director_section_multi') ?>" method="POST">
            <?= csrf_field() ?>

            <div class="vda-form-group">
                <label class="vda-label">Section Title</label>
                <input type="text" name="director_title" class="vda-input"
                    value="<?= esc($d['director_title']['heading'] ?? '') ?>">
            </div>

            <div class="vda-form-group">
                <label class="vda-label">Section Subtitle</label>
                <input type="text" name="director_subtitle" class="vda-input"
                    value="<?= esc($d['director_subtitle']['heading'] ?? '') ?>">
            </div>
            <button type="submit" class="btn-vda btn-vda-primary">
                <i class="fas fa-save me-1"></i> Save
            </button>
        </form>
        <br>

        <!-- Director Cards -->
        <?php
        // find how many directors exist
        $dirCount = 0;
        for ($i = 1; $i <= 10; $i++) {
            if (isset($d["director_{$i}_name"])) {
                $dirCount = $i;
            }
        }
        if ($dirCount < 2) $dirCount = 2;
        ?>

        <?php for ($i = 1; $i <= $dirCount; $i++): ?>
            <?php
            $dirImg = $d["director_{$i}_image"]['image'] ?? '';
            if (!empty($dirImg)) {
                if (file_exists(FCPATH . 'public/uploads/about/' . $dirImg)) {
                    $dImgUrl = base_url('public/uploads/about/' . $dirImg);
                } elseif (file_exists(FCPATH . 'public/assets/images/' . $dirImg)) {
                    $dImgUrl = base_url('public/assets/images/' . $dirImg);
                } else {
                    $dImgUrl = base_url('public/assets/images/placeholder.jpg');
                }
            } else {
                $dImgUrl = base_url('public/assets/images/placeholder.jpg');
            }
            ?>
            <div class="vda-card mb-3" style="border:1px solid var(--adm-border);">
                <div class="vda-card-header" style="padding:12px 16px;">
                    <div class="vda-card-title">
                        <i class="fas fa-user-tie" style="color:var(--adm-primary);"></i>
                        Director <?= $i ?> — <?= esc($d["director_{$i}_name"]['heading'] ?? 'New Director') ?>
                    </div>
                    <?php if ($i > 2): ?>
                        <a href="<?= base_url('admin/about/director/delete/' . $i) ?>"
                            class="btn-vda btn-vda-danger btn-sm"
                            data-confirm-delete="Remove this director?">
                            <i class="fas fa-trash"></i> Remove
                        </a>
                    <?php endif; ?>
                </div>
                <div class="vda-card-body">
                    <div class="row g-3">

                        <form action="<?= base_url('admin/about/update/director_' . $i . '_details') ?>"
                            method="POST" enctype="multipart/form-data">
                            <div class="row g-3">
                                <?= csrf_field() ?>
                                <div class="col-md-2">
                                    <img src="<?= $dImgUrl ?>" alt="Director"
                                        class="w-100 rounded" style="height:120px;object-fit:cover;">
                                    <input type="file" name="image" class="vda-input mt-2" accept="image/*"
                                        style="font-size:11px;padding:4px;">
                                </div>
                                <div class="col-md-10">
                                    <div class="row g-2">
                                        <div class="col-md-4">
                                            <label class="vda-label">Name</label>
                                            <input type="text" name="director_name" class="vda-input"
                                                value="<?= esc($d["director_{$i}_name"]['heading'] ?? '') ?>">
                                        </div>
                                        <div class="col-md-4">
                                            <label class="vda-label">Designation</label>
                                            <input type="text" name="director_designation" class="vda-input"
                                                value="<?= esc($d["director_{$i}_designation"]['heading'] ?? '') ?>">
                                        </div>
                                        <div class="col-md-4">
                                            <label class="vda-label">Experience</label>
                                            <input type="text" name="director_experience" class="vda-input"
                                                value="<?= esc($d["director_{$i}_experience"]['heading'] ?? '') ?>"
                                                placeholder="30+ Years">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="vda-label">Message Title</label>
                                            <input type="text" name="director_message" class="vda-input"
                                                value="<?= esc($d["director_{$i}_message"]['heading'] ?? '') ?>">
                                        </div>
                                        <div class="col-md-6 d-flex align-items-end">
                                            <button type="submit" class="btn-vda btn-vda-primary w-100">
                                                <i class="fas fa-save"></i> Save Details
                                            </button>
                                        </div>
                                        <div class="col-12">
                                            <label class="vda-label">Description / Message</label>
                                            <textarea name="director_description" class="vda-textarea" rows="3"><?= esc($d["director_{$i}_description"]['description'] ?? '') ?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        <?php endfor; ?>

    </div>
</div>

<!-- ============================================================
     SECTION 8: TEAM
============================================================ -->
<div class="vda-card mb-4" id="team">
    <div class="vda-card-header">
        <div class="vda-card-title"><i class="fas fa-users"></i> Our Distinguished Team</div>
        <a href="<?= base_url('admin/about/team/add') ?>" class="btn-vda btn-vda-outline btn-sm">
            <i class="fas fa-plus"></i> Add Member
        </a>
    </div>
    <div class="vda-card-body">

        <!-- Team Section Title -->
        <form action="<?= base_url('admin/about/update/team_titles') ?>" method="POST" class="mb-4">
            <?= csrf_field() ?>
            <div class="row g-3 align-items-end">
                <div class="col-md-4">
                    <label class="vda-label">Section Title</label>
                    <input type="text" name="team_title" class="vda-input"
                        value="<?= esc($d['team_title']['heading'] ?? 'Our Distinguished Team') ?>">
                </div>
                <div class="col-md-5">
                    <label class="vda-label">Subtitle</label>
                    <input type="text" name="team_subtitle" class="vda-input"
                        value="<?= esc($d['team_subtitle']['heading'] ?? '') ?>">
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn-vda btn-vda-primary w-100">
                        <i class="fas fa-save"></i> Save
                    </button>
                </div>
            </div>
        </form>

        <!-- Team Members -->
        <?php
        $teamCount = 0;
        for ($i = 1; $i <= 20; $i++) {
            if (isset($d["team_{$i}_name"])) {
                $teamCount = $i;
            }
        }
        if ($teamCount < 4) $teamCount = 4;
        ?>

        <div class="row g-3">
            <?php for ($i = 1; $i <= $teamCount; $i++): ?>
                <?php
                $tmImg = $d["team_{$i}_image"]['image'] ?? '';
                if (!empty($tmImg)) {
                    if (file_exists(FCPATH . 'public/uploads/about/' . $tmImg)) {
                        $tmUrl = base_url('public/uploads/about/' . $tmImg);
                    } elseif (file_exists(FCPATH . 'public/assets/images/' . $tmImg)) {
                        $tmUrl = base_url('public/assets/images/' . $tmImg);
                    } else {
                        $tmUrl = base_url('public/assets/images/placeholder.jpg');
                    }
                } else {
                    $tmUrl = base_url('public/assets/images/placeholder.jpg');
                }
                ?>
                <div class="col-md-6 col-lg-3">
                    <div class="vda-card" style="border:1px solid var(--adm-border);">
                        <div class="vda-card-header" style="padding:10px 12px;">
                            <div class="vda-card-title" style="font-size:12px;">
                                <i class="fas fa-user" style="color:var(--adm-primary);"></i>
                                Member <?= $i ?>
                            </div>
                            <?php if ($i > 4): ?>
                                <a href="<?= base_url('admin/about/team/delete/' . $i) ?>"
                                    class="btn-vda btn-vda-danger btn-sm"
                                    data-confirm-delete="Remove this team member?">
                                    <i class="fas fa-times"></i>
                                </a>
                            <?php endif; ?>
                        </div>
                        <div class="vda-card-body" style="padding:12px;">

                            <form action="<?= base_url('admin/about/update/team_' . $i . '_details') ?>"
                                method="POST" enctype="multipart/form-data">
                                <?= csrf_field() ?>
                                <img src="<?= $tmUrl ?>" alt="Team"
                                    class="w-100 rounded mb-2"
                                    style="height:90px;object-fit:cover;">
                                <input type="file" name="image" class="vda-input mb-2"
                                    accept="image/*" style="font-size:11px;padding:4px;">
                                <div class="vda-form-group">
                                    <label class="vda-label" style="font-size:11px;">Name</label>
                                    <input type="text" name="team_name" class="vda-input"
                                        style="font-size:12px;padding:6px 10px;"
                                        value="<?= esc($d["team_{$i}_name"]['heading'] ?? '') ?>">
                                </div>
                                <div class="vda-form-group">
                                    <label class="vda-label" style="font-size:11px;">Designation</label>
                                    <input type="text" name="team_designation" class="vda-input"
                                        style="font-size:12px;padding:6px 10px;"
                                        value="<?= esc($d["team_{$i}_designation"]['heading'] ?? '') ?>">
                                </div>
                                <button type="submit" class="btn-vda btn-vda-primary btn-sm w-100">
                                    <i class="fas fa-save"></i> Save
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endfor; ?>
        </div>

    </div>
</div>

<?= $this->section('scripts') ?>
<script>
    function previewImg(input, previewId) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = e => {
                const img = document.getElementById(previewId);
                img.src = e.target.result;
                img.style.display = 'block';
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
<?= $this->endSection() ?>

<?= $this->endSection() ?>
