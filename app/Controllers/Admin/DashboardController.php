<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\HomeBannerModel;
use App\Models\Admin\HomeStatsModel;
use App\Models\Admin\FacilitiesModel;
use App\Models\Admin\FaqModel;
use App\Models\Admin\CourseModel;
use App\Models\Admin\GalleryPhotosModel;
use App\Models\Admin\GalleryVideosModel;
use App\Models\Admin\ContactModel;

class DashboardController extends BaseController
{
    public function index()
    {
        $bannerModel  = new HomeBannerModel();
        $statsModel   = new HomeStatsModel();
        $facilityModel= new FacilitiesModel();
        $faqModel     = new FaqModel();
        $courseModel  = new CourseModel();
        $photoModel   = new GalleryPhotosModel();
        $videoModel   = new GalleryVideosModel();
        $contactModel = new ContactModel();

        $data = [
            'pageTitle'      => 'Dashboard',
            'totalBanners'   => $bannerModel->countAll(),
            'totalStats'     => $statsModel->countAll(),
            'totalFacilities'=> $facilityModel->countAll(),
            'totalFaqs'      => $faqModel->countAll(),
            'totalCourses'   => $courseModel->countAll(),
            'totalPhotos'    => $photoModel->countAll(),
            'totalVideos'    => $videoModel->countAll(),
            'totalEnquiries' => $contactModel->countAll(),
            'unreadEnquiries'=> $contactModel->where('is_read', 0)->countAllResults(),
            'recentEnquiries'=> $contactModel->orderBy('created_at', 'DESC')->limit(5)->findAll(),
        ];

        // unread count for sidebar badge
        $data['unreadCount'] = $data['unreadEnquiries'];

        return view('admin/dashboard/index', $data);
    }
}