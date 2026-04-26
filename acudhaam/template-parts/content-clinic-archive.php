<?php
/**
 * Template part for displaying clinics in archive
 *
 * @package Acudhaam
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('archive-clinic-item'); ?>>
    
    <?php if (has_post_thumbnail()) : ?>
        <div class="clinic-archive-thumbnail">
            <a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail('medium', array('alt' => the_title_attribute(array('echo' => false)))); ?>
            </a>
        </div>
    <?php endif; ?>
    
    <div class="clinic-archive-content">
        <h3 class="clinic-archive-title">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </h3>
        
        <div class="clinic-archive-meta">
            <?php $city = get_post_meta(get_the_ID(), 'clinic_city', true); ?>
            <?php if ($city) : ?>
                <span class="clinic-city">
                    <i class="fas fa-map-marker-alt"></i>
                    <?php echo esc_html($city); ?>
                </span>
            <?php endif; ?>
            
            <?php $phone = get_post_meta(get_the_ID(), 'clinic_phone', true); ?>
            <?php if ($phone) : ?>
                <span class="clinic-phone">
                    <i class="fas fa-phone-alt"></i>
                    <a href="tel:<?php echo esc_attr($phone); ?>"><?php echo esc_html($phone); ?></a>
                </span>
            <?php endif; ?>
        </div>
        
        <div class="clinic-archive-excerpt">
            <?php the_excerpt(); ?>
        </div>
        
        <a href="<?php the_permalink(); ?>" class="btn btn-secondary clinic-archive-btn">
            <?php esc_html_e('View Clinic Details', 'acudhaam'); ?>
            <i class="fas fa-arrow-right"></i>
        </a>
    </div>
    
</article>