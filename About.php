<?php

require_once($_SERVER["DOCUMENT_ROOT"] .'/Includes/3rdPartyLibs/smarty/Smarty.class.php');
//require_once('Smarty.class.php');
$smarty = new Smarty();
$smarty->display("templates/about.html")
?>