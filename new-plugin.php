<?php
/**
 * @package  newPlugin
 */
/*
Plugin Name: new plugin
Plugin URI: https://github.com/hossenmaruf
Description: This is my first attempt on writing a custom Plugin
Version: 1.0.0
Author: hossenmaruf
Author URI: https://github.com/hossenmaruf
License: GPLv2 or later
Text Domain: newPlugin
*/


add_shortcode( 'new' , 'Example_Plugin' ) ;

     function Example_Plugin (){
          
         $info = 'hello from shortcode'  ;

          return $info ;



     }

     echo 'hello' ;

