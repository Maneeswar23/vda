<?php

namespace App\Controllers;

use App\Models\Admin\AboutContentModel;
use App\Models\Admin\CourseModel;
use App\Models\Admin\FaqModel;
use App\Models\Admin\FacilitiesModel;
use App\Models\Admin\GalleryPhotosModel;
use App\Models\Admin\GalleryVideosModel;
use App\Models\Admin\HomeAboutModel;
use App\Models\Admin\HomeBannerModel;
use App\Models\Admin\HomeStatsModel;
use App\Models\Admin\JobSelectionsModel;
use App\Models\Admin\MedicalCounsellingModel;
use App\Models\Admin\SettingsModel;

class Home extends BaseController
{
    public function index()
    {
        helper(['url', 'form', 'cms']);

        $bannerModel  = new HomeBannerModel();
        $statsModel   = new HomeStatsModel();
        $aboutModel   = new HomeAboutModel();
        $courseModel  = new CourseModel();
        $faqModel     = new FaqModel();
        $facilitiesModel = new FacilitiesModel();
        $photoModel   = new GalleryPhotosModel();
        $videoModel   = new GalleryVideosModel();
        $contentModel = new AboutContentModel();
        $settings     = new SettingsModel();
        $jobModel     = new JobSelectionsModel();
        $medicalModel = new MedicalCounsellingModel();

        $banners            = $bannerModel->getActive();
        $stats              = $statsModel->getAll();
        $homeAbout          = $aboutModel->getRow() ?? [];
        $courses            = $courseModel->getActive();
        $faqs               = $faqModel->getActive();
        $facilities         = $facilitiesModel->getActive();
        $photos             = $photoModel->getActive();
        $videos             = $videoModel->getActive();
        $aboutContent       = $contentModel->getAllKeyed();
        $siteSettings       = $settings->getAllSettings();
        $jobSelection       = $jobModel->getRow() ?? [];
        $medicalCounselling = $medicalModel->getRow() ?? [];

        $aboutSubtitle = $homeAbout['heading'] ?? '';
        $aboutHeading  = $homeAbout['subheading'] ?? '';

        $aboutTextBlocks = [];
        if (!empty($homeAbout['description'])) {
            $aboutTextBlocks = preg_split('/\r\n|\r|\n/', trim($homeAbout['description']));
            $aboutTextBlocks = array_values(array_filter(array_map('trim', $aboutTextBlocks), static function ($item) {
                return $item !== '';
            }));
        }

        $featureItems = [];

        $aboutImage = '';
        if (!empty($homeAbout['image'])) {
            $aboutImage = cms_image_url($homeAbout['image'], 'about');
        }

        $statsList = [];
        foreach (array_slice($stats, 0, 4) as $stat) {
            if (!empty($stat['number']) || !empty($stat['label'])) {
                $statsList[] = $stat;
            }
        }
        foreach ($facilities as &$facility) {
            $facility['features'] = cms_json_decode($facility['features'] ?? '[]');
        }
        unset($facility);

        $faqList   = array_slice($faqs, 0, 5);
        $photoList = array_slice($photos, 0, 8);
        $videoList = array_slice($videos, 0, 8);

        $notifications = [];
        if (($siteSettings['admission_open'] ?? '') === '1') {
            $year = $siteSettings['admission_year'] ?? date('Y');
            $notifications[] = [
                'icon'    => 'fas fa-bullhorn',
                'date'    => 'Admissions ' . $year,
                'title'   => 'Admissions Open for ' . $year,
                'excerpt' => 'Admissions are currently open. Call ' . ($siteSettings['site_phone1'] ?? 'us') . ' to secure your seat.',
            ];
        }
        if (!empty($jobSelection['caption']) || !empty($jobSelection['campus'])) {
            $notifications[] = [
                'icon'    => 'fas fa-trophy',
                'date'    => 'Latest Update',
                'title'   => $jobSelection['caption'] ?? 'Job Selections',
                'excerpt' => !empty($jobSelection['campus']) ? 'Updated selection highlights from ' . $jobSelection['campus'] . '.' : 'Latest student selection highlights are available now.',
            ];
        }
        if (!empty($medicalCounselling['caption']) || !empty($medicalCounselling['campus'])) {
            $notifications[] = [
                'icon'    => 'fas fa-stethoscope',
                'date'    => 'Important Notice',
                'title'   => $medicalCounselling['caption'] ?? 'Medical Counselling Guide',
                'excerpt' => !empty($medicalCounselling['campus']) ? 'Medical counselling information updated for ' . $medicalCounselling['campus'] . '.' : 'Medical counselling guidance has been updated.',
            ];
        }
        foreach (array_slice($courses, 0, 2) as $course) {
            $notifications[] = [
                'icon'    => 'fas fa-book-open',
                'date'    => 'Course Update',
                'title'   => $course['title'] ?? 'Course',
                'excerpt' => cms_truncate($course['description'] ?? 'Explore this course and get complete guidance from our expert faculty.', 120),
            ];
        }
        $recentCards = [];
        if (!empty($jobSelection['caption']) || !empty($jobSelection['campus'])) {
            $recentCards[] = [
                'badge'    => 'Updated',
                'count'    => $siteSettings['admission_year'] ?? date('Y'),
                'label'    => 'batch',
                'title'    => $jobSelection['caption'] ?? 'Job Selections',
                'location' => $jobSelection['campus'] ?? ($siteSettings['site_name'] ?? 'Visakha Defence Academy'),
            ];
        }
        $directors = [];
        for ($i = 1; $i <= 10; $i++) {
            $name        = trim($aboutContent['director_' . $i . '_name']['heading'] ?? '');
            $designation = trim($aboutContent['director_' . $i . '_designation']['heading'] ?? '');
            $message     = trim($aboutContent['director_' . $i . '_description']['description'] ?? '');
            $image       = $aboutContent['director_' . $i . '_image']['image'] ?? '';

            if ($name === '' && $designation === '' && $message === '' && $image === '') {
                continue;
            }

            $primaryName = $name;
            $metaName    = '';
            if ($name !== '' && preg_match('/^(.*?)\s*(\([^)]*\))$/', $name, $matches)) {
                $primaryName = trim($matches[1]);
                $metaName    = trim($matches[2]);
            }

            $directors[] = [
                'name'        => $primaryName,
                'meta'        => $metaName,
                'designation' => $designation,
                'message'     => $message,
                'image'       => $image !== '' ? cms_image_url($image, 'about') : base_url('public/assets/images/director' . $i . '.jpg'),
            ];
        }
        return view('index', [
            'banners'             => $banners,
            'courses'             => $courses,
            'faqList'             => $faqList,
            'facilities'          => $facilities,
            'photoList'           => $photoList,
            'videoList'           => $videoList,
            'aboutSubtitle'       => $aboutSubtitle,
            'aboutHeading'        => $aboutHeading,
            'aboutTextBlocks'     => $aboutTextBlocks,
            'featureItems'        => $featureItems,
            'aboutImage'          => $aboutImage,
            'statsList'           => $statsList,
            'aboutStats'          => array_slice($statsList, 0, 3),
            'enquiryStats'        => array_slice($statsList, 0, 3),
            'notifications'       => $notifications,
            'scrollNotifications' => count($notifications) > 1 ? array_merge($notifications, $notifications) : $notifications,
            'recentCards'         => $recentCards,
            'directors'           => $directors,
            'settings'            => $siteSettings,
            'siteName'            => $siteSettings['site_name'] ?? 'Visakha Defence Academy',
            'facebookUrl'         => $siteSettings['facebook_url'] ?? '#',
            'instagramUrl'        => $siteSettings['instagram_url'] ?? '#',
            'youtubeUrl'          => $siteSettings['youtube_url'] ?? '#',
            'linkedinUrl'         => $siteSettings['linkedin_url'] ?? '#',
        ]);
    }

