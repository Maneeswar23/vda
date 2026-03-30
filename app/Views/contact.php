<?php include 'includes/header.php'; ?>

<?php
$siteName = strip_tags($siteName ?? '');
$phone1 = strip_tags($phone1 ?? '');
$phone2 = strip_tags($phone2 ?? '');
$email1 = strip_tags($email1 ?? '');
$email2 = strip_tags($email2 ?? '');
$address = strip_tags($address ?? '');
$facebookUrl = $facebookUrl ?? '';
$instagramUrl = $instagramUrl ?? '';
$youtubeUrl = $youtubeUrl ?? '';
$linkedinUrl = $linkedinUrl ?? '';
$admissionOpen = $admissionOpen ?? '';
$admissionYear = strip_tags($admissionYear ?? '');
$primaryWhatsapp = $phone2 !== '' ? $phone2 : $phone1;
?>

<section class="hero-about-section">
    <div class="hero-overlay"></div>
    <div class="hero-content">
        <h1 class="about-heading">Contact Us</h1>
    </div>
</section>

<div class="container py-4 py-lg-5">
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

    <div class="card contact-card">
        <div class="row g-0">
            <div class="col-md-6">
                <div class="form-panel">
                    <h2 class="section-title">Send message</h2>
                    <div class="subhead-accent mb-4 py-1 px-2">
                        <i class="fas fa-phone-alt me-2"></i> Ask anything and we will get back to you
                    </div>

                    <?php if (session()->getFlashdata('success')): ?>
                        <div class="alert alert-success"><?= esc(session()->getFlashdata('success')) ?></div>
                    <?php endif; ?>

                    <?php if (session()->getFlashdata('error')): ?>
                        <div class="alert alert-danger"><?= esc(session()->getFlashdata('error')) ?></div>
                    <?php endif; ?>

                    <form action="<?= base_url('contact/submit') ?>" method="post">
                        <?= csrf_field() ?>
                        <div class="mb-3">
                            <label><i class="fas fa-user-graduate"></i> Full name <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" placeholder="Arjun Raj" required>
                        </div>
                        <div class="mb-3">
                            <label><i class="fas fa-envelope"></i> Email address <span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control" placeholder="student@example.com" required>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 mb-3">
                                <label><i class="fas fa-phone"></i> Phone</label>
                                <input type="tel" name="phone" class="form-control" placeholder="+91 98765 43210">
                            </div>
                            <div class="col-sm-6 mb-3">
                                <label><i class="fas fa-graduation-cap"></i> Interested in</label>
                                <select name="interest" class="form-select">
                                    <option value="">-- select --</option>
                                    <option value="NDA foundation">NDA foundation</option>
                                    <option value="CDS / AFCAT">CDS / AFCAT</option>
                                    <option value="SSB interview">SSB interview</option>
                                    <option value="Officers training">Officers training</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label><i class="fas fa-comment"></i> Message / query</label>
                            <textarea name="message" class="form-control" rows="3" placeholder="I want to know more about defence courses..."></textarea>
                        </div>
                        <button type="submit" class="btn btn-cta w-100">
                            <i class="fas fa-paper-plane me-2"></i> Submit enquiry
                        </button>
                    </form>

                    <div class="d-block d-lg-flex d-md-flex align-items-center justify-content-center mt-4">
                        <?php if ($admissionOpen === '1' && $admissionYear !== ''): ?>
                            <span class="badge bg-highlight text-dark px-3 py-2 rounded-pill fw-bold" style="background: var(--highlight);">
                                <i class="fas fa-bolt text-dark me-1"></i> ADMISSION OPEN <?= esc($admissionYear) ?>
                            </span>
                        <?php endif; ?>
                        <?php if ($phone1 !== ''): ?>
                            <p class="ms-2 mt-3 mt-md-0 mt-lg-0 text-secondary-custom"><i class="fas fa-phone"></i> <?= esc($phone1) ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="info-panel">
                    <h2 class="section-title">Get in touch</h2>
                    <div class="subhead-accent mb-4 py-1 px-2">
                        <i class="fas fa-flag-checkered me-2" style="color: var(--cta);"></i> <?= esc($siteName) ?>
                    </div>

                    <div class="detail-item">
                        <div class="info-icon-box"><i class="fas fa-map-pin"></i></div>
                        <div class="detail-text">
                            <h5>HEADQUARTERS</h5>
                            <p><?= esc($address) ?></p>
                        </div>
                    </div>

                    <div class="detail-item">
                        <div class="info-icon-box"><i class="fas fa-phone-alt"></i></div>
                        <div class="detail-text">
                            <h5>HELPLINE (24/7)</h5>
                            <p>
                                <?php if ($phone1 !== ''): ?>
                                    <a href="tel:<?= esc(preg_replace('/\s+/', '', $phone1), 'attr') ?>"><?= esc($phone1) ?></a>
                                <?php endif; ?>
                                <?php if ($phone2 !== ''): ?>
                                    <br><a href="tel:<?= esc(preg_replace('/\s+/', '', $phone2), 'attr') ?>"><?= esc($phone2) ?></a>
                                <?php endif; ?>
                            </p>
                        </div>
                    </div>

                    <div class="detail-item">
                        <div class="info-icon-box"><i class="fas fa-envelope-open-text"></i></div>
                        <div class="detail-text">
                            <h5>OFFICIAL EMAIL</h5>
                            <p>
                                <?php if ($email1 !== ''): ?>
                                    <a href="mailto:<?= esc($email1, 'attr') ?>"><?= esc($email1) ?></a>
                                <?php endif; ?>
                                <?php if ($email2 !== ''): ?>
                                    <br><a href="mailto:<?= esc($email2, 'attr') ?>"><?= esc($email2) ?></a>
                                <?php endif; ?>
                            </p>
                        </div>
                    </div>

                    <div class="my-4">
                        <?php if ($facebookUrl !== ''): ?><a href="<?= esc($facebookUrl, 'attr') ?>" class="social-circle" target="_blank"><i class="fab fa-facebook-f"></i></a><?php endif; ?>
                        <?php if ($instagramUrl !== ''): ?><a href="<?= esc($instagramUrl, 'attr') ?>" class="social-circle" target="_blank"><i class="fab fa-instagram"></i></a><?php endif; ?>
                        <?php if ($youtubeUrl !== ''): ?><a href="<?= esc($youtubeUrl, 'attr') ?>" class="social-circle" target="_blank"><i class="fab fa-youtube"></i></a><?php endif; ?>
                        <?php if ($linkedinUrl !== ''): ?><a href="<?= esc($linkedinUrl, 'attr') ?>" class="social-circle" target="_blank"><i class="fab fa-linkedin-in"></i></a><?php endif; ?>
                    </div>

                    <div class="map-container">
                        <iframe src="https://www.google.com/maps?q=<?= rawurlencode($address) ?>&output=embed" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-3 mt-4">
        <div class="col-md-4">
            <div class="bg-white p-3 rounded-4 d-flex align-items-center shadow-sm">
                <div class="bg-accent bg-opacity-10 p-3 rounded-3 me-3">
                    <i class="fas fa-phone-volume fa-xl" style="color: var(--cta);"></i>
                </div>
                <div>
                    <span class="text-secondary-custom fw-bold">CALL DIRECT</span>
                    <p class="mb-0 fw-semibold">
                        <a href="tel:<?= esc(preg_replace('/\s+/', '', $phone1), 'attr') ?>" class="text-decoration-none text-dark"><?= esc($phone1) ?></a>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="bg-white p-3 rounded-4 d-flex align-items-center shadow-sm">
                <div class="bg-accent bg-opacity-10 p-3 rounded-3 me-3">
                    <i class="fab fa-whatsapp fa-xl" style="color: var(--accent);"></i>
                </div>
                <div>
                    <span class="text-secondary-custom fw-bold">WHATSAPP</span>
                    <p class="mb-0 fw-semibold">
                        <a href="https://wa.me/<?= esc(preg_replace('/[^0-9]/', '', $primaryWhatsapp), 'attr') ?>" class="text-decoration-none text-dark"><?= esc($primaryWhatsapp) ?></a>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="bg-white p-3 rounded-4 d-flex align-items-center shadow-sm">
                <div class="bg-accent bg-opacity-10 p-3 rounded-3 me-3">
                    <i class="fas fa-calendar-check fa-xl" style="color: var(--primary-colour);"></i>
                </div>
                <div>
                    <span class="text-secondary-custom fw-bold">EMAIL US</span>
                    <p class="mb-0 fw-semibold">
                        <a href="mailto:<?= esc($email1, 'attr') ?>" class="text-decoration-none text-dark"><?= esc($email1) ?></a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
