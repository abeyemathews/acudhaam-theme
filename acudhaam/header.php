<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- FIXED TOP BAR -->
<div class="top-contact-bar" id="topContactBar">
    <div class="container contact-bar-content">
        <div class="contact-info-top">
            <a href="tel:<?php echo esc_attr(get_theme_mod('contact_phone', '+91 77366 85613')); ?>">
                <i class="fas fa-phone"></i>
                <span><?php echo esc_html(get_theme_mod('contact_phone', '+91 77366 85613')); ?></span>
            </a>
            <a href="mailto:<?php echo esc_attr(get_theme_mod('contact_email', 'enquiry@acudhaam.com')); ?>">
                <i class="fas fa-envelope"></i>
                <span><?php echo esc_html(get_theme_mod('contact_email', 'enquiry@acudhaam.com')); ?></span>
            </a>
        </div>
        <div class="top-social-links">
            <?php if (get_theme_mod('facebook_url', '#')) : ?>
                <a href="<?php echo esc_url(get_theme_mod('facebook_url', '#')); ?>" target="_blank" rel="noopener noreferrer" aria-label="Facebook">
                    <i class="fab fa-facebook-f"></i>
                </a>
            <?php endif; ?>
            
            <?php if (get_theme_mod('twitter_url', '#')) : ?>
                <a href="<?php echo esc_url(get_theme_mod('twitter_url', '#')); ?>" target="_blank" rel="noopener noreferrer" aria-label="Twitter / X">
                    <i class="fab fa-x-twitter"></i>
                </a>
            <?php endif; ?>
            
            <?php if (get_theme_mod('instagram_url', '#')) : ?>
                <a href="<?php echo esc_url(get_theme_mod('instagram_url', '#')); ?>" target="_blank" rel="noopener noreferrer" aria-label="Instagram">
                    <i class="fab fa-instagram"></i>
                </a>
            <?php endif; ?>
            
            <?php if (get_theme_mod('youtube_url', '#')) : ?>
                <a href="<?php echo esc_url(get_theme_mod('youtube_url', '#')); ?>" target="_blank" rel="noopener noreferrer" aria-label="YouTube">
                    <i class="fab fa-youtube"></i>
                </a>
            <?php endif; ?>
            
            <?php if (get_theme_mod('linkedin_url', '#')) : ?>
                <a href="<?php echo esc_url(get_theme_mod('linkedin_url', '#')); ?>" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn">
                    <i class="fab fa-linkedin-in"></i>
                </a>
            <?php endif; ?>
        </div>
    </div>
</div>
<div class="header-spacer" id="headerSpacer"></div>

<!-- SCROLLING BANNER -->
<div class="scrolling-banner-wrapper">
    <div class="container scrolling-container">
        <div class="scrolling-messages" id="scrollingMessages">
            <div class="message-item">
                <a href="#clinics" class="message-link">
                    <i class="fas fa-star"></i>
                    <span><?php _e('60+ Clinics Across India', 'acudhaam'); ?></span>
                </a>
            </div>
            <div class="message-item">
                <a href="#about" class="message-link">
                    <i class="fas fa-heart"></i>
                    <span><?php _e('9+ Years of Healing', 'acudhaam'); ?></span>
                </a>
            </div>
            <div class="message-item">
                <a href="#institute-detailed" class="message-link">
                    <i class="fas fa-award"></i>
                    <span><?php _e('B.Voc & Diploma', 'acudhaam'); ?></span>
                </a>
            </div>
            <div class="message-item">
                <a href="#organics-detailed" class="message-link">
                    <i class="fas fa-leaf"></i>
                    <span><?php _e('Green Raw Organics', 'acudhaam'); ?></span>
                </a>
            </div>
            <div class="message-item">
                <a href="#testimonials" class="message-link">
                    <i class="fas fa-users"></i>
                    <span><?php _e('50,000+ Patients', 'acudhaam'); ?></span>
                </a>
            </div>
            <div class="message-item">
                <a href="#institute-detailed" class="message-link">
                    <i class="fas fa-graduation-cap"></i>
                    <span><?php _e('Enki Stream', 'acudhaam'); ?></span>
                </a>
            </div>
            <!-- Duplicate for seamless scrolling -->
            <div class="message-item">
                <a href="#clinics" class="message-link">
                    <i class="fas fa-star"></i>
                    <span><?php _e('60+ Clinics Across India', 'acudhaam'); ?></span>
                </a>
            </div>
            <div class="message-item">
                <a href="#about" class="message-link">
                    <i class="fas fa-heart"></i>
                    <span><?php _e('9+ Years of Healing', 'acudhaam'); ?></span>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- HERO CAROUSEL - DYNAMIC FROM CPT -->
