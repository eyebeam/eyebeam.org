<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package eyebeam2018
 */

if (is_post_type_archive('stopwork')){ 
    ?> <div id="secondary" class="widget-area" role="complementary">
		<?php dynamic_sidebar( 'stopworks-sidebar' ); ?>
	</div><!-- #secondary --> 
	<?php 
}else{ ?>
<div id="secondary" class="widget-area" role="complementary">
	<?php dynamic_sidebar( 'sidebar-1' );  } ?>
</div><!-- #secondary -->
    