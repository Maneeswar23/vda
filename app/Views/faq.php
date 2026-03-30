<!-- Clean Banner Section -->
<?php include 'includes/header.php'; ?>

<?php
$faqs = $faqs ?? [];
?>

<section class="hero-about-section">
    <div class="hero-overlay"></div>
    <div class="hero-content">
        <h1 class="about-heading">FAQ's </h1>
    </div>

</section>

<section class="faq-section section-padding">
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="latest-faq-sec faq-card">

                    <div class="latest-faq-sec accordion" id="faqAccordion">
                        <?php foreach ($faqs as $index => $faq): ?>
                            <?php
                            $itemNumber = $index + 1;
                            $headingId = 'faqHeading' . $itemNumber;
                            $collapseId = 'faqCollapse' . $itemNumber;
                            ?>
                            <div class="latest-faq-sec accordion-item">
                                <h2 class="latest-faq-sec accordion-header" id="<?= esc($headingId) ?>">
                                    <button class="latest-faq-sec accordion-button collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#<?= esc($collapseId) ?>" aria-expanded="false"
                                        aria-controls="<?= esc($collapseId) ?>">
                                        <?= esc(strip_tags($faq['question'] ?? '')) ?>
                                    </button>
                                </h2>
                                <div id="<?= esc($collapseId) ?>" class="latest-faq-sec accordion-collapse collapse"
                                    aria-labelledby="<?= esc($headingId) ?>" data-bs-parent="#faqAccordion">
                                    <div class="latest-faq-sec accordion-body">
                                        <?= nl2br(esc(strip_tags($faq['answer'] ?? ''))) ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