<?php if (is_front_page()) : ?>
<div class="fullscreen-carousel gradient-bg" id="home">
    <div class="carousel-slides">
        <?php
        $slides = acudhaam_get_hero_slides();
        $slide_index = 0;
        if ($slides->have_posts()) :
            while ($slides->have_posts()) : $slides->the_post();
                $slide_index++;
                $subtitle      = get_post_meta(get_the_ID(), '_hero_slide_subtitle', true);
                $description   = get_post_meta(get_the_ID(), '_hero_slide_description', true);
                $button_text   = get_post_meta(get_the_ID(), '_hero_slide_button_text', true);
                $button_url    = get_post_meta(get_the_ID(), '_hero_slide_button_url', true);
                $overlay_opacity = get_post_meta(get_the_ID(), '_hero_slide_overlay_opacity', true) ?: '0.65';
                $background_image = has_post_thumbnail() ? get_the_post_thumbnail_url(get_the_ID(), 'full') : get_template_directory_uri() . '/assets/images/a04.jpg';
                ?>
                <div class="carousel-slide <?php echo ($slide_index === 1) ? 'active' : ''; ?>" 
                     style="background-image: url('<?php echo esc_url($background_image); ?>');">
                    <div class="slide-overlay" style="opacity: <?php echo esc_attr($overlay_opacity); ?>;"></div>
                    <div class="slide-content">
                        <?php if (get_the_title()) : ?>
                            <h1><?php the_title(); ?></h1>
                        <?php endif; ?>
                        <?php if ($subtitle) : ?>
                            <p class="slide-subtitle"><?php echo esc_html($subtitle); ?></p>
                        <?php endif; ?>
                        <?php if ($description) : ?>
                            <p class="slide-value-proposition"><?php echo esc_html($description); ?></p>
                        <?php endif; ?>
                        <?php if ($button_text && $button_url) : ?>
                            <a href="<?php echo esc_url($button_url); ?>" class="btn btn-primary">
                                <?php echo esc_html($button_text); ?>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
                <?php
            endwhile;
            wp_reset_postdata();
        else :
            // Fallback slide if no slides created
            ?>
            <div class="carousel-slide active" style="background-image: url('<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/a04.jpg');">
                <div class="slide-overlay" style="opacity:0.65;"></div>
                <div class="slide-content">
                    <h1><?php _e('Acudhaam Pvt. Ltd.', 'acudhaam'); ?></h1>
                    <p class="slide-subtitle"><?php _e('WHERE WELL‑BEING MEETS TRANQUILITY', 'acudhaam'); ?></p>
                    <p class="slide-value-proposition"><?php _e('A holistic ecosystem integrating Indian Classical Acupuncture, Conscious Education, and Organic Living', 'acudhaam'); ?></p>
                    <a href="#about" class="btn btn-primary"><?php _e('Explore More', 'acudhaam'); ?></a>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <!-- Center Logo -->
    <div class="logo-center">
        <a href="#home">
            <?php if (has_custom_logo()) : ?>
                <?php the_custom_logo(); ?>
            <?php else : ?>
                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/logo.png" alt="<?php bloginfo('name'); ?>" class="main-logo-image">
            <?php endif; ?>
        </a>
        <div class="logo-tagline"><?php bloginfo('description'); ?></div>
    </div>

    <!-- Desktop Thumbnails - Left Side (static) -->
    <nav class="thumbnail-menu thumbnail-menu-left">
        <a href="#home" class="thumbnail-item">
            <img src="https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&q=80" alt="" class="thumbnail-image" loading="lazy">
            <div class="thumbnail-icon"><i class="fas fa-home"></i></div>
            <span class="thumbnail-label"><?php _e('Home', 'acudhaam'); ?></span>
        </a>
        <a href="#clinics" class="thumbnail-item">
            <img src="https://images.unsplash.com/photo-1582750433449-648ed127bb54?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&q=80" alt="" class="thumbnail-image" loading="lazy">
            <div class="thumbnail-icon"><i class="fas fa-map-marker-alt"></i></div>
            <span class="thumbnail-label"><?php _e('Clinics', 'acudhaam'); ?></span>
        </a>
        <a href="#about" class="thumbnail-item">
            <img src="https://images.unsplash.com/photo-1551601651-2a8555f1a136?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&q=80" alt="" class="thumbnail-image" loading="lazy">
            <div class="thumbnail-icon"><i class="fas fa-spa"></i></div>
            <span class="thumbnail-label"><?php _e('Treatments', 'acudhaam'); ?></span>
        </a>
    </nav>

    <!-- Desktop Thumbnails - Right Side (static) -->
    <nav class="thumbnail-menu thumbnail-menu-right">
        <a href="#institute-detailed" class="thumbnail-item">
            <img src="https://images.unsplash.com/photo-1523050854058-8df90110c9f1?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&q=80" alt="" class="thumbnail-image" loading="lazy">
            <div class="thumbnail-icon"><i class="fas fa-graduation-cap"></i></div>
            <span class="thumbnail-label"><?php _e('Institute', 'acudhaam'); ?></span>
        </a>
        <a href="#organics-detailed" class="thumbnail-item">
            <img src="https://images.unsplash.com/photo-1498837167922-ddd27525d352?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&q=80" alt="" class="thumbnail-image" loading="lazy">
            <div class="thumbnail-icon"><i class="fas fa-leaf"></i></div>
            <span class="thumbnail-label"><?php _e('Organics', 'acudhaam'); ?></span>
        </a>
        <a href="#contact-section" class="thumbnail-item">
            <img src="https://images.unsplash.com/photo-1542744173-8e7e53415bb0?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&q=80" alt="" class="thumbnail-image" loading="lazy">
            <div class="thumbnail-icon"><i class="fas fa-envelope"></i></div>
            <span class="thumbnail-label"><?php _e('Contact', 'acudhaam'); ?></span>
        </a>
    </nav>

    <!-- Carousel Navigation -->
    <div class="carousel-nav carousel-prev" id="prevSlide"><i class="fas fa-chevron-left"></i></div>
    <div class="carousel-nav carousel-next" id="nextSlide"><i class="fas fa-chevron-right"></i></div>

    <!-- Carousel Dots - generated dynamically -->
    <div class="carousel-controls" id="carouselDots">
        <?php
        $total_slides = $slides->post_count;
        if ($total_slides == 0) $total_slides = 1; // fallback count
        for ($i = 0; $i < $total_slides; $i++) {
            $active_class = ($i === 0) ? 'active' : '';
            echo '<div class="carousel-dot ' . $active_class . '" data-index="' . $i . '"></div>';
        }
        ?>
    </div>
