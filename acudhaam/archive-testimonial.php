<?php
/**
 * Archive Template for Testimonials
 *
 * Displays a list of all testimonial posts.
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

        <?php if (have_posts()) : ?>
            <div class="testimonials-grid">
                <?php while (have_posts()) : the_post(); ?>
                    <div class="testimonial-card">
                        <i class="fas fa-quote-left"></i>
                        <div class="testimonial-text">
                            <?php the_content(); ?>
                        </div>
                        <div class="testimonial-author">
                            <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail('testimonial-small', array('class' => 'author-img')); ?>
                            <?php else : ?>
                                <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/testimonial-placeholder.jpg'); ?>" alt="<?php the_title_attribute(); ?>" class="author-img">
                            <?php endif; ?>
                            <div class="author-info">
                                <h5><?php the_title(); ?></h5>
                                <?php
                                $location = get_post_meta(get_the_ID(), 'location', true);
                                if ($location) : ?>
                                    <p><?php echo esc_html($location); ?></p>
                                <?php endif; ?>
                                <?php
                                $rating = get_post_meta(get_the_ID(), 'rating', true);
                                if ($rating) : ?>
                                    <div class="testimonial-rating">
                                        <?php for ($i = 1; $i <= 5; $i++) : ?>
                                            <i class="fas fa-star <?php echo $i <= $rating ? 'rated' : ''; ?>"></i>
                                        <?php endfor; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>

            <div class="pagination-wrapper">
                <?php
                the_posts_pagination(array(
                    'mid_size'  => 2,
                    'prev_text' => '<i class="fas fa-chevron-left"></i> ' . __('Previous', 'acudhaam'),
                    'next_text' => __('Next', 'acudhaam') . ' <i class="fas fa-chevron-right"></i>',
                ));
                ?>
            </div>

        <?php else : ?>
            <p class="no-results"><?php _e('No testimonials found.', 'acudhaam'); ?></p>
        <?php endif; ?>

    </div>
</div>

<?php get_footer(); ?>