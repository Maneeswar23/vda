<?php include 'includes/header.php'; ?>

<?php
$pageTitle = $pageTitle ?? 'Job Selections';
$jobImage  = $jobImage ?? '';
$caption   = $caption ?? '';
$campus    = $campus ?? '';
?>

<section class="hero-about-section">
    <div class="hero-overlay"></div>
    <div class="hero-content">
        <h1 class="about-heading"><?= esc($pageTitle) ?></h1>
    </div>
</section>

<div class="mock-image-card">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <?php if ($jobImage !== ''): ?>
                    <div class="image-placeholder">
                        <img class="mock-img"
                            src="<?= esc($jobImage, 'attr') ?>"
                            alt="<?= esc($pageTitle, 'attr') ?>"
                            title="<?= esc($caption, 'attr') ?>">
                    </div>
                <?php endif; ?>

                <?php if ($caption !== '' || $campus !== ''): ?>
                    <div class="image-caption">
                        <?php if ($caption !== ''): ?>
                            <span class="badge"><i class="fas fa-calendar-alt"></i> <?= esc($caption) ?></span>
                        <?php endif; ?>
                        <?php if ($campus !== ''): ?>
                            <span><i class="fas fa-map-marker-alt" style="font-style: normal;"></i> <?= esc($campus) ?></span>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
