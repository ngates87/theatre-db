<?php 
    require_once($_SERVER["DOCUMENT_ROOT"] .'/Includes/3rdPartyLibs/smarty/Smarty.class.php');
    $smarty = new Smarty();
    $smarty->assign("title", "MASC - Links");
    $smarty->display("templates/links.tpl");
?>