    public function about()
    {
        helper(['url', 'form', 'cms']);

        $contentModel = new AboutContentModel();
        $siteSettings = (new SettingsModel())->getAllSettings();
        $aboutContent = $contentModel->getAllKeyed();

        $pageTitle = trim($aboutContent['about_main_title']['heading'] ?? '');
        $aboutSubtitle = trim($aboutContent['about_text']['heading'] ?? '');
        $aboutHeading = trim($aboutContent['about_subtitle']['heading'] ?? '');

        $aboutTextBlocks = [];
        if (!empty($aboutContent['about_description']['heading'])) {
            $aboutTextBlocks = preg_split('/\r\n|\r|\n/', trim($aboutContent['about_description']['heading']));
            $aboutTextBlocks = array_values(array_filter(array_map('trim', $aboutTextBlocks), static function ($item) {
                return $item !== '';
            }));
        }
        $featureItems = [];
        for ($i = 1; $i <= 4; $i++) {
            $feature = trim($aboutContent['feature_' . $i]['heading'] ?? '');
            if ($feature !== '') {
                $featureItems[] = $feature;
            }
        }

        $aboutImage = !empty($aboutContent['about_image']['image']) ? cms_image_url($aboutContent['about_image']['image'], 'about') : '';

        $heroImage = !empty($aboutContent['main_image']['image']) ? cms_image_url($aboutContent['main_image']['image'], 'about') : '';

        $aboutStats = [];
        for ($i = 1; $i <= 3; $i++) {
            $number = trim($aboutContent['stat_' . $i]['heading'] ?? '');
            $label = trim($aboutContent['stat_' . $i]['description'] ?? '');
            if ($number !== '' || $label !== '') {
                $aboutStats[] = ['number' => $number, 'label' => $label];
            }
        }
        $ourSectionTitle = trim($aboutContent['our_section_title']['heading'] ?? '');
        $ourSectionSubtitle = trim($aboutContent['our_section_subtitle']['heading'] ?? '');

        $missionTitle = trim($aboutContent['mission_title']['heading'] ?? '');
        $missionDescription = trim($aboutContent['mission_description']['heading'] ?? '');

        $visionTitle = trim($aboutContent['vision_title']['heading'] ?? '');
        $visionDescription = trim($aboutContent['vision_description']['heading'] ?? '');

        $valueItems = [];
        for ($i = 1; $i <= 4; $i++) {
            $value = trim($aboutContent['value_' . $i]['heading'] ?? '');
            if ($value !== '') {
                $valueItems[] = $value;
            }
        }
        $valueTitle = trim($aboutContent['values_title']['heading'] ?? '');
        $directorSectionTitle = trim($aboutContent['director_title']['heading'] ?? '');
        $directorSectionSubtitle = trim($aboutContent['director_subtitle']['heading'] ?? '');

        $directors = [];
        for ($i = 1; $i <= 20; $i++) {
            $name = trim($aboutContent['director_' . $i . '_name']['heading'] ?? '');
            $designation = trim($aboutContent['director_' . $i . '_designation']['heading'] ?? '');
            $experience = trim($aboutContent['director_' . $i . '_experience']['heading'] ?? '');
            $messageTitle = trim($aboutContent['director_' . $i . '_message']['heading'] ?? '');
            $description = trim($aboutContent['director_' . $i . '_description']['description'] ?? '');
            $image = trim($aboutContent['director_' . $i . '_image']['image'] ?? '');

            if ($name === '' && $designation === '' && $experience === '' && $description === '' && $image === '') {
                continue;
            }

            $directors[] = [
                'name' => $name,
                'designation' => $designation,
                'experience' => $experience,
                'message_title' => $messageTitle,
                'description' => $description,
                'image' => $image !== '' ? cms_image_url($image, 'about') : '',
            ];
        }

        $teamSectionTitle = trim($aboutContent['team_title']['heading'] ?? '');
        $teamSectionSubtitle = trim($aboutContent['team_subtitle']['heading'] ?? '');

        $teamMembers = [];
        for ($i = 1; $i <= 20; $i++) {
            $name = trim($aboutContent['team_' . $i . '_name']['heading'] ?? '');
            $designation = trim($aboutContent['team_' . $i . '_designation']['heading'] ?? '');
            $image = trim($aboutContent['team_' . $i . '_image']['image'] ?? '');

            if ($name === '' && $designation === '' && $image === '') {
                continue;
            }

            $teamMembers[] = [
                'name' => $name,
                'designation' => $designation,
                'image' => $image !== '' ? cms_image_url($image, 'about') : '',
            ];
        }

        return view('about', [
            'pageTitle' => $pageTitle,
            'heroImage' => $heroImage,
            'aboutSubtitle' => $aboutSubtitle,
            'aboutHeading' => $aboutHeading,
            'aboutTextBlocks' => $aboutTextBlocks,
            'featureItems' => $featureItems,
            'aboutImage' => $aboutImage,
            'aboutStats' => $aboutStats,
            'ourSectionTitle' => $ourSectionTitle,
            'ourSectionSubtitle' => $ourSectionSubtitle,
            'missionTitle' => $missionTitle,
            'missionDescription' => $missionDescription,
            'visionTitle' => $visionTitle,
            'visionDescription' => $visionDescription,
            'valueTitle' => $valueTitle,
            'valueItems' => $valueItems,
            'directorSectionTitle' => $directorSectionTitle,
            'directorSectionSubtitle' => $directorSectionSubtitle,
            'directors' => $directors,
            'teamSectionTitle' => $teamSectionTitle,
            'teamSectionSubtitle' => $teamSectionSubtitle,
            'teamMembers' => $teamMembers,
            'siteName' => $siteSettings['site_name'] ?? '',
        ]);
    }

