<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');
$iEventID = null;
$sSlug = null;
if (isset($_GET["EventID"]))
{
    $iEventID = $_GET["EventID"];
}
else if(isset($_GET["s"]))
{
    $sSlug = $_GET["s"];
}
else
{
    header("location: /index.php");
}
include_once($_SERVER["DOCUMENT_ROOT"] . "/Includes/Database/DAO/TheatreCMSDBHelper.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/Includes/Database/DAO/Troupers.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/Includes/Database/VO/Trouper.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/Includes/Database/DAO/Events.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/Includes/Database/VO/Event.php");
require_once($_SERVER["DOCUMENT_ROOT"] . '/Includes/3rdPartyLibs/smarty/Smarty.class.php');

$dbTheatreCms = new TheatreCMSDBHelper();
$daoTroupers = new Troupers();
$daoEvents = new Events();
/* @var $oEvent Event */
$oEvent = $daoEvents->GetEventBySlugOrID($sSlug,$iEventID);
$oCompany = $dbTheatreCms->LookUpCompany($oEvent->Company_ID);

$smarty = new Smarty();

$smarty->assign("company", $oCompany->Name);
$smarty->assign("title", $oEvent->Title);
$smarty->assign("notes", $oEvent->Notes);
$smarty->assign("earlyTicketPrice", $oEvent->EarlyTicketPrice);
$smarty->assign("doorTicketPrice", $oEvent->DoorTicketPrice);
$smarty->assign("artfullyID", $oEvent->Artfully_ID);

$aoEventInfo = $oEvent->GetEventInfoDetailed();

if ($aoEventInfo != null)
{
    $where = array();

    foreach ($aoEventInfo as $oEventInfo)
    {
        $iVenueID = $oEventInfo->Venue_ID;
        $sVenueName = $dbTheatreCms->GetVenueName($iVenueID);
        $dtDate = new DateTime($oEventInfo->EventDateTime);
        $where[$oEventInfo->MasterType][] = array(
            "venueID" => $iVenueID,
            "venueName" => $sVenueName,
            "when" => $dtDate->format("M d, Y - g:i A"),
            "type" => $oEventInfo->Type);
    }
    $smarty->assign("eventInfo", $where);
}

//var_dump($oEvent);
if($oEvent->PublishCast != false)
{
    $aCategories = $dbTheatreCms->GetTrouperCategories();
    $troupers = array();
    foreach ($aCategories as $oCategory)
    {
        /* @var $aoTroupeInfo TroupeInfo */
        $aoTroupeInfo = $oEvent->GetTroupeInfoByCategoryID($oCategory->ID);

        if ($aoTroupeInfo != null)
        {
            $troupers[$oCategory->Display] = array();
            /* @var $oTrouperInfo TroupeInfo */
            foreach ($aoTroupeInfo as $oTrouperInfo)
            {
                $oTrouper = $daoTroupers->GetTrouperByID($oTrouperInfo->Trouper_ID);
                $troupers[$oCategory->Display][] = array("trouperID" => $oTrouperInfo->Trouper_ID,
                    "fullName" => $oTrouper->FullName(),
                    "role" => $oTrouperInfo->Role);
            }
        }
    }
    //var_dump($troupers);
    $smarty->assign("troupers", $troupers);
}

$sThisUrl = !empty($_SERVER['HTTPS']) ? "https://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'] :
        "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];

$smarty->assign("currentUrl", $sThisUrl);

$smarty->display("templates/viewevent.html");
?>


