    <?php
    helper('cms');

    $siteName = strip_tags(cms_setting('site_name'));
    $phone1 = strip_tags(cms_setting('site_phone1'));
    $phone2 = strip_tags(cms_setting('site_phone2'));
    $email1 = strip_tags(cms_setting('site_email1'));
    $address = strip_tags(cms_setting('site_address'));
    $facebookUrl = trim(cms_setting('facebook_url'));
    $instagramUrl = trim(cms_setting('instagram_url'));
    $youtubeUrl = trim(cms_setting('youtube_url'));
    $linkedinUrl = trim(cms_setting('linkedin_url'));
    $scrollingText = cms_setting('scrolling_text');
    $whatsappNumber = preg_replace('/[^0-9]/', '', $phone2 !== '' ? $phone2 : $phone1);
    $callNumber = preg_replace('/\s+/', '', $phone1 !== '' ? $phone1 : $phone2);
    ?>

    <section class="footer-above">
      <div class="scroll-text">
        <h1><?= strip_tags($scrollingText) ?></h1>
      </div>
    </section>


    <footer class="footer">
      <div class="footer-bg"></div>
      <div class="footer-overlay"></div>
      <div class="footer-content">
        <div class="container section-padding pb-0">
          <div class="footer-columns row">
            <div class="footer-column col-lg-4 col-md-6">
              <h3>About Us</h3>
              <p>
                <?= strip_tags($siteName) ?>
              </p>
              <div class="social-links">
                <?php if ($facebookUrl !== ''): ?><a href="<?= esc($facebookUrl, 'attr') ?>" target="_blank"><i class="fab fa-facebook-f"></i></a><?php endif; ?>
                <?php if ($instagramUrl !== ''): ?><a href="<?= esc($instagramUrl, 'attr') ?>" target="_blank"><i class="fab fa-instagram"></i></a><?php endif; ?>
                <?php if ($linkedinUrl !== ''): ?><a href="<?= esc($linkedinUrl, 'attr') ?>" target="_blank"><i class="fab fa-linkedin-in"></i></a><?php endif; ?>
                <?php if ($youtubeUrl !== ''): ?><a href="<?= esc($youtubeUrl, 'attr') ?>" target="_blank"><i class="fab fa-youtube"></i></a><?php endif; ?>
              </div>
            </div>

            <div class="footer-column col-lg-2 col-md-6">
              <h3>Quick Links</h3>
              <ul>
                <li>
                  <a href="<?= base_url('/') ?>"><i class="fas fa-chevron-right"></i> Home</a>
                </li>
                <li>
                  <a href="<?= base_url('about') ?>"><i class="fas fa-chevron-right"></i> About</a>
                </li>
                <li>
                  <a href="<?= base_url('course') ?>"><i class="fas fa-chevron-right"></i> Courses</a>
                </li>
                <li>
                  <a href="<?= base_url('facilities') ?>"><i class="fas fa-chevron-right"></i> Facilities</a>
                </li>
                <li>
                  <a href="<?= base_url('contact') ?>"><i class="fas fa-chevron-right"></i> Contact</a>
                </li>


                <li>
                  <a href="<?= base_url('privacy-policy') ?>"><i class="fas fa-chevron-right"></i> Privacy Policy</a>
                </li>

                <li>
                  <a href="<?= base_url('terms-conditions') ?>"><i class="fas fa-chevron-right"></i> Terms & Condtitions</a>
                </li>


              </ul>
            </div>

            <div class="footer-column col-lg-3 col-md-6">
              <h3>Contact Us</h3>
              <ul>
                <li>
                  <a href="#"><i class="fas fa-map-marker-alt"></i> <?= esc($address) ?></a>
                </li>
                <li>
                  <a href="tel:<?= esc($callNumber, 'attr') ?>"><i class="fas fa-phone"></i> <?= esc(trim($phone1 . ($phone2 !== '' ? ',' . $phone2 : ''))) ?></a>
                </li>
                <li>
                  <a href="mailto:<?= esc($email1, 'attr') ?>"><i class="fas fa-envelope"></i> <?= esc($email1) ?></a>
                </li>
                <li>
                  <a href="#"><i class="fas fa-clock"></i> Mon - Fri: 9:00 AM - 6:00
                    PM</a>
                </li>
              </ul>
            </div>

            <div class="footer-column col-lg-3 col-md-6">
              <h3>Our Location</h3>
              <iframe
                src="https://www.google.com/maps?q=<?= rawurlencode($address) ?>&output=embed"
                width="100%"
                height="250"
                style="border: 0"
                allowfullscreen=""
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade">
              </iframe>
            </div>
          </div>
        </div>

        <div class="footer-bottom">
          <p>&copy; 2026 <?= esc($siteName) ?>. All Rights Reserved.</p>
          <p>Design & Developed by <a href="https://www.thecolourmoon.com/" target="_blank">Colourmoon Technologies </a></p>
        </div>
      </div>
    </footer>
    </div>

    <div class="floating-contact">

      <!-- WhatsApp -->
      <a href="https://wa.me/<?= esc($whatsappNumber, 'attr') ?>" target="_blank" class="whatsapp">
        <img src="https://cdn-icons-png.flaticon.com/512/733/733585.png">
      </a>

      <!-- Call -->
      <a href="tel:<?= esc($callNumber, 'attr') ?>" class="call">
        <img src="https://cdn-icons-png.flaticon.com/512/724/724664.png">
      </a>

    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Swiper 10 JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script src="<?= base_url('public/assets/js/main.js') ?>"></script>
    <!-- AOS Animation JS -->
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>

    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <script>
      document.querySelectorAll('.floating-contact a').forEach(btn => {
        btn.addEventListener('click', () => {
          btn.style.transform = "scale(0.9)";
          setTimeout(() => {
            btn.style.transform = "scale(1)";
          }, 150);
        });
      });
    </script>

    <script>
      document.addEventListener("DOMContentLoaded", function() {
        const swiper = new Swiper(".home-course-swiper", {
          slidesPerView: 1,
          spaceBetween: 20,
          loop: true,
          speed: 1000, // Smooth transition speed
          autoplay: {
            delay: 3000, // 3 seconds delay between slides
            disableOnInteraction: false,
          },
          grabCursor: true,
          pagination: {
            el: ".swiper-pagination",
            clickable: true,
          },
          navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
          },
          breakpoints: {
            640: {
              slidesPerView: 2,
            },
            992: {
              slidesPerView: 3,
            },
            1199: {
              slidesPerView: 4,
            },
          },
        });
      });
    </script>

    <script>
      document.addEventListener("DOMContentLoaded", function() {
        const swiper = new Swiper(".recent-job-swiper", {
          slidesPerView: 4,
          spaceBetween: 20,
          slidesPerGroup: 1,
          loop: true,
          speed: 600,
          autoplay: {
            delay: 3000,
            disableOnInteraction: false,
          },
          navigation: {
            nextEl: ".recent-job-button-next",
            prevEl: ".recent-job-button-prev",
          },
          breakpoints: {
            320: {
              slidesPerView: 1,
              spaceBetween: 10,
            },
            576: {
              slidesPerView: 2,
              spaceBetween: 15,
            },
            768: {
              slidesPerView: 3,
              spaceBetween: 15,
            },
            1199: {
              slidesPerView: 4,
              spaceBetween: 20,
            },
          },
        });
      });
    </script>

    <script>
      document.addEventListener("DOMContentLoaded", function() {
        const directorViewMoreBtn = document.getElementById(
          "directorViewMoreBtn"
        );
        const directorHiddenContent = document.getElementById(
          "directorHiddenContent"
        );
        directorViewMoreBtn.addEventListener("click", function() {
          // Toggle the expanded class
          directorHiddenContent.classList.toggle("expanded");
          directorViewMoreBtn.classList.toggle("expanded");
          // Change button text based on state
          if (directorHiddenContent.classList.contains("expanded")) {
            directorViewMoreBtn.querySelector("span").textContent =
              "Show Less";
          } else {
            directorViewMoreBtn.querySelector("span").textContent =
              "View More Details";
          }
        });
      });
    </script>

    <script>
      $(document).ready(function() {
        // Initialize fancybox
        $('[data-fancybox="gallery"]').fancybox({
          buttons: [
            "zoom",
            "share",
            "slideShow",
            "fullScreen",
            "download",
            "thumbs",
            "close",
          ],
          loop: true,
          protect: true,
        });
      });
    </script>


    <script>
      $(document).ready(function() {
        // Initialize fancybox for the video gallery
        $('[data-fancybox="video-gallery"]').fancybox({
          buttons: [
            "close"
          ],
          loop: true,
          protect: true,
          iframe: {
            preload: false,
            css: {
              width: '80%',
              height: '80%'
            }
          },
          beforeLoad: function(instance, current) {
            // Convert YouTube URL to embed URL
            if (current.type === 'iframe') {
              var url = current.src;
              var videoId = '';
              // Check if it's a YouTube URL
              if (url.indexOf('youtube.com') > -1) {
                // Extract video ID from youtube.com URL
                if (url.indexOf('v=') > -1) {
                  videoId = url.split('v=')[1];
                  var ampersandPosition = videoId.indexOf('&');
                  if (ampersandPosition !== -1) {
                    videoId = videoId.substring(0, ampersandPosition);
                  }
                }
              } else if (url.indexOf('youtu.be') > -1) {
                // Extract video ID from youtu.be URL
                videoId = url.split('youtu.be/')[1];
                var questionMarkPosition = videoId.indexOf('?');
                if (questionMarkPosition !== -1) {
                  videoId = videoId.substring(0, questionMarkPosition);
                }
              }
              if (videoId) {
                // Create embed URL
                current.src = 'https://www.youtube.com/embed/' + videoId +
                  '?autoplay=1&rel=0&showinfo=0&controls=1';
              }
            }
          },
          afterLoad: function(instance, current) {
            // Adjust iframe size after load
            if (current.type === 'iframe') {
              $('.fancybox-content').css({
                'max-width': '800px',
                'max-height': '450px'
              });
            }
          }
        });
      });
    </script>

    <script>
      function toggleMobileMenu() {
        const mobileNav = document.getElementById("mobileNav");
        const overlay = document.getElementById("overlay");

        mobileNav.classList.toggle("active");
        overlay.classList.toggle("active");

        // Prevent body scrolling when menu is open
        document.body.style.overflow = mobileNav.classList.contains("active") ?
          "hidden" :
          "";
      }

      function toggleMobileDropdown(dropdownId) {
        const dropdown = document.getElementById(dropdownId);
        dropdown.classList.toggle("active");

        // Prevent the default link behavior
        event.preventDefault();
      }
    </script>

    <script>
      function toggleMobileMenu() {
        const mobileNav = document.getElementById("mobileNav");
        const overlay = document.getElementById("overlay");

        mobileNav.classList.toggle("active");
        overlay.classList.toggle("active");
        document.body.classList.toggle("menu-open");
      }

      function toggleMobileDropdown(dropdownId) {
        const dropdown = document.getElementById(dropdownId);
        const parentLink = event.currentTarget;

        // Close all other dropdowns first
        const allDropdowns = document.querySelectorAll(".mobile-nav .dropdown");
        const allLinks = document.querySelectorAll(
          ".mobile-nav .menuzord-menu > li > a"
        );

        allDropdowns.forEach((drop) => {
          if (drop.id !== dropdownId) {
            drop.classList.remove("active");
          }
        });

        allLinks.forEach((link) => {
          if (link !== parentLink) {
            link.classList.remove("active");
          }
        });

        // Toggle current dropdown
        dropdown.classList.toggle("active");
        parentLink.classList.toggle("active");

        event.preventDefault();
        event.stopPropagation();
      }
    </script>

    <script>
      AOS.init({
        duration: 1000, // Animation duration (in ms)
        once: true, // Whether animation should happen only once
      });
    </script>
    </body>

    </html>
