<?php
include_once("CodeBehind/FrontPagePage.php");
include_once("CodeBehind/SessionHandler.php");
$oPage = new FrontPagePage();
$oPage->PageLoad();
require_once($_SERVER["DOCUMENT_ROOT"] .'/Includes/3rdPartyLibs/smarty/TCMSAdminSmarty.php');
$smarty = new TCMSAdminSmarty();
$smarty->assign("title", "MASC Admin - Front Page");
//$smarty->assign("active", $oPage->m_bCurrentSeason);
$smarty->assign("actionText", $oPage->m_sActionText);
$aEvents = array();
$aoEvents = $oPage->m_daoEvents->GetAllEvents();
if ($aoEvents)
{
    /* @var $oEvent Event */
    foreach ($aoEvents as $oEvent)
    {
        $aEvents[] = array("id"=> $oEvent->ID, "title"=>$oEvent->Title, "company"=>$oEvent->Company);
    }
}
$smarty->assign("events", $aEvents);
$smarty->assign("imageID",$oPage->m_iImageID);
$smarty->assign("frontPages",$oPage->PopulateFrontPageRows()); 
$smarty->display("templates/frontpage.tpl");