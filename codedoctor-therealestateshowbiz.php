<?php
/**
 * Plugin Name: CodeDoctor TheRealEstateShowBiz
 * Plugin URI: http://URI_Of_Page_Describing_Plugin_and_Updates
 * Description: Private plugin
 * Version: 1.0
 * Author: Martin Wawrusch
 * Author URI: http://URI_Of_The_Plugin_Author
 * License: GPL2
 */

/*  Copyright 2013  Martin Wawrusch  (email : martin@wawrusch.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

/* **********************************************************
 * RESOURCE Shortcode
 * **********************************************************/
function theme_resource_shortcode( $params, $content = null) {
  extract( shortcode_atts( array(
    'title' => '',
    'description' => '',
    'phone' => '',
    'phone2' => '',
    'email' => '',
    'homepage' => '',
    'subtitle' => '',
    'address' => '',
    ), $params ) );
  
  $result = '';
  $result .= '<h4 class="resource">'.$title.'</h4>';
  $result .= '<ul class="resource">';


  if(strlen($subtitle) > 0) {
    $result .= '<li>'.$subtitle.'</li>';
  }
  if(strlen($address) > 0) {
    $result .= '<li>'.$address.'</li>';
  }
  if(strlen($phone) > 0) {
    $result .= '<li>'.$phone.'</li>';
  }
  if(strlen($phone2) > 0) {
    $result .= '<li>'.$phone2.'</li>';
  }
  if(strlen($email) > 0) {
    $result .= '<li><a href="mailto:'.$email.'">'.$email.'</a></li>';
  }
  if(strlen($homepage) > 0) {
    $result .= '<li><a href="http://'.$homepage.'">'.$homepage.'</a></li>';
  }
  if(strlen($description) > 0) {
    $result .= '<li>'.$description.'</li>';
  }
  
  $result .= '</ul>';
  return $result;

}

// WIDGETS


/**
 * Creates widget with list of towns
 */
class TownList_Widget extends WP_Widget {
  /**
   * Widget constructor 
     *
   * @desc sets default options and controls for widget
   */
  function TownList_Widget () {
    /* Widget settings */
    $widget_ops = array (
      'classname' => 'widget_townlist',
      'description' => __( 'List of Towns' )     
    );

    /* Create the widget */
    $this->WP_Widget( 'townlist-widget', __( 'List of Towns' ), $widget_ops );
  }
  
  /**
   * Displaying the widget
   *
   * Handle the display of the widget
   * @param array
   * @param array
   */
  function widget( $args, $instance ) {
      
    global $post;
    $children=wp_list_pages( 'echo=0&child_of=' . $post->ID . '&title_li=' );
    if ($children) {
      $parent = $post->ID;
    }else{
      $parent = $post->post_parent;
      if(!$parent){
        $parent = $post->ID;
      }
    }
    $parent_title = get_the_title($parent);
    
    extract( $args );
    $title = apply_filters('widget_title', empty($instance['title']) ? $parent_title : do_shortcode($instance['title']), $instance, $this->id_base);
        
      echo $before_widget;
      if ( $title)
        echo $before_title . $title . $after_title;
    ?>
<div class="footer-town-list">
<ul class="list-left">
  <li><a href="/towns/ardsley">Ardsley</a></li>
  <li><a href="/towns/armonk">Armonk</a></li>
  <li><a href="/towns/bedford">Bedford</a></li>
  <li><a href="/towns/briarcliff">Briarcliff Manor</a></li>
  <li><a href="/towns/bronxville">Bronxville</a></li>
  <li><a href="/towns/chappaqua">Chappaqua</a></li>
  <li><a href="/towns/cold-spring">Cold Spring</a></li>
  <li><a href="/towns/cortlandt-manor">Cortlandt Manor</a></li>
  <li><a href="/towns/croton-on-hudson">Croton-on-Hudson</a></li>
  <li><a href="/towns/dobbs-ferry">Dobbs Ferry</a></li>
  <li><a href="/towns/garrison">Garrison</a></li>
  <li><a href="/towns/hastings-on-hudson">Hastings-on-Hudson</a></li>
  <li><a href="/towns/irvington">Irvington</a></li>
  <li><a href="/towns/katonah">Katonah</a></li>
  <li><a href="/towns/larchmont">Larchmont</a></li>
  <li><a href="/towns/mamaroneck">Mamaroneck</a></li>
  <li><a href="/towns/mt-kisco">Mt. Kisco</a></li>
</ul>
<ul class="list-right">
  <li><a href="/towns/new-rochelle">New Rochelle</a></li>
  <li><a href="/towns/north-salem">North Salem</a></li>
  <li><a href="/towns/ossining">Ossining</a></li>
  <li><a href="/towns/peekskill">Peekskill</a></li>
  <li><a href="/towns/pelham">Pelham</a></li>
  <li><a href="/towns/pleasantville">Pleasantville</a></li>
  <li><a href="/towns/pocantico">Pocantico Hills</a></li>
  <li><a href="/towns/port-chester">Port Chester</a></li>
  <li><a href="/towns/pound-ridge">Pound Ridge</a></li>
  <li><a href="/towns/rye">Rye</a></li>
  <li><a href="/towns/rye-brook">Rye Brook</a></li>
  <li><a href="/towns/rye-neck">Rye Neck</a></li>
  <li><a href="/towns/scarsdale">Scarsdale</a></li>
  <li><a href="/towns/sleepy-hollow">Sleepy Hollow</a></li>
  <li><a href="/towns/somers">Somers</a></li>
  <li><a href="/towns/tarrytown">Tarrytown</a></li>
  <li><a href="/towns/teatown">Teatown</a></li>
  <li><a href="/towns/yorktown">Yorktown</a></li>
</ul>
<div class="clear clearfix"></div>
<p class="summary">
</Br>
</p>

</div>
    <?php
      echo $after_widget;
    
  }
  
