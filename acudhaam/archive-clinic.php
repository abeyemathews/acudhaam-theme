<?php
/**
 * Archive template for Clinics
 *
 * @package Acudhaam
 */

get_header(); ?>

<div class="main-content">
    <div class="container">
        <header class="archive-header">
            <h1 class="archive-title"><?php post_type_archive_title(); ?></h1>
            <?php
            $term_description = term_description();
            if (!empty($term_description)) {
                echo '<div class="archive-description">' . $term_description . '</div>';
            }
            ?>
        </header>

        <div class="locations-grid"> <!-- reuse your clinic grid styling -->
            <?php if (have_posts()) : ?>
                <?php while (have_posts()) : the_post(); ?>
                    <div class="location-card">
                        <?php if (has_post_thumbnail()) : ?>
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail('clinic-thumb', array('class' => 'location-img')); ?>
                            </a>
                        <?php endif; ?>
                        <div class="location-content">
                            <div class="location-icon"><i class="fas fa-map-marker-alt"></i></div>
                            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            <?php
                            $address = get_post_meta(get_the_ID(), 'clinic_address', true);
                            $city = get_post_meta(get_the_ID(), 'clinic_city', true);
                            $phone = get_post_meta(get_the_ID(), 'clinic_phone', true);
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
            <?php else : ?>
                <p><?php _e('No clinics found.', 'acudhaam'); ?></p>
            <?php endif; ?>
        </div>

        <?php the_posts_pagination(); ?>
    </div>
</div>

<?php get_footer(); ?>