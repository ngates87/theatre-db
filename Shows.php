<?php
include_once($_SERVER["DOCUMENT_ROOT"] . "/Includes/Database/DAO/Events.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/Includes/Database/VO/Event.php");
require_once($_SERVER["DOCUMENT_ROOT"] .'/Includes/3rdPartyLibs/smarty/Smarty.class.php');

$smarty = new Smarty();

$smarty->assign("title","MASC - Shows" );

$daoEvents = new Events();
$aoEvents = $daoEvents->GetAllEvents();

$smarty->assign("events", $aoEvents);
$smarty->display("templates/shows.html")

?>
    