    public function contact()
    {
        helper(['url', 'form']);

        $settingsModel = new SettingsModel();
        $siteSettings  = $settingsModel->getAllSettings();

        return view('contact', [
            'siteName'      => $siteSettings['site_name'] ?? '',
            'phone1'        => $siteSettings['site_phone1'] ?? '',
            'phone2'        => $siteSettings['site_phone2'] ?? '',
            'email1'        => $siteSettings['site_email1'] ?? '',
            'email2'        => $siteSettings['site_email2'] ?? '',
            'address'       => $siteSettings['site_address'] ?? '',
            'facebookUrl'   => $siteSettings['facebook_url'] ?? '',
            'instagramUrl'  => $siteSettings['instagram_url'] ?? '',
            'youtubeUrl'    => $siteSettings['youtube_url'] ?? '',
            'linkedinUrl'   => $siteSettings['linkedin_url'] ?? '',
            'admissionOpen' => $siteSettings['admission_open'] ?? '',
            'admissionYear' => $siteSettings['admission_year'] ?? '',
        ]);
    }

    public function contactSubmit()
    {
        helper(['url', 'form']);

        $rules = [
            'name'     => 'required|min_length[3]|max_length[100]',
            'email'    => 'required|valid_email|max_length[150]',
            'phone'    => 'required|min_length[10]|max_length[20]',
            'interest' => 'permit_empty|max_length[100]',
            'message'  => 'required|min_length[5]|max_length[1000]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->to(base_url('contact'))->withInput()->with('errors', $this->validator->getErrors());
        }

        $contactModel = new \App\Models\Admin\ContactModel();
        $contactModel->insert([
            'name'     => trim((string) $this->request->getPost('name')),
            'email'    => trim((string) $this->request->getPost('email')),
            'phone'    => trim((string) $this->request->getPost('phone')),
            'interest' => trim((string) $this->request->getPost('interest')),
            'message'  => trim((string) $this->request->getPost('message')),
            'is_read'  => 0,
        ]);

        return redirect()->to(base_url('contact'))->with('success', 'Your enquiry has been submitted successfully.');
    }

