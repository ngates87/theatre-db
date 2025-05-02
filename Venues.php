<?php
include_once($_SERVER["DOCUMENT_ROOT"] . "/Includes/Database/DAO/Venues.php");
require_once($_SERVER["DOCUMENT_ROOT"] .'/Includes/3rdPartyLibs/smarty/Smarty.class.php');
$smarty = new Smarty();
$smarty->assign("title","MASC - Venues");
$daoVenues = new Venues();
$aoVenues = $daoVenues->GetVenues();

$smarty->assign("venues", $aoVenues);

$smarty->display("templates/venues.tpl");
?>
    