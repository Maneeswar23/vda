<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($pageTitle) ? esc($pageTitle) . ' — ' : '' ?>VDA Admin Panel</title>

    <!-- Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Admin CSS -->
    <link rel="stylesheet" href="<?= base_url('public/admin/css/admin.css') ?>">

    <?= $this->renderSection('styles') ?>
</head>
<body>

<!-- ═══════════════════════════════════════════════
     SIDEBAR
═══════════════════════════════════════════════ -->
<div class="vda-sidebar" id="vdaSidebar">

    <!-- Sidebar Brand -->
    <div class="sidebar-brand">
        <div class="brand-logo">
            <div class="brand-line1">VISAKHA</div>
            <div class="brand-line2">DEFENCE ACADEMY</div>
            <div class="brand-line3">Admin Panel</div>
        </div>
        <button class="sidebar-close-btn d-lg-none" id="sidebarClose">
            <i class="fas fa-times"></i>
        </button>
    </div>

    <!-- Admin Info -->
    <div class="sidebar-admin-info">
        <div class="admin-avatar">
            <i class="fas fa-user-shield"></i>
        </div>
        <div class="admin-details">
            <span class="admin-name"><?= session()->get('admin_username') ?? 'Admin' ?></span>
            <span class="admin-role">Administrator</span>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="sidebar-nav">

        <!-- Dashboard -->
        <div class="nav-section-label">Main</div>
        <a href="<?= base_url('admin/dashboard') ?>" class="nav-item <?= (uri_string() === 'admin/dashboard' || uri_string() === 'admin') ? 'active' : '' ?>">
            <i class="fas fa-tachometer-alt nav-icon"></i>
            <span>Dashboard</span>
        </a>

        <!-- Homepage -->
        <div class="nav-section-label">Content</div>
        <div class="nav-group <?= str_starts_with(uri_string(), 'admin/homepage') ? 'open' : '' ?>">
            <div class="nav-group-toggle" onclick="toggleNavGroup(this)">
                <div class="nav-item-inner">
                    <i class="fas fa-home nav-icon"></i>
                    <a href="<?= base_url('admin/homepage') ?>"><span>Home page</span></a>
                </div>
                <i class="fas fa-chevron-down nav-arrow"></i>
            </div>
            <div class="nav-group-children">
                <a href="<?= base_url('admin/homepage/banners') ?>" class="nav-child <?= str_starts_with(uri_string(), 'admin/homepage/banner') ? 'active' : '' ?>">
                    <i class="fas fa-images"></i> Banners
                </a>
                <a href="<?= base_url('admin/homepage/stats') ?>" class="nav-child <?= str_starts_with(uri_string(), 'admin/homepage/stats') ? 'active' : '' ?>">
                    <i class="fas fa-chart-bar"></i> Stats
                </a>
                <a href="<?= base_url('admin/homepage/about') ?>" class="nav-child <?= str_starts_with(uri_string(), 'admin/homepage/about') ? 'active' : '' ?>">
                    <i class="fas fa-align-left"></i> About Section
                </a>
            </div>
        </div>

        <!-- About -->
        <a href="<?= base_url('admin/about') ?>" class="nav-item <?= str_starts_with(uri_string(), 'admin/about') ? 'active' : '' ?>">
            <i class="fas fa-info-circle nav-icon"></i>
            <span>About Page</span>
        </a>

        <!-- Facilities -->
        <a href="<?= base_url('admin/facilities') ?>" class="nav-item <?= str_starts_with(uri_string(), 'admin/facilities') ? 'active' : '' ?>">
            <i class="fas fa-building nav-icon"></i>
            <span>Facilities</span>
        </a>

        <!-- Courses -->
        <a href="<?= base_url('admin/courses') ?>" class="nav-item <?= str_starts_with(uri_string(), 'admin/courses') ? 'active' : '' ?>">
            <i class="fas fa-graduation-cap nav-icon"></i>
            <span>Courses</span>
        </a>

        <!-- Eligibility -->
        <a href="<?= base_url('admin/eligibility') ?>" class="nav-item <?= str_starts_with(uri_string(), 'admin/eligibility') ? 'active' : '' ?>">
            <i class="fas fa-clipboard-check nav-icon"></i>
            <span>Eligibility</span>
        </a>

        <!-- Job Selections -->
        <a href="<?= base_url('admin/job-selections') ?>" class="nav-item <?= str_starts_with(uri_string(), 'admin/job-selections') ? 'active' : '' ?>">
            <i class="fas fa-briefcase nav-icon"></i>
            <span>Job Selections</span>
        </a>

        <!-- Medical Counselling -->
        <a href="<?= base_url('admin/medical-counselling') ?>" class="nav-item <?= str_starts_with(uri_string(), 'admin/medical-counselling') ? 'active' : '' ?>">
            <i class="fas fa-stethoscope nav-icon"></i>
            <span>Medical Counselling</span>
        </a>

        <!-- Gallery -->
        <div class="nav-group <?= str_starts_with(uri_string(), 'admin/gallery') ? 'open' : '' ?>">
            <div class="nav-group-toggle" onclick="toggleNavGroup(this)">
                <div class="nav-item-inner">
                    <i class="fas fa-photo-film nav-icon"></i>
                    <span>Gallery</span>
                </div>
                <i class="fas fa-chevron-down nav-arrow"></i>
            </div>
            <div class="nav-group-children">
                <a href="<?= base_url('admin/gallery/photos') ?>" class="nav-child <?= str_starts_with(uri_string(), 'admin/gallery/photos') ? 'active' : '' ?>">
                    <i class="fas fa-images"></i> Photos
                </a>
                <a href="<?= base_url('admin/gallery/videos') ?>" class="nav-child <?= str_starts_with(uri_string(), 'admin/gallery/videos') ? 'active' : '' ?>">
                    <i class="fas fa-video"></i> Videos
                </a>
            </div>
        </div>

        <!-- FAQ -->
        <a href="<?= base_url('admin/faq') ?>" class="nav-item <?= str_starts_with(uri_string(), 'admin/faq') ? 'active' : '' ?>">
            <i class="fas fa-question-circle nav-icon"></i>
            <span>FAQ</span>
        </a>

        <!-- Contact Enquiries -->
        <a href="<?= base_url('admin/contact') ?>" class="nav-item <?= str_starts_with(uri_string(), 'admin/contact') ? 'active' : '' ?>">
            <i class="fas fa-envelope nav-icon"></i>
            <span>Enquiries</span>
            <?php
                // Show unread badge if count available
                if (isset($unreadCount) && $unreadCount > 0):
            ?>
            <span class="nav-badge"><?= $unreadCount ?></span>
            <?php endif; ?>
        </a>

        <!-- Settings -->
        <div class="nav-section-label">System</div>
        <a href="<?= base_url('admin/settings') ?>" class="nav-item <?= str_starts_with(uri_string(), 'admin/settings') ? 'active' : '' ?>">
            <i class="fas fa-cog nav-icon"></i>
            <span>Settings</span>
        </a>

        <!-- Logout -->
        <a href="<?= base_url('admin/logout') ?>" class="nav-item nav-logout"
           onclick="return confirm('Are you sure you want to logout?')">
            <i class="fas fa-sign-out-alt nav-icon"></i>
            <span>Logout</span>
        </a>

    </nav>