    public function course()
    {
        helper(['url', 'cms']);

        $courseModel = new CourseModel();
        $settings    = new SettingsModel();

        $courses      = $courseModel->getActive();
        $siteSettings = $settings->getAllSettings();

        return view('course', [
            'courses'  => $courses,
            'siteName' => $siteSettings['site_name'] ?? 'Visakha Defence Academy',
        ]);
    }

    public function courseView($id = null)
    {
        helper(['url', 'cms']);

        $courseId = (int) $id;
        if ($courseId <= 0) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $courseModel       = new CourseModel();
        $courseDetailModel = new \App\Models\Admin\CourseDetailModel();
        $settingsModel     = new SettingsModel();

        $course = $courseModel->find($courseId);

        if (!$course || (int) ($course['status'] ?? 0) !== 1) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $courseDetail = $courseDetailModel->getByCourseId($courseId) ?? [];
        $siteSettings = $settingsModel->getAllSettings();
        $courseImage  = !empty($course['image']) ? cms_image_url($course['image'], 'courses') : '';

        return view('course-view', [
            'course'       => $course,
            'courseDetail' => $courseDetail,
            'courseImage'  => $courseImage,
            'siteName'     => $siteSettings['site_name'] ?? 'Visakha Defence Academy',
            'phoneNumber'  => $siteSettings['site_phone1'] ?? '',
        ]);
    }

