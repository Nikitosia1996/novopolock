<style>

    #tchsp .buttons {
        color :green;
    }

</style>

<?php
/**
 * Tiny Carousel
 *
 * @package 	Tiny Carousel
 * @subpackage 	mod_tiny_carousel
 * @version   	4.0
 * @author    	Gopi Ramasamy
 * @copyright 	Copyright (C) 2010 - 2021 www.gopiplus.com. All rights reserved.
 * @license   	GNU General Public License version 2 or later; see LICENSE.txt
 *
 * http://www.gopiplus.com/extensions/2014/06/tiny-carousel-slider-joomla-module/
 */

defined('_JEXEC') or die;

if ( ! empty($images) ) 
{
	$tinyc_width 		= (int) $params->get('tinyc_width', 100);
	$tinyc_height 		= (int) $params->get('tinyc_height', 75);
	$tinyc_autointerval = $params->get('tinyc_autointerval', 'true');
	$tinyc_intervaltime = (int) $params->get('tinyc_intervaltime', 1500);
	$tinyc_animation 	= (int) $params->get('tinyc_animation', 1000);
	$tinyc_random 		= $params->get('tinyc_random', 'NO');
	$tinyc_arrowcolor 	= $params->get('tinyc_arrowcolor');
	
	if($tinyc_random == "YES")
	{
		shuffle($images);
	}
			
	$TinycImg = "";
	foreach ( $images as $images ) 
	{	
		$tinyc_path = JURI::base().$folder ."/". $images->name;
		$tinyc_path = str_replace('\\', '/', $tinyc_path);	
		$TinycImg 	= $TinycImg ."<li><img src='".$tinyc_path ."' alt='' /></li>";
	}
	
	$tinyc_width1 = $tinyc_width + 4;
	$tinyc_height1 = $tinyc_height + 4;
	
?>
<script type="text/javascript">var $j = jQuery.noConflict();</script>
<style type='text/css' media='screen'>
#tchsp { height: 100%; margin: 30px 0 0; overflow:hidden; position: relative; padding: 0 50px 10px;   }
#tchsp .viewport { height: <?php echo $tinyc_height1; ?>px; overflow: hidden; position: relative; }
#tchsp .buttons { background: <?php echo $tinyc_arrowcolor; ?>; border-radius: 35px; display: block; position: absolute;
top: 20%; left: 0; width: 35px; height: 35px; color: #fff; font-weight: bold; text-align: center; line-height: 35px; text-decoration: none;
font-size: 22px; }
#tchsp .next { right: 0; left: auto;top: 20%; }
#tchsp .buttons:hover{ color: #C01313;background: #fff; }
#tchsp .disable { visibility: hidden; }
#tchsp .overview { list-style: none; position: absolute; padding: 0; margin: 0; width: <?php echo $tinyc_width1; ?>px; left: 0 top: 0; }
#tchsp .overview li{ float: left; margin: 0 20px 0 0; padding: 1px; height: <?php echo $tinyc_height; ?>px; border: 0px solid #dcdcdc; width: <?php echo $tinyc_width; ?>px;}
</style>
<div id="tchsp">
	<a class="buttons prev" href="#">&#60;</a>
		<div class="viewport">
			<ul class="overview">
				<?php echo $TinycImg; ?>
			</ul>
		</div>
	<a class="buttons next" href="#">&#62;</a>
</div>
<script type="text/javascript">
jQuery(document).ready(function(){
jQuery('#tchsp').tinycarousel({ 
buttons: true, 
interval: "<?php echo $tinyc_autointerval; ?>", 
intervalTime: "<?php echo $tinyc_intervaltime; ?>", 
animationTime: "<?php echo $tinyc_animation; ?>" 
});
});
</script>
<?php
}