<?php
/**
 * Comments Template
 *
 * @package Acudhaam
 */

if (post_password_required()) {
    return;
}
?>

<div id="comments" class="comments-area">
    
    <?php if (have_comments()) : ?>
        <h2 class="comments-title">
            <?php
            $comment_count = get_comments_number();
            if ('1' === $comment_count) {
                printf(
                    esc_html__('One thought on &ldquo;%1$s&rdquo;', 'acudhaam'),
                    '<span>' . wp_kses_post(get_the_title()) . '</span>'
                );
            } else {
                printf(
                    esc_html(_nx('%1$s thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', $comment_count, 'comments title', 'acudhaam')),
                    number_format_i18n($comment_count),
                    '<span>' . wp_kses_post(get_the_title()) . '</span>'
                );
            }
            ?>
        </h2>
        
        <?php the_comments_navigation(); ?>
        
        <ol class="comment-list">
            <?php
            wp_list_comments(array(
                'style'       => 'ol',
                'short_ping'  => true,
                'avatar_size' => 60,
                'callback'    => 'acudhaam_comment_callback',
            ));
            ?>
        </ol>
        
        <?php the_comments_navigation(); ?>
        
        <?php if (!comments_open()) : ?>
            <p class="no-comments"><?php esc_html_e('Comments are closed.', 'acudhaam'); ?></p>
        <?php endif; ?>
        
    <?php endif; ?>
    
    <?php
    $commenter = wp_get_current_commenter();
    $req = get_option('require_name_email');
    $aria_req = ($req ? " aria-required='true'" : '');
    
    $fields = array(
        'author' => '<p class="comment-form-author">' .
                    '<label for="author">' . esc_html__('Name', 'acudhaam') . ($req ? ' <span class="required">*</span>' : '') . '</label> ' .
                    '<input id="author" name="author" type="text" value="' . esc_attr($commenter['comment_author']) . '" size="30" maxlength="245"' . $aria_req . ' placeholder="' . esc_attr__('Your Name', 'acudhaam') . '" /></p>',
        
        'email'  => '<p class="comment-form-email">' .
                    '<label for="email">' . esc_html__('Email', 'acudhaam') . ($req ? ' <span class="required">*</span>' : '') . '</label> ' .
                    '<input id="email" name="email" type="email" value="' . esc_attr($commenter['comment_author_email']) . '" size="30" maxlength="100"' . $aria_req . ' placeholder="' . esc_attr__('Your Email', 'acudhaam') . '" /></p>',
        
        'url'    => '<p class="comment-form-url">' .
                    '<label for="url">' . esc_html__('Website', 'acudhaam') . '</label> ' .
                    '<input id="url" name="url" type="url" value="' . esc_attr($commenter['comment_author_url']) . '" size="30" maxlength="200" placeholder="' . esc_attr__('Your Website', 'acudhaam') . '" /></p>',
    );
    
    $comments_args = array(
        'fields'               => apply_filters('comment_form_default_fields', $fields),
        'comment_field'        => '<p class="comment-form-comment">' .
                                   '<label for="comment">' . esc_html__('Comment', 'acudhaam') . ' <span class="required">*</span></label> ' .
                                   '<textarea id="comment" name="comment" cols="45" rows="8" maxlength="65525" required="required" placeholder="' . esc_attr__('Write your comment here...', 'acudhaam') . '"></textarea></p>',
        'must_log_in'          => '<p class="must-log-in">' .
                                   sprintf(
                                       __('You must be <a href="%s">logged in</a> to post a comment.', 'acudhaam'),
                                       wp_login_url(apply_filters('the_permalink', get_permalink()))
                                   ) . '</p>',
        'logged_in_as'         => '<p class="logged-in-as">' .
                                   sprintf(
                                       __('Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', 'acudhaam'),
                                       admin_url('profile.php'),
                                       $user_identity,
                                       wp_logout_url(apply_filters('the_permalink', get_permalink()))
                                   ) . '</p>',
        'comment_notes_before' => '<p class="comment-notes">' .
                                   esc_html__('Your email address will not be published. Required fields are marked *', 'acudhaam') . '</p>',
        'comment_notes_after'  => '',
        'id_form'              => 'commentform',
        'id_submit'            => 'submit',
        'class_submit'         => 'submit',
        'name_submit'          => 'submit',
        'title_reply'          => esc_html__('Leave a Reply', 'acudhaam'),
        'title_reply_to'       => esc_html__('Leave a Reply to %s', 'acudhaam'),
        'cancel_reply_link'    => esc_html__('Cancel reply', 'acudhaam'),
        'label_submit'         => esc_html__('Post Comment', 'acudhaam'),
        'submit_button'        => '<button name="%1$s" type="submit" id="%2$s" class="%3$s">%4$s</button>',
        'submit_field'         => '<p class="form-submit">%1$s %2$s</p>',
        'format'               => 'html5',
    );
    
    comment_form($comments_args);
    ?>
    
</div>