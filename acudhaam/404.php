<?php
/**
 * 404 Error Page Template
 *
 * Displayed when a page cannot be found.
 *
 * @package Acudhaam
 */

get_header(); ?>

<!-- MAIN CONTENT -->
<div class="main-content">
    <div class="container">
        
        <section class="error-404 not-found">
            
            <!-- Decorative Element -->
            <div class="error-decoration">
                <span class="error-number">4</span>
                <span class="error-icon">
                    <i class="fas fa-leaf"></i>
                </span>
                <span class="error-number">4</span>
            </div>
            
            <!-- Main Content -->
            <div class="error-content">
                <h1 class="error-title"><?php esc_html_e('Page Not Found', 'acudhaam'); ?></h1>
                
                <p class="error-message">
                    <?php esc_html_e('Oops! The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.', 'acudhaam'); ?>
                </p>
                
                <p class="error-suggestion">
                    <?php esc_html_e('Here are some helpful links instead:', 'acudhaam'); ?>
                </p>
                
                <!-- Navigation Options -->
                <div class="error-actions">
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-primary">
                        <i class="fas fa-home"></i>
                        <?php esc_html_e('Return Home', 'acudhaam'); ?>
                    </a>
                    
                    <a href="#contact-section" class="btn btn-secondary">
                        <i class="fas fa-envelope"></i>
                        <?php esc_html_e('Contact Us', 'acudhaam'); ?>
                    </a>
                </div>
                
                <!-- Search Form -->
                <div class="error-search">
                    <h3><?php esc_html_e('Or try searching:', 'acudhaam'); ?></h3>
                    <?php get_search_form(); ?>
                </div>
            </div>
            
            <!-- Quick Links Grid -->
            <div class="error-quick-links">
                <h3><?php esc_html_e('Popular Pages', 'acudhaam'); ?></h3>
                
                <div class="quick-links-grid">
                    
                    <!-- Clinics -->
                    <a href="#clinics" class="quick-link-card">
                        <div class="quick-link-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div class="quick-link-info">
                            <h4><?php esc_html_e('Our Clinics', 'acudhaam'); ?></h4>
                            <p><?php esc_html_e('Find a clinic near you', 'acudhaam'); ?></p>
                        </div>
                    </a>
                    
                    <!-- Institute -->
                    <a href="#institute-detailed" class="quick-link-card">
                        <div class="quick-link-icon">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <div class="quick-link-info">
                            <h4><?php esc_html_e('Acudhaam Institute', 'acudhaam'); ?></h4>
                            <p><?php esc_html_e('Explore our courses', 'acudhaam'); ?></p>
                        </div>
                    </a>
                    
                    <!-- Organics -->
                    <a href="#organics-detailed" class="quick-link-card">
                        <div class="quick-link-icon">
                            <i class="fas fa-leaf"></i>
                        </div>
                        <div class="quick-link-info">
                            <h4><?php esc_html_e('Green Organics', 'acudhaam'); ?></h4>
                            <p><?php esc_html_e('Shop organic products', 'acudhaam'); ?></p>
                        </div>
                    </a>
                    
                    <!-- Blog -->
                    <a href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>" class="quick-link-card">
                        <div class="quick-link-icon">
                            <i class="fas fa-blog"></i>
                        </div>
                        <div class="quick-link-info">
                            <h4><?php esc_html_e('Our Blog', 'acudhaam'); ?></h4>
                            <p><?php esc_html_e('Read latest articles', 'acudhaam'); ?></p>
                        </div>
                    </a>
                    
                </div>
            </div>
            
            <!-- Contact Info -->
            <div class="error-contact">
                <p>
                    <?php esc_html_e('If you need immediate assistance, please contact us:', 'acudhaam'); ?>
                </p>
                
                <div class="contact-details">
                    <span class="contact-phone">
                        <i class="fas fa-phone"></i>
                        <a href="tel:<?php echo esc_attr(get_theme_mod('contact_phone', '+91 77366 85613')); ?>">
                            <?php echo esc_html(get_theme_mod('contact_phone', '+91 77366 85613')); ?>
                        </a>
                    </span>
                    
                    <span class="contact-email">
                        <i class="fas fa-envelope"></i>
                        <a href="mailto:<?php echo esc_attr(get_theme_mod('contact_email', 'enquiry@acudhaam.com')); ?>">
                            <?php echo esc_html(get_theme_mod('contact_email', 'enquiry@acudhaam.com')); ?>
                        </a>
                    </span>
                </div>
            </div>
            
        </section>
        
    </div>
</div>

<?php get_footer(); ?>