<?php

/**
 * @package  newPlugin
 */
/*
Plugin Name: new plugin
Plugin URI: https://github.com/hossenmaruf
Description: This is a custom Plugin
Version: 1.0.0
Author: hossenmaruf
Author URI: https://github.com/hossenmaruf
License: GPLv2 or later
Text Domain: newPlugin
*/


add_shortcode('new', 'Example_Plugin');

function Example_Plugin()
{

    $info = 'hello from shortcode';
    $info .= "<div>  what is this </div>";

    $info .= "<p> this is a blocjk post  </p>";

    return $info;
}


function wpdocs_register_my_custom_menu_page()
{
    add_menu_page(
        __('Custom Menu Title', 'textdomain'),
        'custom menu',
        'manage_options',
        'custompage',
        'my_custom_menu_page',
        'dashicons-admin-network',
        100
    );
}
add_action('admin_menu', 'wpdocs_register_my_custom_menu_page');

/**
 * Display a custom menu page
 */
function my_custom_menu_page()
{
    esc_html_e('Admin Page Test', 'textdomain');


    if (array_key_exists('submit_scripts_update', $_POST)) {


        update_option('new_header_scripts', $_POST['header_scripts']);
        update_option('new_footer_scripts', $_POST['footer_scripts']);


?>

        <div id="setting-error-settings-updated" class="updated settings-error notice is-dimissible">

            <strong> settings has been save </strong>

        </div>

    <?php


    }


    $header_scripts = get_option('new_header_scripts', 'none');
    $footer_scripts = get_option('new_footer_scripts', 'none');

    ?>
    <div class="wrap">

        <h2> hello </h2>

        <form method="post" action="">

            <label for="header_scripts"> Header scripts</label>
            <textarea class="large-text" name="header_scripts"> <?php print $header_scripts  ?> </textarea>

            <label for="footer_scripts"> footer scripts</label>
            <textarea class="large-text" name="footer_scripts"><?php print $footer_scripts  ?>  </textarea>


            <input type="submit" name="submit_scripts_update" class="button button_primary" value="UPDATE SCRIPTS">

        </form>
    </div>

<?php




}
