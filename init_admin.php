<?php
  /*
  File Name: init_admin.php
  Plugin URI: http://pwdthecnology.zxq.net/dev/
  Description: Paid Post Plugin.
  Author: Chinmoy Paul (chinmoy29)
  Author URI: http://chinmoy29.wordpress.com/
  Version: 2.0
  */
  
  /*
  Copyright 2010 Chinmoy Paul
  
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
  add_action('admin_init', 'editor_admin_init');
  add_action('admin_head', 'editor_admin_head');
  function editor_admin_init() {
	  //wp_enqueue_script('word-count');
	  //wp_enqueue_script('post');
	  wp_enqueue_script('editor');
	  //wp_enqueue_script('media-upload');
	}

	function editor_admin_head() {
	  wp_tiny_mce();
	}
	  
	add_action("init", "load_css");
	function load_css(){
		$path = get_option("home") . "/wp-content/plugins/testimonials/testimonials.css";
		//wp_enqueue_style('testimonials', $path, array(), 20101114);
		wp_register_style('load_css_styles', $path);
    	wp_enqueue_style( 'load_css_styles');
	}
   //Add widget
   add_action("widgets_init", "widget_Testimonials_init");
  //Add the Admin Menus
  if (is_admin()) {
	function testimonials_add_admin_menu() {
  		add_menu_page(__("Testimonials", 'testimonials'), __("Testimonials", 'testimonials'), 8, "testimonials_listing.php");
		add_submenu_page("testimonials_listing.php", __("Testimonials", 'testimonials'), __("Testimonials", 'testimonials'), 8, "testimonials_listing.php", "testimonials_options");
		add_submenu_page("testimonials_listing.php", __("Add testimonials", 'testimonials'), __("Add Testimonial", 'testimonials'), 8, "add_edit_testimonials.php", "testimonials_options");
  		add_submenu_page("testimonials_listing.php", __("General Settings testimonials", 'testimonials'), __("General Settings", 'testimonials'), 8, "settings.php", "testimonials_options");
  		//add_submenu_page("setup.php", __("Manage Posts WP_Paid_Posts", 'wppaidposts'), __("Manage Posts", 'wppaidposts'), 8, "posts_listing.php", "wppaidposts_options");
  		//add_submenu_page("setup.php", __("Manage Category WP_Paid_Posts", 'wppaidposts'), __("Manage Category", 'wppaidposts'), 6, "ad_category.php", "wppaidposts_options");
  		//add_submenu_page("setup.php", __("Manage Design WP_Paid_Posts", 'wp125'), __("Manage Design", 'wppaidposts'), 8, "design.php", "wppaidposts_options");
  		//add_submenu_page("setup.php", __("Thank You Page WP_Paid_Posts", 'wp125'), __("Thank You Page", 'wppaidposts'), 9, "thankyou.php", "wppaidposts_options");  		
  		//add_submenu_page("setup.php", __("Coupon Code WP_Paid_Posts", 'wp125'), __("Coupon Code", 'wppaidposts'), 10, "coupon_code.php", "wppaidposts_options");
  	}
  	
  }
  
  add_shortcode("testimonial_in_post", "show_testimonial_in_post");
  add_shortcode("testimonials", "show_testimonials");
  
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
  
   function widget_Testimonials_init(){
    	if ( !function_exists('register_sidebar_widget') )
			return;
		function load_jlib(){			
			//add_action('wp_head', 'load_jlib2');
			echo '<script src="'.get_option('home') . '/wp-content/plugins/testimonials/js/jquery.innerfade.js" type="text/javascript"></script>';
			echo '<script src="'.get_option('home') . '/wp-content/plugins/testimonials/js/testimonials.js" type="text/javascript"></script>';
		}
		/*function load_jlib2(){
			echo '<script src="'.get_option('home') . '/wp-content/plugins/testimonials/js/jquery.innerfade.js" type="text/javascript"></script>';
			wp_register_script('testimonials', get_option('home') . '/wp-content/plugins/testimonials/js/testimonials.js');
			wp_enqueue_script('innerfade');
			wp_enqueue_script('testimonials');
		}*/
		function widget_Testimonials($args){
		  global $wpdb;
		  extract ($args);
		  $options = get_option('widget_Testimonials');
		  $table_name = $wpdb->prefix . "testimonials";
		  $testimonials = $wpdb->get_results("SELECT * FROM $table_name WHERE 1 AND status='publish' ORDER BY add_dt DESC LIMIT 0, {$options['Testimonials_num']}");
		  
		  if($options['jquery_if']=="on") load_jlib();	
			
		  echo $before_widget;
		  echo $before_title . $options['Testimonials-title'] . $after_title;
		  if(is_array($testimonials)){
		  	 $options = get_option('testimonials_tpl');
			 echo  '<ul id="testimonials_widget">';
			 foreach($testimonials as $t):
			    $tpl = stripslashes($options['widget_tpl']);
			 	$list ="<li>\n";  				  
				$html = str_replace('%author%', $t->author, $tpl);
				if($t->image == "avatar")
				  $html = str_replace('%image%', get_avatar($t->email, 48), $html);
				else
				  $html = str_replace('%image%', '', $html);
				  
				$html = str_replace('%company%', $t->company, $html);					
				$html = str_replace('%website%', $t->website, $html);
				if((strlen($t->testimonials) > $options['Testimonials_word']) && ($options['Testimonials_word'] > 0) 
					&& ( $options['Testimonials_word'] !="")){
					$index = strrpos(substr(stripslashes($t->testimonials), 0, $options['Testimonials_word']), ' ') ;
					$html = str_replace('%testimonials%', str_replace("\n",'<br/>', substr(stripslashes($t->testimonials), 0, $index)) .'...', $html);
				}
				else
					$html = str_replace('%testimonials%', str_replace("\n",'<br/>', stripslashes($t->testimonials)), $html);
				
				if($options['Testimonials_rdmore'] !="")
					$list .= $html . " <a href='". get_permalink(get_option('testimonial_page')) ."#testimonials-".$t->ID."'>" . 
									$options['Testimonials_rdmore'] . "</a></li>\n";
				else
					$list .= $html . "</li>\n";
					
				echo $list;
			 endforeach;
			 echo '</ul>';
		  }
		  echo $after_widget;
		}	
		function widget_Testimonials_control(){
			// Get options
			$options = get_option('widget_Testimonials');
			if(!is_array($options)){
				$options['Testimonials-title'] = "Testimonials";
				$options['Testimonials_num'] = (int) 1;
				$options['Testimonials_word'] = 200;
				$options['Testimonials_rdmore'] = "Read More &mdash;";
				update_option('widget_Testimonials', $options);
			  }
			if($_POST['Testimonials-submit']){
			  	$options['Testimonials-title'] = strip_tags(stripslashes($_POST['Testimonials-title']));
				$options['Testimonials_num'] = strip_tags(stripslashes($_POST['Testimonials_num']));
				$options['Testimonials_word'] = (int) $_POST['Testimonials_word'];
				$options['Testimonials_rdmore'] = stripslashes($_POST['Testimonials_rdmore']);
				$options['jquery_if'] = $_POST['jquery_if'];
				update_option('widget_Testimonials', $options);
			}
			$Testimonials_title = $options['Testimonials-title'];
			$Testimonials_num = $options['Testimonials_num'];
			$Testimonials_word = $options['Testimonials_word'];
			$Testimonials_rdmore = $options['Testimonials_rdmore'];
			$jquery_inf = $_POST['jquery_if'];
?>
      <p>
				<label for="title">
					<?php _e( 'Title' ); ?>:
					<input class="widefat" id="Testimonials-title" name="Testimonials-title" type="text" value="<?php echo $Testimonials_title; ?>" />
				</label>
			</p>
			<p>
				<label for="fpost_num">
					<?php _e('Number of Ad Listing to show'); ?>:
					<input style="text-align: center;" id="Testimonials_num" name="Testimonials_num" type="text" value="<?php echo absint($Testimonials_num); ?>" size='3' />
				</label>
			</p>
			<p>
				<label for="fpost_num">
					<?php _e('Excerpt Length'); ?>:
					<input style="text-align: center;" id="Testimonials_word" name="Testimonials_word" type="text" 
					value="<?php echo absint($Testimonials_word); ?>" size='3' />
					<small>(0 or blink means: whole content will display )</small>
				</label>
			</p>
			<p>
				<label for="fpost_num">
					<?php _e('Link Text'); ?>:
					<input id="Testimonials_rdmore" name="Testimonials_rdmore" type="text" 
					value="<?php echo $Testimonials_rdmore; ?>"  />
					<small>(blank means disable)</small>
				</label>
			</p>
			<p>
				<label for="jquery">
					<?php _e('Use innerfade jquery'); ?>:
					<input type="checkbox" id="jquery_if" name="jquery_if" <?php checked( (bool) $jquery_inf, true ); ?>/>
				</label>
			</p>
  		<input type="hidden" id="Testimonials-submit" name="Testimonials-submit" value="1" />
<?php
		}
		
		// Register widget for use
		register_sidebar_widget(array('Testimonials', 'widgets'), 'widget_Testimonials');

		// Register settings for use, 200x200 pixel form
		register_widget_control(array('Testimonials', 'widgets'), 'widget_Testimonials_control', 200, 200);	
		
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
	}
	
?>
