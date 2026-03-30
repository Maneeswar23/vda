<?php include 'includes/header.php'; ?>
<?php
$settings = $settings ?? [];
$banners = $banners ?? [];
$courses = $courses ?? [];
$faqList = $faqList ?? [];
$photoList = $photoList ?? [];
$videoList = $videoList ?? [];
$aboutSubtitle = $aboutSubtitle ?? '';

$aboutHeading = $aboutHeading ?? '';

$aboutTextBlocks = $aboutTextBlocks ?? [];
//print_r($aboutTextBlocks);die;
$featureItems = $featureItems ?? [];
//print_r($featureItems);die;
$aboutImage = $aboutImage ?? '';
//print_r($aboutImage);die;
$statsList = $statsList ?? [];
//print_r($statsList);die;
$aboutStats = $aboutStats ?? [];
//print_r($aboutStats);die;
$enquiryStats = $enquiryStats ?? [];
$notifications = $notifications ?? [];
//print_r($notifications);die;
$scrollNotifications = $scrollNotifications ?? [];
//print_r($scrollNotifications);die;
$recentCards = $recentCards ?? [];
//print_r($recentCards);die;
$directors = $directors ?? [];
$facebookUrl = $facebookUrl ?? '';
$instagramUrl = $instagramUrl ?? '';
$youtubeUrl = $youtubeUrl ?? '';
$linkedinUrl = $linkedinUrl ?? '';
$siteName = $siteName ?? '';
?>

<section class="home-banner">
  <div class="swiper home-banner-swiper" data-banner-count="<?= count($banners) ?>">
    <div class="swiper-wrapper">
      <?php foreach ($banners as $banner): ?>
        <?php if (!empty($banner['image'])): ?>
          <?php $bannerImage = cms_image_url($banner['image'], 'banners'); ?>
          <div class="swiper-slide home-banner-slide" style="background-image: url('<?= esc($bannerImage, 'attr') ?>')"></div>
        <?php endif; ?>
      <?php endforeach; ?>
    </div>
  </div>
  <div class="home-banner-button home-banner-button-prev">
    <i class="fas fa-chevron-left"></i>
  </div>
  <div class="home-banner-button home-banner-button-next">
    <i class="fas fa-chevron-right"></i>
  </div>
  <div class="home-banner-pagination"></div>
  <div class="home-banner-counter">
    <span id="homeBannerCurrent">1</span> /
    <span id="homeBannerTotal"><?= count($banners) ?></span>
  </div>
</section>
<section class="home-about about-section section-padding" data-aos="fade-up" data-aos-duration="1000">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-5 col-md-12" data-aos="fade-right" data-aos-delay="100">
        <span class="section-subtitle"><?= esc($aboutSubtitle) ?></span>
        <h2 class="about-heading"><?= esc($aboutHeading) ?></h2>
        <?php foreach ($aboutTextBlocks as $block): ?>
          <p class="about-text"><?= strip_tags($block) ?></p>
        <?php endforeach; ?>
        <div class="features-list" data-aos="fade-up" data-aos-delay="200">
          <ul>
            <?php foreach ($featureItems as $feature): ?>
              <li><?= esc($feature) ?></li>
            <?php endforeach; ?>
          </ul>
        </div>
        <a href="<?= base_url('about') ?>" class="faci-offer-btn">Read More</a>
      </div>
      <div class="col-lg-5 col-md-8" data-aos="zoom-in" data-aos-delay="150">
        <?php if ($aboutImage !== ''): ?>
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

