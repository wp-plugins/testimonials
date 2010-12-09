<?php
	class Testimonials extends WP_Widget {
		function Testimonials() {
			parent::WP_Widget(false, $name='Testimonials');
		}
		
		function widget($args, $instance){
			global $wpdb;
			extract($args, EXTR_SKIP);
			$table_name = $wpdb->prefix . "testimonials";
		    $testimonials = $wpdb->get_results("SELECT * FROM $table_name WHERE 1 AND status='publish' ORDER BY add_dt DESC 
												LIMIT 0, {$instance['Testimonials_num']}");
		  
			echo $before_widget;
		  	echo $before_title . $instance['Testimonials-title'] . $after_title;
			
			if($instance['jLib_rotate'] != '-1') {
				echo '<div id="'.$instance['jLib_rotate'].'" class="slideshow">';
				$param = 'speed=' . $instance['speed'] . '&timeout='. $instance['timeout'];
				update_option('param', $param);
			}
			
			if(is_array($testimonials)){
				$options = get_option('testimonials_tpl');
				foreach($testimonials as $t):
			    	$tpl = stripslashes($options['widget_tpl']);
					$html = str_replace('%author%', $t->author, $tpl);
					if($t->image == "avatar")
					  $html = str_replace('%image%', get_avatar($t->email, 48), $html);
					elseif(($t->image != "avatar") && ($t->image != "no_image") && ($t->image != ""))
						$html = str_replace('%image%', '<img src="'.get_option('home').'/wp-content/plugins/testimonials/avatar/'.$t->image.'">', $html);
					else
					  $html = str_replace('%image%', '', $html);
					  
					$html = str_replace('%company%', $t->company, $html);					
					$html = str_replace('%website%', $t->website, $html);
					if((strlen($t->testimonials) > $instance['Testimonials_word']) && ($instance['Testimonials_word'] > 0) 
						&& ( $instance['Testimonials_word'] !="")){
						$index = strrpos(substr(stripslashes($t->testimonials), 0, $instance['Testimonials_word']), ' ') ;
						$content = str_replace("\n",'<br/>', substr(stripslashes($t->testimonials), 0, $index)) .'...';
					}
					else
						$content = str_replace("\n",'<br/>', stripslashes($t->testimonials));
						
						
					if($instance['Testimonials_rdmore'] !="")
					  $content .=" <a href='". get_permalink(get_option('testimonial_page')) ."#testimonials-".$t->ID."'>" . $instance['Testimonials_rdmore'] . "</a>\n";
					  
					  $html = str_replace('%testimonials%', $content, $html);
					  
					$list .= $html;
				endforeach;
			}
			echo $list;
			if($instance['jLib_rotate'] != '-1') echo '</div>';
			echo $after_widget;
		}
		
		/**
		 * Form processing... Dead simple.
		 */
		function update($new_instance, $old_instance) {
			/**
			 * Save the thumbnail dimensions outside so we can
			 * register the sizes easily. We have to do this
			 * because the sizes must registered beforehand
			 * in order for WP to hard crop images (this in
			 * turn is because WP only hard crops on upload).
			 * The code inside the widget is executed only when
			 * the widget is shown so we register the sizes
			 * outside of the widget class.
			 */
			$instance = $old_instance;
			$instance['Testimonials-title'] = strip_tags($new_instance['Testimonials-title']);
			$instance['Testimonials_num'] = (int) strip_tags($new_instance['Testimonials_num']);
			$instance['Testimonials_word'] = (int) strip_tags($new_instance['Testimonials_word']);
			$instance['Testimonials_rdmore'] = stripslashes($new_instance['Testimonials_rdmore']);
			$instance['jLib_rotate'] = stripslashes($new_instance['jLib_rotate']);
			$instance['speed'] = stripslashes($new_instance['speed']);
			$instance['timeout'] = stripslashes($new_instance['timeout']);
			return $instance;

		}

		function form($instance){
			///print_r($instance);
		?>
      		<p>
				<label for="title">
					<?php _e( 'Title' ); ?>:
					<input class="widefat" id="<?php echo $this->get_field_id("Testimonials-title"); ?>" name="<?php echo $this->get_field_name("Testimonials-title"); ?>" type="text" value="<?php echo esc_attr($instance["Testimonials-title"]);?>" />
				</label>
			</p>
			<p>
				<label for="fpost_num">
					<?php _e('Number of Testimonials'); ?>:
					<input style="text-align: center;" id="<?php echo $this->get_field_id("Testimonials_num"); ?>" 
					name="<?php echo $this->get_field_name("Testimonials_num"); ?>" type="text" value="<?php echo esc_attr($instance["Testimonials_num"]);?>" size='3' />
				</label>
			</p>
			<p>
				<label for="fpost_num">
					<?php _e('Excerpt Length'); ?>:
					<input style="text-align: center;" id="<?php echo $this->get_field_id("Testimonials_word"); ?>" 
					name="<?php echo $this->get_field_name("Testimonials_word"); ?>" type="text" 
					value="<?php echo esc_attr($instance["Testimonials_word"]);?>" size='3' />
					<small>(0 or blank means: whole content will be display )</small>
				</label>
			</p>
			<p>
				<label for="fpost_num">
					<?php _e('Read More Link'); ?>:
					<input id="<?php echo $this->get_field_id("Testimonials_rdmore"); ?>" name="<?php echo $this->get_field_name("Testimonials_rdmore"); ?>" type="text" 
					value="<?php echo esc_attr($instance["Testimonials_rdmore"]);?>"  />
					<small>(blank means disable)</small>
				</label>
			</p>
			<p>
				<label for="jquery">
					<?php _e('Rotation Type'); ?>:
					<select id="<?php echo $this->get_field_id("jLib_rotate"); ?>" name="<?php echo $this->get_field_name("jLib_rotate"); ?>">
						<option value="-1"> Select one</option>
						<option value="scrollup" <?php if($instance['jLib_rotate']=="scrollup") echo "selected"; ?>>Scroll up</option>
					</select>
				</label>
			</p>
				<!--<div id="cycle">-->
					<p><label for="speed"><?php _e('Speed/Delay'); ?>: </label>
					<input type="text" name="<?php echo $this->get_field_name("speed"); ?>" id="<?php echo $this->get_field_id("speed"); ?>" 
						value="<?php echo esc_attr($instance["speed"]);?>" size="15"/></p>
					<p><label for="timeout"><?php _e('Timeout'); ?>: </label>
					<input type="text" name="<?php echo $this->get_field_name("timeout"); ?>" id="<?php echo $this->get_field_id("timeout"); ?>" 
						value="<?php echo esc_attr($instance["timeout"]);?>" /></p>
				<!--</div>-->
			<p>
				<small>Above tow fields are required when you select a rotation type.</small>
			</p>
			
  		<input type="hidden" id="Testimonials-submit" name="Testimonials-submit" value="1" />
<?php
		}
	}
	
	add_action( 'widgets_init', create_function('', 'return register_widget("Testimonials");') );
?>