  /**
   * Update and save widget
   *
   * @param array $new_instance
   * @param array $old_instance
   * @return array New widget values
   */
  function update ( $new_instance, $old_instance ) {  
    $old_instance['title'] = strip_tags( $new_instance['title'] );
        
    return $old_instance;
  }
  
  /**
   * Creates widget controls or settings
   *
   * @param array Return widget options form
   */
  function form ( $instance ) { ?>
    <p>
      <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php echo __( 'Title',"ait-theme" ); ?>:</label>
      <input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>"class="widefat" style="width:100%;" />
        </p>
              
        <?php
  }
}


/*************
*************/


/**
 * Creates widget with about jean
 */
class AboutJean_Widget extends WP_Widget {
  /**
   * Widget constructor 
     *
   * @desc sets default options and controls for widget
   */
  function AboutJean_Widget () {
    /* Widget settings */
    $widget_ops = array (
      'classname' => 'widget_aboutjean',
      'description' => __( 'About Jean' )     
    );

    /* Create the widget */
    $this->WP_Widget( 'aboutjean-widget', __( 'About Jean' ), $widget_ops );
  }
  
  /**
   * Displaying the widget
   *
   * Handle the display of the widget
   * @param array
   * @param array
   */
  function widget( $args, $instance ) {
      
    global $post;
    $children=wp_list_pages( 'echo=0&child_of=' . $post->ID . '&title_li=' );
    if ($children) {
      $parent = $post->ID;
    }else{
      $parent = $post->post_parent;
      if(!$parent){
        $parent = $post->ID;
      }
    }
    $parent_title = get_the_title($parent);
    
    extract( $args );
    $title = apply_filters('widget_title', empty($instance['title']) ? $parent_title : do_shortcode($instance['title']), $instance, $this->id_base);
        
      echo $before_widget;
      if ( $title)
        echo $before_title . $title . $after_title;
    ?>
<div class="footer-about-jean">
<p> <img class="thumb alignleft size-full wp-image-3542" title="Jean Cameron-Smith" src="/wp-content/jean-custom/other/JeanCameron.jpeg" alt="" width="180" height="120"> 
</p><p>
</Br>
</Br>
</Br>
</Br>
</Br>
</Br>
</Br>Seeing the jewel in the crown in every purchase and sale is the hallmark of Jean Cameron-Smith's career as a real estate broker. Believing the best gains are achieved through an expert, informed navigation of the buying and selling process, Jean uses her experience and unique knowledge of the area to provide her clients with optimal results. With the ability to access comprehensive luxury home archives, and armed with a myriad of top resources at her fingertips, Jean can lead you through a successful real estate transaction with ease.


</p><p>
This white-glove, 25-year comparative trademark service in sales, marketing and real estate has classified her as a highly sought-after realtor, marketer and real estate interpreter. Whether it is second nature to her or just an unwillingness to except anything less than stellar for her clients, Jean is serious about her clients' interests. She regularly provides complete historical, cultural and demographic information on the kinds of neighborhoods her clients are interested in, as well as providing quantitative analysis for both buyers and sellers, helping them make informed
purchasing decisions. This is all delivered in an approachable, encouraging manner, with an emphasis on personalized service each and every time.
</p>
<h4>Negotiate wisely. With Jean.</h4>
<p>
It's the home of your dreams, whether you are buying it, or selling it to another dreamer.
</p>
<h4>Current portfolio</h4>
<ul>
<li>Rates TOP 1% of Northern Westchester Realtor for deals closed & satisfied customers.</li>
<li>Awards:  Multiple listings service DIAMOND, PLATINUM, and GOLD awards.</li>
<li>Co-produced and co-hosted "The Real-Estate Show of Westchester" on cable television.</li>
</ul>
<p>
    
O: 914.238.2486 M: 914-645-7157 Click <a href="mailto:info@jeancameron-smith.om">here</a> to email Jean. </p>

<div class="clear clearfix"></div>

</div>
    <?php
      echo $after_widget;
    
  }
  
