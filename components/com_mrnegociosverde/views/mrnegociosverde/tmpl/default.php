<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_helloworld
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
 
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
?>
<div>
    <h1><?php echo $this->msg; ?></h1>
    <link href="<?=JURI::base()?>components/com_MrNegociosVerde/views/MrNegociosVerde/tmpl/css/site.css" rel="stylesheet">
    <div id="appsite"></div>
    <script src="<?=JURI::base()?>components/com_MrNegociosVerde/views/MrNegociosVerde/tmpl/js/site.js"></script>
</div>