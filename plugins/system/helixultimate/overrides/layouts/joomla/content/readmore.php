<?php
/**
 * @package Helix Ultimate Framework
 * @author JoomShaper https://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2021 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
*/

defined ('JPATH_BASE') or die();

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;

$params    = $displayData['params'];
$item      = $displayData['item'];
$direction = Factory::getLanguage()->isRtl() ? 'left' : 'right';
?>

<div class="readmore" style = "display: flex !important;
  justify-content: center !important;
 margin-bottom: 30px !important;
    margin-top: -22px !important;">
	<?php if (!$params->get('access-view')) : ?>
		<a href="<?php echo $displayData['link']; ?>"  itemprop="url" aria-label="<?php echo Text::_('COM_CONTENT_REGISTER_TO_READ_MORE'); ?>
			<?php echo htmlspecialchars($item->title, ENT_QUOTES, 'UTF-8'); ?>">
			<?php echo Text::_('COM_CONTENT_REGISTER_TO_READ_MORE'); ?>
		</a>
	<?php elseif ($readmore = $item->alternative_readmore) : ?>
		<a  href="<?php echo $displayData['link']; ?>"  itemprop="url" aria-label="<?php echo htmlspecialchars($item->title, ENT_QUOTES, 'UTF-8'); ?>">
			<?php echo $readmore; ?>
			<?php if ($params->get('show_readmore_title', 0) != 0) : ?>
				<?php echo HTMLHelper::_('string.truncate', $item->title, $params->get('readmore_limit')); ?>
			<?php endif; ?>
		</a>
	<?php elseif ($params->get('show_readmore_title', 0) == 0) : ?>
		<a href="<?php echo $displayData['link']; ?>" style = "background-color: #acb7c1 !important;
    background-image: none !important;
    box-shadow: none !important;
    border-radius: 4px !important;
    color: #fff !important;
    display: inline-block !important;
    padding: 10px 15px !important;
    text-decoration: none !important;
    text-shadow: none !important;
    transition: background-color 0.3s !important;" itemprop="url" aria-label="<?php echo Text::_('COM_CONTENT_READ_MORE'); ?> <?php echo htmlspecialchars($item->title, ENT_QUOTES, 'UTF-8'); ?>">
			<?php echo JVERSION < 4 ? Text::sprintf('COM_CONTENT_READ_MORE_TITLE') : Text::_('JGLOBAL_READ_MORE'); ?>
		</a>
	<?php else : ?>
		<a href="<?php echo $displayData['link']; ?>" itemprop="url" aria-label="<?php echo Text::_('COM_CONTENT_READ_MORE'); ?> <?php echo htmlspecialchars($item->title, ENT_QUOTES, 'UTF-8'); ?>">
			<?php echo Text::_('COM_CONTENT_READ_MORE'); ?>
			<?php echo HTMLHelper::_('string.truncate', $item->title, $params->get('readmore_limit')); ?>
		</a>
	<?php endif; ?>
</div>
