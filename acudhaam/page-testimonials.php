<?php
/**
 * Template Name: Testimonials Archive
 * Description: Displays all client testimonials.
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
        $testimonials = new WP_Query(array(
            'post_type'      => 'testimonial',
            'posts_per_page' => -1,
            'orderby'        => 'date',
            'order'          => 'DESC',
        ));

        if ($testimonials->have_posts()) : ?>
            <div class="testimonials-grid">
                <?php while ($testimonials->have_posts()) : $testimonials->the_post(); ?>
                    <div class="testimonial-card">
                        <i class="fas fa-quote-left"></i>
                        <div class="testimonial-text"><?php the_content(); ?></div>
                        <div class="testimonial-author">
                            <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail('testimonial-small', array('class' => 'author-img')); ?>
                            <?php else : ?>
                                <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/testimonial-placeholder.jpg'); ?>" class="author-img" alt="<?php the_title_attribute(); ?>">
                            <?php endif; ?>
                            <div class="author-info">
                                <h5><?php the_title(); ?></h5>
                                <?php $location = get_post_meta(get_the_ID(), 'location', true); ?>
                                <?php if ($location) : ?>
                                    <p><?php echo esc_html($location); ?></p>
                                <?php endif; ?>
                                <?php $rating = get_post_meta(get_the_ID(), 'rating', true); ?>
                                <?php if ($rating) : ?>
                                    <div class="testimonial-rating">
                                        <?php for ($i = 1; $i <= 5; $i++) : ?>
                                            <i class="fas fa-star <?php echo $i <= $rating ? 'rated' : ''; ?>" style="color: <?php echo $i <= $rating ? '#d4af37' : '#ccc'; ?>;"></i>
                                        <?php endfor; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
            <?php wp_reset_postdata(); ?>
        <?php else : ?>
            <p><?php esc_html_e('No testimonials found.', 'acudhaam'); ?></p>
        <?php endif; ?>
    </div>
</div>

<?php get_footer(); ?>