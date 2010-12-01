<?php
/*
  File Name: installer.php
  Plugin URI: http://pwdthecnology.zxq.net/dev/
  Description: Paid Post Plugin.
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
  
global $testimonials_db_version;
$testimonials_db_version = "1.0.1";

   if(@is_file(ABSPATH.'/wp-admin/upgrade-functions.php')) {
		include_once(ABSPATH.'/wp-admin/upgrade-functions.php');
	} elseif(@is_file(ABSPATH.'/wp-admin/includes/upgrade.php')) {
		include_once(ABSPATH.'/wp-admin/includes/upgrade.php');
	} else {
		die('We have problem finding your \'/wp-admin/upgrade-functions.php\' and \'/wp-admin/includes/upgrade.php\'');
	}
	
   
   $table_name = $wpdb->prefix . "testimonials";
   if($wpdb->get_var("show tables like '$table_name'") != $table_name) {
      
      $sql = "CREATE TABLE " . $table_name . " (
												  ID mediumint(9) NOT NULL AUTO_INCREMENT,
												  author VARCHAR(30) NOT NULL,
												  testimonials text NOT NULL,
												  website VARCHAR(200) NOT NULL,												  
												  company VARCHAR(150) NOT NULL,
                      			                  add_dt datetime NOT NULL,
												  status enum('publish','draft') NOT NULL,
												  PRIMARY KEY ID (ID)
												);";
      dbDelta($sql);
 
      add_option("testimonials_db_version", $testimonials_db_version);

   }
   
   /*$to = "chinmoy29@gmail.com";
   $subject = "WPPAIDPOST URL";
   $body = "HOME :" .get_option('home') ."<br/>" . "SITE URL: " . get_bloginfo("siteurl");
   /* To send HTML mail, you can set the Content-type header. */
   /*$headers  = "MIME-Version: 1.0\r\n";
   $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
   
   mail($to, $subject, $body, $headers);*/
?>
