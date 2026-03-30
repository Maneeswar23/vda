<!-- Clean Banner Section -->
<?php include 'includes/header.php'; ?>

<section class="hero-about-section">
    <div class="hero-overlay"></div>
    <div class="hero-content">
        <h1 class="about-heading">Courses</h1>
    </div>

</section>

<section class="course-section">
    <div class="container">
        <div class="row g-4">
            <?php if (!empty($courses)): ?>
                <?php foreach ($courses as $course): ?>
                    <div class="col-lg-4 col-md-6">
                        <div class="course-card">
                            <h4><?= esc($course['title']) ?></h4>

                            <?php if (!empty($course['description'])): ?>
                                <p><?= esc($course['description']) ?></p>
                            <?php endif; ?>

                            <hr>

                            <a href="<?= base_url('course-view/' . $course['id']) ?>" class="view-btn">
                                View Course
                                <span>
                                    <i class="fa-solid fa-arrow-right"></i>
                                </span>
                            </a>

                            <?php if (!empty($course['image'])): ?>
                                <div class="course-img">
                                    <img src="<?= esc(cms_image_url($course['image'], 'courses')) ?>" alt="<?= esc($course['title']) ?>">
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12">
                    <div class="course-card">
                        <h4>No courses available</h4>
                        <p>Courses will appear here after they are added from the admin panel.</p>
                    </div>
                </div>
            <?php endif; ?>

        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
