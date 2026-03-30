<?= $this->extend('admin/layouts/main') ?>
<?= $this->section('content') ?>

<!-- Page Header -->
<div class="page-header">
    <div class="page-header-left">
        <h1><i class="fas fa-tachometer-alt me-2" style="color:var(--adm-primary);"></i>Dashboard</h1>
        <p>Welcome back, <strong><?= session()->get('admin_username') ?></strong>! Here's what's happening today.</p>
    </div>
    <div>
        <a href="<?= base_url('/') ?>" target="_blank" class="btn-vda btn-vda-outline">
            <i class="fas fa-external-link-alt"></i> View Website
        </a>
    </div>
</div>

<!-- ── Stat Cards ── -->
<div class="stat-cards-row">

    <div class="stat-card blue">
        <div class="stat-icon"><i class="fas fa-images"></i></div>
        <div class="stat-info">
            <div class="stat-number"><?= $totalBanners ?></div>
            <div class="stat-label">Banners</div>
        </div>
    </div>

    <div class="stat-card green">
        <div class="stat-icon"><i class="fas fa-graduation-cap"></i></div>
        <div class="stat-info">
            <div class="stat-number"><?= $totalCourses ?></div>
            <div class="stat-label">Courses</div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon"><i class="fas fa-building"></i></div>
        <div class="stat-info">
            <div class="stat-number"><?= $totalFacilities ?></div>
            <div class="stat-label">Facilities</div>
        </div>
    </div>

    <div class="stat-card yellow">
        <div class="stat-icon"><i class="fas fa-question-circle"></i></div>
        <div class="stat-info">
            <div class="stat-number"><?= $totalFaqs ?></div>
            <div class="stat-label">FAQs</div>
        </div>
    </div>

    <div class="stat-card blue">
        <div class="stat-icon"><i class="fas fa-camera"></i></div>
        <div class="stat-info">
            <div class="stat-number"><?= $totalPhotos ?></div>
            <div class="stat-label">Photos</div>
        </div>
    </div>

    <div class="stat-card green">
        <div class="stat-icon"><i class="fas fa-video"></i></div>
        <div class="stat-info">
            <div class="stat-number"><?= $totalVideos ?></div>
            <div class="stat-label">Videos</div>
        </div>
    </div>

    <div class="stat-card orange">
        <div class="stat-icon"><i class="fas fa-envelope"></i></div>
        <div class="stat-info">
            <div class="stat-number"><?= $totalEnquiries ?></div>
            <div class="stat-label">Total Enquiries</div>
        </div>
    </div>

    <div class="stat-card red">
        <div class="stat-icon"><i class="fas fa-envelope-open"></i></div>
        <div class="stat-info">
            <div class="stat-number"><?= $unreadEnquiries ?></div>
            <div class="stat-label">Unread Enquiries</div>
        </div>
    </div>

</div>