<section id="courses" class="home-course" data-aos="fade-up" data-aos-duration="1000">
  <div class="container">
    <div class="dark-bg" style="padding: 0rem 2rem; text-align: center">
      <div class="achievements-heading">
        <h2>Courses <span class="text-theme-colored2">Offered</span></h2>
        <div class="line-container"><div class="moving-circle"></div></div>
      </div>
    </div>
    <div class="swiper home-course-swiper">
      <div class="swiper-wrapper">
        <?php foreach ($courses as $course): ?>
          <?php $courseImage = !empty($course['image']) ? cms_image_url($course['image'], 'courses') : ''; ?>
          <div class="swiper-slide">
            <div class="course-single-item bg-white border-1px clearfix mb-30">
              <div class="course-thumb">
                <?php if ($courseImage !== ''): ?>
                  <img class="img-fullwidth" alt="<?= esc($course['title'] ?? '', 'attr') ?>" src="<?= esc($courseImage, 'attr') ?>" />
                <?php endif; ?>
              </div>
              <div class="course-details clearfix p-20 pt-15">
                <div class="course-top-part pull-left mr-40">
                  <a href="<?= base_url('course-view/' . ($course['id'] ?? '')) ?>">
                    <h4 class="mt-0"><?= esc($course['title'] ?? '') ?></h4>
                  </a>
                </div>
                <div class="clearfix"></div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
      <div class="swiper-button-prev"></div>
      <div class="swiper-button-next"></div>
      <div class="swiper-pagination"></div>
    </div>
  </div>
</section>

<section class="latest-faq-sec section-padding" data-aos="fade-up" data-aos-duration="1000">
  <div class="container">
    <div class="light-bg" style="padding: 0rem 2rem; text-align: center">
      <div class="achievements-heading">
        <h2>Latest <span class="text-theme-colored1">Notifications & </span> Selections & <span class="text-theme-colored1">FAQs</span></h2>
        <div class="line-container"><div class="moving-circle"></div></div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-5 mb-4 mb-lg-0">
        <div class="latest-faq-sec latest-news-card">
          <div class="latest-faq-sec latest-news-header"><h3>Latest Notifications & Selections</h3><i class="fas fa-newspaper"></i></div>
          <div class="latest-faq-sec news-scroll-container"><div class="latest-faq-sec news-scroll">
            <?php foreach ($scrollNotifications as $item): ?>
              <div class="latest-faq-sec news-item">
                <div class="latest-faq-sec news-icon"><i class="<?= esc($item['icon'] ?? 'fas fa-bullhorn', 'attr') ?>"></i></div>
                <div class="latest-faq-sec news-content">
                  <div class="latest-faq-sec news-date"><i class="far fa-calendar-alt"></i> <?= esc($item['date'] ?? 'Latest Update') ?></div>
                  <h4 class="latest-faq-sec news-title"><?= esc($item['title'] ?? '') ?></h4>
                  <p class="latest-faq-sec news-excerpt"><?= esc($item['excerpt'] ?? '') ?></p>
                </div>
              </div>
            <?php endforeach; ?>
          </div></div>
        </div>
      </div>
      <div class="col-lg-7">
        <div class="latest-faq-sec faq-card">
          <div class="latest-faq-sec faq-header"><h3>Frequently Asked Question & Answers</h3><i class="fas fa-question-circle"></i></div>
          <div class="latest-faq-sec accordion" id="faqAccordion">
            <?php foreach ($faqList as $index => $faq): ?>
              <?php $collapseId = 'faqCollapse' . ($index + 1); $headingId = 'faqHeading' . ($index + 1); ?>
              <div class="latest-faq-sec accordion-item">
                <h2 class="latest-faq-sec accordion-header" id="<?= esc($headingId, 'attr') ?>">
                  <button class="latest-faq-sec accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#<?= esc($collapseId, 'attr') ?>" aria-expanded="false" aria-controls="<?= esc($collapseId, 'attr') ?>">
                    <?= esc($faq['question'] ?? '') ?>
                  </button>
                </h2>
                <div id="<?= esc($collapseId, 'attr') ?>" class="latest-faq-sec accordion-collapse collapse" aria-labelledby="<?= esc($headingId, 'attr') ?>" data-bs-parent="#faqAccordion">
                  <div class="latest-faq-sec accordion-body"><?= (strip_tags($faq['answer'] ?? '')) ?></div>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
          <a href="<?= base_url('faq') ?>" class="latest-faq-sec read-more-btn">View All FAQs</a>
        </div>
      </div>
    </div>
  </div>