</div>

<!-- ================================================== -->
<!-- COMPLETE BANNER MANAGEMENT SYSTEM                  -->
<!-- ================================================== -->

<!-- CLINIC BANNER - Fully Customizable via Customizer -->
<?php if (acudhaam_display_clinic_banner()) : ?>

<div class="<?php acudhaam_clinic_banner_classes(); ?>" 
     <?php if (get_theme_mod('clinic_banner_type') == 'image' && get_theme_mod('clinic_banner_image')) : ?>
     style="background-image: url('<?php echo esc_url(get_theme_mod('clinic_banner_image')); ?>');"
     <?php endif; ?>>
    
    <!-- Admin Quick Edit Controls (visible only to admins) -->
    <?php if (current_user_can('administrator')) : ?>
    <div class="banner-edit-controls">
        <a href="<?php echo esc_url(admin_url('customize.php?autofocus[section]=banner_section')); ?>" 
           title="<?php esc_attr_e('Edit Banner in Customizer', 'acudhaam'); ?>" 
           target="_blank">
            <i class="fas fa-pencil-alt"></i>
        </a>
        <a href="<?php echo esc_url(admin_url('widgets.php')); ?>" 
           title="<?php esc_attr_e('Manage Banner Widgets', 'acudhaam'); ?>" 
           target="_blank">
            <i class="fas fa-cog"></i>
        </a>
    </div>
    <?php endif; ?>
    
    <div class="container">
        
        <?php if (is_active_sidebar('banner-widget')) : ?>
            <!-- Banner Widget Area - For complex banners -->
            <?php dynamic_sidebar('banner-widget'); ?>
            
        <?php else : ?>
            <!-- Default Banner Content - Customizable via Customizer -->
            
            <!-- Banner Title -->
            <?php if (get_theme_mod('clinic_banner_title')) : ?>
                <div class="clinic-title"><?php echo esc_html(get_theme_mod('clinic_banner_title')); ?></div>
            <?php endif; ?>
            
            <!-- Banner Tamil Subtitle -->
            <?php if (get_theme_mod('clinic_banner_subtitle_tamil')) : ?>
                <div class="clinic-address-tamil"><?php echo esc_html(get_theme_mod('clinic_banner_subtitle_tamil')); ?></div>
            <?php endif; ?>
            
            <!-- Banner Address -->
            <?php if (get_theme_mod('clinic_banner_address')) : ?>
                <div class="clinic-address"><?php echo esc_html(get_theme_mod('clinic_banner_address')); ?></div>
            <?php endif; ?>
            
            <!-- Banner Button (Optional) -->
            <?php if (get_theme_mod('clinic_banner_button_enabled', false) && get_theme_mod('clinic_banner_button_text')) : ?>
                <div class="banner-button">
                    <a href="<?php echo esc_url(get_theme_mod('clinic_banner_button_url', '#clinics')); ?>" 
                       class="btn btn-secondary"
                       style="color: <?php echo esc_attr(get_theme_mod('clinic_banner_button_color', '#ffffff')); ?>; 
                              border-color: <?php echo esc_attr(get_theme_mod('clinic_banner_button_border_color', '#ffffff')); ?>;">
                        <?php echo esc_html(get_theme_mod('clinic_banner_button_text')); ?>
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            <?php endif; ?>
            
        <?php endif; ?>
        
    </div>
