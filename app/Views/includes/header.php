<!DOCTYPE html>
<html lang="en">

<head>
  <?php
  helper('cms');

  $siteName = strip_tags(cms_setting('site_name'));
  $phone1 = strip_tags(cms_setting('site_phone1'));
  $phone2 = strip_tags(cms_setting('site_phone2'));
  $email1 = strip_tags(cms_setting('site_email1'));
  $email2 = strip_tags(cms_setting('site_email2'));
  $address = strip_tags(cms_setting('site_address'));
  $facebookUrl = trim(cms_setting('facebook_url'));
  $instagramUrl = trim(cms_setting('instagram_url'));
  $youtubeUrl = trim(cms_setting('youtube_url'));
  $linkedinUrl = trim(cms_setting('linkedin_url'));
  $pageTitleValue = trim(strip_tags($pageTitle ?? ''));
  $metaTitle = $pageTitleValue !== '' ? $pageTitleValue : $siteName;
  ?>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?= esc($metaTitle) ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="keywords" content="vishaka-defence-academy" />
  <meta name="description" content="vishaka-defence-academy" />
  <meta name="author" content="" />
  <meta name="description" content="vishaka-defence-academy" />
  <meta
    name="robots"
    content="follow, index, max-snippet:-1, max-video-preview:-1, max-image-preview:large" />
  <link rel="canonical" href="https://vishaka-defence-academy.com" />
  <meta property="og:locale" content="en_US" />
  <meta property="og:type" content="website" />
  <meta property="og:title" content="vishaka-defence-academy" />
  <meta property="og:description" content="vishaka-defence-academy" />
  <meta property="og:url" content="https://vishaka-defence-academy.com" />
  <meta property="og:site_name" content="<?= esc($siteName, 'attr') ?>" />
  <meta property="og:updated_time" content="2021-04-13T14:03:56+00:00" />
  <meta property="og:image" content="img/thumbnail-logo.jpg" />
  <meta property="og:image:secure_url" content="img/thumbnail-logo.jpg" />
  <meta property="og:image:width" content="521" />
  <meta property="og:image:height" content="210" />
  <meta property="og:image:alt" content="Homepage" />
  <meta property="og:image:type" content="image/png" />
  <meta name="twitter:card" content="summary_large_image" />
  <meta name="twitter:title" content="Homepage - vishaka-defence-academy" />
  <meta name="twitter:description" content="vishaka-defence-academy" />
  <meta name="twitter:image" content="img/thumbnail-logo.jpg" />
  <link rel="shortcut icon" type="image/x-icon" href="<?= base_url('public/assets/images/favicon.png') ?>" />
  <link
    href="https://fonts.googleapis.com/css2?family=Noto+Sans+Telugu:wght@400;600;700&display=swap"
    rel="stylesheet" />

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />

  <!-- AOS Animation CSS -->
  <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet" />

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />


  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,400;14..32,500;14..32,600;14..32,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?= base_url('public/assets/css/style.css') ?>" />
  <link rel="stylesheet" href="<?= base_url('public/assets/css/responsive.css') ?>" />
</head>

