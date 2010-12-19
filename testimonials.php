<?php
/*
  Plugin Name: Testimonials
  Plugin URI: http://www.marketingadsandseo.com/
  Description: Testimonials is a WordPress plugin that allows you to manage and display testimonials for your blog, product or service. It can be used to build your portfolio or to encourage readers to subscribe / buy your products.
  Author: Chinmoy Paul (chinmoy29)
  Author URI: http://chinmoy29.wordpress.com/
  Version: 3.0
  */
  
  /*
  Copyright (c) 2010 Chinmoy Paul
  
  Testimonials is a free software: you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation, either version 3 of the License, or
  (at your option) any later version.
  
  Testimonials is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.
  
  You should have received a copy of the GNU General Public License
  along with this program.  If not, see <http://www.gnu.org/licenses/>.
  */
  require_once("tWidgets.php");
  include "init_admin.php";
  function testimonials_install() {
	   require_once(dirname(__FILE__).'/installer.php');
	}
	register_activation_hook(__FILE__, 'testimonials_install');
  
  function show_testimonial_in_post($atts){
  	global $wpdb;
	$table = $wpdb->prefix . "testimonials";
    extract(shortcode_atts(array('id' => '', 'excerpt_length' => 200, 'readmore' => 'Read more &rarr;'),$atts));
  
	if(is_array($id))
		$id = implode(",", $id);
	
	$options = get_option('testimonials_tpl');
	$testimonials = $wpdb->get_results("SELECT * FROM $table WHERE FIND_IN_SET(`ID`, '$id') ORDER BY add_dt DESC");
	foreach($testimonials as $t){
		$tpl = stripslashes($options['shortcode_tpl']);
		$testimonial = stripslashes($t->testimonials);
		if(strlen($testimonial) > $excerpt_length){			
			$index = strrpos(substr($testimonial, 0, $excerpt_length), ' ');
			$testimonial = substr($testimonial, 0, $index) . '... <a href="'.get_permalink(get_option('testimonial_page')) .'#testimonials-'.$t->ID.'" >' . 
							html_entity_decode($readmore) . '</a>';
		}
		
		$html = str_replace('%author%', $t->author, $tpl);
		if($t->image == "avatar")
		  $html = str_replace('%image%', get_avatar($t->email, 48), $html);
		elseif(($t->image != "avatar") && ($t->image != "no_image") && ($t->image != ""))
			$html = str_replace('%image%', '<img src="'.get_option('home').'/wp-content/plugins/testimonials/avatar/'.$t->image.'">', $html);
		else
		  $html = str_replace('%image%', '', $html);
		  
		$html = str_replace('%company%', $t->company, $html);
		$html = str_replace('%website%', $t->website, $html);
		$html = str_replace('%testimonials%', str_replace("\n",'<br/>', $testimonial), $html);
		$output .= $html; 
	}
	
	return $output;
  }
  
  
  function show_testimonials(){
  	global $wpdb;
	$table = $wpdb->prefix . "testimonials";
	$options = get_option('testimonials_tpl');
	$testimonials = $wpdb->get_results("SELECT * FROM $table WHERE status = 'publish' ORDER BY add_dt DESC");
	foreach($testimonials as $t){
		$tpl = stripslashes($options['page_tpl']);
		$html = str_replace('%author%', $t->author, $tpl);
		if($t->image == "avatar")
		  $html = str_replace('%image%', get_avatar($t->email, 48), $html);
		elseif(($t->image != "avatar") && ($t->image != "no_image") && ($t->image != ""))
			$html = str_replace('%image%', '<img src="'.get_option('home').'/wp-content/plugins/testimonials/avatar/'.$t->image.'">', $html);
		else
		  $html = str_replace('%image%', '', $html);
		
		$html = str_replace('%company%', $t->company, $html);
		$html = str_replace('%website%', $t->website, $html);
		$html = str_replace('%testimonials%', str_replace("\n",'<br/>', stripslashes($t->testimonials)), $html);
		
		$output .= '<div id="testimonials-'.$t->ID.'">' . $html .'</div>'; 
	}
	
	return $output;
  }
?>
