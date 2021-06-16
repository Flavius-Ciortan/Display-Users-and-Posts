<?php
/**
 * Plugin Name: Users with posts
 * Plugin URI: 
 * Description: A simple way to display a list of users and their posts, in an accodrion style! All you need is to add the shortcode <strong>[users]</strong> to a page or post to display the content.
 * Version: 1.0
 * Text Domain: users_with_posts
 * Author: Flavius Ciortan
 * Author URI: 
 */


function users_with_posts() {	
	$writers = get_users();
	echo '<div class="accordion-wrapper">';

	foreach ($writers as $user) {		// Display users list
		$user_id = $user->id;		
		echo '<div class="accordion"><div class="accordion_tab"><p class="user-name">' . $user->display_name .'</p><div class="accordion-icon-container"><img class="accordion-icon" src="'.plugins_url( '/img/arrow.png', __FILE__ ).'"></div></div>';

		$get_the_posts = new WP_Query( array( 'author' => $user_id ) );		// Get the posts for each user

		if ( $get_the_posts->have_posts() ) {		// Display posts for each user, if there are any posts
			echo '<div class="accordion_content">';

			while ( $get_the_posts->have_posts() ) {
				$get_the_posts->the_post();
				echo '<p class="user-posts-item"><a href="'. get_permalink($get_the_posts->ID) .'" target="_blank">' . get_the_title() .'</a> <span class="user-posts-date">'. get_the_date( 'd.m.Y' ) .'</span></p><hr>';
			}

			echo '</div></div>';

		} else {		// Display message, if there are no posts
			echo '<div class="accordion_content"><p class="no-posts">This user did not post anything yet!</p></div>';
		}
		wp_reset_postdata();		// Restore original Post Data because we used "the_post()"
	}
	echo '</div>';
	
		// Linked Stylesheet, Custom Script and jquery-UI(we need this for the accordion)
	wp_register_style( 'users-with-posts-style', plugins_url( '/css/users-with-posts-style.css', __FILE__ ) );
	wp_enqueue_style( 'users-with-posts-style');
	wp_register_script('jquery-ui', plugins_url('/js/jquery-ui.js', __FILE__ ), array(), null, true);
	wp_enqueue_script('jquery-ui');
	wp_register_script('users-with-posts-script', plugins_url('/js/users-with-posts-accordion.js', __FILE__ ), array('jquery'), null, true);
	wp_enqueue_script('users-with-posts-script');


	
} 

add_shortcode('users', 'users_with_posts');		// Create the shortcode