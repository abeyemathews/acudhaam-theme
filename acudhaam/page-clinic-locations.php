<?php
/**
 * Template Name: Clinic Locations
 * Description: Displays all clinic locations in a grid.
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

        <?php
        $clinics = new WP_Query(array(
            'post_type'      => 'clinic',
            'posts_per_page' => -1,
            'orderby'        => 'title',
            'order'          => 'ASC',
        ));

        if ($clinics->have_posts()) : ?>
            <div class="locations-grid">
                <?php while ($clinics->have_posts()) : $clinics->the_post(); ?>
                    <div class="location-card">
                        <?php if (has_post_thumbnail()) : ?>
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail('clinic-thumb', array('class' => 'location-img')); ?>
                            </a>
                        <?php else : ?>
                            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/clinic-placeholder.jpg'); ?>" class="location-img" alt="<?php the_title_attribute(); ?>">
                        <?php endif; ?>
                        <div class="location-content">
                            <div class="location-icon"><i class="fas fa-map-marker-alt"></i></div>
                            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            <?php
                            $address = get_post_meta(get_the_ID(), 'clinic_address', true);
                            $city    = get_post_meta(get_the_ID(), 'clinic_city', true);
                            $phone   = get_post_meta(get_the_ID(), 'clinic_phone', true);
                            ?>
                            <?php if ($address) : ?>
                                <p class="location-address"><?php echo esc_html($address); ?><br><?php echo esc_html($city); ?></p>
                            <?php endif; ?>
                            <?php if ($phone) : ?>
                                <a href="tel:<?php echo esc_attr($phone); ?>" class="location-phone">
                                    <i class="fas fa-phone-alt"></i> <?php echo esc_html($phone); ?>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
            <?php wp_reset_postdata(); ?>
        <?php else : ?>
            <p><?php esc_html_e('No clinics found.', 'acudhaam'); ?></p>
        <?php endif; ?>
    </div>
</div>

<?php get_footer(); ?>