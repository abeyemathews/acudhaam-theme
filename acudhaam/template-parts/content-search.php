<?php
/**
 * Template part for displaying search results
 *
 * @package Acudhaam
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('search-result-item'); ?>>
    
    <div class="search-result-content">
        
        <!-- Post Type Indicator -->
        <div class="result-type">
            <?php
            $post_type = get_post_type_object(get_post_type());
            if ($post_type) :
                switch (get_post_type()) {
                    case 'post':
                        echo '<span class="type-badge post-type"><i class="fas fa-file-alt"></i> ' . esc_html__('Blog Post', 'acudhaam') . '</span>';
                        break;
                    case 'page':
                        echo '<span class="type-badge page-type"><i class="fas fa-file"></i> ' . esc_html__('Page', 'acudhaam') . '</span>';
                        break;
                    case 'clinic':
                        echo '<span class="type-badge clinic-type"><i class="fas fa-map-marker-alt"></i> ' . esc_html__('Clinic', 'acudhaam') . '</span>';
                        break;
                    case 'team_member':
                        echo '<span class="type-badge team-type"><i class="fas fa-users"></i> ' . esc_html__('Team Member', 'acudhaam') . '</span>';
                        break;
                    case 'testimonial':
                        echo '<span class="type-badge testimonial-type"><i class="fas fa-star"></i> ' . esc_html__('Testimonial', 'acudhaam') . '</span>';
                        break;
                    case 'course':
                        echo '<span class="type-badge course-type"><i class="fas fa-graduation-cap"></i> ' . esc_html__('Course', 'acudhaam') . '</span>';
                        break;
                    default:
                        echo '<span class="type-badge default-type"><i class="fas fa-file"></i> ' . esc_html($post_type->labels->singular_name) . '</span>';
                }
            endif;
            ?>
        </div>
        
        <!-- Result Title -->
        <h2 class="result-title">
            <a href="<?php the_permalink(); ?>">
                <?php the_title(); ?>
                <?php if (get_post_type() === 'clinic') : ?>
                    <?php $city = get_post_meta(get_the_ID(), 'clinic_city', true); ?>
                    <?php if ($city) : ?>
                        <span class="result-location">- <?php echo esc_html($city); ?></span>
                    <?php endif; ?>
                <?php endif; ?>
            </a>
        </h2>
        
        <!-- Result Meta -->
        <div class="result-meta">
            <?php if (get_post_type() === 'post') : ?>
                <span class="result-date">
                    <i class="far fa-calendar-alt"></i>
                    <?php echo get_the_date(); ?>
                </span>
                <span class="result-author">
                    <i class="far fa-user"></i>
                    <?php the_author(); ?>
                </span>
            <?php elseif (get_post_type() === 'clinic') : ?>
                <?php $phone = get_post_meta(get_the_ID(), 'clinic_phone', true); ?>
                <?php if ($phone) : ?>
                    <span class="result-phone">
                        <i class="fas fa-phone-alt"></i>
                        <?php echo esc_html($phone); ?>
                    </span>
                <?php endif; ?>
            <?php elseif (get_post_type() === 'team_member') : ?>
                <?php $position = get_post_meta(get_the_ID(), 'position', true); ?>
                <?php if ($position) : ?>
                    <span class="result-position">
                        <i class="fas fa-briefcase"></i>
                        <?php echo esc_html($position); ?>
                    </span>
                <?php endif; ?>
            <?php endif; ?>
        </div>
        
        <!-- Result Excerpt -->
        <div class="result-excerpt">
            <?php the_excerpt(); ?>
        </div>
        
        <!-- Read More Link -->
        <div class="result-read-more">
            <a href="<?php the_permalink(); ?>" class="btn btn-secondary">
                <?php esc_html_e('Read More', 'acudhaam'); ?>
                <i class="fas fa-arrow-right"></i>
            </a>
        </div>
        
    </div>
    
    <!-- Result Thumbnail -->
    <?php if (has_post_thumbnail()) : ?>
        <div class="result-thumbnail">
            <a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail('medium', array('alt' => the_title_attribute(array('echo' => false)))); ?>
            </a>
        </div>
    <?php endif; ?>
    
</article>