</div>
<?php endif; ?>

<!-- SECONDARY PROMOTION BANNER -->
<?php if (get_theme_mod('secondary_banner_enabled', false)) : ?>
<div class="secondary-banner" style="background-color: <?php echo esc_attr(get_theme_mod('secondary_banner_bg_color', '#d4af37')); ?>;">
    <div class="container">
        <div class="secondary-banner-content">
            <?php if (get_theme_mod('secondary_banner_text')) : ?>
                <p class="secondary-banner-text"><?php echo esc_html(get_theme_mod('secondary_banner_text')); ?></p>
            <?php endif; ?>
            
            <?php if (get_theme_mod('secondary_banner_link')) : ?>
                <a href="<?php echo esc_url(get_theme_mod('secondary_banner_link')); ?>" class="secondary-banner-link">
                    <?php _e('Learn More', 'acudhaam'); ?> <i class="fas fa-arrow-right"></i>
                </a>
            <?php endif; ?>
        </div>
    </div>
    <button class="banner-close" aria-label="<?php esc_attr_e('Close banner', 'acudhaam'); ?>">
        <i class="fas fa-times"></i>
    </button>
</div>
<?php endif; ?>

<?php endif; // End is_front_page ?>

<!-- MOBILE MENU BUTTON & OVERLAY -->
<button class="mobile-menu-btn" id="mobileMenuBtn" aria-label="<?php esc_attr_e('Menu', 'acudhaam'); ?>">
    <i class="fas fa-bars"></i>
</button>

<div class="mobile-overlay" id="mobileOverlay">
    <button class="close-menu" id="closeMenu" aria-label="<?php esc_attr_e('Close Menu', 'acudhaam'); ?>">
        <i class="fas fa-times"></i>
    </button>
    
    <div class="mobile-overlay-header">
        <?php if (has_custom_logo()) : ?>
            <?php the_custom_logo(); ?>
        <?php else : ?>
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/logo.png" alt="<?php bloginfo('name'); ?>" class="mobile-logo">
        <?php endif; ?>
        <div class="mobile-tagline"><?php bloginfo('description'); ?></div>
    </div>
    
    <div class="mobile-contact-info">
        <p><i class="fas fa-phone-alt"></i> <?php echo esc_html(get_theme_mod('contact_phone', '+91 77366 85613')); ?></p>
        <p><i class="fas fa-envelope"></i> <?php echo esc_html(get_theme_mod('contact_email', 'enquiry@acudhaam.com')); ?></p>
        <p><i class="fas fa-map-marker-alt"></i> <?php _e('60+ Clinics Across India', 'acudhaam'); ?></p>
    </div>
    
    <div class="mobile-menu-items">
        <?php
        if (has_nav_menu('mobile')) {
            wp_nav_menu(array(
                'theme_location' => 'mobile',
                'container'      => false,
                'menu_class'     => 'mobile-menu-items',
                'fallback_cb'    => false,
                'link_before'    => '<i class="fas fa-home"></i><span>',
                'link_after'     => '</span>',
                'depth'          => 1,
                'items_wrap'     => '%3$s',
            ));
        } else {
            acudhaam_mobile_menu_fallback();
        }
        ?>
    </div>
    
    <div class="mobile-social-links">
        <?php if (get_theme_mod('facebook_url', '#')) : ?>
            <a href="<?php echo esc_url(get_theme_mod('facebook_url', '#')); ?>" target="_blank" rel="noopener noreferrer" aria-label="Facebook">
                <i class="fab fa-facebook-f"></i>
            </a>
        <?php endif; ?>
        
        <?php if (get_theme_mod('twitter_url', '#')) : ?>
            <a href="<?php echo esc_url(get_theme_mod('twitter_url', '#')); ?>" target="_blank" rel="noopener noreferrer" aria-label="Twitter / X">
                <i class="fab fa-x-twitter"></i>
            </a>
        <?php endif; ?>
        
        <?php if (get_theme_mod('instagram_url', '#')) : ?>
            <a href="<?php echo esc_url(get_theme_mod('instagram_url', '#')); ?>" target="_blank" rel="noopener noreferrer" aria-label="Instagram">
                <i class="fab fa-instagram"></i>
            </a>
        <?php endif; ?>
    </div>
</div>

<!-- MAIN CONTENT START -->
<div class="main-content">