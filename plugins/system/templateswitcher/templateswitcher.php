<?php
/**
 * @copyright	Copyleft (C) 2014 Ilhom666, Inc. All rights reserved.
 * @license		GNU General Public License version 3 or later; see LICENSE.txt
*/

// no direct access
defined( '_JEXEC' ) or die;

class plgSystemTemplateSwitcher extends JPlugin
	{
		function onAfterInitialise()
			{
				$input = JFactory::getApplication()->input;
				$session = JFactory::getSession();
				$template = $input->getCmd( 'template', '' );
				if ( $template !== '' ) {
				$session->set( 'templateChanged', $template );
				}
				if ( $session->get( 'templateChanged', '' )!== '' ) {
				$input->set( 'template', $session->get( 'templateChanged', '' ) );
				}
			}
	}



?>