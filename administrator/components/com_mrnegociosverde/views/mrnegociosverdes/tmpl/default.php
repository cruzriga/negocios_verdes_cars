<?php
use Joomla\CMS\Uri\Uri;
$uri = Uri::getInstance();
JToolBarHelper::title("Mr Negocios Verdes")
?>
<div id="app-mr-negocios-verdes">
    <script>
        const  base_url  = '<?=JURI::base()?>';
        const  root_url  = '<?=$uri->root();?>';
    </script>

    <link href="<?=JURI::base()?>components/com_mrnegociosverde/css/admin.css" rel="stylesheet">
    <div id="appadmin"></div>
    <script src="<?=JURI::base()?>components/com_mrnegociosverde/js/admin.js?v=1.?v=2.<?= time()?>"></script>
</div>
<style>
    .subhead-collapse{
        display: none;
    }
</style>