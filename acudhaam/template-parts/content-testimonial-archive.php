<?php
/**
 * Template part for displaying testimonials in archive
 *
 * @package Acudhaam
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('archive-testimonial-item'); ?>>
    
    <div class="testimonial-archive-content">
        <i class="fas fa-quote-left testimonial-quote-icon"></i>
        
        <div class="testimonial-archive-text">
            <?php the_content(); ?>
        </div>
        
        <div class="testimonial-archive-author">
            <?php if (has_post_thumbnail()) : ?>
                <div class="testimonial-archive-avatar">
                    <?php the_post_thumbnail('testimonial-small'); ?>
                </div>
            <?php endif; ?>
            
            <div class="testimonial-archive-info">
                <h4><?php the_title(); ?></h4>
                
                <?php $location = get_post_meta(get_the_ID(), 'location', true); ?>
                <?php if ($location) : ?>
                    <span class="testimonial-location"><?php echo esc_html($location); ?></span>
                <?php endif; ?>
                
                <?php $rating = get_post_meta(get_the_ID(), 'rating', true); ?>
                <?php if ($rating) : ?>
                    <div class="testimonial-rating">
                        <?php for ($i = 1; $i <= 5; $i++) : ?>
                            <i class="fas fa-star <?php echo $i <= $rating ? 'rated' : ''; ?>"></i>
                        <?php endfor; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    
</article>