</section>
<section class="recent-job-section">
  <div class="recent-job-container">
    <div class="recent-job-row">
      <div class="recent-job-col-lg-3">
        <div class="dark-bg" style="padding: 0rem 2rem; text-align: center">
          <div class="achievements-heading">
            <h2>Job <span class="text-theme-colored2">Selections</span></h2>
            <div class="line-container"><div class="moving-circle"></div></div>
          </div>
        </div>
        <div class="recent-job-content"><p>Browse live highlights pulled from your current homepage content, selection updates, and key academy milestones.</p></div>
      </div>
      <div class="recent-job-col-lg-9">
        <div class="recent-job-slider-container">
          <div class="recent-job-swiper swiper"><div class="swiper-wrapper">
            <?php foreach ($recentCards as $card): ?>
              <div class="recent-job-slide swiper-slide"><div class="recent-job-card">
                <?php if (!empty($card['badge'])): ?><div class="recent-job-badge"><?= esc($card['badge']) ?></div><?php endif; ?>
                <div class="recent-job-card-header"><div class="recent-job-count"><?= esc((string) ($card['count'] ?? '')) ?></div><div class="recent-job-count-label"><?= esc($card['label'] ?? '') ?></div></div>
                <div class="recent-job-card-body"><h3 class="recent-job-title"><?= esc($card['title'] ?? '') ?></h3><div class="recent-job-location"><i class="recent-job-location-icon fas fa-map-marker-alt"></i><span><?= esc($card['location'] ?? '') ?></span></div></div>
              </div></div>
            <?php endforeach; ?>
          </div></div>
          <div class="recent-job-navigation"><button class="recent-job-button recent-job-button-prev"><i class="fas fa-chevron-left"></i></button><button class="recent-job-button recent-job-button-next"><i class="fas fa-chevron-right"></i></button></div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="home-gallery-section">
  <div class="container">
    <div class="home-gallery-section-title"><div class="light-bg" style="padding: 0rem 2rem; text-align: center"><div class="achievements-heading"><h2 class="text-start">Our <span class="text-theme-colored1">Photo Gallery</span></h2><div class="line-container"><div class="moving-circle"></div></div></div></div></div>
    <div class="home-gallery-row">
      <?php foreach ($photoList as $photo): ?>
        <?php if (!empty($photo['image'])): ?>
          <?php $photoImage = cms_image_url($photo['image'], 'gallery/photos'); ?>
          <div class="home-gallery-col"><a href="<?= esc($photoImage, 'attr') ?>" data-fancybox="gallery" data-caption="<?= esc($photo['caption'] ?? '', 'attr') ?>"><div class="home-gallery-item"><div class="home-gallery-image"><img src="<?= esc($photoImage, 'attr') ?>" alt="<?= esc($photo['caption'] ?? '', 'attr') ?>" /></div><div class="home-gallery-overlay"><div class="home-gallery-icon"><i class="fas fa-magnifying-glass-plus"></i></div></div></div></a></div>
        <?php endif; ?>
      <?php endforeach; ?>
    </div>
    <div class="gal-bal"><a href="<?= base_url('photo-gallery') ?>" class="faci-offer-btn">View More</a></div>
  </div>
</section>

