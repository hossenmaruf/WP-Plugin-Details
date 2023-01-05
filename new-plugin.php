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
add_shortcode('ideapro_contact_form','ideapro_form');


function set_html_content_type()
{
    return 'text/html';

}



function ideapro_form_capture()
	{
		global $post,$wpdb;

		if(array_key_exists('ideapro_submit_form',$_POST))
		{
			$to = "support@ideapro.com";
			$subject = "Idea Pro Example Site Form Submission";
			$body = '';

			$body .= 'Name: '.$_POST['full_name'].' <br /> ';
			$body .= 'Email: '.$_POST['email_address'].' <br /> ';
			$body .= 'Phone: '.$_POST['phone_number']. ' <br /> ';
			$body .= 'Comments: '.$_POST['comments'].' <br /> ';


			

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

        $wpdb->get_results(" INSERT INTO ".$wpdb->prefix."form_submission (data) VALUES ('".$body."') ");

    //  $wpdb->insert($table,$data,$format);



    }

}


//adding our own portfolio item
function my_custom_portfolio_item() {
    $labels = array(
      'name'               => _x( 'Portfolio items', 'post type general name' ),
      'singular_name'      => _x( 'Portfolio item', 'post type singular name' ),
      'menu_name'          => 'Portfolio'
    );
      $args = array(
      'labels'        => $labels,
      'description'   => 'Holds our custom portfolio items',
      'public'        => true,
      'menu_position' => 5,
      'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments' ),
      'has_archive'   => true,
    );
    register_post_type( 'portfolio_items', $args ); 
  } 
  add_action( 'init', 'my_custom_portfolio_item' );


    function get_customs_pos() {


          $args = array(

          'post_per_page' => -1 ,
          'post_type' => 'portfolio_items' ,

          ) ;

          $myPost = get_post( $args ) ;

       foreach ( $myPost as $key => $value ) {

              echo $value->ID . '<br />' ;
               

       }


    }

    add_shortcode( 'customs_post_shortcode' , 'get_customs_pos' ) ;






