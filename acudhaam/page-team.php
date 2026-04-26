<?php
/**
 * Template Name: Our Team
 * Description: Displays all team members.
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
        $team = new WP_Query(array(
            'post_type'      => 'team_member',
            'posts_per_page' => -1,
            'orderby'        => 'menu_order',
            'order'          => 'ASC',
        ));

        if ($team->have_posts()) : ?>
            <div class="team-grid">
                <?php while ($team->have_posts()) : $team->the_post(); ?>
                    <div class="team-member">
                        <?php if (has_post_thumbnail()) : ?>
                            <?php the_post_thumbnail('team-square', array('class' => 'member-img')); ?>
                        <?php else : ?>
                            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/team-placeholder.jpg'); ?>" class="member-img" alt="<?php the_title_attribute(); ?>">
                        <?php endif; ?>
                        <h4><?php the_title(); ?></h4>
                        <div class="position"><?php echo esc_html(get_post_meta(get_the_ID(), 'position', true)); ?></div>
                        <p><?php echo get_the_excerpt(); ?></p>
                        <div class="member-social">
                            <?php $linkedin = get_post_meta(get_the_ID(), 'linkedin', true); ?>
                            <?php if ($linkedin) : ?>
                                <a href="<?php echo esc_url($linkedin); ?>" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                            <?php endif; ?>
                            <?php $twitter = get_post_meta(get_the_ID(), 'twitter', true); ?>
                            <?php if ($twitter) : ?>
                                <a href="<?php echo esc_url($twitter); ?>" target="_blank"><i class="fab fa-twitter"></i></a>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
            <?php wp_reset_postdata(); ?>
        <?php else : ?>
            <p><?php esc_html_e('No team members found.', 'acudhaam'); ?></p>
        <?php endif; ?>
    </div>
</div>

<?php get_footer(); ?>