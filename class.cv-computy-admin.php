<?php
/*class admin page*/

class Cv_Computy_Admin {

    public static function init() {
        add_action( 'admin_menu', array( 'Cv_Computy_Admin', 'add_admin_menu' ) );/* инициализируем меню в админке*/
        add_action( 'admin_enqueue_scripts', array( 'Cv_Computy_Admin', 'load_scripts' ) );/*Загружаем скрипты и стили*/
        add_filter( 'plugin_action_links_' . plugin_basename( plugin_dir_path( __FILE__ ) . 'comment-validation.php' ), array( 'Cv_Computy_Admin', 'admin_plugin_settings_link' ) );/*добавляем ссылку на настройки на странице плагинов */
    }

    public static function add_admin_menu() {
        $hello1 = __( 'Comment validation computy', 'comment-validation-computy' );
        add_options_page( ' ', $hello1, 'manage_options', 'cv-plugin-options', array( 'Cv_Computy_Admin', 'cv_plugin_options' ) );
    }

    public static function admin_plugin_settings_link( $links ) {
        $settings_link = '<a href="options-general.php?page=cv-plugin-options">'.__("Manual").'</a>';
        array_unshift( $links, $settings_link );
        return $links;
    }

    public static function load_scripts() {
        wp_register_style( 'cv-computy-style-admin.css', plugin_dir_url( __FILE__ ) . 'css/cv-computy-style-admin.css', array(), CV_COMPUTY_VERSION );
        wp_enqueue_style( 'cv-computy-style-admin.css' );
    }
    public static function cv_plugin_options()
    {
        ?>
        <div class="wrap cv-computy-admin">
            <h2 class="computy"><?php echo _e('Comment validation computy', 'comment-validation-computy'), ' V', CV_COMPUTY_VERSION; ?></h2>
            <p><?php echo _e('With the support of <a href="https://computy.ru" target="_blank" title="Development and support of sites on WordPress"> Computy </a>', 'comment-validation-computy') ?> </p>
            <hr/>
            <h2><?php echo _e('Description of the plugin', 'comment-validation-computy') ?></h2>
            <p><?php echo _e('Welcome to the comments validation plugin configuration guide page. ', 'comment-validation-computy') ?></p>
            <p><?php echo _e('The plugin does not require any settings and works automatically for standard WordPress comments, of course, if you have a standard theme. ', 'comment-validation-computy') ?></p>
            <?php echo '<img class="vp-img" src="' . esc_url(plugins_url('img/1.png', __FILE__)) . '" > '; ?>
            <p><?php echo _e('Currently the plugin works with the following validation: <br>
                                 1. Name must not be less than 2 characters <br>
                                 2. Must be valid mail. <br>
                                 3. The comment should not be shorter than 20 characters.', 'comment-validation-computy'); ?>  <br>
                                  <?php echo _e('4. Checking the "site" field for the correct url, if one is entered.', 'comment-validation-computy'); ?><br>
                                  5. <?php echo _e('Added a ban on sending active links in comments. Unfortunately, the check is still only on the server', 'comment-validation-computy'); ?></p>
            <p><?php echo _e('Detailed description of the plugin, <a href="https://computy.ru/blog/plagin-validacii-formy-kommentariev-v-wordpress/" target="_blank">see page</a>.', 'comment-validation-computy') ?></p>
            <p><?php echo _e('The plugin supports translation into your language. You can help in the translation by going to the page of <a href="https://wordpress.org/plugins/comment-validation-computy/" target="_blank">the plugin</a> in the <a href="https://translate.wordpress.org/projects/wp-plugins/comment-validation-computy" target="_blank">section</a>.', 'comment-validation-computy') ?></p>
            <p><?php echo _e('For suggestions for improving the plugin or questions, please write by in the <a href="https://wordpress.org/support/plugin/comment-validation-computy" target="_blank">forum</a>. We welcome feedback.', 'comment-validation-computy') ?></p>
            <p><?php echo _e('The source code is open to your creativity and you can customize everything you need. But we warn that after updating the plugin your changes will be lost. We advise to update the plugin, because we constantly add something new and improve the plugin. Thank you for using our development. <a href="https://computy.ru" target="_blank">Computy</a> wishes you success.', 'comment-validation-computy') ?></p>
            <hr/>

        </div>
        <?php
    }
}