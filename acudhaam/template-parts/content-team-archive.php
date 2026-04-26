<?php
/**
 * Template part for displaying team members in archive
 *
 * @package Acudhaam
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('archive-team-item'); ?>>
    
    <?php if (has_post_thumbnail()) : ?>
        <div class="team-archive-thumbnail">
            <a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail('team-square', array('alt' => the_title_attribute(array('echo' => false)))); ?>
            </a>
        </div>
    <?php endif; ?>
    
    <div class="team-archive-content">
        <h3 class="team-archive-title">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </h3>
        
        <?php $position = get_post_meta(get_the_ID(), 'position', true); ?>
        <?php if ($position) : ?>
            <div class="team-archive-position"><?php echo esc_html($position); ?></div>
        <?php endif; ?>
        
        <div class="team-archive-excerpt">
            <?php the_excerpt(); ?>
        </div>
        
        <div class="team-archive-social">
            <?php $linkedin = get_post_meta(get_the_ID(), 'linkedin', true); ?>
            <?php if ($linkedin) : ?>
                <a href="<?php echo esc_url($linkedin); ?>" target="_blank" rel="noopener noreferrer" class="social-link linkedin">
                    <i class="fab fa-linkedin-in"></i>
                </a>
            <?php endif; ?>
            
            <?php $twitter = get_post_meta(get_the_ID(), 'twitter', true); ?>
            <?php if ($twitter) : ?>
                <a href="<?php echo esc_url($twitter); ?>" target="_blank" rel="noopener noreferrer" class="social-link twitter">
                    <i class="fab fa-twitter"></i>
                </a>
            <?php endif; ?>
        </div>
    </div>
    
</article>