<section id="director-message" class="director-message-inn section-padding">
  <div class="director-message-inn__bg-shape director-message-inn__bg-shape-3"></div>
  <div class="director-message-inn__bg-pattern"></div>
  <div class="container">
    <?php foreach ($directors as $index => $director): ?>
      <div class="row <?= $index < count($directors) - 1 ? 'mb-5' : '' ?>">
        <div class="col-lg-4"><div class="dir-img-sti"><div class="director-message-inn__director-card"><div class="director-message-inn__director-img-wrapper"><img src="<?= esc($director['image'], 'attr') ?>" alt="<?= esc($director['name'], 'attr') ?>" class="director-message-inn__director-img" /><div class="director-message-inn__director-img-overlay"></div></div><div class="director-message-inn__director-info"><h2 class="director-message-inn__director-name"><?= esc($director['name']) ?></h2><?php if (!empty($director['meta'])): ?><h3 class="text-black"><?= esc($director['meta']) ?></h3><?php endif; ?><p class="director-message-inn__director-designation"><?= esc($director['designation']) ?></p></div></div></div></div>
        <div class="col-lg-8 dark-bg"><div class="achievements-heading"><h2>Director's <span class="text-theme-colored2"> Message</span></h2><div class="line-container"><div class="moving-circle"></div></div></div><div class="director-message-inn__message-content"><div class="director-message-inn__corner-decoration director-message-inn__corner-decoration--tl"></div><div class="director-message-inn__corner-decoration director-message-inn__corner-decoration--br"></div><div class="director-message-inn__message-text"><?php foreach (preg_split('/\r\n|\r|\n/', $director['message']) as $paragraph): ?><?php if (trim($paragraph) !== ''): ?><p><?= esc(trim($paragraph)) ?></p><?php endif; ?><?php endforeach; ?><?php if ($index === 0): ?><div id="directorHiddenContent"></div><button id="directorViewMoreBtn" type="button" style="display:none;"><span>View More Details</span></button><?php endif; ?></div></div></div>
      </div>
    <?php endforeach; ?>
  </div>
</section>
<section class="home-gallery-section">
  <div class="container">
    <div class="home-gallery-section-title"><div class="light-bg" style="padding: 0rem 2rem; text-align: center"><div class="achievements-heading"><h2 class="text-start">Our <span class="text-theme-colored1">Video Gallery</span></h2><div class="line-container"><div class="moving-circle"></div></div></div></div></div>
    <div class="home-gallery-row">
      <?php foreach ($videoList as $video): ?>
        <?php $videoUrl = $video['youtube_url'] ?? ''; ?>
        <?php $videoThumb = !empty($video['thumbnail']) ? cms_image_url($video['thumbnail'], 'gallery/videos') : ''; ?>
        <?php if ($videoUrl !== '' && $videoThumb !== ''): ?>
          <div class="home-gallery-col"><a href="<?= esc($videoUrl, 'attr') ?>" data-fancybox="video-gallery" data-type="iframe" data-caption="<?= esc($video['title'] ?? '', 'attr') ?>"><div class="home-gallery-item"><div class="home-gallery-image"><img src="<?= esc($videoThumb, 'attr') ?>" alt="<?= esc($video['title'] ?? '', 'attr') ?>"><div class="video-play-button"><i class="fas fa-play"></i></div></div><div class="home-gallery-overlay"><div class="home-gallery-icon"><i class="fas fa-play-circle"></i></div></div></div></a></div>
        <?php endif; ?>
      <?php endforeach; ?>
    </div>
    <div class="gal-bal"><a href="<?= base_url('video-gallery') ?>" class="faci-offer-btn">View More Videos</a></div>
  </div>
</section>

