<?php
/**
 * Page Template
 *
 * Used for displaying regular WordPress pages.
 *
 * @package Acudhaam
 */

get_header(); ?>

<!-- MAIN CONTENT -->
<div class="main-content">
    <div class="container">
        
        <?php while (have_posts()) : the_post(); ?>
            
            <article id="post-<?php the_ID(); ?>" <?php post_class('page-content-wrapper'); ?>>
                
                <!-- Page Header -->
                <header class="entry-header">
                    <h1 class="entry-title"><?php the_title(); ?></h1>
                </header>
                
                <!-- Featured Image (if any) -->
                <?php if (has_post_thumbnail()) : ?>
                    <div class="page-featured-image">
                        <?php the_post_thumbnail('large', array(
                            'alt' => the_title_attribute(array('echo' => false)),
                            'class' => 'featured-image'
                        )); ?>
                    </div>
                <?php endif; ?>
                
                <!-- Page Content -->
                <div class="entry-content">
                    <?php
                    the_content();
                    
                    // Page breaks pagination
                    wp_link_pages(array(
                        'before'      => '<div class="page-links">' . esc_html__('Pages:', 'acudhaam'),
                        'after'       => '</div>',
                        'link_before' => '<span>',
                        'link_after'  => '</span>',
                        'pagelink'    => '%',
                        'separator'   => '',
                    ));
                    ?>
                </div>
                
                <!-- Edit Link (for logged in users) -->
                <?php if (current_user_can('edit_post', get_the_ID())) : ?>
                    <footer class="entry-footer">
                        <div class="edit-link">
                            <?php edit_post_link(
                                __('Edit this page', 'acudhaam'),
                                '<i class="fas fa-pencil-alt"></i> ',
                                ''
                            ); ?>
                        </div>
                    </footer>
                <?php endif; ?>
                
            </article>
            
            <!-- Comments Section (if enabled for pages) -->
            <?php if (comments_open() || get_comments_number()) : ?>
                <div class="page-comments">
                    <?php comments_template(); ?>
                </div>
            <?php endif; ?>
            
        <?php endwhile; ?>
        
    </div>
</div>

<?php get_footer(); ?>