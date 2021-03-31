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
use Joomla\CMS\Uri\Uri;
$uri = Uri::getInstance();
?>
<div style="min-height: calc(100vh - 172px);">
    <script>
        const  base_url  = '<?=JURI::base()?>';
        const  root_url  = '<?=$uri->root();?>';
    </script>
    <link href="<?=JURI::base()?>components/com_mrnegociosverde/views/mrnegociosverde/tmpl/css/site.css" rel="stylesheet">
    <div id="appsite"></div>
    <script src="<?=JURI::base()?>components/com_mrnegociosverde/views/mrnegociosverde/tmpl/js/site.js?v=2.<?= time()?>"></script>
</div>


