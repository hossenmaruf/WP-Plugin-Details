<?php




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


