<?php

/**
 * @package  newPlugin
 */
/*
Plugin Name       : new plugin
Plugin URI        : https: //github.com/hossenmaruf
       Description: This is a custom Plugin
       Version    : 1.0.0
       Author     : hossenmaruf
Author URI        : https: //github.com/hossenmaruf
       License    : GPLv2 or later
Text   Domain     : newPlugin
*/


/**  customs admin dashboard widget */

function admin_dashboard_widget()
{


    wp_add_dashboard_widget(


        'admin_dashboard_widget',
        'Admin Dashboaed Widget',
        'admin_dashboard_callback'

    );
}


add_action('wp_dashboard_setup', 'admin_dashboard_widget');

function admin_dashboard_callback()
{

    echo 'hiii';
}








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


function display_header_scripts()
{

    $header_scripts = get_option('new_header_scripts', 'none');

    print $header_scripts;
}

add_action('wp_head', 'display_header_scripts');


function display_footer_scripts()
{

    $footer_scripts = get_option('new_footer_scripts', 'none');

    print $footer_scripts;
}

add_action('wp_footer', 'display_footer_scripts');




function ideapro_form()
{
    /* content variable */
    $content = '';

    $content .= '<form method="post" action="http://new.local/thank-you/">';

    $content .= '<input type="text" name="full_name" placeholder="Your Full Name" />';
    $content .= '<br />';

    $content .= '<input type="text" name="email_address" placeholder="Email Address" />';
    $content .= '<br />';

    $content .= '<input type="text" name="phone_number" placeholder="Phone Number" />';
    $content .= '<br />';

    $content .= '<textarea name="comments" placeholder="Give us your comments"></textarea>';
    $content .= '<br />';

    $content .= '<input type="submit" name="ideapro_submit_form" value="SUBMIT YOUR INFORMATION" />';

    $content .= '</form>';

    return $content;
}
add_shortcode('ideapro_contact_form', 'ideapro_form');


function set_html_content_type()
{
    return 'text/html';
}



function ideapro_form_capture()
{
    global $post, $wpdb;

    if (array_key_exists('ideapro_submit_form', $_POST)) {
        $to      = "support@ideapro.com";
        $subject = "Idea Pro Example Site Form Submission";
        $body    = '';

        $body .= 'Name: ' . $_POST['full_name'] . ' <br /> ';
        $body .= 'Email: ' . $_POST['email_address'] . ' <br /> ';
        $body .= 'Phone: ' . $_POST['phone_number'] . ' <br /> ';
        $body .= 'Comments: ' . $_POST['comments'] . ' <br /> ';




        // $data = array(


        //     array (


        //         'Name: '.$_POST['full_name'].' <br /> ',
        //             'Email: '.$_POST['email_address'].' <br /> ',
        //            'Phone: '.$_POST['phone_number']. ' <br /> ',
        //             'Comments: '.$_POST['comments'].' <br /> ',

        //     )
        // ) ;



        // add_filter('wp_mail_content_type','set_html_content_type');

        // wp_mail($to,$subject,$body);

        // remove_filter('wp_mail_content_type','set_html_content_type');

        /* Insert the information into a comment */

        // $time = current_time('mysql');

        // $data = array(
        //     'comment_post_ID' => $post->ID,
        //     'comment_content' => $body,
        //     'comment_author_IP' => $_SERVER['REMOTE_ADDR'],
        //     'comment_date' => $time,
        //     'comment_approved' => 1,
        // );

        // wp_insert_comment($data);

        /* add the submission to the database using the table we created */

        // $table = $wpdb->prefix.'form_submission';
        // $format = array('%s','%d');

        $wpdb->get_results(" INSERT INTO " . $wpdb->prefix . "form_submission (data) VALUES ('" . $body . "') ");

        //  $wpdb->insert($table,$data,$format);



    }
}


