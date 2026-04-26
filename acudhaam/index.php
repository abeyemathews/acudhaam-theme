<?php
/**
 * Index Template (Blog Archive)
 *
 * This is the main template file that displays blog posts.
 * It's used when no more specific template is available.
 *
 * @package Acudhaam
 */

get_header(); ?>

<!-- MAIN CONTENT -->
<div class="main-content">
    <div class="container">
        <div class="blog-grid">
            <!-- Main Blog Content -->
            <div class="blog-main">
                <?php if (have_posts()) : ?>
                    
                    <?php if (is_home() && !is_front_page()) : ?>
                        <header class="page-header">
                            <h1 class="page-title"><?php single_post_title(); ?></h1>
                        </header>
                    <?php endif; ?>
                    
                    <?php while (have_posts()) : the_post(); ?>
                        
                        <?php get_template_part('template-parts/content', get_post_type()); ?>
                        
                    <?php endwhile; ?>
                    
                    <!-- Pagination -->
                    <div class="pagination-wrapper">
                        <?php
                        the_posts_pagination(array(
                            'mid_size'  => 2,
                            'prev_text' => '<i class="fas fa-chevron-left"></i> ' . __('Previous', 'acudhaam'),
                            'next_text' => __('Next', 'acudhaam') . ' <i class="fas fa-chevron-right"></i>',
                            'screen_reader_text' => __('Posts navigation', 'acudhaam'),
                        ));
                        ?>
                    </div>
                    
                <?php else : ?>
                    
                    <?php get_template_part('template-parts/content', 'none'); ?>
                    
                <?php endif; ?>
            </div>
            
            <!-- Sidebar -->
            <?php get_sidebar(); ?>
            
        </div>
    </div>
</div>

<?php get_footer(); ?>