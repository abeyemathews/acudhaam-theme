<?php
/**
 * Search Results Template
 *
 * Displays search results when a user performs a search.
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
                
                <!-- Search Header -->
                <header class="search-header">
                    <h1 class="search-title">
                        <?php
                        printf(
                            esc_html__('Search Results for: "%s"', 'acudhaam'),
                            '<span>' . get_search_query() . '</span>'
                        );
                        ?>
                    </h1>
                    
                    <div class="search-count">
                        <?php
                        global $wp_query;
                        $total_results = $wp_query->found_posts;
                        
                        printf(
                            esc_html(_n('%d result found', '%d results found', $total_results, 'acudhaam')),
                            number_format_i18n($total_results)
                        );
                        ?>
                    </div>
                </header>
                
                <!-- Search Form (to refine search) -->
                <div class="search-again">
                    <h3><?php esc_html_e('Refine your search:', 'acudhaam'); ?></h3>
                    <?php get_search_form(); ?>
                </div>
                
                <?php if (have_posts()) : ?>
                    
                    <!-- Search Results -->
                    <div class="search-results">
                        <?php while (have_posts()) : the_post(); ?>
                            
                            <?php get_template_part('template-parts/content', 'search'); ?>
                            
                        <?php endwhile; ?>
                    </div>
                    
                    <!-- Pagination -->
                    <div class="pagination-wrapper">
                        <?php
                        the_posts_pagination(array(
                            'mid_size'           => 2,
                            'prev_text'          => '<i class="fas fa-chevron-left"></i> ' . __('Previous', 'acudhaam'),
                            'next_text'          => __('Next', 'acudhaam') . ' <i class="fas fa-chevron-right"></i>',
                            'screen_reader_text' => __('Search results navigation', 'acudhaam'),
                        ));
                        ?>
                    </div>
                    
                <?php else : ?>
                    
                    <!-- No Results Found -->
                    <div class="no-search-results">
                        
                        <div class="no-results-icon">
                            <i class="fas fa-search"></i>
                        </div>
                        
                        <h2><?php esc_html_e('No Results Found', 'acudhaam'); ?></h2>
                        
                        <p class="no-results-message">
                            <?php
                            printf(
                                esc_html__('Sorry, no posts matched your search for "%s".', 'acudhaam'),
                                '<strong>' . get_search_query() . '</strong>'
                            );
                            ?>
                        </p>
                        
                        <p class="no-results-suggestion">
                            <?php esc_html_e('Suggestions:', 'acudhaam'); ?>
                        </p>
                        
                        <ul class="suggestions-list">
                            <li><?php esc_html_e('Check your spelling', 'acudhaam'); ?></li>
                            <li><?php esc_html_e('Try more general keywords', 'acudhaam'); ?></li>
                            <li><?php esc_html_e('Try different keywords', 'acudhaam'); ?></li>
                            <li><?php esc_html_e('Browse our categories below', 'acudhaam'); ?></li>
                        </ul>
                        
                        <!-- Category Suggestions -->
                        <div class="suggested-categories">
                            <h3><?php esc_html_e('Popular Categories', 'acudhaam'); ?></h3>
                            <div class="category-list">
                                <?php
                                wp_list_categories(array(
                                    'title_li'           => '',
                                    'show_count'         => true,
                                    'orderby'            => 'count',
                                    'order'              => 'DESC',
                                    'number'             => 6,
                                    'use_desc_for_title' => false,
                                ));
                                ?>
                            </div>
                        </div>
                        
                        <!-- Recent Posts -->
                        <div class="suggested-posts">
                            <h3><?php esc_html_e('Recent Posts', 'acudhaam'); ?></h3>
                            <div class="recent-posts-list">
                                <?php
                                $recent_posts = wp_get_recent_posts(array(
                                    'numberposts' => 5,
                                    'post_status' => 'publish'
                                ));
                                foreach ($recent_posts as $post) : ?>
                                    <div class="recent-post-item">
                                        <a href="<?php echo esc_url(get_permalink($post['ID'])); ?>">
                                            <h4><?php echo esc_html($post['post_title']); ?></h4>
                                            <span class="post-date"><?php echo get_the_date('', $post['ID']); ?></span>
                                        </a>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        
                        <!-- Back to Home -->
                        <div class="no-results-action">
                            <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-primary">
                                <i class="fas fa-home"></i>
                                <?php esc_html_e('Return Home', 'acudhaam'); ?>
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