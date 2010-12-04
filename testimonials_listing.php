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
  
  require_once("class_pagination.php");
  global $wpdb;
  if(!empty($_GET['p']))
  	  $page = $_GET['p'];
  elseif($_POST['p'] !="")
  	  $page = $_POST['p'];
  else
  	  $page = 1;
  $table_name = $wpdb->prefix . "testimonials";
  
  if($_POST['isSave'] == '1'){
    $query= "UPDATE {$table_name} SET 
            `image` = '{$_POST['image']}',
            `author` = '{$wpdb->escape(strip_tags(stripslashes($_POST['author'])))}',
            `email` = '{$wpdb->escape(strip_tags(stripslashes($_POST['email'])))}',
      			`company` = '{$wpdb->escape(strip_tags(stripslashes($_POST['company'])))}',
      			`website` = '{$wpdb->escape(strip_tags(stripslashes($_POST['website'])))}',
      			`testimonials` = '{$wpdb->escape(stripslashes($_POST['testimonials']))}', 
            `status` = '{$_POST['status']}'
            WHERE ID='{$_POST['post_id']}' ";
    $wpdb->query($query);
    echo '<div id="message" class="updated fade"><p>Testimonal-#'.$_POST['post_id'].' updated successfully.</p></div>';
  }
  
  if(isset($_GET['d']) && ($_GET['d']=="yes")){    
      $delPost = "DELETE FROM {$table_name} WHERE ID='{$_GET['post']}'";
      $wpdb->query($delPost);
      echo '<div id="message" class="updated fade"><p>Post-#'.$_GET['post'].' deleted successfully.</p></div>';    
  }
    $ttlRec = $wpdb->get_row("SELECT COUNT(*) TOTAL FROM $table_name", OBJECT);
    $pagination = new Pagination(admin_url() . 'admin.php?page=testimonials_listing.php', $ttlRec->TOTAL, PAGE_LIMIT, $page);
	$offset = $pagination->getOffset();
    $testimonials = $wpdb->get_results("SELECT * FROM $table_name ORDER BY add_dt DESC LIMIT {$offset}, " .PAGE_LIMIT);
   	  
  echo '<div class="wrap">
        <h2>'.__('Testimonials', 'testimonials').'</h2>' ."\n";
  echo "<hr color='#DEDEDE' size='2'/>";
?>
  <table cellspacing="0" class="widefat fixed" border="1">
		<thead>
			<tr>
				<th class="manage-column" width="3%">ID#</th>
				<th class="manage-column" width="25%">Author</th>
				<th class="manage-column">Testimonials</th>
			</tr>
		</thead>
		<?php if(is_array($testimonials)):
            echo "<tbody>";
            $odd = true;
            foreach($testimonials as $testimonial):
              $class=($odd) ? "alternate":"";
              //Avatar 
              if($testimonial->image == "avatar")
                $avatar = "<div style='float: left; padding: 5px;position: relative;'>".get_avatar($testimonial->email, 48) . "</div>";
              else
			  	$avatar = "";
              echo "<tr class={$class}>\n".
                   "\t<td>{$testimonial->ID}</td>\n".
                   "\t<td>{$avatar}<b>{$testimonial->author}</b><br/>{$testimonial->company}<br/><a href='{$testimonial->website}' target='_blank'>{$testimonial->website}</a>
                    <div class=\"row-actions\">
                    <span class='edit'><a href=\"".admin_url()."admin.php?page=add_edit_testimonials.php&post={$testimonial->ID}&p={$page}&action=edit\" title=\"Edit this testimonial\">Edit</a> | </span>
                    <span class='trash'><a class='submitdelete' title='Delete this testimonial' href='".admin_url()."admin.php?page=testimonials_listing.php&post={$testimonial->ID}&d=yes&p={$page}'>Delete</a></span></div></td>\n".
                   "\t<td>".str_replace("\n", '<br/>', $testimonial->testimonials)."</td>\n".
                   "</tr>";
              $odd = !$odd;
            endforeach;
            echo "</tbody>";
          endif;
    ?>
    <tfoot>
      <tr>
				<th class="manage-column" width="3%">ID#</th>
				<th class="manage-column" width="15%">Author</th>
				<th class="manage-column">Testimonials</th>
			</tr>
    </tfoot>
	</table>
	
	<?php echo $pagination->getPagination(); ?>
<?php echo "</div>"; ?>
