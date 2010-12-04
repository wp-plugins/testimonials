<?php
  /*
  File Name: add_edit_testimonials.php
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
  /** Load WordPress Administration Bootstrap */
  	$action = $_GET['action'];
	//if($action=="edit"): require_once('../../../wp-admin/admin.php'); endif;
	global $wpdb;
	
	$id = $_GET['post'];
	$table_name = $wpdb->prefix . "testimonials";
	$testimonial = $wpdb->get_row("SELECT * FROM $table_name WHERE ID='{$id}'", OBJECT);
	if($_POST['isSave'] == '1'){
		$query= "INSERT INTO {$table_name} SET 
		    	`image` = '{$_POST['image']}',
				`author` = '{$wpdb->escape(strip_tags(stripslashes($_POST['author'])))}',
				`email` = '{$wpdb->escape(strip_tags(stripslashes($_POST['email'])))}',
				`company` = '{$wpdb->escape(strip_tags(stripslashes($_POST['company'])))}',
				`website` = '{$wpdb->escape(strip_tags(stripslashes($_POST['website'])))}',
				`testimonials` = '{$wpdb->escape(stripslashes($_POST['testimonials']))}',
				`status` = '{$wpdb->escape(strip_tags(stripslashes($_POST['status'])))}',
				`add_dt` = NOW()
				";
		$wpdb->query($query);
		echo '<div id="message" class="updated fade"><p>Testimonials has been added successfully.</p></div>';
	  }
	echo '<div class="wrap">
			<h2>'.__('Testimonials', 'testimonials').'</h2>' ."\n";
	  echo "<hr color='#DEDEDE' size='2'/>";
?>
<link media="all" type="text/css" href="<?php echo get_option('home')?>/wp-admin/load-styles.php?c=1&adir=ltr&load=global,wp-admin,media" rel="stylesheet">
<link media="all" type="text/css" href="<?php echo get_option('home')?>/wp-admin/css/colors-fresh.css?ver=20100610" id="colors-css" rel="stylesheet">
<form id="edit-form" class="media-upload-form type-form validate" method="post" <?php if($action=="edit"): ?>action="<?=admin_url()?>admin.php?page=testimonials_listing.php"<?php endif;?>>
  <input type="hidden" value="<?php echo $_GET['post']; ?>" id="post_id" name="post_id">
  <input type="hidden" value="<?php echo $_REQUEST['p']; ?>" id="p" name="p">
 <!-- <div id="media-items">-->
  	<h2><?php if($action=="edit"): ?>Edit<?php else: ?>Add New<?php endif;?> Testimonial</h2>
    <div class="media-item media-blank">
      <table class="describe"><tbody>
        <tr>
          <th class="label" scope="row"><span class="alignleft"><label for="image">Image:</label></span></th>
          <td class="field">
            <input type="radio" name="image" id="image" class="ads_txt" value="avatar" <?php if($testimonial->image == "avatar") echo "checked";?>> Avatar 
            <input type="radio" name="image" id="image" class="ads_txt" value="no_image" <?php if($testimonial->image == "no_image") echo "checked";?>> No Image
          </td>
        </tr>
        <tr>
          <th class="label" scope="row"><span class="alignleft"><label for="ads_title">Author:</label></span></th>
          <td class="field"><input type="text" name="author" id="author1" class="ads_txt" value="<?php echo $testimonial->author; ?>"/></td>
        </tr>
		    <tr>
          <th class="label"><span class="alignleft"><label for="email">Email:</label></span></th>
          <td><input type="text" name="email" id="email" class="ads_txt" value="<?php echo stripslashes($testimonial->email); ?>"/></td>
        </tr>
        <tr>
          <th class="label"><span class="alignleft"><label for="company">Company:</label></span></th>
          <td><input type="text" name="company" id="company" class="ads_txt" value="<?php echo stripslashes($testimonial->company); ?>"/></td>
        </tr>
    	 <tr>
          <th class="label"><span class="alignleft"><label for="ads_link">Website:</label></span></th>
          <td><input type="text" name="website" id="website" class="ads_txt" value="<?php echo $testimonial->website; ?>"/></td>
        </tr>
        <tr>
          <th valign="top" class="label"><span class="alignleft"><label for="ads_desc">Testimonial:</label></span></th>
          <td>
			<div id="poststuff"><?php the_editor(stripslashes($testimonial->testimonials), 'testimonials', '', $media_buttons = false); ?></div>
		  </td>
        </tr>
        <tr>
          <th class="label" scope="row"><span class="alignleft"><label for="category">Status:</label></span></th>
          <td class="field">
            <select name="status">
              <option value="-1">Select a status</option>
              <option value="publish" <?php if($testimonial->status=='publish') echo "selected"; ?>>Publish</option>
              <option value="draft" <?php if($testimonial->status=='draft') echo "selected"; ?>>Draft</option>
            </select>
          </td>
        </tr>
        <tr>
          <td colspan="2"><input type="submit" name="edit" value="Save" class="button"/><input type="hidden" name="isSave" value="1"/></td>          
        </tr></tbody>
      </table>
    </div>
  <!--</div>-->
</form>
</div>
