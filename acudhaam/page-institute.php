<?php
/**
 * Template Name: Institute Overview
 * Description: Dedicated page for Acudhaam Institute.
 *
 * @package Acudhaam
 */

get_header(); ?>

<div class="main-content">
    <div class="container">
        <header class="page-header" style="text-align: center; margin-bottom: 50px;">
            <h1 class="page-title"><?php the_title(); ?></h1>
            <?php if (has_excerpt()) : ?>
                <div class="page-description"><?php the_excerpt(); ?></div>
            <?php endif; ?>
        </header>

        <!-- Main institute content (from page editor) -->
        <div class="institute-main-content" style="margin-bottom: 60px;">
            <?php the_content(); ?>
        </div>

        <!-- Programs / Features Grid -->
        <div class="institute-features" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 30px; margin: 50px 0;">
            <div class="feature-item" style="text-align: center; padding: 30px; background: white; border-radius: 20px;">
                <i class="fas fa-certificate" style="font-size: 2.5rem; color: var(--accent-gold);"></i>
                <h4><?php esc_html_e('B.Voc Degree', 'acudhaam'); ?></h4>
                <p><?php esc_html_e('3-year full-time program with 1200+ hours of clinical training.', 'acudhaam'); ?></p>
            </div>
            <div class="feature-item" style="text-align: center; padding: 30px; background: white; border-radius: 20px;">
                <i class="fas fa-diploma" style="font-size: 2.5rem; color: var(--accent-gold);"></i>
                <h4><?php esc_html_e('Advanced Diploma', 'acudhaam'); ?></h4>
                <p><?php esc_html_e('18-month intensive for medical professionals.', 'acudhaam'); ?></p>
            </div>
            <div class="feature-item" style="text-align: center; padding: 30px; background: white; border-radius: 20px;">
                <i class="fas fa-chalkboard-teacher" style="font-size: 2.5rem; color: var(--accent-gold);"></i>
                <h4><?php esc_html_e('Expert Faculty', 'acudhaam'); ?></h4>
                <p><?php esc_html_e('Learn from practitioners with 20+ years experience.', 'acudhaam'); ?></p>
            </div>
            <div class="feature-item" style="text-align: center; padding: 30px; background: white; border-radius: 20px;">
                <i class="fas fa-globe-asia" style="font-size: 2.5rem; color: var(--accent-gold);"></i>
                <h4><?php esc_html_e('Global Recognition', 'acudhaam'); ?></h4>
                <p><?php esc_html_e('Credential accepted in 15+ countries.', 'acudhaam'); ?></p>
            </div>
        </div>

        <!-- Call to Action -->
        <div style="text-align: center; margin: 60px 0 40px;">
            <a href="#" class="btn btn-primary"><?php esc_html_e('Download Prospectus', 'acudhaam'); ?></a>
            <a href="#contact-section" class="btn btn-secondary" style="margin-left: 15px;"><?php esc_html_e('Enquire Now', 'acudhaam'); ?></a>
        </div>
    </div>
</div>

<?php get_footer(); ?>