<?php
/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2020 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/

//no direct accees
defined ('_JEXEC') or die ('restricted access');

$user = JFactory::getUser();
$input 	= JFactory::getApplication()->input;
$view 	= $input->get('view', NULL, 'STRING');
$option = $input->get('option', NULL, 'STRING');
$layout = $input->get('layout', NULL, 'STRING');

if ($user->authorise('core.manage', 'com_sppagebuilder')) { ?>

<ul id="sp-pagebuiler-menu" class="nav <?php echo ($layout == 'edit') ? 'disabled': ''; ?>">
	<li class="dropdown <?php echo ($option == 'com_sppagebuilder' && $layout != 'edit') ? 'active': ''; ?> <?php echo ($layout == 'edit') ? 'disabled': ''; ?> ">

	<?php if($layout == 'edit') : ?>
		<a class="no-dropdown">
			<?php echo JText::_('MOD_MENU_COM_SPPAGEBUILDER');?>
		</a>
	<?php else : ?>
		<a class="dropdown-toggle" data-toggle="dropdown" href="#">
			<?php echo JText::_('MOD_MENU_COM_SPPAGEBUILDER');?> <span class="caret"></span>
		</a>
		<ul aria-labelledby="dropdownMenu" role="menu" class="dropdown-menu">
			<li <?php echo ($option == 'com_sppagebuilder' && $view == 'page') ? 'class="active"': '';?>>
				<a href="<?php echo JRoute::_('index.php?option=com_sppagebuilder&task=page.add'); ?>">
					<?php echo JText::_('MOD_MENU_COM_SPPAGEBUILDER_ADD_PAGE');?>
				</a>
			</li>
			
			<li <?php echo ($option == 'com_sppagebuilder' && ($view == '' || $view == 'pages') ) ? 'class="active"': '';?>>
				<a href="<?php echo JRoute::_('index.php?option=com_sppagebuilder'); ?>">
					<?php echo JText::_('MOD_MENU_COM_SPPAGEBUILDER_PAGES');?>
				</a>
			</li>

			<li <?php echo ($option == 'com_sppagebuilder' && $view == 'media' ) ? 'class="active"': '';?>>
				<a href="<?php echo JRoute::_('index.php?option=com_sppagebuilder&view=media'); ?>">
					<?php echo JText::_('MOD_MENU_COM_SPPAGEBUILDER_MEDIA');?>
				</a>
			</li>

			<li <?php echo ($option == 'com_sppagebuilder' && $view == 'categories' ) ? 'class="active"': '';?>>
				<a href="<?php echo JRoute::_('index.php?option=com_categories&extension=com_sppagebuilder'); ?>">
					<?php echo JText::_('MOD_MENU_COM_SPPAGEBUILDER_CATEGORIES');?>
				</a>
			</li>

			<li <?php echo ($option == 'com_sppagebuilder' && $view == 'integrations') ? 'class="active"': '';?>>
				<a href="<?php echo JRoute::_('index.php?option=com_sppagebuilder&view=integrations'); ?>">
					<?php echo JText::_('MOD_MENU_COM_SPPAGEBUILDER_INTEGRATIONS');?>
				</a>
			</li>

			<li <?php echo ($option == 'com_sppagebuilder' && $view == 'languages') ? 'class="active"': '';?>>
				<a href="<?php echo JRoute::_('index.php?option=com_sppagebuilder&view=languages'); ?>">
					<?php echo JText::_('MOD_MENU_COM_SPPAGEBUILDER_LANGUAGES');?>
				</a>
			</li>
			
			<li <?php echo ($option == 'com_sppagebuilder' && $view == 'maintenance') ? 'class="active"': '';?>>
				<a href="<?php echo JRoute::_('index.php?option=com_sppagebuilder&view=maintenance'); ?>">
					<?php echo JText::_('MOD_MENU_COM_SPPAGEBUILDER_MAINTENANCE');?>
				</a>
			</li>

			<li <?php echo ($option == 'com_sppagebuilder' && $view == 'about') ? 'class="active"': '';?>>
				<a href="<?php echo JRoute::_('index.php?option=com_sppagebuilder&view=about'); ?>">
					<?php echo JText::_('MOD_MENU_COM_SPPAGEBUILDER_ABOUT');?>
				</a>
			</li>

			<li>
				<a href="<?php echo JRoute::_('https://www.joomshaper.com/documentation/sp-page-builder/sp-page-builder-3'); ?>" target="_blank">
					<?php echo JText::_('MOD_MENU_COM_SPPAGEBUILDER_DOC');?>
				</a>
			</li>
		</ul>
	<?php endif; ?>
	</li>
</ul>

<?php
}