  /**
   * Update and save widget
   *
   * @param array $new_instance
   * @param array $old_instance
   * @return array New widget values
   */
  function update ( $new_instance, $old_instance ) {  
    $old_instance['title'] = strip_tags( $new_instance['title'] );
        
    return $old_instance;
  }
  
  /**
   * Creates widget controls or settings
   *
   * @param array Return widget options form
   */
  function form ( $instance ) { ?>
    <p>
      <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php echo __( 'Title',"ait-theme" ); ?>:</label>
      <input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>"class="widefat" style="width:100%;" />
        </p>
              
        <?php
  }
}

/**
Listing short code
**/

/* **********************************************************
 * LISTING Shortcode
 * **********************************************************/
function theme_listing_shortcode( $params, $content = null) {
  extract( shortcode_atts( array(
    'title' => '',
    'image' => '',
    'beds' => '',
    'sqft' => '',
    'link' => ''
    ), $params ) );
  
  $result = '<div class="home-listing">';
  $result .= '<h4 class="listing">'.$title.'</h4>';
  $result .= '<p class="image"><img src="'.$image.'" alt=""/></p>';

  $result .= '<ul class="listing">';
  $result .= '<li class="bed">'.$beds.'</li>';
  $result .= '<li class="sqft">'.$sqft.'</li>';
  $result .= '<li class="more-information"><a href="'.$link.'">More Information</a></li>';
  
  $result .= '</ul></div>';
  return $result;

}

/* **********************************************************
 * LISTING SOLD Shortcode
 * **********************************************************/
function theme_listing_sold_shortcode( $params, $content = null) {
  extract( shortcode_atts( array(
    'title' => '',
    'image' => '',
    'beds' => '',
    'sqft' => '',
    'link' => ''
    ), $params ) );
  
  $result = '<div class="home-listing">';
  $result .= '<h4 class="listing">'.$title.'</h4>';
  $result .= '<p class="image"><img src="'.$image.'" alt=""/></p>';

  $result .= '<ul class="listing">';
  $result .= '<li class="bed">'.$beds.'</li>';
  $result .= '<li class="sqft">'.$sqft.'</li>';
  
  $result .= '</ul></div>';
  return $result;

}


/* **********************************************************
 * LISTING SOLD Shortcode
 * **********************************************************/
function theme_listing_townbox_shortcode( $params, $content = null) {

  
  $result = "
<div class=\"listings-comment-header\">


<ul class=\"list-column-a\">
  <li><a href=\"/listings/#none\">Ardsley</a></li>
  <li><a href=\"/listings/#none\">Armonk</a></li>
  <li><a href=\"/listings/#none\">Bedford</a></li>
  <li><a href=\"/listings/#none\">Briarcliff Manor</a></li>
  <li><a href=\"/listings/#none\">Bronxville</a></li>

 <li><strong><a href=\"/listings/#chappaqua\">Chappaqua</a></strong></li>

  <li><strong><a href=\"/listings/#cold-spring\">Cold Spring</a></strong></li>
</ul>
<ul class=\"list-column-b\">
  <li><a href=\"/listings/#none\">Cortlandt Manor</a></li>
  <li><strong><a href=\"/listings/#croton-on-hudson\">Croton-on-Hudson</a></strong></li>
  <li><a href=\"/listings/#none\">Dobbs Ferry</a></li>

 <li><strong><a href=\"/listings/#garrison\">Garrison</a></strong></li>

 


  <li><a href=\"/listings/#none\">Hastings-on-Hudson</a></li>
  <li><a href=\"/listings/#none\">Irvington</a></li>
</ul>
<ul class=\"list-column-c\">
  <li><a href=\"/listings/#none\">Katonah</a></li>
  <li><a href=\"/listings/#none\">Larchmont</a></li>
  <li><a href=\"/listings/#none\">Mamaronek</a></li>
  <li><strong><a href=\"/listings/#mt-kisco\">Mt. Kisco</a></strong></li>
  <li><a href=\"/listings/#none\">New Rochelle</a></li>
  <li><a href=\"/listings/#none\">North Salem</a></li>
 </ul>
<ul class=\"list-column-d\">
  <li><strong><a href=\"/listings/#ossining\">Ossining</a></strong></li>
  <li><a href=\"/listings/#none\">Peekskill</a></li>
  <li><a href=\"/listings/#none\">Pelham</a></li>
  <li><strong><a href=\"/listings/#pleasantville\">Pleasantville</a></strong></li>
  <li><a href=\"/listings/#none\">Pocantico Hills</a></li>
  <li><a href=\"/listings/#none\">Port Chester</a></li>
 </ul>
<ul class=\"list-column-e\">
 <li><a href=\"/listings/#none\">Pound Ridge</a></li>
  <li><a href=\"/listings/#none\">Rye</a></li>
  <li><a href=\"/listings/#none\">Rye Brook</a></li>
  <li><a href=\"/listings/#none\">Rye Neck</a></li>
  <li><a href=\"/listings/#none\">Scarsdale</a></li>
  <li><a href=\"/listings/#none\">Sleepy Hollow</a></li>
  <li><strong><a href=\"/listings/#south salem\">South Salem</a></strong></li>
</ul>

<ul class=\"list-column-f\">


  <li><a href=\"/listings/#none\">Somers</a></li>
  <li><a href=\"/listings/#none\">Tarrytown</a></li>
  <li><a href=\"/listings/#none\">Yorktown</a></li>
</Br>
  <li class=\"jean\">Jean was a real estate 
columnist for the Patent 
Trader and Provided
Real Estate Tips on radio
station WLNA 1420AM
</li>
</ul>

<div class=\"clearfix clear\"></div>
  </div>

  ";

  return $result;

}

