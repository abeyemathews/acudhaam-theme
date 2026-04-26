<?php
/**
 * Single Clinic template
 *
 * @package Acudhaam
 */

get_header(); ?>

<div class="main-content">
    <div class="container">
        <?php while (have_posts()) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="entry-header">
                    <h1 class="entry-title"><?php the_title(); ?></h1>
                </header>

                <div class="entry-content">
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="clinic-featured-image">
                            <?php the_post_thumbnail('large'); ?>
                        </div>
                    <?php endif; ?>

                    <div class="clinic-details">
                        <?php
                        $phone = get_post_meta(get_the_ID(), 'clinic_phone', true);
                        $email = get_post_meta(get_the_ID(), 'clinic_email', true);
                        $address = get_post_meta(get_the_ID(), 'clinic_address', true);
                        $city = get_post_meta(get_the_ID(), 'clinic_city', true);
                        ?>
                        <div class="clinic-info">
                            <?php if ($address) : ?>
                                <p><strong><?php _e('Address:', 'acudhaam'); ?></strong> <?php echo esc_html($address); ?>, <?php echo esc_html($city); ?></p>
                            <?php endif; ?>
                            <?php if ($phone) : ?>
                                <p><strong><?php _e('Phone:', 'acudhaam'); ?></strong> <a href="tel:<?php echo esc_attr($phone); ?>"><?php echo esc_html($phone); ?></a></p>
                            <?php endif; ?>
                            <?php if ($email) : ?>
                                <p><strong><?php _e('Email:', 'acudhaam'); ?></strong> <a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a></p>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="clinic-description">
                        <?php the_content(); ?>
                    </div>
                </div>
            </article>
        <?php endwhile; ?>
    </div>
</div>

<?php get_footer(); ?>