<?php include 'includes/header.php'; ?>

<?php
$course = $course ?? [];
$courseDetail = $courseDetail ?? [];
$courseImage = $courseImage ?? '';
$phoneNumber = $phoneNumber ?? '';
$siteName = $siteName ?? 'Visakha Defence Academy';

$clean = static function ($value): string {
    return trim(strip_tags((string) $value));
};

$decodeJson = static function ($value) use ($clean): array {
    $text = $clean($value);
    if ($text === '') {
        return [];
    }

    $decoded = json_decode($text, true);
    return is_array($decoded) ? $decoded : [];
};

$splitText = static function ($value) use ($clean): array {
    $text = $clean($value);
    if ($text === '') {
        return [];
    }

    $parts = preg_split('/\r\n|\r|\n|,/', $text);
    $parts = array_map($clean, $parts);
    return array_values(array_filter($parts, static fn ($item) => $item !== ''));
};

$title = $clean($course['title'] ?? 'Course');
$description = $clean($course['description'] ?? '');
$tagline = $clean($courseDetail['hero_tagline'] ?? '');
$quote = $clean($courseDetail['hero_quote'] ?? '');
$ssbMarks = $clean($courseDetail['ssb_marks'] ?? '');
$totalMarks = $clean($courseDetail['total_marks'] ?? '');

$eligibilityItems = [];
$eligibilityData = $decodeJson($courseDetail['eligibility'] ?? '');
if (!empty($eligibilityData)) {
    foreach ($eligibilityData as $key => $value) {
        $value = $clean($value);
        if ($value === '') {
            continue;
        }

        $label = is_string($key) ? ucwords(str_replace('_', ' ', $key)) : '';
        $eligibilityItems[] = [
            'label' => $label,
            'value' => $value,
        ];
    }
} else {
    foreach ($splitText($courseDetail['eligibility'] ?? '') as $line) {
        $eligibilityItems[] = [
            'label' => '',
            'value' => $line,
        ];
    }
}

$selectionStages = [];
$selectionData = $decodeJson($courseDetail['selection_procedure'] ?? '');
if (!empty($selectionData)) {
    foreach ($selectionData as $index => $item) {
        if (!is_array($item)) {
            $itemText = $clean($item);
            if ($itemText !== '') {
                $selectionStages[] = [
                    'stage' => 'Stage ' . ($index + 1),
                    'detail' => $itemText,
                ];
            }
            continue;
        }

        $stage = $clean($item['stage'] ?? ('Stage ' . ($index + 1)));
        $detail = $clean($item['detail'] ?? ($item['description'] ?? ''));
        if ($stage === '' && $detail === '') {
            continue;
        }

        $selectionStages[] = [
            'stage' => $stage !== '' ? $stage : 'Stage ' . ($index + 1),
            'detail' => $detail,
        ];
    }
} else {
    foreach ($splitText($courseDetail['selection_procedure'] ?? '') as $index => $line) {
        $selectionStages[] = [
            'stage' => 'Stage ' . ($index + 1),
            'detail' => $line,
        ];
    }
}

$vacancyItems = [];
$vacancyData = $decodeJson($courseDetail['vacancies'] ?? '');
if (!empty($vacancyData)) {
    foreach ($vacancyData as $item) {
        if (!is_array($item)) {
            continue;
        }

        $branch = $clean($item['branch'] ?? ($item['name'] ?? ''));
        $seats = $clean($item['seats'] ?? ($item['count'] ?? ''));
        if ($branch === '' && $seats === '') {
            continue;
        }

        $vacancyItems[] = [
            'branch' => $branch,
            'seats' => $seats,
        ];
    }
}

$examRows = [];
$examSchemeData = $decodeJson($courseDetail['exam_scheme'] ?? '');
if (!empty($examSchemeData)) {
    foreach ($examSchemeData as $item) {
        if (!is_array($item)) {
            continue;
        }

        $subject = $clean($item['subject'] ?? '');
        $code = $clean($item['code'] ?? '');
        $duration = $clean($item['duration'] ?? '');
        $maxMarks = $clean($item['max_marks'] ?? ($item['marks'] ?? ''));

        if ($subject === '' && $code === '' && $duration === '' && $maxMarks === '') {
            continue;
        }

        $examRows[] = [
            'subject' => $subject,
            'code' => $code,
            'duration' => $duration,
            'max_marks' => $maxMarks,
        ];
    }
}

$examCentres = [];
$examCentresData = $decodeJson($courseDetail['exam_centres'] ?? '');
if (!empty($examCentresData)) {
    foreach ($examCentresData as $item) {
        $item = $clean($item);
        if ($item !== '') {
            $examCentres[] = $item;
        }
    }
} else {
    $examCentres = $splitText($courseDetail['exam_centres'] ?? '');
}
?>

<section class="hero-about-section">
    <div class="hero-overlay"></div>
    <div class="hero-content">
        <h1 class="about-heading"><?= esc($title) ?></h1>
    </div>
</section>

