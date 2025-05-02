<?php

include_once($_SERVER["DOCUMENT_ROOT"] . "/Includes/Objects/ApplicationHelper.php");

if (ApplicationHelper::IsDevelopmentServer())
{
    error_reporting(E_ALL);
    ini_set('display_errors', 'On');
}

include_once ($_SERVER["DOCUMENT_ROOT"] . "/Includes/Database/DAO/Admins.php");
$GLOBALS["GroupLevel"] = null;

ini_set("session.cookie_lifetime", "10800");
session_start();
if (isset($_SESSION["CurrentUser"]))
{
    $GLOBALS["GroupLevel"] = $_SESSION["CurrentUser"]->GroupLevel;
}
else
{
    Header("Location: /Admin/index.php");
}
?>