<!-- ── Bottom Row ── -->
<div class="row g-4">

    <!-- Recent Enquiries -->
    <div class="col-lg-7">
        <div class="vda-card">
            <div class="vda-card-header">
                <div class="vda-card-title">
                    <i class="fas fa-envelope"></i> Recent Enquiries
                </div>
                <a href="<?= base_url('admin/contact') ?>" class="btn-vda btn-vda-secondary btn-sm">
                    View All
                </a>
            </div>
            <div class="vda-table-wrap">
                <?php if (!empty($recentEnquiries)): ?>
                <table class="vda-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Interest</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($recentEnquiries as $enq): ?>
                        <tr class="<?= !$enq['is_read'] ? 'enquiry-unread' : '' ?>">
                            <td><?= esc($enq['name']) ?></td>
                            <td><?= esc($enq['phone'] ?? '—') ?></td>
                            <td><?= esc($enq['interest'] ?? '—') ?></td>
                            <td style="white-space:nowrap; color:var(--adm-text-muted); font-size:12px;">
                                <?= date('d M Y', strtotime($enq['created_at'])) ?>
                            </td>
                            <td>
                                <?php if (!$enq['is_read']): ?>
                                    <span class="vda-badge vda-badge-danger">New</span>
                                <?php else: ?>
                                    <span class="vda-badge vda-badge-gray">Read</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="<?= base_url('admin/contact/view/' . $enq['id']) ?>"
                                   class="btn-vda btn-vda-primary btn-sm">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?php else: ?>
                <div class="empty-state">
                    <i class="fas fa-inbox"></i>
                    <h4>No enquiries yet</h4>
                    <p>Contact form submissions will appear here.</p>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Quick Links -->
    <div class="col-lg-5">
        <div class="vda-card">
            <div class="vda-card-header">
                <div class="vda-card-title">
                    <i class="fas fa-bolt"></i> Quick Links
                </div>
            </div>
            <div class="vda-card-body">
                <div class="quick-links-grid">

                    <a href="<?= base_url('admin/homepage/banners') ?>" class="quick-link-item">
                        <i class="fas fa-images" style="color:var(--adm-primary);"></i>
                        Banners
                    </a>

                    <a href="<?= base_url('admin/homepage/stats') ?>" class="quick-link-item">
                        <i class="fas fa-chart-bar" style="color:var(--adm-secondary);"></i>
                        Stats
                    </a>

                    <a href="<?= base_url('admin/about') ?>" class="quick-link-item">
                        <i class="fas fa-info-circle" style="color:var(--adm-accent);"></i>
                        About
                    </a>

                    <a href="<?= base_url('admin/courses') ?>" class="quick-link-item">
                        <i class="fas fa-graduation-cap" style="color:var(--adm-cta);"></i>
                        Courses
                    </a>

                    <a href="<?= base_url('admin/facilities') ?>" class="quick-link-item">
                        <i class="fas fa-building" style="color:var(--adm-primary);"></i>
                        Facilities
                    </a>

                    <a href="<?= base_url('admin/faq') ?>" class="quick-link-item">
                        <i class="fas fa-question-circle" style="color:var(--adm-secondary);"></i>
                        FAQ
                    </a>

                    <a href="<?= base_url('admin/gallery/photos') ?>" class="quick-link-item">
                        <i class="fas fa-camera" style="color:var(--adm-accent);"></i>
                        Photos
                    </a>

                    <a href="<?= base_url('admin/gallery/videos') ?>" class="quick-link-item">
                        <i class="fas fa-video" style="color:var(--adm-cta);"></i>
                        Videos
                    </a>

                    <a href="<?= base_url('admin/eligibility') ?>" class="quick-link-item">
                        <i class="fas fa-clipboard-check" style="color:var(--adm-primary);"></i>
                        Eligibility
                    </a>

                    <a href="<?= base_url('admin/job-selections') ?>" class="quick-link-item">
                        <i class="fas fa-briefcase" style="color:var(--adm-secondary);"></i>
                        Jobs
                    </a>

                    <a href="<?= base_url('admin/contact') ?>" class="quick-link-item">
                        <i class="fas fa-envelope" style="color:var(--adm-accent);"></i>
                        Enquiries
                    </a>

                    <a href="<?= base_url('admin/settings') ?>" class="quick-link-item">
                        <i class="fas fa-cog" style="color:var(--adm-cta);"></i>
                        Settings
                    </a>

                </div>
            </div>
        </div>

        <!-- System Info -->
        <div class="vda-card mt-4">
            <div class="vda-card-header">
                <div class="vda-card-title">
                    <i class="fas fa-server"></i> System Info
                </div>
            </div>
            <div class="vda-card-body" style="font-size:13px;">
                <div class="d-flex justify-content-between py-2 border-bottom">
                    <span style="color:var(--adm-text-muted);">PHP Version</span>
                    <strong><?= phpversion() ?></strong>
                </div>
                <div class="d-flex justify-content-between py-2 border-bottom">
                    <span style="color:var(--adm-text-muted);">CodeIgniter</span>
                    <strong><?= \CodeIgniter\CodeIgniter::CI_VERSION ?></strong>
                </div>
                <div class="d-flex justify-content-between py-2 border-bottom">
                    <span style="color:var(--adm-text-muted);">Environment</span>
                    <strong><?= ENVIRONMENT ?></strong>
                </div>
                <div class="d-flex justify-content-between py-2">
                    <span style="color:var(--adm-text-muted);">Server Time</span>
                    <strong><?= date('d M Y, h:i A') ?></strong>
                </div>
            </div>
        </div>

    </div>
</div>

<?= $this->endSection() ?>