<?php 
    require_once($_SERVER["DOCUMENT_ROOT"] .'/Includes/3rdPartyLibs/smarty/Smarty.class.php');
    $smarty = new Smarty();
    $smarty->assign("title", "MASC - Rentals");
    $smarty->display("templates/rentals.html");
?>