<div class="course-wrapper">
    <div class="logo-block text-center text-md-start mt-5">
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

    <div class="hero-new">
        <div class="hero-content">
            <h2><?= esc($title) ?></h2>

            <?php if ($tagline !== ''): ?>
                <div class="hero-tagline">
                    <i class="fas fa-crown me-2" style="color: var(--cta);"></i>
                    <?= esc($tagline) ?>
                </div>
            <?php endif; ?>

            <?php if ($quote !== ''): ?>
                <p class="text-muted fs-5"><?= esc($quote) ?></p>
            <?php elseif ($description !== ''): ?>
                <p class="text-muted fs-5"><?= esc($description) ?></p>
            <?php endif; ?>
        </div>

        <?php if ($courseImage !== ''): ?>
            <div class="hero-image-new">
                <img src="<?= esc($courseImage, 'attr') ?>" alt="<?= esc($title, 'attr') ?>">
            </div>
        <?php endif; ?>
    </div>

    <?php if (!empty($eligibilityItems)): ?>
        <div class="glass-card mb-4">
            <div class="card-header-new">
                <h3 class="directors-mesg-section__heading">Eligibility Criteria</h3>
            </div>
            <div class="row">
                <?php $splitIndex = (int) ceil(count($eligibilityItems) / 2); ?>
                <div class="col-md-6">
                    <?php foreach (array_slice($eligibilityItems, 0, $splitIndex) as $item): ?>
                        <div class="d-flex mb-3">
                            <i class="fas fa-check-circle me-3" style="color: var(--accent); font-size: 1.5rem;"></i>
                            <span>
                                <?php if ($item['label'] !== ''): ?>
                                    <strong><?= esc($item['label']) ?>:</strong>
                                <?php endif; ?>
                                <?= esc($item['value']) ?>
                            </span>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="col-md-6">
                    <?php foreach (array_slice($eligibilityItems, $splitIndex) as $item): ?>
                        <div class="d-flex mb-3">
                            <i class="fas fa-check-circle me-3" style="color: var(--accent); font-size: 1.5rem;"></i>
                            <span>
                                <?php if ($item['label'] !== ''): ?>
                                    <strong><?= esc($item['label']) ?>:</strong>
                                <?php endif; ?>
                                <?= esc($item['value']) ?>
                            </span>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <div class="row mb-4">
        <?php if (!empty($selectionStages)): ?>
            <div class="col-md-6">
                <div class="glass-card mb-4">
                    <div class="card-header-new">
                        <h3 class="directors-mesg-section__heading">Selection Procedure</h3>
                    </div>
                    <div class="stages-modern">
                        <?php foreach ($selectionStages as $index => $stage): ?>
                            <div class="stage-modern">
                                <div class="stage-badge"><?= esc((string) ($index + 1)) ?></div>
                                <h5><?= esc($stage['stage']) ?></h5>
                                <p class="small"><?= esc($stage['detail']) ?></p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <?php if (!empty($vacancyItems)): ?>
            <div class="col-md-6">
                <div class="glass-card mb-4">
                    <div class="card-header-new">
                        <h3 class="directors-mesg-section__heading">Vacancies</h3>
                    </div>
                    <div class="vacancy-pills">
                        <?php foreach ($vacancyItems as $item): ?>
                            <div class="pill">
                                <span class="number"><?= esc($item['seats']) ?></span><br>
                                <?= esc($item['branch']) ?>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <?php if ($description !== ''): ?>
                        <div class="text-center mt-4 p-3 bg-light rounded-4">
                            <span class="fw-bold fs-5"><?= esc($description) ?></span>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <?php if (!empty($examRows) || $ssbMarks !== '' || $totalMarks !== ''): ?>
        <div class="glass-card mb-4">
            <h3 class="directors-mesg-section__heading">Scheme of Examination</h3>

            <?php if (!empty($examRows)): ?>
                <div class="table-responsive">
                    <table class="table-new">
                        <thead>
                            <tr>
                                <th>Subject</th>
                                <th>Code</th>
                                <th>Duration</th>
                                <th>Max Marks</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($examRows as $row): ?>
                                <tr>
                                    <td><strong><?= esc($row['subject']) ?></strong></td>
                                    <td><?= esc($row['code']) ?></td>
                                    <td><?= esc($row['duration']) ?></td>
                                    <td><?= esc($row['max_marks']) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>

            <?php if ($ssbMarks !== '' || $totalMarks !== ''): ?>
                <div class="d-flex justify-content-between align-items-center mt-4 flex-wrap">
                    <?php if ($totalMarks !== ''): ?>
                        <span class="total-box"><i class="fas fa-star me-2"></i>Total: <?= esc($totalMarks) ?></span>
                    <?php endif; ?>
                    <?php if ($ssbMarks !== ''): ?>
                        <span class="fs-5 fw-semibold" style="color: var(--primary-colour);">
                            <i class="fas fa-microphone-alt me-2" style="color: var(--cta);"></i>
                            SSB Test Interview: <?= esc($ssbMarks) ?> Marks
                        </span>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($examCentres)): ?>
        <div class="glass-card mb-4">
            <div class="card-header-new">
                <h3 class="directors-mesg-section__heading">Exam Centres</h3>
            </div>
            <div class="centres-grid">
                <?php foreach ($examCentres as $centre): ?>
                    <span class="centre-chip"><i class="fas fa-location-dot"></i> <?= esc($centre) ?></span>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>

    <div class="fly-high-new">
        <h3><i class="fas fa-plane-departure"></i> JOIN TO FLY HIGH <i class="fas fa-plane-arrival"></i></h3>
    </div>

    <div class="text-center my-5">
        <button onclick="window.location.href='<?= base_url('contact') ?>'" class="btn-new">
            <i class="fas fa-paper-plane me-2"></i> APPLY NOW
        </button>

        <?php if ($phoneNumber !== ''): ?>
            <p class="mt-4">
                <a href="tel:<?= esc(preg_replace('/\s+/', '', $phoneNumber), 'attr') ?>" class="text-decoration-none text-dark">
                    <i class="fas fa-phone-alt me-2" style="color: var(--accent);"></i> <?= esc($phoneNumber) ?>
                </a>
            </p>
        <?php endif; ?>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