</div>
<!-- Sidebar Overlay (mobile) -->
<div class="sidebar-overlay" id="sidebarOverlay" onclick="closeSidebar()"></div>

<!-- ═══════════════════════════════════════════════
     MAIN CONTENT AREA
═══════════════════════════════════════════════ -->
<div class="vda-main" id="vdaMain">

    <!-- ── TOPBAR ── -->
    <div class="vda-topbar">
        <div class="topbar-left">
            <button class="sidebar-toggle-btn" id="sidebarToggle" onclick="toggleSidebar()">
                <i class="fas fa-bars"></i>
            </button>
            <?php if (isset($pageTitle)): ?>
            <div class="topbar-breadcrumb">
                <span class="breadcrumb-page"><?= esc($pageTitle) ?></span>
            </div>
            <?php endif; ?>
        </div>
        <div class="topbar-right">
            <a href="<?= base_url('/') ?>" target="_blank" class="topbar-action-btn" title="View Site">
                <i class="fas fa-external-link-alt"></i>
                <span class="d-none d-md-inline ms-1">View Site</span>
            </a>
            <div class="topbar-admin-dropdown">
                <button class="topbar-admin-btn" onclick="toggleAdminDropdown()">
                    <div class="topbar-avatar">
                        <i class="fas fa-user-shield"></i>
                    </div>
                    <span class="d-none d-md-inline"><?= session()->get('admin_username') ?? 'Admin' ?></span>
                    <i class="fas fa-chevron-down ms-1" style="font-size:11px;"></i>
                </button>
                <div class="admin-dropdown-menu" id="adminDropdownMenu">
                    <div class="dropdown-header">
                        <strong><?= session()->get('admin_username') ?? 'Admin' ?></strong>
                        <small><?= session()->get('admin_email') ?? '' ?></small>
                    </div>
                    <div class="dropdown-divider"></div>
                    <a href="<?= base_url('admin/settings') ?>" class="dropdown-item-link">
                        <i class="fas fa-cog me-2"></i> Settings
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="<?= base_url('admin/logout') ?>"
                       class="dropdown-item-link text-danger"
                       onclick="return confirm('Logout?')">
                        <i class="fas fa-sign-out-alt me-2"></i> Logout
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- ── PAGE CONTENT ── -->
    <div class="vda-content">

        <!-- Flash Alerts -->
        <?= view('admin/partials/alerts') ?>

        <!-- Page Content -->
        <?= $this->renderSection('content') ?>

    </div>

    <!-- ── FOOTER ── -->
    <div class="vda-footer">
        <span>&copy; <?= date('Y') ?> Visakha Defence Academy. All rights reserved.</span>
        <span>Admin Panel v1.0</span>
    </div>

</div><!-- /vda-main -->

<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<!-- Admin JS -->
<script src="<?= base_url('public/admin/js/admin.js') ?>"></script>

<?= $this->renderSection('scripts') ?>

</body>
</html>
