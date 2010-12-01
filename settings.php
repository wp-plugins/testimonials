<?php
  /*
  File Name: testimonials_listing.php
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
  
   $options = get_option('testimonials_tpl');
  if(!is_array($options)){
    $options['page_tpl'] = "<div>%image%<div id='testimonial'><div class='cnt right'><span id='author'>%author% | %company%</span>%testimonials%</div></div></div><br/>";
  	$options['shortcode_tpl'] = "<div>%image%<div id='testimonial'><div class='cnt right'><span id='author'>%author% | %company%</span>%testimonials%</div></div></div><br/>";
    $options['widget_tpl'] = "<div class='testimonial'><span class='right' id='author'>%image% %author% %website%</span><span>%testimonials%</span></div>";
    update_option('testimonials_tpl', $options);
  }
  
  if($_POST['isSave'] == '1'){
    $option['shortcode_tpl'] = stripslashes($_POST['shortcode_tpl']);
    $option['widget_tpl'] = stripslashes($_POST['widget_tpl']);
	$option['page_tpl'] = stripslashes($_POST['page_tpl']);
    update_option('testimonials_tpl', $option);
    $options = get_option('testimonials_tpl');
    echo '<div id="message" class="updated fade"><p>Settings updated.</p></div>';
	$css = "../wp-content/plugins/testimonials/testimonials.css";
  	$fp = fopen($css,"w");
	fwrite($fp, stripslashes($_POST['css']));
	fclose($fp);
  }
  
  echo '<div class="wrap">
		<h2>'.__('General Settings', 'testimonials').'</h2>' ."\n";
  echo "<hr color='#DEDEDE' size='2'/>";
  
  //css file
  $css = "../wp-content/plugins/testimonials/testimonials.css";
  $fp = fopen($css,"r");
?>
<form name="gnrl_frm" method="post">
	<table class="form-table">
	  <tr valign="top">
		<th>Template for testimonials page:</th>
		<td>
			<textarea class="text" id="page_tpl" name="page_tpl" rows="8" cols="60"><?php echo $options['page_tpl'];?></textarea>
		</td>
	 </tr>
	 <tr valign="top">
		<th>Template for Widget:</th>
		<td>
			<textarea class="text" id="widget_tpl" name="widget_tpl" rows="8" cols="60"><?php echo $options['widget_tpl'];?></textarea>
		</td>
	 </tr>
	 <tr valign="top">
		<th>Template for diplaying testimonials within post or page(using shortcode):</th>
		<td>
			<textarea class="text" id="shortcode_tpl" name="shortcode_tpl" rows="8" cols="60"><?php echo $options['shortcode_tpl'];?></textarea>
		</td>
	 </tr>
	 <tr valign="top">
		<th>Customize CSS:</th>
		<td>
			<textarea class="text" id="css" name="css" rows="18" cols="60"><?php echo fread($fp, filesize($css)); ?></textarea>
		</td>
	 </tr>
	 <tr>
          <td colspan="2"><input type="submit" name="edit" value="Save Changes" class="button"/><input type="hidden" name="isSave" value="1"/></td>          
        </tr>
	</table>
</form>

<?php 
  fclose($fp); 
  echo "</div>";
?>