<section id="reservation">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-md-6 sm-text-center enq">
        <div class="text-center"><img src="<?= base_url('public/assets/images/logo.png') ?>" alt="Enquiry" /></div>
        <div class="row mt-30 sm-text-center">
          <?php foreach ($enquiryStats as $stat): ?>
            <div class="col-xs-12 col-sm-4 col-md-4"><div class="funfact"><i class="<?= esc($stat['icon'] ?? 'fas fa-award', 'attr') ?>"></i><h2 class="animate-number font-38 font-weight-400 mt-0 mb-15"><?= esc($stat['number'] ?? '') ?></h2><h5 class="text-uppercase"><?= esc($stat['label'] ?? '') ?></h5></div></div>
          <?php endforeach; ?>
        </div>
      </div>
      <div class="col-md-6">
        <div class="p-30 mt-0 bg-dark-transparent-2">
          <h3 class="title-pattern mt-0"><span class="text-white">Quick <span class="text-theme-colored2">Enquiry</span></span></h3>
          <form id="form" name="reservation_form" class="reservation-form mt-20" method="post" action="">
            <div class="row">
              <div class="col-sm-12"><div class="form-group mb-20"><input placeholder="Enter Name" id="reservation_name" name="name" required class="form-control" type="text" /></div></div>
              <div class="col-sm-6"><div class="form-group mb-20"><input placeholder="Email" id="reservation_email" name="email" class="form-control" required type="email" /></div></div>
              <div class="col-sm-6"><div class="form-group mb-20"><input placeholder="Phone" id="reservation_phone" name="mobile" class="form-control" required type="tel" /></div></div>
              <div class="col-sm-6"><div class="form-group mb-20"><div class="styled-select"><select id="person_select" name="course" class="form-control" required><option value="">Choose Course</option><?php foreach ($courses as $course): ?><option value="<?= esc($course['title'] ?? '', 'attr') ?>"><?= esc($course['title'] ?? '') ?></option><?php endforeach; ?></select></div></div></div>
              <div class="col-sm-6"><div class="form-group mb-20"><input name="dob" class="form-control required date-picker" placeholder="Date Of Birth" type="date" /></div></div>
              <div class="col-sm-12"><div class="form-group"><textarea placeholder="Enter Message" rows="3" class="form-control required" name="message" id="form_message"></textarea></div></div>
              <div class="col-sm-12"><div class="form-group mb-0 mt-10"><input name="form_botcheck" class="form-control" value="" type="hidden" /><button type="submit" name="submit" class="btn btn-colored btn-lg btn-block">Submit</button></div></div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="home-social-media-section">
  <div class="home-social-media-container">
    <div class="light-bg" style="padding: 0rem 2rem; text-align: center"><div class="achievements-heading"><h2 class="text-start">Follow <span class="text-theme-colored1">Us On</span></h2><div class="line-container"><div class="moving-circle"></div></div></div></div>
    <div class="home-social-media-row">
      <?php if ($facebookUrl !== ''): ?><div class="home-social-media-col-lg-3"><div class="home-social-media-card home-social-media-facebook-card"><div class="home-social-media-header"><i class="fab fa-facebook-f me-2"></i><?= esc($siteName) ?></div><div class="home-social-media-content"><iframe src="https://www.facebook.com/plugins/page.php?href=<?= rawurlencode($facebookUrl) ?>&amp;tabs=timeline&amp;width=300&amp;height=500&amp;small_header=true&amp;adapt_container_width=true&amp;hide_cover=false&amp;show_facepile=true&amp;appId" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe></div></div></div><?php endif; ?>
      <?php if ($instagramUrl !== ''): ?><div class="home-social-media-col-lg-3"><div class="home-social-media-card home-social-media-instagram-card"><div class="home-social-media-header"><i class="fab fa-instagram me-2"></i>Instagram</div><div class="home-social-media-content"><a href="<?= esc($instagramUrl, 'attr') ?>" target="_blank" rel="noopener noreferrer"><img src="<?= base_url('public/assets/images/inst.jpg') ?>" alt="Instagram" /></a></div></div></div><?php endif; ?>
      <?php if ($youtubeUrl !== ''): ?><div class="home-social-media-col-lg-3"><div class="home-social-media-card home-social-media-twitter-card"><div class="home-social-media-header"><i class="fa-brands fa-youtube me-2"></i>YouTube</div><div class="home-social-media-content"><a href="<?= esc($youtubeUrl, 'attr') ?>" target="_blank" rel="noopener noreferrer"><img src="<?= base_url('public/assets/images/youtube.png') ?>" alt="YouTube" /></a></div></div></div><?php endif; ?>
      <?php if ($linkedinUrl !== ''): ?><div class="home-social-media-col-lg-3"><div class="home-social-media-card home-social-media-linkedin-card"><div class="home-social-media-header"><i class="fab fa-linkedin me-2"></i>LinkedIn</div><div class="home-social-media-content"><a href="<?= esc($linkedinUrl, 'attr') ?>" target="_blank" rel="noopener noreferrer"><img src="<?= base_url('public/assets/images/linked.jpg') ?>" alt="LinkedIn" /></a></div></div></div><?php endif; ?>
    </div>
  </div>
</section>
<script src="https://platform.linkedin.com/badges/js/profile.js" async defer></script>

<?php include 'includes/footer.php'; ?>