    public function eligibility()
    {
        helper(['url', 'form', 'cms']);

        $eligibilityModel = new \App\Models\Admin\EligibilityModel();
        $eligibility      = $eligibilityModel->getRow() ?? [];

        $eligibilityImage = !empty($eligibility['image']) ? cms_image_url($eligibility['image'], 'eligibility') : '';

        return view('eligibility-conditions', [
            'pageTitle'        => 'Eligibility Conditions',
            'eligibilityImage' => $eligibilityImage,
            'caption'          => $eligibility['caption'] ?? '',
            'campus'           => $eligibility['campus'] ?? '',
        ]);
    }

    public function facilities()
    {
        helper(['url', 'form', 'cms']);

        $facilitiesModel = new \App\Models\Admin\FacilitiesModel();
        $contentModel    = new AboutContentModel();
        $settingsModel   = new SettingsModel();

        $facilities = $facilitiesModel->getActive();
        foreach ($facilities as &$facility) {
            $facility['features'] = cms_json_decode($facility['features'] ?? '[]');
        }
        unset($facility);

        $content      = $contentModel->getAllKeyed();
        $siteSettings = $settingsModel->getAllSettings();

        $highlights = [];
        for ($i = 1; $i <= 20; $i++) {
            $icon        = trim($content["facilities_highlight_{$i}_icon"]['heading'] ?? '');
            $heading     = trim($content["facilities_highlight_{$i}_heading"]['heading'] ?? '');
            $description = trim($content["facilities_highlight_{$i}_description"]['description'] ?? '');

            if ($icon === '' && $heading === '' && $description === '') {
                continue;
            }

            $highlights[] = [
                'icon'        => $icon ?: 'fas fa-star',
                'heading'     => $heading ?: 'Facility Highlight',
                'description' => $description,
            ];
        }

        if (empty($highlights)) {
            $highlights = [
                [
                    'icon'        => 'fas fa-person-booth',
                    'heading'     => 'Separate hostels for boys & girls',
                    'description' => 'Fully secure, 24/7 power backup, purified water, and recreational common rooms.',
                ],
                [
                    'icon'        => 'fas fa-bowl-food',
                    'heading'     => 'Mess & Nutrition',
                    'description' => 'Dietician-planned meals to meet defence physical standards. Special menu for trainees.',
                ],
            ];
        }

        return view('facilities', [
            'pageTitle'  => 'Facilities',
            'facilities' => $facilities,
            'highlights' => $highlights,
            'siteName'   => $siteSettings['site_name'] ?? 'Visakha Defence Academy',
        ]);
    }

    public function faq()
    {
        helper(['url']);

        $faqModel = new FaqModel();
        $faqs     = $faqModel->getActive();

        return view('faq', [
            'faqs' => $faqs,
        ]);
    }

    public function jobSelections()
    {
        helper(['url', 'form', 'cms']);

        $jobModel = new JobSelectionsModel();
        $job      = $jobModel->getRow() ?? [];

        $jobImage = !empty($job['image']) ? cms_image_url($job['image'], 'job-selections') : '';

        return view('job-selections', [
            'pageTitle' => 'Job Selections',
            'jobImage'  => $jobImage,
            'caption'   => $job['caption'] ?? '',
            'campus'    => $job['campus'] ?? '',
        ]);
    }

    public function medicalCounselling()
    {
        helper(['url', 'form', 'cms']);

        $medicalModel = new MedicalCounsellingModel();
        $medical      = $medicalModel->getRow() ?? [];

        $medicalImage = !empty($medical['image']) ? cms_image_url($medical['image'], 'medical-counselling') : '';

        return view('medical-counselling', [
            'pageTitle'    => 'Medical Counselling',
            'medicalImage' => $medicalImage,
            'caption'      => $medical['caption'] ?? '',
            'campus'       => $medical['campus'] ?? '',
        ]);
    }

    public function photoGallery()
    {
        return view('photo-gallery');
    }

    public function videoGallery()
    {
        return view('video-gallery');
    }

    public function privacyPolicy()
    {
        return view('privacy-policy');
    }

    public function termsConditions()
    {
        return view('terms-conditions');
    }
}
