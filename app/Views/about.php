<?php include('includes/header.php') ?>

<?php
$valueTitle = $valueTitle ?? '';
?>

<section class="hero-about-section"<?= !empty($heroImage) ? ' style="background-image: url(\'' . esc($heroImage, 'attr') . '\');"' : '' ?>>
    <div class="hero-overlay"></div>
    <div class="hero-content">
        <h1 class="about-heading"><?= esc($pageTitle) ?></h1>
    </div>
</section>

<section class="home-about about-section section-padding" data-aos="fade-up" data-aos-duration="1000">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-12 text-center" data-aos="fade-right" data-aos-delay="100">
                <span class="section-subtitle"><?= esc($aboutSubtitle) ?></span>
                <h2 class="about-heading"><?= esc($aboutHeading) ?></h2>
            </div>
        </div>
        <div class="row align-items-center">
            <div class="col-lg-5 col-md-12" data-aos="fade-right" data-aos-delay="100">
                <?php foreach ($aboutTextBlocks as $block): ?>
                    <p class="about-text"><?= esc($block) ?></p>
                <?php endforeach; ?>

                <div class="features-list" data-aos="fade-up" data-aos-delay="200">
                    <ul>
                        <?php foreach ($featureItems as $feature): ?>
                            <li><?= esc($feature) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
            <div class="col-lg-5 col-md-8" data-aos="zoom-in" data-aos-delay="150">
                <?php if (!empty($aboutImage)): ?>
                    <img src="<?= esc($aboutImage, 'attr') ?>" alt="<?= esc($siteName, 'attr') ?>" />
                <?php endif; ?>
            </div>
            <div class="col-lg-2 col-md-4">
                <div class="column tab-col">
                    <?php foreach ($aboutStats as $index => $stat): ?>
                        <div class="col-12 <?= $index < count($aboutStats) - 1 ? 'mb-4' : '' ?>" data-aos="fade-left" data-aos-delay="<?= 200 + ($index * 50) ?>">
                            <div class="stat-item">
                                <span class="stat-number"><?= esc($stat['number'] ?? '') ?></span>
                                <div class="stat-title"><?= esc($stat['label'] ?? '') ?></div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="my-mis-vis-val">
    <div class="container">
        <div class="my-mis-vis-val__header">
            <h2 class="my-mis-vis-val__title"><?= esc($ourSectionTitle) ?></h2>
            <p class="my-mis-vis-val__subtitle"><?= esc($ourSectionSubtitle) ?></p>
        </div>

        <div class="my-mis-vis-val__grid">
            <div class="my-mis-vis-val__card">
                <div class="my-mis-vis-val__card-inner">
                    <div class="my-mis-vis-val__icon-wrapper">
                        <div class="my-mis-vis-val__icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5" />
                            </svg>
                        </div>
                    </div>
                    <h3 class="my-mis-vis-val__card-title"><?= esc($missionTitle) ?></h3>
                    <p class="my-mis-vis-val__card-text"><?= esc($missionDescription) ?></p>
                </div>
            </div>

            <div class="my-mis-vis-val__card">
                <div class="my-mis-vis-val__card-inner">
                    <div class="my-mis-vis-val__icon-wrapper">
                        <div class="my-mis-vis-val__icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <circle cx="12" cy="12" r="2" />
                                <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7z" />
                            </svg>
                        </div>
                    </div>
                    <h3 class="my-mis-vis-val__card-title"><?= esc($visionTitle) ?></h3>
                    <p class="my-mis-vis-val__card-text"><?= esc($visionDescription) ?></p>
                </div>
            </div>

            <div class="my-mis-vis-val__card">
                <div class="my-mis-vis-val__card-inner">
                    <div class="my-mis-vis-val__icon-wrapper">
                        <div class="my-mis-vis-val__icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                            </svg>
                        </div>
                    </div>
                    <h3 class="my-mis-vis-val__card-title"><?= esc($valueTitle ?? '') ?></h3>
                    <div class="my-mis-vis-val__values-wrapper">
                        <?php foreach ($valueItems as $value): ?>
                            <div class="my-mis-vis-val__value-item">
                                <span class="my-mis-vis-val__value-dot"></span>
                                <span><?= esc($value) ?></span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="directors-mesg-section">
    <div class="container">
        <div class="directors-mesg-section__header">
            <h2 class="directors-mesg-section__heading"><?= esc($directorSectionTitle) ?></h2>
            <p class="directors-mesg-section__subheading"><?= esc($directorSectionSubtitle) ?></p>
        </div>

        <div class="directors-mesg-section__container">
            <?php foreach ($directors as $director): ?>
                <div class="directors-mesg-section__card">
                    <div class="directors-mesg-section__profile">
                        <div class="directors-mesg-section__image-wrapper">
                            <?php if (!empty($director['image'])): ?>
                                <img src="<?= esc($director['image'] ?? '', 'attr') ?>" alt="<?= esc($director['name'] ?? '', 'attr') ?>" class="directors-mesg-section__image">
                            <?php endif; ?>
                        </div>
                        <div class="directors-mesg-section__info">
                            <h4 class="directors-mesg-section__name"><?= esc($director['name'] ?? '') ?></h4>
                            <p class="directors-mesg-section__designation"><?= esc($director['designation'] ?? '') ?></p>
                            <?php if (!empty($director['experience'])): ?>
                                <div class="directors-mesg-section__experience">
                                    <span class="directors-mesg-section__experience-tag"><?= esc($director['experience']) ?></span>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="directors-mesg-section__content">
                        <h3 class="directors-mesg-section__title"><?= esc($director['message_title'] ?? '') ?></h3>
                        <div class="directors-mesg-section__text-wrapper">
                            <div class="directors-mesg-section__text-preview">
                                <?php foreach (preg_split('/\r\n|\r|\n/', $director['description'] ?? '') as $paragraph): ?>
                                    <?php if (trim($paragraph) !== ''): ?>
                                        <p class="directors-mesg-section__text"><?= esc(trim($paragraph)) ?></p>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="our-team-section">
    <div class="our-team-section__header">
        <h2 class="our-team-section__heading"><?= esc($teamSectionTitle) ?></h2>
        <p class="our-team-section__subheading"><?= esc($teamSectionSubtitle) ?></p>
    </div>

    <div class="our-team-section__container">
        <?php foreach ($teamMembers as $member): ?>
            <div class="our-team-section__card">
                <div class="our-team-section__image-wrapper">
                    <?php if (!empty($member['image'])): ?>
                        <img src="<?= esc($member['image'] ?? '', 'attr') ?>" alt="<?= esc($member['name'] ?? '', 'attr') ?>" class="our-team-section__image">
                    <?php endif; ?>
                </div>
                <div class="our-team-section__content">
                    <h3 class="our-team-section__name"><?= esc($member['name'] ?? '') ?></h3>
                    <p class="our-team-section__designation"><?= esc($member['designation'] ?? '') ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<?php include('includes/footer.php') ?>