<body>
  <div class="main-website">
    <!-- Top Bar -->
    <div class="top-bar d-md-block d-none">
      <div class="container">
        <div class="top-bar-content">
          <div class="contact-info">
            <?php if ($phone1 !== ''): ?>
              <a href="tel:<?= esc(preg_replace('/\s+/', '', $phone1), 'attr') ?>">
                <i class="fas fa-phone"></i>
                <?= esc($phone1) ?>
              </a>
            <?php endif; ?>

            <?php if ($phone2 !== ''): ?>
              <a href="tel:<?= esc(preg_replace('/\s+/', '', $phone2), 'attr') ?>">
                <i class="fas fa-phone"></i>
                <?= esc($phone2) ?>
              </a>
            <?php endif; ?>

            <?php if ($email1 !== ''): ?>
              <a href="mailto:<?= esc($email1, 'attr') ?>">
                <i class="fas fa-envelope"></i>
                <?= esc($email1) ?>
              </a>
            <?php endif; ?>

            <?php if ($address !== ''): ?>
              <a href="#">
                <i class="fas fa-map-marker-alt"></i>
                <?= esc($address) ?>
              </a>
            <?php endif; ?>
          </div>
          <div class="social-links">
            <span style="margin-right: 10px">Follow Us:</span>
            <?php if ($facebookUrl !== ''): ?><a href="<?= esc($facebookUrl, 'attr') ?>" target="_blank"><i class="fab fa-facebook-f"></i></a><?php endif; ?>
            <?php if ($instagramUrl !== ''): ?><a href="<?= esc($instagramUrl, 'attr') ?>" target="_blank"><i class="fab fa-instagram"></i></a><?php endif; ?>
            <?php if ($linkedinUrl !== ''): ?><a href="<?= esc($linkedinUrl, 'attr') ?>" target="_blank"><i class="fab fa-linkedin-in"></i></a><?php endif; ?>
            <?php if ($youtubeUrl !== ''): ?><a href="<?= esc($youtubeUrl, 'attr') ?>" target="_blank"><i class="fab fa-youtube"></i></a><?php endif; ?>
          </div>
        </div>
      </div>
    </div>

    <!-- Header -->
    <header>
      <div class="container">
        <div class="header-content">
          <div class="logo">
            <a href="<?= base_url('/') ?>"><img src="<?= base_url('public/assets/images/logo.png') ?>" alt="<?= esc($siteName, 'attr') ?>" /></a>
            <a href="<?= base_url('/') ?>" class="p-2 logo2"><img src="<?= base_url('public/assets/images/logo2.png') ?>" alt="<?= esc($siteName, 'attr') ?>" /></a>
          </div>
          <div class="header-buttons">
            <a href="<?= base_url('medical-counselling') ?>" class="btn">
              <i class="far fa-calendar-alt"></i>
              Medical Counciling
            </a>
            <a href="<?= base_url('public/assets/images/admission-form.pdf') ?>" target="_blank" class="btn">
              <i class="fas fa-user-graduate"></i>
              Admission Form
            </a>
          </div>
        </div>
      </div>
    </header>

    <!-- Navigation -->
    <div class="header-nav-wrapper">
      <div class="container-fluid">
        <!-- Desktop Navigation -->
        <nav class="menuzord default menuzord-responsive d-md-inline-flex justify-content-md-between d-none w-100">
          <ul class="menuzord-menu menuzord-indented scrollable">
            <li class="active">
              <a href="<?= base_url('/') ?>"> <i class="fas fa-home"></i> Home </a>
            </li>
            <li>
              <a href="<?= base_url('about') ?>">
                <i class="fas fa-info-circle"></i> About Us
              </a>
            </li>
            <li>
              <a href="<?= base_url('course') ?>"> <i class="fas fa-book-open"></i> Courses </a>
            </li>
            <li>
              <a href="<?= base_url('facilities') ?>">
                <i class="fas fa-building"></i> Facilities
              </a>
            </li>
            <li>
              <a href="<?= base_url('eligibility-conditions') ?>">
                <i class="fas fa-clipboard-check"></i> Eligibility Conditions
              </a>
            </li>

            <li>
              <a href="<?= base_url('job-selections') ?>">
                <i class="fas fa-clipboard-check"></i> Job Selections
              </a>
            </li>


            <li>
              <a href="#">
                <i class="fas fa-images"></i> Gallery
                <span class="indicator"><i class="fas fa-angle-down"></i></span>
              </a>
              <ul class="dropdown">
                <li>
                  <a href="<?= base_url('photo-gallery') ?>"> <i class="fas fa-camera"></i> Images </a>
                </li>
                <li>
                  <a href="<?= base_url('video-gallery') ?>"> <i class="fas fa-video"></i> Videos </a>
                </li>
              </ul>
            </li>
            <li>
              <a href="<?= base_url('faq') ?>">
                <i class="fas fa-question-circle"></i> Faq's
              </a>
            </li>
            <li>
              <a href="<?= base_url('contact') ?>">
                <i class="fas fa-envelope"></i> Contact Us
              </a>
            </li>
          </ul>
          <div class="pull-right sm-pull-none mb-sm-15 btn-r btn-sm-left">
            <a
              class="btn btn-colored btn-theme-colored2"
              href="<?= base_url('public/assets/images/vda_career_booklet.pdf') ?>" download>
              <i class="fa fa-download" aria-hidden="true"></i> Career Booklet
            </a>
          </div>
        </nav>

        <div class="mobile-logo-menu">
          <div class="logo d-lg-none">
            <a href="<?= base_url('/') ?>">
              <h3><?= esc($siteName) ?></h3>
            </a>
          </div>

          <!-- Mobile Navigation Toggle -->
          <button class="mobile-menu-btn" onclick="toggleMobileMenu()">
            <i class="fas fa-bars"></i>
          </button>
        </div>
      </div>

      <!-- Mobile Navigation -->
      <div class="mobile-nav" id="mobileNav">
        <a href="<?= base_url('/') ?>"><img src="<?= base_url('public/assets/images/logo.png') ?>" style="width: 80%; margin-top: 10px; margin-left: 10px;" alt="<?= esc($siteName, 'attr') ?>" /></a>
        <button class="mobile-nav-close" onclick="toggleMobileMenu()">
          <i class="fas fa-times"></i>
        </button>
        <ul class="menuzord-menu">
          <li class="active">
            <a href="<?= base_url('/') ?>"> <i class="fas fa-home"></i> Home </a>
          </li>
          <li>
            <a href="<?= base_url('about') ?>">
              <i class="fas fa-info-circle"></i> About Us
            </a>
          </li>
          <li>
            <a href="<?= base_url('course') ?>"> <i class="fas fa-book-open"></i> Courses </a>
          </li>
          <li>
            <a href="<?= base_url('facilities') ?>">
              <i class="fas fa-building"></i> Facilities
            </a>
          </li>
          <li>
            <a href="<?= base_url('eligibility-conditions') ?>">
              <i class="fas fa-clipboard-check"></i> Eligibility Conditions
            </a>
          </li>

          <li>
            <a href="<?= base_url('job-selections') ?>">
              <i class="fas fa-clipboard-check"></i> Job Selections
            </a>
          </li>

          <li>
            <a href="#" onclick="toggleMobileDropdown('galleryDropdown')">
              <i class="fas fa-images"></i> Gallery
              <span class="indicator"><i class="fas fa-angle-down"></i></span>
            </a>
            <ul class="dropdown" id="galleryDropdown">
              <li>
                <a href="<?= base_url('photo-gallery') ?>"> <i class="fas fa-camera"></i> Images </a>
              </li>
              <li>
                <a href="<?= base_url('video-gallery') ?>"> <i class="fas fa-video"></i> Videos </a>
              </li>
            </ul>
          </li>
          <li>
            <a href="<?= base_url('faq') ?>"> <i class="fas fa-question-circle"></i> Faq's </a>
          </li>
          <li>
            <a href="<?= base_url('contact') ?>">
              <i class="fas fa-envelope"></i> Contact Us
            </a>
          </li>
        </ul>
        <div class="btn-r" style="padding: 15px 20px">
          <a
            class="btn btn-colored btn-theme-colored2"
            href="<?= base_url('public/assets/images/VDA-Career-booklet-2026.pdf') ?>" download
            style="width: 100%; justify-content: center">
            <i class="fa fa-download" aria-hidden="true"></i> Career Booklet
          </a>
        </div>
      </div>

      <!-- Overlay -->
      <div class="overlay" id="overlay" onclick="toggleMobileMenu()"></div>
    </div>

    <!-- Bootstrap 5 CSS -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
      rel="stylesheet" />

    <!-- Swiper 10 CSS -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />

    <!-- Loader -->
    <div id="loader" class="loader">
      <div class="loader-circle"></div>
      <div class="loader-text">Loading...</div>
    </div>

    <style>
      .loader {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 2rem;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgb(255, 255, 255);
        z-index: 9999;
      }

      .loader-circle {
        width: 50px;
        height: 50px;
        border: 4px solid #f3f3f3;
        border-top: 4px solid #2c5aa0;
        border-radius: 50%;
        animation: spin 1s linear infinite;
      }

      .loader-text {
        margin-top: 1rem;
        color: #2c5aa0;
        font-weight: 600;
        font-size: 1.2rem;
      }

      @keyframes spin {
        0% {
          transform: rotate(0deg);
        }

        100% {
          transform: rotate(360deg);
        }
      }

      /* Hide loader by default */
      #loader {
        display: none;
      }

      /* Your page content */
      .content {
        padding: 2rem;
        text-align: center;
      }
    </style>
    <script>
      // Loader functions
      function showLoader() {
        document.getElementById("loader").style.display = "flex";
      }

      function hideLoader() {
        document.getElementById("loader").style.display = "none";
      }

      function simulateLoading() {
        showLoader();
        setTimeout(() => {
          hideLoader();
          alert("Loading complete!");
        }, 3000);
      }

      // Show loader when page starts loading
      window.addEventListener("load", function() {
        // Uncomment below if you want loader to show on page load
        // showLoader();
        // setTimeout(hideLoader, 2000); // Hide after 2 seconds
      });

      // Optional: Show loader when leaving page
      window.addEventListener("beforeunload", function() {
        showLoader();
      });
    </script>
