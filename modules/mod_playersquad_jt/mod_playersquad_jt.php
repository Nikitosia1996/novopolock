<?php
/**
* @autor        JoomlaTema
* @title		Player Squad JT Module
* @website		https://www.joomlatema.net
* @copyright	Copyright (C) 2008 -2021 JoomlaTema.net. All rights reserved.
* @license		http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
**/

// no direct access
defined('_JEXEC') or die;

$document = JFactory::getDocument();
$document->addStyleSheet(JURI::base() . 'modules/mod_playersquad_jt/css/style.css"  media="screen');

?>
<?php
  require(JModuleHelper::getLayoutPath('mod_playersquad_jt', $params->get( 'layout', 'horizontal' )))
  ;?>