//adding our own portfolio item
function my_custom_portfolio_item()
{
    $labels = array(
        'name'          => _x('Portfolio items', 'post type general name'),
        'singular_name' => _x('Portfolio item', 'post type singular name'),
        'menu_name'     => 'Portfolio',
        'search_items'  => 'Search things'
    );
    $args = array(
        'labels'               => $labels,
        'description'          => 'Holds our custom portfolio items',
        'public'               => true,
        'menu_position'        => 5,
        'supports'             => array('title', 'editor', 'thumbnail', 'excerpt', 'comments'),
        'has_archive'          => true,
        'register_meta_box_cb' => 'example_metabox'
    );
    register_post_type('portfolio_items', $args);
}


function example_metabox()
{

    add_meta_box('customs_metabox', 'Customs Filed', 'metabox_display', 'portfolio_items', 'normal', 'high');
}

add_action('add_meta_boxs', 'example_metabox');

function metabox_display()
{

    global $post;

    $sub_title   = get_post_meta($post->ID, 'sub_title', true);
    $author_name = get_post_meta($post->ID, 'author_name', true);


?>

    <label> Sub Title </label>
    <input type="text" name="sub_title" placeholder="SUB tITLE" class="widefat" value="<?php print $sub_title   ?> " />

    <br>
    <br>


    <label> Author Title </label>
    <input type="text" name="author_name" placeholder="Author Name" class="widefat" value="<?php print $author_name   ?> " />

    <?php

}



function post_type_save($post_id)
{

    $is_autosave = wp_is_post_autosave($post_id);
    $is_revision = wp_is_post_revision($post_id);

    if ($is_autosave || $is_revision) {
        return;
    }

    $post = get_post($post_id);

    if ($post->post_type == "portfolio_items") {

        /** save custom field */

        if (array_key_exists('author_name', $_POST)) {
            update_post_meta($post_id, 'author_name', $_POST['author_name']);
        }


        if (array_key_exists('author_name', $_POST)) {
            update_post_meta($post_id, 'author_name', $_POST['author_name']);
        }
    }
}

add_action('save_post', 'post_type_save');




add_action('init', 'my_custom_portfolio_item');












function get_customs_pos()
{


    //   $args = array(

    //   'post_per_page' => -1 ,
    //   'post_type' => 'portfolio_items' ,

    //   ) ;

    //       $myPost = get_post( $args ) ;

    //    foreach ( $myPost as $key => $value ) {

    //            print $value -> ID. '<br />' ;
    //            print $value -> post_title. '<br />' ;


    //    }


    //     $sports = new WP_Query(array('post_type'=>'sport','posts_per_page' => -1,));

    //    if($sports->have_posts()) : 

    //          while($sports->have_posts()) :  $sports->the_post(); 

    //                 the_title(); 

    //           endwhile; 

    //       endif; wp_reset_postdata() 

    global $post;

    $content = '';

    $args = array(
        'post_type'      => 'portfolio_items',
        'post_status'    => 'publish',
        'posts_per_page' => 8,

    );

    $loop = new WP_Query($args);

    while ($loop->have_posts()) : $loop->the_post();

        $sub_title   = get_post_meta($post->ID, 'sub_title', true);
        $author_name = get_post_meta($post->ID, 'author_name', true);


        $content .= $sub_title . ' <br /> ';
        $content .= $author_name . ' <br /> ';




    ?>

        <div>

            <?php $content .= $post->ID . '<br />'; ?>

            <?php $content .= the_title()   ?>

            <?php the_excerpt();  ?>

        </div>


    <?php




    // var_dump( $loop) ;

    endwhile;

    wp_reset_postdata();

    return $content;
}

add_shortcode('customs_post_shortcode', 'get_customs_pos');


// remove wordpress admin menu bar items 


function remove_bar_items($wp_admin_bar)
{
   global $post ;

     if ( ! is_admin())  {
        if ($post -> post_type == "post") {

            $wp_admin_bar->remove_node('new-content');


        }
     }

  
}

add_action('admin_bar_menu', 'remove_bar_items', 800);


//or 

function remove_admin_bar_js()
{

    ?>

    <script>
        jQuery("#wp-admin-bar-my-account").css("display", "none");
    </script>


<?php


}

add_action('admin_footer', 'remove_admin_bar_js');
