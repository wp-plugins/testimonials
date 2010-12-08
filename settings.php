<?php
  /*
  File Name: testimonials_listing.php
  Plugin URI: http://www.marketingadsandseo.com/
  Description: Testimonials is a WordPress plugin that allows you to manage and display testimonials for your blog, product or service. It can be used to build your portfolio or to encourage readers to subscribe / buy your products.
  Author: Chinmoy Paul (chinmoy29)
  Author URI: http://chinmoy29.wordpress.com/
  Version: 1.0
  */
  
  /*
  Copyright (c) 2010 Chinmoy Paul
  
  This program is a free software: you can redistribute it and/or modify
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
  
   $options = get_option('testimonials_tpl');
   $custOption = get_option("custom_css");
   $dsgnOptions = get_option("testimonials_custom_dsgn");
  if(!is_array($options)){
    $options['page_tpl'] = "<div><span class='testimonials-avatar'>%image%</span><div id='testimonial'><div class='cnt'><span id='tAuthor'>%author%</span> | <span id='tCompany'>%company%</span><div class='tTestimonial'>%testimonials%</div></div></div></div><br/>";
  	$options['shortcode_tpl'] = "<div><span class='testimonials-avatar'>%image%</span><div id='testimonial'><div class='cnt'><span id='tAuthor'>%author%</span> | <span id='tCompany'>%company%</span><div class='tTestimonial'>%testimonials%</div></div></div></div><br/>";
    $options['widget_tpl'] = "<div id='testimonails-widget'><span class='wAvatar'>%image%</span><p class='wTesimonial'>%testimonials%</p> — <span class='wAuthor'>%author%</span> | <span class='wCompany'>%company%</span></div>";
    update_option('testimonials_tpl', $options);
  }
  
  if(!is_array($dsgnOptions)){
  	$dsgnOptions['author_txt_clr'] = "3d3d3d" ;
	$dsgnOptions['wauthor_txt_clr'] = "3d3d3d";
	$dsgnOptions['ipauthor_txt_clr'] = "3d3d3d";
	
	$dsgnOptions['web_clr'] = "3d3d3d" ;
	$dsgnOptions['wweb_clr'] = "3d3d3d";
	$dsgnOptions['ipweb_clr'] = "3d3d3d";
	
	$dsgnOptions['cmp_txt_clr'] = "3d3d3d" ;
	$dsgnOptions['wcmp_txt_clr'] = "3d3d3d";
	$dsgnOptions['ipcmp_txt_clr'] = "3d3d3d";
	
	$dsgnOptions['tetm_txt_clr'] = "666666" ;
	$dsgnOptions['wtetm_txt_clr'] = "666666";
	$dsgnOptions['iptetm_txt_clr'] = "666666";
	
	update_option('testimonials_custom_dsgn', $dsgnOptions);
  }
  
  if($_POST['isSave'] == '1'){
    $option['shortcode_tpl'] = stripslashes($_POST['shortcode_tpl']);
    $option['widget_tpl'] = stripslashes($_POST['widget_tpl']);
	$option['page_tpl'] = stripslashes($_POST['page_tpl']);
	$custOption['custom_css'] = stripslashes($_POST['custom_css']);
    update_option('testimonials_tpl', $option);
    $options = get_option('testimonials_tpl');
	update_option('custom_css', $custOption);
	
	$dsgnOptions['author_txt_clr'] = $_POST['author_txt_clr'] ;
	$dsgnOptions['wauthor_txt_clr'] = $_POST['wauthor_txt_clr'];
	$dsgnOptions['ipauthor_txt_clr'] = $_POST['ipauthor_txt_clr'];
	
	$dsgnOptions['web_clr'] = $_POST['web_clr'] ;
	$dsgnOptions['wweb_clr'] = $_POST['wweb_clr'];
	$dsgnOptions['ipweb_clr'] = $_POST['ipweb_clr'];
	
	$dsgnOptions['cmp_txt_clr'] = $_POST['cmp_txt_clr'] ;
	$dsgnOptions['wcmp_txt_clr'] = $_POST['wcmp_txt_clr'];
	$dsgnOptions['ipcmp_txt_clr'] = $_POST['ipcmp_txt_clr'];
	
	$dsgnOptions['tetm_txt_clr'] = $_POST['tetm_txt_clr'] ;
	$dsgnOptions['wtetm_txt_clr'] = $_POST['wtetm_txt_clr'];
	$dsgnOptions['iptetm_txt_clr'] = $_POST['iptetm_txt_clr'];
	
	update_option('testimonials_custom_dsgn', $dsgnOptions);
	$dsgnOptions = get_option("testimonials_custom_dsgn");
    echo '<div id="message" class="updated fade"><p>Settings updated.</p></div>';
  }
  
  echo '<div class="wrap">
		<h2>'.__('General Settings', 'testimonials').'</h2>' ."\n";
  echo "<hr color='#DEDEDE' size='2'/>";
  
?>
<form name="gnrl_frm" method="post">
	<table class="form-table">
	   
	 <tr valign="top">
		<th colspan="2">
			<b>Custom Design Settings</b>
		</th>
	 </tr>
	 <tr>
	 	<td colspan="2">
			<table width="100%">
				<tr valign="top">
					<th>&nbsp;
						
					</th>
					<th>
						<b>Testimonials Page</b>
					</th>
					<th>
						<b>Sidebar Widget</b>
					</th>
					<th>
						<b>Testimonials inside post/page</b>
					</th>
				 </tr>
				  <tr valign="top">
					<th><label for="author_txt_clr">Author Text color</label></th>
					<td>
						<span>#</span><input type="text" name="author_txt_clr" id="author_txt_clr" class="colorpick" 
							style="background-color: #<?php echo esc_attr($dsgnOptions['author_txt_clr']);?>;" 
							value="<?php echo esc_attr($dsgnOptions['author_txt_clr']);?>">
					</td>
					<td>
						<span>#</span><input type="text" name="wauthor_txt_clr" id="wauthor_txt_clr" class="colorpick" 
							style="background-color: #<?php echo esc_attr($dsgnOptions['wauthor_txt_clr']);?>;" 
							value="<?php echo esc_attr($dsgnOptions['wauthor_txt_clr']);?>">
					</td>
					<td>
						<span>#</span><input type="text" name="ipauthor_txt_clr" id="ipauthor_txt_clr" class="colorpick"
							style="background-color: #<?php echo esc_attr($dsgnOptions['ipauthor_txt_clr']);?>;" 
							value="<?php echo esc_attr($dsgnOptions['ipauthor_txt_clr']);?>">
					</td>
				 </tr>
				 <tr valign="top">
					<th><label for="cmp_txt_clr">Company Text color</label></th>
					<td>
						<span>#</span><input type="text" name="cmp_txt_clr" id="cmp_txt_clr" class="colorpick"
							style="background-color: #<?php echo esc_attr($dsgnOptions['cmp_txt_clr']);?>;" 
							value="<?php echo esc_attr($dsgnOptions['cmp_txt_clr']);?>">
					</td>
					<td>
						<span>#</span><input type="text" name="wcmp_txt_clr" id="wcmp_txt_clr" class="colorpick"
							style="background-color: #<?php echo esc_attr($dsgnOptions['wcmp_txt_clr']);?>;" 
							value="<?php echo esc_attr($dsgnOptions['wcmp_txt_clr']);?>">
					</td>
					<td>
						<span>#</span><input type="text" name="ipcmp_txt_clr" id="ipcmp_txt_clr" class="colorpick"
							style="background-color: #<?php echo esc_attr($dsgnOptions['ipcmp_txt_clr']);?>;" 
							value="<?php echo esc_attr($dsgnOptions['ipcmp_txt_clr']);?>">
					</td>
				 </tr>
				 <tr valign="top">
					<th><label for="web_clr">Website color</label></th>
					<td>
						<span>#</span><input type="text" name="web_clr" id="web_clr" class="colorpick"
							style="background-color: #<?php echo esc_attr($dsgnOptions['web_clr']);?>;" 
							value="<?php echo esc_attr($dsgnOptions['web_clr']);?>">
					</td>
					<td>
						<span>#</span><input type="text" name="wweb_clr" id="wweb_clr" class="colorpick"
							style="background-color: #<?php echo esc_attr($dsgnOptions['wweb_clr']);?>;" 
							value="<?php echo esc_attr($dsgnOptions['wweb_clr']);?>">
					</td>
					<td>
						<span>#</span><input type="text" name="ipweb_clr" id="ipweb_clr" class="colorpick"
							style="background-color: #<?php echo esc_attr($dsgnOptions['ipweb_clr']);?>;" 
							value="<?php echo esc_attr($dsgnOptions['ipweb_clr']);?>">
					</td>
				 </tr>
				 <tr valign="top">
					<th><label for="tetm_txt_clr">Testimonial Text color</label></th>
					<td>
						<span>#</span><input type="text" name="tetm_txt_clr" id="tetm_txt_clr" class="colorpick"
							style="background-color: #<?php echo esc_attr($dsgnOptions['tetm_txt_clr']);?>;" 
							value="<?php echo esc_attr($dsgnOptions['tetm_txt_clr']);?>">
					</td>
					<td>
						<span>#</span><input type="text" name="wtetm_txt_clr" id="wtetm_txt_clr" class="colorpick"
							style="background-color: #<?php echo esc_attr($dsgnOptions['wtetm_txt_clr']);?>;" 
							value="<?php echo esc_attr($dsgnOptions['wtetm_txt_clr']);?>">
					</td>
					<td>
						<span>#</span><input type="text" name="iptetm_txt_clr" id="iptetm_txt_clr" class="colorpick"
							style="background-color: #<?php echo esc_attr($dsgnOptions['iptetm_txt_clr']);?>;" 
							value="<?php echo esc_attr($dsgnOptions['iptetm_txt_clr']);?>">
					</td>
				 </tr>
			</table>
		</td>
	 </tr>
	 <tr>
          <td colspan="2"><input type="submit" name="edit" value="Save Changes" class="button"/><input type="hidden" name="isSave" value="1"/></td>          
        </tr>
	</table>
</form>

<?php  
  echo "</div>";
?>
