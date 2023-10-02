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

use Joomla\CMS\Helper\ModuleHelper;
use Joomla\Module\TinyCarousel\Site\Helper\TinyCarouselHelper;

$folder		= TinyCarouselHelper::getFolder($params);
$images		= TinyCarouselHelper::getImages($params, $folder);

if (!count($images)) 
{
	echo \JText::_('No Images <br>' . $folder . '<br>');
	return;
}

$modbase 	= JURI::base(true).'/modules/mod_tiny_carousel/';
$document 	= JFactory::getDocument();
$tinyc_jquery = $params->get("tinyc_jquery","YES");	
if($tinyc_jquery == "YES")	
{
	JHtml::_('jquery.framework');
}
$document->addScript ($modbase.'js/jquery.tinycarousel.js');

require ModuleHelper::getLayoutPath('mod_tiny_carousel', $params->get('layout', 'default'));