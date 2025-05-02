<!DOCTYPE HTML>
<?php
//include_once ($_SERVER["DOCUMENT_ROOT"] . "/Includes/Database/DAO/TheatreCMSDBHelper.php");
include_once ($_SERVER["DOCUMENT_ROOT"] . "/Includes/Database/DAO/Companies.php");
require_once($_SERVER["DOCUMENT_ROOT"] .'/Includes/3rdPartyLibs/smarty/Smarty.class.php');
include_once ($_SERVER["DOCUMENT_ROOT"] . "/Includes/Database/VO/Admin.php");
require_once($_SERVER["DOCUMENT_ROOT"] .'/Includes/3rdPartyLibs/smarty/TCMSAdminSmarty.php');
$smarty = new TCMSAdminSmarty();
include_once("CodeBehind/SessionHandler.php");

if (isset($_POST["inCompanyName"]))
{
    $name = $_POST["inCompanyName"];
    $shortName = $_POST["inCompanyShortName"];
    $address = $_POST["inCompanyAddress"];
    $city = $_POST["inCompanyCity"];
    $state = $_POST["inCompanyState"];
    $zip = $_POST["inCompanyZip"];
    $website = $_POST["inCompanyWebsite"];
    $logo = $_POST["inCompanyLogo"];

    //$theatreDB = new TheatreCMSDBHelper();
    //$theatreDB->InsertNewCompany($name, $shortName, $address, $city, $state, $zip, $website, $logo);

    $companies = new Companies();
    $companies->Insert($name, $shortName, $address,$city,$state,$zip,$website,$$_SESSION["CurrentUser"]->ID, $_SESSION["CurrentUser"]->ID);
}
$smarty->assign("title", "MASC Admin - Companies");
$smarty->assign("groupLevel", $GLOBALS["GroupLevel"]);
//$sLink = ApplicationHelper::IsDevelopmentServer()? "/mysqlAdmin/myadmin/":"/myadmin/myadmin/"; 
//$smarty->assign("mysqlAdminLink", $sLink);
$smarty->display("templates/companies.tpl");
?>