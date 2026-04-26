<?php
/**
 * Sidebar Template
 *
 * Displays the sidebar widget area.
 *
 * @package Acudhaam
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}
?>

<aside id="secondary" class="widget-area sidebar" role="complementary" aria-label="<?php esc_attr_e('Sidebar', 'acudhaam'); ?>">
    
    <?php if (is_active_sidebar('sidebar-1')) : ?>
        
        <!-- Dynamic Widgets -->
        <?php dynamic_sidebar('sidebar-1'); ?>
        
    <?php else : ?>
        
        <!-- Default Widgets (shown when no widgets are added) -->
        
        <!-- Search Widget -->
        <div class="widget widget_search">
            <h3 class="widget-title"><?php esc_html_e('Search', 'acudhaam'); ?></h3>
            <?php get_search_form(); ?>
        </div>
        
        <!-- Recent Posts Widget -->
        <div class="widget widget_recent_entries">
            <h3 class="widget-title"><?php esc_html_e('Recent Posts', 'acudhaam'); ?></h3>
            <ul>
                <?php
                $recent_posts = wp_get_recent_posts(array(
                    'numberposts' => 5,
                    'post_status' => 'publish'
                ));
                foreach ($recent_posts as $post) : ?>
                    <li>
                        <a href="<?php echo esc_url(get_permalink($post['ID'])); ?>">
                            <?php echo esc_html($post['post_title']); ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        
        <!-- Categories Widget -->
        <div class="widget widget_categories">
            <h3 class="widget-title"><?php esc_html_e('Categories', 'acudhaam'); ?></h3>
            <ul>
                <?php
                wp_list_categories(array(
                    'title_li'           => '',
                    'show_count'         => true,
                    'count_separator'    => ' ',
                    'use_desc_for_title' => false,
                ));
                ?>
            </ul>
        </div>
        
        <!-- Archives Widget -->
        <div class="widget widget_archive">
            <h3 class="widget-title"><?php esc_html_e('Archives', 'acudhaam'); ?></h3>
            <ul>
                <?php wp_get_archives(array(
                    'type'            => 'monthly',
                    'show_post_count' => true,
                )); ?>
            </ul>
        </div>
        
        <!-- Tags Widget -->
        <div class="widget widget_tag_cloud">
            <h3 class="widget-title"><?php esc_html_e('Popular Tags', 'acudhaam'); ?></h3>
            <div class="tagcloud">
                <?php
                wp_tag_cloud(array(
                    'smallest' => 12,
                    'largest'  => 20,
                    'unit'     => 'px',
                    'number'   => 15,
                ));
                ?>
            </div>
        </div>
        
        <!-- Meta Widget -->
        <div class="widget widget_meta">
            <h3 class="widget-title"><?php esc_html_e('Meta', 'acudhaam'); ?></h3>
            <ul>
                <?php wp_register(); ?>
                <li><?php wp_loginout(); ?></li>
                <li><a href="<?php echo esc_url(get_bloginfo('rss2_url')); ?>"><?php esc_html_e('Entries feed', 'acudhaam'); ?></a></li>
                <li><a href="<?php echo esc_url(get_bloginfo('comments_rss2_url')); ?>"><?php esc_html_e('Comments feed', 'acudhaam'); ?></a></li>
                <?php wp_meta(); ?>
            </ul>
        </div>
        
    <?php endif; ?>
    
</aside><!-- #secondary -->