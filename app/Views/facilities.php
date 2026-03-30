<?php include 'includes/header.php'; ?>

<?php
$pageTitle  = $pageTitle ?? 'Facilities';
$facilities = $facilities ?? [];
$highlights = $highlights ?? [];
$siteName   = $siteName ?? 'Visakha Defence Academy';
?>

<section class="hero-about-section">
    <div class="hero-overlay"></div>
    <div class="hero-content">
        <h1 class="about-heading"><?= esc($pageTitle) ?></h1>
    </div>
</section>

<div class="facilities-wrapper">
    <div class="container">
        <div class="logo-block text-center text-md-start">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <div class="logo-line1">VISAKHA</div>
                    <div class="logo-line2">DEFENCE ACADEMY</div>
                    <div class="logo-line3">Educational Initiatives</div>
                </div>
                <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
                    <span class="badge-tagline">
                        <i class="fas fa-shield-alt" style="color: var(--primary-colour);"></i>
                        <?= esc($siteName) ?>
                        <i class="fas fa-shield-alt" style="color: var(--accent);"></i>
                    </span>
                </div>
            </div>
        </div>

        <div class="page-title">
            <h2>PREMIUM FACILITIES</h2>
            <p><i class="fas fa-check-circle me-2" style="color: var(--accent);"></i> Everything you need for defence training under one roof</p>
        </div>

        <div class="facility-grid">
            <?php foreach ($facilities as $facility): ?>
                <div class="facility-card">
                    <div class="facility-icon">
                        <i class="<?= esc($facility['icon'] ?? 'fas fa-building', 'attr') ?>"></i>
                    </div>
                    <h3><?= esc($facility['title'] ?? '') ?></h3>
                    <span class="badge-info">
                        <i class="<?= esc($facility['badge_icon'] ?? 'fas fa-tag', 'attr') ?> me-1"></i>
                        <?= esc($facility['badge'] ?? '') ?>
                    </span>
                    <ul class="facility-feature">
                        <?php foreach (($facility['features'] ?? []) as $feature): ?>
                            <?php if (!empty($feature['text'])): ?>
                                <li>
                                    <i class="<?= esc($feature['icon'] ?? 'fas fa-check', 'attr') ?>"></i>
                                    <?= esc($feature['text']) ?>
                                </li>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endforeach; ?>
        </div>

        <?php if (!empty($highlights)): ?>
            <div class="row g-4 mt-2">
                <?php foreach ($highlights as $highlight): ?>
                    <div class="col-md-6">
                        <div class="bg-white p-4 rounded-4 d-flex gap-3 shadow-sm h-100">
                            <div style="font-size: 2.5rem; color: var(--primary-colour);">
                                <i class="<?= esc($highlight['icon'] ?? 'fas fa-star', 'attr') ?>"></i>
                            </div>
                            <div>
                                <h4 style="color: var(--primary-colour); font-weight: 700;"><?= esc($highlight['heading'] ?? '') ?></h4>
                                <p style="color: var(--gray);"><?= esc($highlight['description'] ?? '') ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