function theme_listing_active_shortcode( $params, $content = null) {

  
  $result = "
<h3 style=\"margin-top:60px\">More Listings</h3>
[one_fourth]
[listing title=\"Hudson River Views -Garrison- $699,000 PENDING\" beds=\"3 Bdrms 2 Full Bth \" sqft=\"1,175 Sq Ft\" link=\"/listings/hudson-river-views//\" image=\"/wp-content/uploads/2013/07/559rt9d-thumb.jpg\"]
[/one_fourth]
[one_fourth]
[listing title=\"Hudson River Views and Dream Lifestyle - Croton on Hudson- $1,299,000\" beds=\"4 Bdrms 4 Full Bth 1 Partial \" sqft=\"4,462 Sq Ft\" link=\"/listings//hudson-river-views-dream-lifestyle/\" image=\"/wp-content/uploads/2013/07/1212albanypost-thumb.jpg\"]
[/one_fourth]
[one_fourth]
[listing title=\"The Columns - Chappaqua -$2,795,000\" beds=\"9 Bdrms 6 Full Bth 2 Partial\" sqft=\"7,223 Sq Ft\" link=\"/listings/The-Columns/\" image=\"/wp-content/uploads/2013/06/780King-springThumb.jpg\"]
[/one_fourth]
[one_fourth_last]
[listing title=\"Open Floor Plan - Croton on Hudson -$649,000 \" beds=\"4 Bdrms 3 Full Bth\" sqft=\"2,233 Sq Ft\" link=\"/listings/open-floor-plan/\" image=\"/wp-content/uploads/2013/04/123NOldPost-Croton-thumb1.jpg\"]
[/one_fourth_last]

[one_fourth]
[listing title=\"Deal of the Century -Ossining - $489,000 PENDING\" beds=\"3 Bdrms 2 Full Bth\" sqft=\" 2,658 Sq Ft\" link=\"/listings/deal-of-the-century/\" image=\"/wp-content/uploads/2013/06/459Illingtonthumb.jpg\"]
[/one_fourth]

[one_fourth]
[listing title=\"Artfully expanded- $565,000 Ossining\" beds=\"3 Bdrms 3 Bth\" sqft=\"2,645 Sq Ft\" link=\"/listings/charming-farmhouse-has-been-artfully-expanded-over-the-years\" image=\"/wp-content/jean-custom/properties/Ossining-beautiful-houses-farmhouse-th.jpg\"]
[/one_fourth]

[one_fourth_last]
[listing title=\"On the Pond - Ossining - $685,000\" beds=\"3 Bdrms 2 Full Bth 1 partial\" sqft=\" 2,233 Sq Ft\" link=\"/listings/on-the-pond/\" image=\"/wp-content/uploads/2013/06/1364SpringValleythumb.jpg\"]
[/one_fourth_last]

  ";

  return do_shortcode($result);

}


add_action('init', 'register_shortcodes');
function register_shortcodes() {
  add_shortcode( 'listing', 'theme_listing_shortcode' );
  add_shortcode( 'listing_sold', 'theme_listing_sold_shortcode' );

  add_shortcode('listing_townbox','theme_listing_townbox_shortcode');
  add_shortcode( 'listing_active', 'theme_listing_active_shortcode' );
  add_shortcode( 'resource', 'theme_resource_shortcode' );

}

add_action('widgets_init', 'register_states_widget');
function register_states_widget() {
  register_widget( 'TownList_Widget' );
  register_widget( 'AboutJean_Widget' );
}

?>
