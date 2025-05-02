<?php
include_once("CodeBehind/SessionHandler.php");
include_once ($_SERVER["DOCUMENT_ROOT"] . "/Includes/Database/DAO/Events.php");
include_once ("CodeBehind/EventPage.php");
$daoEvents = new Events();
$oPage = new EventPage();
require_once($_SERVER["DOCUMENT_ROOT"] .'/Includes/3rdPartyLibs/smarty/TCMSAdminSmarty.php');
$smarty = new TCMSAdminSmarty();

$smarty->assign("title","MASC Admin - Manage Events");
$smarty->assign("groupLevel", $GLOBALS["GroupLevel"]);
//$sLink = ApplicationHelper::IsDevelopmentServer()? "/mysqlAdmin/myadmin/":"/myadmin/myadmin/"; 
//$smarty->assign("mysqlAdminLink", $sLink);
$events = array();

$aoEvents = $daoEvents->GetAllEvents();
$smarty->assign("companies", $oPage->PopulateCompaniesDropDown());
foreach ($aoEvents as $oEvent)
{
    
    $events[] = array("id" => $oEvent->ID,
                      "active" => $oEvent->Active,
                      "canUpdate" => $oPage->CanUpdate($_SESSION["CurrentUser"]->ID, $oEvent->ID), 
                      "title" => $oEvent->Title, 
                      "company" => $oEvent->Company,
                      "slug" => $oEvent->Slug,
                      "canDelete"=>($GLOBALS["GroupLevel"] == 6 || $GLOBALS["GroupLevel"] == 7));
    
}
$daoAdmins = new Admins();
$admins = array();
foreach ($daoAdmins->GetAdmins() as $row)
{
    $admins[] = array("id"=> $row->ID, "name" => $row->FirstName. " " .$row->LastName);
}
$smarty->assign("admins", $admins);
$smarty->assign("venues", $oPage->PopulateVenuesDropDown());
$smarty->assign("itemTypes", $oPage->PopulateEventTypeDropDown());
$smarty->assign("troupers", $oPage->PopulateTroupersDropDown());
$smarty->assign("trouperCategories", $oPage->PopulateTrouperCatogeriesDropDown());

$smarty->assign("events", $events);

$smarty->display("templates/manageevents.html");

?>
