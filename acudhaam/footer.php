    <!-- FOOTER -->
    <footer>
        <div class="container">
            <div class="footer-content">
                <!-- Footer Column 1 -->
                <div class="footer-col">
                    <?php if (is_active_sidebar('footer-1')) : ?>
                        <?php dynamic_sidebar('footer-1'); ?>
                    <?php else : ?>
                        <h3><?php bloginfo('name'); ?></h3>
                        <p><?php bloginfo('description'); ?></p>
                        <p><i class="fas fa-map-marker-alt"></i> <?php echo esc_html(get_theme_mod('contact_address', 'Thiruvananthapuram, India')); ?></p>
                        <p><i class="fas fa-phone"></i> <?php echo esc_html(get_theme_mod('contact_phone', '+91 77366 85613')); ?></p>
                        <p><i class="fas fa-envelope"></i> <?php echo esc_html(get_theme_mod('contact_email', 'enquiry@acudhaam.com')); ?></p>
                    <?php endif; ?>
                </div>
                
                <!-- Footer Column 2 -->
                <div class="footer-col">
                    <?php if (is_active_sidebar('footer-2')) : ?>
                        <?php dynamic_sidebar('footer-2'); ?>
                    <?php else : ?>
                        <h3><?php _e('Explore', 'acudhaam'); ?></h3>
                        <?php
                        wp_nav_menu(array(
                            'theme_location' => 'footer',
                            'menu_class'     => 'footer-menu',
                            'container'      => false,
                            'fallback_cb'    => 'acudhaam_footer_menu_fallback',
                            'depth'          => 1,
                            'link_before'    => '<i class="fas fa-chevron-right"></i> ',
                        ));
                        ?>
                    <?php endif; ?>
                </div>
                
                <!-- Footer Column 3 -->
                <div class="footer-col">
                    <?php if (is_active_sidebar('footer-3')) : ?>
                        <?php dynamic_sidebar('footer-3'); ?>
                    <?php else : ?>
                        <h3><?php _e('Support', 'acudhaam'); ?></h3>
                        <a href="#contact-section"><i class="fas fa-chevron-right"></i> <?php _e('Contact Us', 'acudhaam'); ?></a>
                        <a href="#"><i class="fas fa-chevron-right"></i> <?php _e('Privacy Policy', 'acudhaam'); ?></a>
                        <a href="#"><i class="fas fa-chevron-right"></i> <?php _e('Terms of Service', 'acudhaam'); ?></a>
                        <a href="#"><i class="fas fa-chevron-right"></i> <?php _e('FAQ', 'acudhaam'); ?></a>
                    <?php endif; ?>
                </div>
                
                <!-- Footer Column 4 -->
                <div class="footer-col">
                    <?php if (is_active_sidebar('footer-4')) : ?>
                        <?php dynamic_sidebar('footer-4'); ?>
                    <?php else : ?>
                        <h3><?php _e('Follow Us', 'acudhaam'); ?></h3>
                        <div class="footer-social-links" style="display: flex; gap: 15px; margin-top: 20px;">
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
                    <?php endif; ?>
                </div>
            </div>
            
            <!-- Copyright -->
            <div class="copyright">
                <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?> <?php _e('Wellness Ecosystem. All rights reserved.', 'acudhaam'); ?></p>
            </div>
        </div>
    </footer>
</div> <!-- .main-content END -->

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

<?php wp_footer(); ?>
</body>
</html>