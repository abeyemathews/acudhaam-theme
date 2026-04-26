<?php
/**
 * Template Name: Enhanced Contact
 * Description: Contact page with map, hours, and form.
 *
 * @package Acudhaam
 */

get_header(); ?>

<div class="main-content">
    <div class="container">
        <header class="page-header">
            <h1 class="page-title"><?php the_title(); ?></h1>
            <?php if (has_excerpt()) : ?>
                <div class="page-description"><?php the_excerpt(); ?></div>
            <?php endif; ?>
        </header>

        <div class="contact-grid-enhanced" style="display: grid; grid-template-columns: 1fr 1fr; gap: 50px;">
            <!-- Left: Contact Info & Map -->
            <div>
                <div class="contact-info-box" style="background: white; padding: 30px; border-radius: 20px; margin-bottom: 30px;">
                    <h3><?php esc_html_e('Get in Touch', 'acudhaam'); ?></h3>
                    <div class="contact-detail" style="margin: 20px 0;">
                        <i class="fas fa-map-marker-alt" style="color: var(--accent-gold); width: 30px;"></i>
                        <div>
                            <h4><?php esc_html_e('Head Office', 'acudhaam'); ?></h4>
                            <p><?php echo esc_html(get_theme_mod('contact_address', 'Acudhaam House, Kurishadi Junction, Nalanchira, Thiruvananthapuram - 695015')); ?></p>
                        </div>
                    </div>
                    <div class="contact-detail" style="margin: 20px 0;">
                        <i class="fas fa-phone-alt" style="color: var(--accent-gold); width: 30px;"></i>
                        <div>
                            <h4><?php esc_html_e('Phone', 'acudhaam'); ?></h4>
                            <p><a href="tel:<?php echo esc_attr(get_theme_mod('contact_phone', '+91 77366 85613')); ?>"><?php echo esc_html(get_theme_mod('contact_phone', '+91 77366 85613')); ?></a></p>
                        </div>
                    </div>
                    <div class="contact-detail" style="margin: 20px 0;">
                        <i class="fas fa-envelope" style="color: var(--accent-gold); width: 30px;"></i>
                        <div>
                            <h4><?php esc_html_e('Email', 'acudhaam'); ?></h4>
                            <p><a href="mailto:<?php echo esc_attr(get_theme_mod('contact_email', 'enquiry@acudhaam.com')); ?>"><?php echo esc_html(get_theme_mod('contact_email', 'enquiry@acudhaam.com')); ?></a></p>
                        </div>
                    </div>
                    <div class="contact-detail" style="margin: 20px 0;">
                        <i class="fas fa-clock" style="color: var(--accent-gold); width: 30px;"></i>
                        <div>
                            <h4><?php esc_html_e('Business Hours', 'acudhaam'); ?></h4>
                            <p><?php esc_html_e('Mon - Sat: 10:00 AM – 6:00 PM', 'acudhaam'); ?><br><?php esc_html_e('Sunday: Closed', 'acudhaam'); ?></p>
                        </div>
                    </div>
                </div>

                <!-- Simple Map Embed (replace with your Google Maps API key if needed) -->
                <div class="map-container" style="border-radius: 20px; overflow: hidden; box-shadow: var(--shadow);">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3945.123456789!2d76.123456789!3d8.123456789!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zOMKwMDAnMDAuMCJOIDc2wrAwMCcwMC4wIkU!5e0!3m2!1sen!2sin!4v1234567890" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>

            <!-- Right: Contact Form -->
            <div class="contact-form-wrapper" style="background: white; padding: 30px; border-radius: 20px;">
                <h3><?php esc_html_e('Send a Message', 'acudhaam'); ?></h3>
                <form id="contactForm" method="post">
                    <?php wp_nonce_field('acudhaam_contact', 'contact_nonce'); ?>
                    <input type="text" name="name" placeholder="<?php esc_attr_e('Your Name *', 'acudhaam'); ?>" required>
                    <input type="email" name="email" placeholder="<?php esc_attr_e('Your Email *', 'acudhaam'); ?>" required>
                    <input type="tel" name="phone" placeholder="<?php esc_attr_e('Phone Number', 'acudhaam'); ?>">
                    <textarea name="message" rows="5" placeholder="<?php esc_attr_e('Your Message *', 'acudhaam'); ?>" required></textarea>
                    <button type="submit" class="btn btn-primary" style="width: 100%;"><?php esc_html_e('Send Message', 'acudhaam'); ?></button>
                </form>
                <div id="formResponse" style="display:none; margin-top: 15px;"></div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>