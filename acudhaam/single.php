<?php
/**
 * Single Post Template
 *
 * Displays individual blog posts with full content, comments, and author information.
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
                <?php while (have_posts()) : the_post(); ?>
                    
                    <article id="post-<?php the_ID(); ?>" <?php post_class('single-post'); ?>>
                        
                        <!-- Post Thumbnail -->
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="post-thumbnail">
                                <?php the_post_thumbnail('large', array(
                                    'alt' => the_title_attribute(array('echo' => false)),
                                    'class' => 'featured-image'
                                )); ?>
                            </div>
                        <?php endif; ?>
                        
                        <!-- Post Header -->
                        <header class="entry-header">
                            <h1 class="entry-title"><?php the_title(); ?></h1>
                            
                            <div class="entry-meta">
                                <!-- Date -->
                                <span class="posted-on">
                                    <i class="far fa-calendar-alt"></i>
                                    <time datetime="<?php echo esc_attr(get_the_date('c')); ?>">
                                        <?php echo esc_html(get_the_date()); ?>
                                    </time>
                                </span>
                                
                                <!-- Author -->
                                <span class="byline">
                                    <i class="far fa-user"></i>
                                    <span class="author vcard">
                                        <a class="url fn n" href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>">
                                            <?php the_author(); ?>
                                        </a>
                                    </span>
                                </span>
                                
                                <!-- Categories -->
                                <?php if (has_category()) : ?>
                                    <span class="cat-links">
                                        <i class="far fa-folder"></i>
                                        <?php the_category(', '); ?>
                                    </span>
                                <?php endif; ?>
                                
                                <!-- Comments Count -->
                                <span class="comments-link">
                                    <i class="far fa-comment"></i>
                                    <?php comments_popup_link(
                                        __('0 Comments', 'acudhaam'),
                                        __('1 Comment', 'acudhaam'),
                                        __('% Comments', 'acudhaam'),
                                        '',
                                        __('Comments Off', 'acudhaam')
                                    ); ?>
                                </span>
                                
                                <!-- Reading Time -->
                                <?php
                                $content = get_post_field('post_content', $post->ID);
                                $word_count = str_word_count(strip_tags($content));
                                $reading_time = ceil($word_count / 200); // 200 words per minute
                                if ($reading_time < 1) $reading_time = 1;
                                ?>
                                <span class="reading-time">
                                    <i class="far fa-clock"></i>
                                    <?php printf(__('%d min read', 'acudhaam'), $reading_time); ?>
                                </span>
                            </div>
                        </header>
                        
                        <!-- Post Content -->
                        <div class="entry-content">
                            <?php
                            the_content(sprintf(
                                wp_kses(
                                    /* translators: %s: Name of current post. */
                                    __('Continue reading %s <span class="meta-nav">&rarr;</span>', 'acudhaam'),
                                    array('span' => array('class' => array()))
                                ),
                                the_title('<span class="screen-reader-text">"', '"</span>', false)
                            ));
                            
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
                        
                        <!-- Post Footer -->
                        <footer class="entry-footer">
                            <!-- Tags -->
                            <?php if (has_tag()) : ?>
                                <div class="tags-links">
                                    <i class="fas fa-tags"></i>
                                    <?php the_tags('', ' ', ''); ?>
                                </div>
                            <?php endif; ?>
                            
                            <!-- Edit Link (for logged in users) -->
                            <?php if (current_user_can('edit_post', get_the_ID())) : ?>
                                <div class="edit-link">
                                    <?php edit_post_link(__('Edit this post', 'acudhaam'), '<i class="fas fa-pencil-alt"></i> ', ''); ?>
                                </div>
                            <?php endif; ?>
                        </footer>
                        
                    </article>
                    
                    <!-- Author Bio Section -->
                    <div class="author-bio">
                        <div class="author-avatar">
                            <?php echo get_avatar(get_the_author_meta('ID'), 120, '', get_the_author(), array('class' => 'avatar')); ?>
                        </div>
                        <div class="author-info">
                            <h4><?php esc_html_e('About the Author', 'acudhaam'); ?></h4>
                            <h5><?php the_author_posts_link(); ?></h5>
                            
                            <?php if (get_the_author_meta('description')) : ?>
                                <p><?php the_author_meta('description'); ?></p>
                            <?php else : ?>
                                <p><?php printf(__('%s is a contributor to Acudhaam Wellness Ecosystem.', 'acudhaam'), get_the_author()); ?></p>
                            <?php endif; ?>
                            
                            <div class="author-meta">
                                <span class="author-posts">
                                    <i class="fas fa-pencil-alt"></i>
                                    <?php
                                    printf(
                                        _n('%s post', '%s posts', count_user_posts(get_the_author_meta('ID')), 'acudhaam'),
                                        count_user_posts(get_the_author_meta('ID'))
                                    );
                                    ?>
                                </span>
                                
                                <?php
                                $author_email = get_the_author_meta('user_email');
                                if ($author_email) : ?>
                                    <span class="author-email">
                                        <i class="fas fa-envelope"></i>
                                        <a href="mailto:<?php echo esc_attr($author_email); ?>">
                                            <?php echo esc_html($author_email); ?>
                                        </a>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Post Navigation -->
                    <nav class="post-navigation">
                        <div class="nav-previous">
                            <?php
                            previous_post_link(
                                '%link',
                                '<i class="fas fa-chevron-left"></i> <span class="nav-text">%title</span>'
                            );
                            ?>
                        </div>
                        
                        <div class="nav-next">
                            <?php
                            next_post_link(
                                '%link',
                                '<span class="nav-text">%title</span> <i class="fas fa-chevron-right"></i>'
                            );
                            ?>
                        </div>
                    </nav>
                    
                    <!-- Related Posts -->
                    <?php
                    $categories = wp_get_post_categories(get_the_ID());
                    if (!empty($categories)) :
                        $related_args = array(
                            'category__in'   => $categories,
                            'post__not_in'   => array(get_the_ID()),
                            'posts_per_page' => 3,
                            'orderby'        => 'rand',
                        );
                        $related_query = new WP_Query($related_args);
                        
                        if ($related_query->have_posts()) : ?>
                            <div class="related-posts">
                                <h3 class="related-title"><?php esc_html_e('You Might Also Like', 'acudhaam'); ?></h3>
                                <div class="related-grid">
                                    <?php while ($related_query->have_posts()) : $related_query->the_post(); ?>
                                        <div class="related-post">
                                            <?php if (has_post_thumbnail()) : ?>
                                                <a href="<?php the_permalink(); ?>" class="related-thumbnail">
                                                    <?php the_post_thumbnail('medium', array('alt' => the_title_attribute(array('echo' => false)))); ?>
                                                </a>
                                            <?php endif; ?>
                                            <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                            <span class="related-date"><?php echo get_the_date(); ?></span>
                                        </div>
                                    <?php endwhile; ?>
                                </div>
                            </div>
                            <?php wp_reset_postdata();
                        endif;
                    endif;
                    ?>
                    
                    <!-- Comments Section -->
                    <?php
                    if (comments_open() || get_comments_number()) :
                        comments_template();
                    endif;
                    ?>
                    
                <?php endwhile; ?>
            </div>
            
            <!-- Sidebar -->
            <?php get_sidebar(); ?>
            
        </div>
    </div>
</div>

<?php get_footer(); ?>