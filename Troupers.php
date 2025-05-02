<?php
include_once($_SERVER["DOCUMENT_ROOT"] . "/Includes/Database/DAO/Troupers.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/Includes/Database/VO/Trouper.php");
require_once($_SERVER["DOCUMENT_ROOT"] .'/Includes/3rdPartyLibs/smarty/Smarty.class.php');

$smarty = new Smarty();
$smarty->assign("title", "MASC - Troupers");

$daoTroupers = new Troupers();
$aoTroupers = $daoTroupers->GetTroupers();

$smarty->assign("troupers", $aoTroupers);
$smarty->display("templates/troupers.html");

?>
    