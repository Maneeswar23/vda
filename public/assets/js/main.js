let homeBannerSwiper;
let homeBannerTotal = 0;

function updateCounter(swiperInstance) {
  const current = swiperInstance.realIndex + 1;
  const total = homeBannerTotal || 0;
  document.getElementById("homeBannerCurrent").textContent = current;
  document.getElementById("homeBannerTotal").textContent = total;
}

document.addEventListener("DOMContentLoaded", function () {
  const bannerElement = document.querySelector(".home-banner-swiper");

  if (!bannerElement) {
    return;
  }

  homeBannerTotal = parseInt(bannerElement.getAttribute("data-banner-count"), 10) || 0;

  homeBannerSwiper = new Swiper(".home-banner-swiper", {
    direction: "horizontal",
    loop: homeBannerTotal > 1,
    speed: 1000,
    effect: "fade",
    fadeEffect: {
      crossFade: true,
    },

    autoplay: {
      delay: 3000, // 3 seconds
      disableOnInteraction: false,
      pauseOnMouseEnter: false,
      waitForTransition: true,
      enabled: homeBannerTotal > 1,
    },

    navigation: {
      nextEl: ".home-banner-button-next",
      prevEl: ".home-banner-button-prev",
    },

    pagination: {
      el: ".home-banner-pagination",
      clickable: true,
      bulletClass: "home-banner-bullet",
      bulletActiveClass: "home-banner-bullet-active",
      renderBullet: function (index, className) {
        return `<span class="${className}"></span>`;
      },
    },

    keyboard: {
      enabled: true,
    },

    mousewheel: {
      forceToAxis: true,
    },

    on: {
      init: function () {
        updateCounter(this);
        if (homeBannerTotal > 1 && this.autoplay) {
          this.autoplay.start();
        }
      },
      slideChange: function () {
        updateCounter(this);
      },
    },
  });

  document.querySelectorAll(".home-banner-button").forEach((button) => {
    button.addEventListener("click", () => {
      setTimeout(() => {
        if (homeBannerSwiper && homeBannerTotal > 1 && homeBannerSwiper.autoplay) {
          homeBannerSwiper.autoplay.start();
        }
      }, 100);
    });
  });

  document.addEventListener("click", function (e) {
    if (e.target.classList.contains("home-banner-bullet")) {
      setTimeout(() => {
        if (homeBannerSwiper && homeBannerTotal > 1 && homeBannerSwiper.autoplay) {
          homeBannerSwiper.autoplay.start();
        }
      }, 100);
    }
  });
});

function toggleMobileMenu() {
  const mobileNav = document.getElementById("mobileNav");
  mobileNav.classList.toggle("show");
}

function toggleMobileDropdown(dropdownId) {
  const dropdown = document.getElementById(dropdownId);
  dropdown.classList.toggle("show");
}

// Close mobile menu when clicking outside
document.addEventListener("click", function (event) {
  const mobileNav = document.getElementById("mobileNav");
  const menuBtn = document.querySelector(".mobile-menu-btn");

  if (!mobileNav.contains(event.target) && !menuBtn.contains(event.target)) {
    mobileNav.classList.remove("show");
  }
});

// Close mobile menu when clicking on a link
document.querySelectorAll(".mobile-nav a").forEach((link) => {
  link.addEventListener("click", (e) => {
    if (!link.querySelector(".indicator")) {
      document.getElementById("mobileNav").classList.remove("show");
    }
  });
});
