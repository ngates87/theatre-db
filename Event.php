<?php
include_once("CodeBehind/SessionHandler.php");

include_once ("CodeBehind/EventPage.php");
include_once ($_SERVER["DOCUMENT_ROOT"] . "/Includes/Objects/HTML/JqueryUIHelper.php");
require_once($_SERVER["DOCUMENT_ROOT"] .'/Includes/3rdPartyLibs/smarty/TCMSAdminSmarty.php');

$daoAdmins = new Admins();
//$aoAdmins = $daoAdmins->GetAdmins();

$oPage = new EventPage();
$smarty = new TCMSAdminSmarty();
$oPage->PageLoad();
$smarty->assign("title",'MASC Admin - Add Event' );
$smarty->assign("active", $oPage->m_bCurrentSeason);
$smarty->assign("actionText", $oPage->m_sActionText );
$smarty->assign("companies", $oPage->PopulateCompaniesDropDown());
$smarty->assign("companyID", $oPage->m_sCompany);
$smarty->assign("eventTitle", $oPage->m_sTitle);
$smarty->assign("artfullyID", $oPage->m_iArtfullyID);
$smarty->assign("prePrice", $oPage->m_sPrePrice);
$smarty->assign("regPrice", $oPage->m_sRegPrice);
$smarty->assign("notes", $oPage->m_sNotes);

$admins = array();
foreach ($daoAdmins->GetAdmins() as $row)
{
    $admins[] = array("id"=> $row->ID, "name" => $row->FirstName. " " .$row->LastName);
}
$smarty->assign("admins", $admins);
$smarty->assign("eventAdmin", $oPage->RePopulateEventAdmin());
$smarty->assign("venues", $oPage->PopulateVenuesDropDown());
$smarty->assign("itemTypes", $oPage->PopulateEventTypeDropDown());
$smarty->assign("eventInfo", $oPage->RePopulateEventInfo());
$smarty->assign("troupers", $oPage->PopulateTroupersDropDown());
$smarty->assign("trouperCategories", $oPage->PopulateTrouperCatogeriesDropDown());
$smarty->assign("trouperInfo", $oPage->RePopulateSetupTrouperRoles());

$smarty->display("templates/editevent.tpl");
//$PageTitle = ;


?>
