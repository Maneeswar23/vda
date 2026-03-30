<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// ================= FRONTEND ROUTES =================
$routes->get('/', 'Home::index');
$routes->get('about', 'Home::about');
$routes->get('contact', 'Home::contact');
$routes->post('contact/submit', 'Home::contactSubmit');
$routes->get('course', 'Home::course');
$routes->get('course-view', 'Home::courseView');
$routes->get('course-view/(:num)', 'Home::courseView/$1');
$routes->get('eligibility-conditions', 'Home::eligibility');
$routes->get('facilities', 'Home::facilities');
$routes->get('faq', 'Home::faq');
$routes->get('job-selections', 'Home::jobSelections');
$routes->get('medical-counselling', 'Home::medicalCounselling');
$routes->get('photo-gallery', 'Home::photoGallery');
$routes->get('video-gallery', 'Home::videoGallery');
$routes->get('privacy-policy', 'Home::privacyPolicy');
$routes->get('terms-conditions', 'Home::termsConditions');

// ================= ADMIN AUTH ROUTES =================
$routes->get('admin/login', 'Admin\AuthController::login');
$routes->post('admin/login', 'Admin\AuthController::loginPost');
$routes->get('admin/logout', 'Admin\AuthController::logout');

// ================= ADMIN PROTECTED ROUTES =================
$routes->group('admin', ['filter' => 'adminauth'], function ($routes) {

    // Dashboard
    $routes->get('/', 'Admin\DashboardController::index');
    $routes->get('dashboard', 'Admin\DashboardController::index');

    // ---- Homepage ----
    $routes->get('homepage', 'Admin\HomePageController::index');

    // Banners
    $routes->get('homepage/banners', 'Admin\HomePageController::banners');
    $routes->get('homepage/banner/add', 'Admin\HomePageController::bannerAdd');
    $routes->post('homepage/banner/store', 'Admin\HomePageController::bannerStore');
    $routes->get('homepage/banner/edit/(:num)', 'Admin\HomePageController::bannerEdit/$1');
    $routes->post('homepage/banner/update/(:num)', 'Admin\HomePageController::bannerUpdate/$1');
    $routes->get('homepage/banner/delete/(:num)', 'Admin\HomePageController::bannerDelete/$1');
    $routes->post('homepage/banner/sort', 'Admin\HomePageController::bannerSort');

    // Stats
    $routes->get('homepage/stats', 'Admin\HomePageController::stats');
    $routes->post('homepage/stats/store', 'Admin\HomePageController::statsStore');
    $routes->get('homepage/stats/delete/(:num)', 'Admin\HomePageController::statsDelete/$1');

    // Homepage About Section
    $routes->get('homepage/about', 'Admin\HomePageController::about');
    $routes->post('homepage/about/update', 'Admin\HomePageController::aboutUpdate');

    // ---- About Page ----
    $routes->get('about', 'Admin\AboutController::index');
    $routes->post('about/update/(:any)', 'Admin\AboutController::update/$1');
    $routes->get('about/director/add', 'Admin\AboutController::addDirector');
    $routes->get('about/director/delete/(:num)', 'Admin\AboutController::deleteDirector/$1');
    $routes->get('about/team/add', 'Admin\AboutController::addTeam');
    $routes->get('about/team/delete/(:num)', 'Admin\AboutController::deleteTeam/$1');

    // ---- Facilities ----
    $routes->get('facilities', 'Admin\FacilitiesController::index');
    $routes->get('facilities/add', 'Admin\FacilitiesController::add');
    $routes->post('facilities/store', 'Admin\FacilitiesController::store');
    $routes->get('facilities/edit/(:num)', 'Admin\FacilitiesController::edit/$1');
    $routes->post('facilities/update/(:num)', 'Admin\FacilitiesController::update/$1');
    $routes->get('facilities/delete/(:num)', 'Admin\FacilitiesController::delete/$1');
    $routes->get('facilities/toggle/(:num)', 'Admin\FacilitiesController::toggleStatus/$1');
    $routes->post('facilities/sort', 'Admin\FacilitiesController::sort');
    $routes->get('facilities/highlight/add', 'Admin\FacilitiesController::addHighlight');
    $routes->post('facilities/highlight/update', 'Admin\FacilitiesController::updateHighlight');
    $routes->get('facilities/highlight/delete/(:num)', 'Admin\FacilitiesController::deleteHighlight/$1');

    // ---- Eligibility ----
    $routes->get('eligibility', 'Admin\EligibilityController::index');
    $routes->post('eligibility/update', 'Admin\EligibilityController::update');

    // ---- Job Selections ----
    $routes->get('job-selections', 'Admin\JobSelectionsController::index');
    $routes->post('job-selections/update', 'Admin\JobSelectionsController::update');

    // ---- Medical Counselling ----
    $routes->get('medical-counselling', 'Admin\MedicalCounsellingController::index');
    $routes->post('medical-counselling/update', 'Admin\MedicalCounsellingController::update');

    // ---- Gallery Photos ----
    $routes->get('gallery', 'Admin\GalleryController::index');
    $routes->get('gallery/photos', 'Admin\GalleryController::photos');
    $routes->post('gallery/photos/upload', 'Admin\GalleryController::photoUpload');
    $routes->post('gallery/photos/update/(:num)', 'Admin\GalleryController::photoUpdate/$1');
    $routes->get('gallery/photos/delete/(:num)', 'Admin\GalleryController::photoDelete/$1');
    $routes->post('gallery/photos/sort', 'Admin\GalleryController::photoSort');

    // ---- Gallery Videos ----
    $routes->get('gallery/videos', 'Admin\GalleryController::videos');
    $routes->post('gallery/videos/store', 'Admin\GalleryController::videoStore');
    $routes->get('gallery/videos/edit/(:num)', 'Admin\GalleryController::videoEdit/$1');
    $routes->post('gallery/videos/update/(:num)', 'Admin\GalleryController::videoUpdate/$1');
    $routes->get('gallery/videos/delete/(:num)', 'Admin\GalleryController::videoDelete/$1');
    $routes->post('gallery/videos/sort', 'Admin\GalleryController::videoSort');

    // ---- FAQ ----
    $routes->get('faq', 'Admin\FaqController::index');
    $routes->get('faq/add', 'Admin\FaqController::add');
    $routes->post('faq/store', 'Admin\FaqController::store');
    $routes->get('faq/edit/(:num)', 'Admin\FaqController::edit/$1');
    $routes->post('faq/update/(:num)', 'Admin\FaqController::update/$1');
    $routes->get('faq/delete/(:num)', 'Admin\FaqController::delete/$1');
    $routes->post('faq/sort', 'Admin\FaqController::sort');

    // ---- Courses ----
    $routes->get('courses', 'Admin\CourseController::index');
    $routes->get('courses/add', 'Admin\CourseController::add');
    $routes->post('courses/store', 'Admin\CourseController::store');
    $routes->get('courses/edit/(:num)', 'Admin\CourseController::edit/$1');
    $routes->post('courses/update/(:num)', 'Admin\CourseController::update/$1');
    $routes->get('courses/delete/(:num)', 'Admin\CourseController::delete/$1');
    $routes->get('courses/detail/(:num)', 'Admin\CourseController::detail/$1');
    $routes->post('courses/detail/update/(:num)', 'Admin\CourseController::detailUpdate/$1');
    $routes->post('courses/sort', 'Admin\CourseController::sort');

    // ---- Contact Enquiries ----
    $routes->get('contact', 'Admin\ContactController::index');
    $routes->get('contact/view/(:num)', 'Admin\ContactController::view/$1');
    $routes->get('contact/delete/(:num)', 'Admin\ContactController::delete/$1');
    $routes->get('contact/mark-read/(:num)', 'Admin\ContactController::markRead/$1');

    // ---- Settings ----
    $routes->get('settings', 'Admin\SettingsController::index');
    $routes->post('settings/update', 'Admin\SettingsController::update');
});
