<?php
/**
 * Template Name: Organic Products
 * Description: Showcases Green Raw Organics products.
 *
 * @package Acudhaam
 */

get_header(); ?>

<div class="main-content">
    <div class="container">
        <header class="page-header" style="text-align: center;">
            <h1 class="page-title"><?php the_title(); ?></h1>
            <?php if (has_excerpt()) : ?>
                <div class="page-description"><?php the_excerpt(); ?></div>
            <?php endif; ?>
        </header>

        <div class="organics-showcase" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 40px; margin: 60px 0;">
            <div class="organic-product" style="text-align: center; padding: 30px; background: white; border-radius: 20px;">
                <i class="fas fa-apple-alt" style="font-size: 3rem; color: var(--accent-gold);"></i>
                <h4><?php esc_html_e('Fresh Harvest', 'acudhaam'); ?></h4>
                <p><?php esc_html_e('Seasonal fruits and vegetables delivered within 24 hours of harvest.', 'acudhaam'); ?></p>
                <span class="organic-badge" style="background: var(--accent-gold); padding: 5px 15px; border-radius: 50px;"><?php esc_html_e('Certified Organic', 'acudhaam'); ?></span>
            </div>
            <div class="organic-product" style="text-align: center; padding: 30px; background: white; border-radius: 20px;">
                <i class="fas fa-seedling" style="font-size: 3rem; color: var(--accent-gold);"></i>
                <h4><?php esc_html_e('Herbal Supplements', 'acudhaam'); ?></h4>
                <p><?php esc_html_e('Traditional Ayurvedic formulations prepared using ancient methods.', 'acudhaam'); ?></p>
                <span class="organic-badge" style="background: var(--accent-gold); padding: 5px 15px; border-radius: 50px;"><?php esc_html_e('GMP Certified', 'acudhaam'); ?></span>
            </div>
            <div class="organic-product" style="text-align: center; padding: 30px; background: white; border-radius: 20px;">
                <i class="fas fa-jar" style="font-size: 3rem; color: var(--accent-gold);"></i>
                <h4><?php esc_html_e('Cold-Pressed Oils', 'acudhaam'); ?></h4>
                <p><?php esc_html_e('Wood-pressed coconut, sesame, and groundnut oils retaining all nutrients.', 'acudhaam'); ?></p>
                <span class="organic-badge" style="background: var(--accent-gold); padding: 5px 15px; border-radius: 50px;"><?php esc_html_e('Chemical Free', 'acudhaam'); ?></span>
            </div>
        </div>

        <!-- Optional WooCommerce integration -->
        <?php if (class_exists('WooCommerce')) : ?>
            <div style="text-align: center; margin-top: 40px;">
                <a href="<?php echo esc_url(get_permalink(wc_get_page_id('shop'))); ?>" class="btn btn-primary">
                    <?php esc_html_e('Visit Organic Store', 'acudhaam'); ?>
                </a>
            </div>
        <?php else : ?>
            <div style="text-align: center; margin-top: 40px;">
                <a href="#contact-section" class="btn btn-primary"><?php esc_html_e('Contact Us for Orders', 'acudhaam'); ?></a>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php get_footer(); ?>