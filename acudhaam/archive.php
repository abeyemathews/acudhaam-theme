<?php
/**
 * Archive Template
 *
 * Used for category, tag, author, date, and custom taxonomy archives.
 *
 * @package Acudhaam
 */

get_header(); ?>

<!-- MAIN CONTENT -->
<div class="main-content">
    <div class="container">
        
        <div class="blog-grid">
            <!-- Main Content Area -->
            <div class="blog-main">
                
                <!-- Archive Header -->
                <header class="archive-header">
                    <?php
                    the_archive_title('<h1 class="archive-title">', '</h1>');
                    the_archive_description('<div class="archive-description">', '</div>');
                    ?>
                    
                    <!-- Archive Meta -->
                    <div class="archive-meta">
                        <?php
                        global $wp_query;
                        $total_posts = $wp_query->found_posts;
                        
                        printf(
                            esc_html(_n('%d post', '%d posts', $total_posts, 'acudhaam')),
                            number_format_i18n($total_posts)
                        );
                        ?>
                    </div>
                </header>
                
                <!-- Archive Filters (for categories/tags) -->
                <?php if (is_category() || is_tag()) : ?>
                    <div class="archive-filters">
                        <div class="filter-label">
                            <i class="fas fa-filter"></i>
                            <?php esc_html_e('Browse:', 'acudhaam'); ?>
                        </div>
                        
                        <?php
                        if (is_category()) {
                            $current_cat = get_queried_object();
                            $args = array(
                                'title_li'           => '',
                                'show_option_none'   => '',
                                'show_count'         => 1,
                                'orderby'            => 'name',
                                'echo'               => 1,
                                'depth'              => 1,
                                'exclude'            => $current_cat->term_id,
                            );
                            echo '<div class="filter-categories">';
                            wp_list_categories($args);
                            echo '</div>';
                        }
                        
                        if (is_tag()) {
                            $tags = get_tags(array(
                                'orderby' => 'count',
                                'order'   => 'DESC',
                                'number'  => 10,
                            ));
                            if ($tags) {
                                echo '<div class="filter-tags">';
                                foreach ($tags as $tag) {
                                    printf(
                                        '<a href="%s" class="tag-link">%s <span class="count">%d</span></a>',
                                        esc_url(get_tag_link($tag->term_id)),
                                        esc_html($tag->name),
                                        esc_html($tag->count)
                                    );
                                }
                                echo '</div>';
                            }
                        }
                        ?>
                    </div>
                <?php endif; ?>
                
                <!-- Author Info (for author archives) -->
                <?php if (is_author()) : 
                    $author_id = get_queried_object_id();
                    $author = get_userdata($author_id);
                ?>
                    <div class="author-archive-info">
                        <div class="author-avatar">
                            <?php echo get_avatar($author_id, 120); ?>
                        </div>
                        <div class="author-details">
                            <h2><?php echo esc_html($author->display_name); ?></h2>
                            
                            <?php if (!empty($author->description)) : ?>
                                <p class="author-bio"><?php echo esc_html($author->description); ?></p>
                            <?php endif; ?>
                            
                            <div class="author-meta">
                                <span class="author-posts">
                                    <i class="fas fa-pencil-alt"></i>
                                    <?php
                                    printf(
                                        esc_html(_n('%s post', '%s posts', count_user_posts($author_id), 'acudhaam')),
                                        number_format_i18n(count_user_posts($author_id))
                                    );
                                    ?>
                                </span>
                                
                                <?php if (!empty($author->user_url)) : ?>
                                    <span class="author-website">
                                        <i class="fas fa-globe"></i>
                                        <a href="<?php echo esc_url($author->user_url); ?>" target="_blank" rel="noopener noreferrer">
                                            <?php echo esc_html(parse_url($author->user_url, PHP_URL_HOST)); ?>
                                        </a>
                                    </span>
                                <?php endif; ?>
                                
                                <span class="author-registered">
                                    <i class="fas fa-calendar-alt"></i>
                                    <?php
                                    printf(
                                        esc_html__('Member since %s', 'acudhaam'),
                                        date_i18n(get_option('date_format'), strtotime($author->user_registered))
                                    );
                                    ?>
                                </span>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                
                <!-- Date Archive Info -->
                <?php if (is_date()) : 
                    $year = get_query_var('year');
                    $month = get_query_var('monthnum');
                    $day = get_query_var('day');
                ?>
                    <div class="date-archive-info">
                        <div class="date-icon">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <div class="date-details">
                            <?php if ($day) : ?>
                                <h3><?php echo esc_html(date_i18n('F j, Y', mktime(0, 0, 0, $month, $day, $year))); ?></h3>
                            <?php elseif ($month) : ?>
                                <h3><?php echo esc_html(date_i18n('F Y', mktime(0, 0, 0, $month, 1, $year))); ?></h3>
                            <?php else : ?>
                                <h3><?php echo esc_html($year); ?></h3>
                            <?php endif; ?>
                            
                            <p><?php printf(esc_html(_n('%d post published on this date', '%d posts published on this date', $total_posts, 'acudhaam')), $total_posts); ?></p>
                        </div>
                    </div>
                <?php endif; ?>
                
                <!-- Custom Taxonomy Info -->
                <?php if (is_tax()) : 
                    $term = get_queried_object();
                    $taxonomy = get_taxonomy($term->taxonomy);
                ?>
                    <div class="taxonomy-archive-info">
                        <div class="taxonomy-icon">
                            <i class="fas fa-tag"></i>
                        </div>
                        <div class="taxonomy-details">
                            <span class="taxonomy-label"><?php echo esc_html($taxonomy->labels->singular_name); ?></span>
                            <h3><?php echo esc_html($term->name); ?></h3>
                            <?php if (!empty($term->description)) : ?>
                                <p class="taxonomy-description"><?php echo esc_html($term->description); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>
                
                <!-- Posts Grid -->
                <?php if (have_posts()) : ?>
                    
                    <div class="archive-posts">
                        <?php while (have_posts()) : the_post(); ?>
                            
                            <?php
                            // Use different templates based on post type
                            $post_type = get_post_type();
                            if ($post_type === 'clinic') {
                                get_template_part('template-parts/content', 'clinic-archive');
                            } elseif ($post_type === 'team_member') {
                                get_template_part('template-parts/content', 'team-archive');
                            } elseif ($post_type === 'testimonial') {
                                get_template_part('template-parts/content', 'testimonial-archive');
                            } elseif ($post_type === 'course') {
                                get_template_part('template-parts/content', 'course-archive');
                            } else {
                                get_template_part('template-parts/content', get_post_type());
                            }
                            ?>
                            
                        <?php endwhile; ?>
                    </div>
                    
                    <!-- Pagination -->
                    <div class="pagination-wrapper">
                        <?php
                        the_posts_pagination(array(
                            'mid_size'           => 2,
                            'prev_text'          => '<i class="fas fa-chevron-left"></i> ' . __('Previous', 'acudhaam'),
                            'next_text'          => __('Next', 'acudhaam') . ' <i class="fas fa-chevron-right"></i>',
                            'screen_reader_text' => __('Posts navigation', 'acudhaam'),
                        ));
                        ?>
                    </div>
                    
                <?php else : ?>
                    
                    <!-- No Posts Found -->
                    <div class="no-archive-posts">
                        <div class="no-posts-icon">
                            <i class="fas fa-folder-open"></i>
                        </div>
                        
                        <h2><?php esc_html_e('No Posts Found', 'acudhaam'); ?></h2>
                        
                        <p class="no-posts-message">
                            <?php
                            if (is_category()) {
                                esc_html_e('There are no posts in this category yet.', 'acudhaam');
                            } elseif (is_tag()) {
                                esc_html_e('There are no posts with this tag yet.', 'acudhaam');
                            } elseif (is_author()) {
                                esc_html_e('This author hasn\'t published any posts yet.', 'acudhaam');
                            } elseif (is_date()) {
                                esc_html_e('There are no posts from this date.', 'acudhaam');
                            } else {
                                esc_html_e('No posts found.', 'acudhaam');
                            }
                            ?>
                        </p>
                        
                        <div class="no-posts-action">
                            <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-primary">
                                <i class="fas fa-home"></i>
                                <?php esc_html_e('Return Home', 'acudhaam'); ?>
                            </a>
                            
                            <a href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>" class="btn btn-secondary">
                                <i class="fas fa-blog"></i>
                                <?php esc_html_e('View All Posts', 'acudhaam'); ?>
                            </a>
                        </div>
                    </div>
                    
                <?php endif; ?>
                
            </div>
            
            <!-- Sidebar -->
            <?php get_sidebar(); ?>
            
        </div>
        
    </div>
</div>

<?php get_footer(); ?>