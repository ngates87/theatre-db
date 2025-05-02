<?php

//include_once("CodeBehind/SessionHandler.php");
include_once ("CodeBehind/AccountSettingsPage.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/Includes/Database/DAO/Admins.php");

require_once($_SERVER["DOCUMENT_ROOT"] .'/Includes/3rdPartyLibs/smarty/TCMSAdminSmarty.php');
$smarty = new TCMSAdminSmarty();
$smarty->assign("title", "MASC Admin - Account Settings");
$smarty->assign("firstName", $_SESSION["CurrentUser"]->FirstName);
$smarty->assign("lastName", $_SESSION["CurrentUser"]->LastName);
$smarty->assign("email", $_SESSION["CurrentUser"]->Email);

$smarty->display("templates/accountSettings.tpl");
?>
