<?php
/**
 * Front Page Template (Multipage Landing)
 *
 * This template creates a landing page that links to dedicated pages
 * for clinics, courses, team, testimonials, organic products, and contact.
 *
 * @package Acudhaam
 */

get_header(); ?>

<!-- MAIN CONTENT -->
<div class="main-content">
    
    <!-- About Section (stays on home page) -->
    <section id="about">
        <div class="container">
            <div class="section-intro">
                <h2><?php _e('Restore. Learn. Thrive.', 'acudhaam'); ?></h2>
                <p><?php _e('Experience the synergy of ancient healing wisdom and modern sustainable living. At Acudhaam, we\'ve created a harmonious ecosystem where wellness, education, and nature converge.', 'acudhaam'); ?></p>
            </div>
            
            <div class="services-grid">
                <!-- Service Card 1: Indian Classical Acupuncture → links to Clinic Locations page -->
                <div class="service-card">
                    <img src="https://images.unsplash.com/photo-1551601651-2a8555f1a136?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="<?php esc_attr_e('Acupuncture', 'acudhaam'); ?>" class="service-img" loading="lazy">
                    <div class="service-content">
                        <div class="service-icon"><i class="fas fa-spa"></i></div>
                        <h3><?php _e('Indian Classical Acupuncture', 'acudhaam'); ?></h3>
                        <p><?php _e('Precision healing across 60+ clinics. Our unique approach restores the body\'s fundamental energy balance.', 'acudhaam'); ?></p>
                        <a href="<?php echo esc_url(get_permalink(get_page_by_path('clinic-locations'))); ?>" class="btn btn-primary">
                            <?php _e('Find a Clinic', 'acudhaam'); ?>
                        </a>
                    </div>
                </div>
                
                <!-- Service Card 2: Acudhaam Institute → links to Our Courses page -->
                <div class="service-card">
                    <img src="https://images.unsplash.com/photo-1523050854058-8df90110c9f1?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="<?php esc_attr_e('Institute', 'acudhaam'); ?>" class="service-img" loading="lazy">
                    <div class="service-content">
                        <div class="service-icon"><i class="fas fa-graduation-cap"></i></div>
                        <h3><?php _e('Acudhaam Institute', 'acudhaam'); ?></h3>
                        <p><?php _e('B.Voc & Advanced Diploma in Acupuncture. Transformative education with intensive clinical practice.', 'acudhaam'); ?></p>
                        <a href="<?php echo esc_url(get_permalink(get_page_by_path('our-courses'))); ?>" class="btn btn-primary">
                            <?php _e('Explore Courses', 'acudhaam'); ?>
                        </a>
                    </div>
                </div>
                
                <!-- Service Card 3: Green Raw Organics → links to Organic Products page -->
                <div class="service-card">
                    <img src="https://images.unsplash.com/photo-1498837167922-ddd27525d352?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="<?php esc_attr_e('Organics', 'acudhaam'); ?>" class="service-img" loading="lazy">
                    <div class="service-content">
                        <div class="service-icon"><i class="fas fa-leaf"></i></div>
                        <h3><?php _e('Green Raw Organics', 'acudhaam'); ?></h3>
                        <p><?php _e('Pure, sustainable nourishment from our chemical-free farms. Fresh produce and herbal supplements.', 'acudhaam'); ?></p>
                        <a href="<?php echo esc_url(get_permalink(get_page_by_path('organic-products'))); ?>" class="btn btn-primary">
                            <?php _e('Shop Organic', 'acudhaam'); ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Philosophy Section (stays on home page – can be moved to an About page later) -->
    <section class="philosophy">
        <div class="container">
            <div class="philosophy-content">
                <div>
                    <h2><?php _e('Our Philosophy', 'acudhaam'); ?></h2>
                    <p><?php _e('For over 9 years, Acudhaam has been pioneering a holistic approach to wellness under the guidance of our founder, Tomichan C. We believe that true healing comes from restoring the harmony between body, mind, and nature.', 'acudhaam'); ?></p>
                    <p><?php _e('Our unique integration of Indian Classical Acupuncture, conscious education, and organic living creates a complete ecosystem for well-being.', 'acudhaam'); ?></p>
                    
                    <div class="philosophy-stats">
                        <div class="stat-item">
                            <div class="stat-number">9+</div>
                            <div class="stat-label"><?php _e('Years', 'acudhaam'); ?></div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number">60+</div>
                            <div class="stat-label"><?php _e('Clinics', 'acudhaam'); ?></div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number">50k+</div>
                            <div class="stat-label"><?php _e('Patients', 'acudhaam'); ?></div>
                        </div>
                    </div>
                    
                    <!-- Optional: link to a separate "About Us" page if you create one -->
                    <a href="<?php echo esc_url(get_permalink(get_page_by_path('about-us'))); ?>" class="btn btn-primary">
                        <?php _e('Learn Our Story', 'acudhaam'); ?>
                    </a>
                </div>
                <div>
                    <img src="https://images.unsplash.com/photo-1542744173-8e7e53415bb0?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="<?php esc_attr_e('Founder', 'acudhaam'); ?>" style="width:100%; border-radius:20px;">
                </div>
            </div>
        </div>
    </section>

    <!-- Quick Links Section – provides easy access to all dedicated pages -->
    <section class="quick-links" style="background: var(--cream-bg); text-align: center; padding: 60px 0;">
        <div class="container">
            <h2><?php _e('Explore Our Ecosystem', 'acudhaam'); ?></h2>
            <div style="display: flex; flex-wrap: wrap; justify-content: center; gap: 20px; margin-top: 30px;">
                <a href="<?php echo esc_url(get_permalink(get_page_by_path('clinic-locations'))); ?>" class="btn btn-secondary">
                    <?php _e('All Clinics', 'acudhaam'); ?>
                </a>
                <a href="<?php echo esc_url(get_permalink(get_page_by_path('our-courses'))); ?>" class="btn btn-secondary">
                    <?php _e('All Courses', 'acudhaam'); ?>
                </a>
                <a href="<?php echo esc_url(get_permalink(get_page_by_path('our-team'))); ?>" class="btn btn-secondary">
                    <?php _e('Our Team', 'acudhaam'); ?>
                </a>
                <a href="<?php echo esc_url(get_permalink(get_page_by_path('testimonials-archive'))); ?>" class="btn btn-secondary">
                    <?php _e('Testimonials', 'acudhaam'); ?>
                </a>
                <a href="<?php echo esc_url(get_permalink(get_page_by_path('organic-products'))); ?>" class="btn btn-secondary">
                    <?php _e('Organic Shop', 'acudhaam'); ?>
                </a>
                <a href="<?php echo esc_url(get_permalink(get_page_by_path('contact-enhanced'))); ?>" class="btn btn-primary">
                    <?php _e('Contact Us', 'acudhaam'); ?>
                </a>
            </div>
        </div>
    </section>

<?php get_footer(); ?>