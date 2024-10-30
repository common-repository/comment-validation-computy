<?php
/**
 * Plugin Name: Comment validation computy
 * Text Domain:   comment-validation-computy
 * Plugin URI: https://computy.ru/blog/plagin-validacii-formy-kommentariev-v-wordpress/
 * Description: Adds custom jQuery validation forms in the form of WordPress comments and bbPress comments.
 * Version: 1.6.6
 * Author: computy.ru
 * Author URI: https://computy.ru
 * License: GPL
 */
if ( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

define( 'CV_COMPUTY_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'CV_COMPUTY_VERSION', '1.6.6' );

if ( is_admin() || ( defined( 'WP_CLI' ) && WP_CLI ) ) {
    require_once( CV_COMPUTY_PLUGIN_DIR . 'class.cv-computy-admin.php' );
    add_action( 'init', array( 'Cv_Computy_Admin', 'init' ) );
}

function cvcScripts() {
	if ( is_single() ) {
	    wp_enqueue_script('jquery-validate',plugin_dir_url( __FILE__ ) . 'js/jquery.validate.min.js',	array( 'jquery' ),'1.19.2',	true);

		wp_enqueue_style(
				'jquery-validate',
				plugin_dir_url( __FILE__ ) . 'css/style.css',
				array(),
				'1.0'
		);
	}
}
add_action( 'template_redirect', 'cvcScripts' );

/*запрет активных ссылок в комментариях*/
add_filter('preprocess_comment', 'href_in_comment');
function href_in_comment($commentdata) {
    if (!is_admin() and str_contains($commentdata['comment_content'], "href=")) {
        wp_die(__("Active links in comments are prohibited. Go back and edit the post.").'<br /><br /><a href="javascript:history.go(-1);">'.__("Go back and edit a comment.").'</a>');
    }
    return $commentdata;
}
/*запрет активных ссылок в комментариях*/

function computy_script() {
    if( comments_open(get_the_ID()) )  {
  ?>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            if ($("#commentform").hasClass("comment-form")) {

                $("#new-post, #commentform").validate({
                    rules: {
                        author             : {required: true, minlength: 2},
                        bbp_anonymous_name : {required: true, minlength: 2},
                        email              : {required: true, email: true},
                        bbp_anonymous_email: {required: true, email: true},
                        bbp_reply_content  : {required: true, minlength: 20},
                        comment            : {required: true, minlength: 20},
                        url              : {required: false, url: true }
                    },

                    messages: {
                        author             : "<?php echo __("Please enter your name.", "comment-validation-computy")?>",
                        bbp_anonymous_name : "<?php echo __("Please enter your name.", "comment-validation-computy")?>",
                        email              : "<?php echo __("Please enter a valid email address.", "comment-validation-computy")?>",
                        bbp_anonymous_email: "<?php echo __("Please enter a valid email address.", "comment-validation-computy")?>",
                        bbp_reply_content  : "<?php echo __("The message must be at least 20 characters.", "comment-validation-computy")?>",
                        comment            : "<?php echo __("The message must be at least 20 characters.", "comment-validation-computy")?>",
                        url                : "<?php echo __("Please enter a valid URL.", "comment-validation-computy")?>"
                    }
                });
            }
        });
    </script>
<?php }
 }
 add_action('wp_footer', 'computy_script');