<?php
require_once($_SERVER["DOCUMENT_ROOT"] .'/Includes/3rdPartyLibs/smarty/Smarty.class.php');
include_once("CodeBehind/SessionHandler.php");

try
{
    session_unset($_SESSION["CurrentUser"]);
    session_destroy();
}
catch(Exception $e)
{
}

$smarty = new Smarty();
//$smarty->testInstall();
$smarty->assign("title","MASC Admin - Logged Out!");
$smarty->display("templates/logout.tpl");

?>