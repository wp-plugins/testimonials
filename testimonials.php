<?php
/*
  Plugin Name: Testimonials
  Plugin URI: http://pwdthecnology.zxq.net/dev/
  Description: Testimonials is a WordPress plugin that allows you to manage and display testimonials for your blog, product or service. It can be used to build your portfolio or to encourage readers to subscribe / buy your products.
  Author: Chinmoy Paul (chinmoy29)
  Author URI: http://chinmoy29.wordpress.com/
  Version: 1.0
  */
  
  /*
  Copyright 2010 Chinmoy Paul
  
  Testimonials: you can redistribute it and/or modify
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
  include "init_admin.php";
  function testimonials_install() {
	   require_once(dirname(__FILE__).'/installer.php');
	}
	register_activation_hook(__FILE__, 'testimonials_install');
  
  function show_testimonial_in_post($atts){
  	global $wpdb;
	$table = $wpdb->prefix . "testimonials";
  	extract(shortcode_atts(array('id' => ''),$atts));
	if(is_array($id))
		$id = implode(",", $id);
	
	$options = get_option('testimonials_tpl');
	$testimonials = $wpdb->get_results("SELECT * FROM $table WHERE FIND_IN_SET(`ID`, '$id')");
	foreach($testimonials as $t){
		$tpl = stripslashes($options['shortcode_tpl']);
		$html = str_replace('%author%', $t->author, $tpl);
		$html = str_replace('%image%', '<img src="http://localhost/blog3.0/wp-content/plugins/testimonials/images/guitar.gif" class="avatar"/>', $html);
		$html = str_replace('%company%', $t->company, $html);
		$html = str_replace('%website%', $t->website, $html);
		$html = str_replace('%testimonials%', str_replace("\n",'<br/>', stripslashes($t->testimonials)), $html);
		//$html.= "<div class='testimonial'><span>" . str_replace("\n",'<br/>', stripslashes($t->testimonials)) .
		//	 	"</span><span class='right' id='author'>&mdash;{}</span></div><div style='clear: both;'></div>";
		$output .= $html; 
	}
	
	return $output;
  }
  
  
  function show_testimonials(){
  	global $wpdb;
	$table = $wpdb->prefix . "testimonials";
  	//extract(shortcode_atts(array('num' => 5),$atts));
	$options = get_option('testimonials_tpl');
	$testimonials = $wpdb->get_results("SELECT * FROM $table WHERE status = 'publish'");
	foreach($testimonials as $t){
		$tpl = stripslashes($options['page_tpl']);
		$html = str_replace('%author%', $t->author, $tpl);
		$html = str_replace('%image%', '<img src="http://localhost/blog3.0/wp-content/plugins/testimonials/images/guitar.gif" class="avatar"/>', $html);
		$html = str_replace('%company%', $t->company, $html);
		$html = str_replace('%website%', $t->website, $html);
		$html = str_replace('%testimonials%', str_replace("\n",'<br/>', stripslashes($t->testimonials)), $html);
		//$html.= "<div class='testimonial'><span>" . str_replace("\n",'<br/>', stripslashes($t->testimonials)) .
		//	 	"</span><span class='right' id='author'>&mdash;{}</span></div><div style='clear: both;'></div>";
		$output .= $html; 
	}
	
	return $output;
  }
?>
