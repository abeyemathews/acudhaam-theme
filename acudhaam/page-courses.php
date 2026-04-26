<?php
/**
 * Template Name: Our Courses
 * Description: Displays all educational courses.
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
        $courses = new WP_Query(array(
            'post_type'      => 'course',
            'posts_per_page' => -1,
            'orderby'        => 'menu_order',
            'order'          => 'ASC',
        ));

        if ($courses->have_posts()) : ?>
            <div class="courses-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 30px;">
                <?php while ($courses->have_posts()) : $courses->the_post(); ?>
                    <div class="course-card" style="background: white; border-radius: 20px; overflow: hidden; box-shadow: var(--shadow); transition: var(--transition);">
                        <?php if (has_post_thumbnail()) : ?>
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail('course-thumb', array('class' => 'course-img', 'style' => 'width:100%; height:200px; object-fit:cover;')); ?>
                            </a>
                        <?php endif; ?>
                        <div class="course-content" style="padding: 25px;">
                            <h3><a href="<?php the_permalink(); ?>" style="color: var(--gradient-color1);"><?php the_title(); ?></a></h3>
                            <?php
                            $duration = get_post_meta(get_the_ID(), 'course_duration', true);
                            $level    = get_post_meta(get_the_ID(), 'course_level', true);
                            $price    = get_post_meta(get_the_ID(), 'course_price', true);
                            ?>
                            <div class="course-meta" style="margin: 15px 0; display: flex; gap: 15px; flex-wrap: wrap; font-size: 0.9rem;">
                                <?php if ($duration) : ?>
                                    <span><i class="fas fa-clock"></i> <?php echo esc_html($duration); ?></span>
                                <?php endif; ?>
                                <?php if ($level) : ?>
                                    <span><i class="fas fa-chart-line"></i> <?php echo esc_html($level); ?></span>
                                <?php endif; ?>
                                <?php if ($price) : ?>
                                    <span><i class="fas fa-tag"></i> <?php echo esc_html($price); ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="course-excerpt"><?php the_excerpt(); ?></div>
                            <a href="<?php the_permalink(); ?>" class="btn btn-primary" style="margin-top: 20px; display: inline-block;"><?php esc_html_e('Learn More', 'acudhaam'); ?></a>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
            <?php wp_reset_postdata(); ?>
        <?php else : ?>
            <p><?php esc_html_e('No courses found.', 'acudhaam'); ?></p>
        <?php endif; ?>
    </div>
</div>

<?php get_footer(); ?>