<?php
/**
 * Template part for displaying courses in archive
 *
 * @package Acudhaam
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('archive-course-item'); ?>>
    
    <?php if (has_post_thumbnail()) : ?>
        <div class="course-archive-thumbnail">
            <a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail('medium', array('alt' => the_title_attribute(array('echo' => false)))); ?>
            </a>
        </div>
    <?php endif; ?>
    
    <div class="course-archive-content">
        <h3 class="course-archive-title">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </h3>
        
        <div class="course-archive-meta">
            <?php
            $duration = get_post_meta(get_the_ID(), 'course_duration', true);
            $level = get_post_meta(get_the_ID(), 'course_level', true);
            ?>
            
            <?php if ($duration) : ?>
                <span class="course-duration">
                    <i class="fas fa-clock"></i>
                    <?php echo esc_html($duration); ?>
                </span>
            <?php endif; ?>
            
            <?php if ($level) : ?>
                <span class="course-level">
                    <i class="fas fa-signal"></i>
                    <?php echo esc_html($level); ?>
                </span>
            <?php endif; ?>
        </div>
        
        <div class="course-archive-excerpt">
            <?php the_excerpt(); ?>
        </div>
        
        <a href="<?php the_permalink(); ?>" class="btn btn-primary course-archive-btn">
            <?php esc_html_e('Learn More', 'acudhaam'); ?>
            <i class="fas fa-arrow-right"></i>
        </a>
    </div>
    
</article>