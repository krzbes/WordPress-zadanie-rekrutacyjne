<?php
    /*
	Plugin Name: XTMConnect
	Description: XTMConnect
	Version: 1.0
	Author: Krzbes
	*/
    if ( ! defined( 'ABSPATH' ) ) {
        exit; // Don't access directly.
    }

    add_action( 'admin_menu', 'my_menu' );

        function my_menu() 
        {
            add_menu_page(
                'My Options',
                'XTMConnect',
                'manage_options',
                'XTMConnect',
                'XTMConnect_options'
            );
            add_submenu_page('XTMConnect','translation', 'translation', 'manage_options', 'XTMConnect-translation','translation');
        }
 
        function translation() 
        {
            if ( !current_user_can( 'manage_options' ) ) {
                wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
            }
            echo "<from><table border=\"1\"><tr><th>nazwa</th><th>zawartość</th> <th>zaznacz do przetłumaczenia</th></tr>";
            $posts = $GLOBALS['wpdb']->get_results( "SELECT ID,post_content, post_name FROM wp_posts", ARRAY_A );
            foreach($posts as $row)
            {
                if($row['post_name']!='')
                {
                    echo "<tr><td>".$row['post_name']."</td><td>".substr($row['post_content'],0,150)."</td><td><input type=\"checkbox\" id=\"id\"  value=\"".$row['ID']."\"></td></tr>";
                }
                
            }
            $comments = $GLOBALS['wpdb']->get_results( "SELECT comment_id,comment_content FROM wp_comments", ARRAY_A );
            foreach($comments as $row)
            {
                if($row['comment_content']!='')
                {
                    echo '<tr><td colspan="2">'.$row['comment_content']."</td><td><input type=\"checkbox\" id=\"id\"  value=\"".$row['comment_id']."\"></td></tr>";
                }
            }
            echo '</table><input type="submit"></form></div><pre>';
        }
        function XTMConnect_options() {
            if ( !current_user_can( 'manage_options' ) ) {
                wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
            }
            echo '</div><pre>';
        }
?>