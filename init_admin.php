<?php
  /*
  File Name: init_admin.php
  Plugin URI: http://www.marketingadsandseo.com/
  Description: Testimonials is a WordPress plugin that allows you to manage and display testimonials for your blog, product or service. It can be used to build your portfolio or to encourage readers to subscribe / buy your products.
  Author: Chinmoy Paul (chinmoy29)
  Author URI: http://chinmoy29.wordpress.com/
  Version: 2.1
  */
  
  /*
  Copyright (c) 2010 Chinmoy Paul
  
  This program is free software: you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation, either version 3 of the License, or
  (at your option) any later version.
  
  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.
  
  You should have received a copy of the GNU General Public License
  along with this program.  If not, see <http://www.gnu.org/licenses/>.
  */
  
  define('PAGE_LIMIT', 15);
  if (function_exists('wp_enqueue_style')) {
		wp_enqueue_script('jquery');
		wp_enqueue_script('thickbox');
		wp_enqueue_style('thickbox');
	  }
  add_action('wp_print_scripts', 'load_cycle_js');
  function load_cycle_js(){
  	wp_register_script('jquery-cycle-js', get_option("home") . "/wp-content/plugins/testimonials/js/jquery.cycle.min.js", array(), "2.1");
	wp_register_script('testimonials-js', get_option("home") . "/wp-content/plugins/testimonials/js/testimonials.js.php?".get_option('param'), array(), "2.1");
	wp_enqueue_script('testimonials-js');
	wp_enqueue_script('jquery-cycle-js');
  }
  
  add_action('admin_init', 'editor_admin_init');
  add_action('admin_head', 'editor_admin_head');
  function editor_admin_init() {
	  //wp_enqueue_script('word-count');
	  //wp_enqueue_script('post');
	  wp_enqueue_script('editor');
	  //wp_enqueue_script('media-upload');
	  $path = get_option("home") . "/wp-content/plugins/testimonials/admin_style.css";
	  wp_register_style('testimonials_admin_styles', $path, array(), "2.1");
	  wp_enqueue_style( 'testimonials_admin_styles');
	  wp_enqueue_script('tjquery-colorpicker', get_option("home") . '/wp-content/plugins/testimonials/js/colorpicker.js');
	  wp_enqueue_script('t_form', get_option("home") . '/wp-content/plugins/testimonials/js/admin_form.js');
	}

	function editor_admin_head() {
	  wp_tiny_mce();
	  
	}
	
	function custom_css_query(){
		$cd = get_option('testimonials_custom_dsgn');
		if(is_array($cd)){
			foreach($cd as $key => $value){
				$custom_css_query .= "&$key=$value";
			}
		}	
		
		return substr($custom_css_query, 1);
	}
	  
	add_action("init", "load_testimonials_css");
	function load_testimonials_css(){
	    $theme_css_query = custom_css_query();
		$path = get_option("home") . "/wp-content/plugins/testimonials/testimonials.css.php?{$theme_css_query}";
		wp_register_style('load_css_styles', $path, array(), '2.1');
    	wp_enqueue_style( 'load_css_styles');
	}
  //Add the Admin Menus
  if (is_admin()) {
	function testimonials_add_admin_menu() {
  		add_menu_page(__("Testimonials", 'testimonials'), __("Testimonials", 'testimonials'), 8, "testimonials_listing.php");
		add_submenu_page("testimonials_listing.php", __("Testimonials", 'testimonials'), __("Testimonials", 'testimonials'), 8, "testimonials_listing.php", "testimonials_options");
		add_submenu_page("testimonials_listing.php", __("Add testimonials", 'testimonials'), __("Add Testimonial", 'testimonials'), 8, "add_edit_testimonials.php", "testimonials_options");
  		add_submenu_page("testimonials_listing.php", __("General Settings testimonials", 'testimonials'), __("General Settings", 'testimonials'), 8, "settings.php", "testimonials_options");
  	}
  	
  }
  
  add_shortcode("testimonial_in_post", "show_testimonial_in_post");
  add_shortcode("testimonials", "show_testimonials");
 
  function load_testimonials_script(){  	
	//wp_tiny_mce();
  }
  
  function testimonials_add_menu_favorite($actions) {
  	$actions['admin.php?page=testimonials_listing.php'] = array('Testimonials', 'manage_options');
  	return $actions;
  }
  add_filter('favorite_actions', 'testimonials_add_menu_favorite'); //Favorites Menu
  if (is_admin()) { add_action('admin_menu', 'testimonials_add_admin_menu'); } //Admin pages
  
  function testimonials_options(){
    $page = $_GET['page'];    
    include("{$page}");
  }
	
	add_action('plugins_loaded', 'createPage', 10);
	if(!is_object($wp_rewrite))
  		$wp_rewrite =& new WP_Rewrite();
	
	function createPage(){
		$testimonial_page->ID = get_option('testimonial_page');
		if(!is_object(get_page($testimonial_page->ID))){
		  $content = "[testimonials]";
		  $args = array('post_status' => "publish", 'post_name' => 'testimonials',
						'post_type' => 'page', 'post_author' => 1,
						'post_title' => 'Testimonials', 'comment_status' => 'closed',
						'post_content' => $content);
		  update_option('testimonial_page', wp_insert_post($args, $wp_error ));
		  
		}
		
		$options['page_tpl'] = "<div><span class='testimonials-avatar'>%image%</span><div id='testimonial'><div class='cnt'><span id='tAuthor'>%author%</span><span id='tCompany'> | %company%</span><div class='tTestimonial'>%testimonials%</div></div></div></div><br/>";
  	$options['shortcode_tpl'] = "<div><span class='testimonials-avatar'>%image%</span><div id='testimonial'><div class='cnt'><span id='tAuthor'>%author%</span><span id='tCompany'> | %company%</span><div class='tTestimonial'>%testimonials%</div></div></div></div><br/>";
    $options['widget_tpl'] = "<div id='testimonails-widget'><span class='wAvatar'>%image%</span><p class='wTesimonial'>%testimonials%</p> &mdash; <span class='wAuthor'>%author%</span><span class='wCompany'> | %company%</span></div>";
    update_option('testimonials_tpl', $options);
	}
	
?>
