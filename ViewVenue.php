<?php
error_reporting(E_ALL);

ini_set('display_errors', '1');

include_once($_SERVER["DOCUMENT_ROOT"] . "/Includes/3rdPartyLibs/PHPGMap/GoogleMap.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/Includes/Database/DAO/Venues.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/Includes/Database/DAO/Events.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/Includes/Database/VO/Event.php");
require_once($_SERVER["DOCUMENT_ROOT"] .'/Includes/3rdPartyLibs/smarty/Smarty.class.php');

$iVenueID = null;
if (isset($_GET["VenueID"]))
{
    $iVenueID = $_GET["VenueID"];
}
else
{
    header("location: /index.php");
}

$_daoVenues = new Venues();
$daoEvents = new Events();


/* @var $_voVenue Venue */
$_voVenue = $_daoVenues->GetVenueByID($iVenueID);

$oGMap = new GoogleMapAPI();
$oGMap->addMarkerByAddress($_voVenue->Address . "," . $_voVenue->City . ', ' . $_voVenue->State . ', ' . $_voVenue->Zip);
$oGMap->enableStreetViewControls();
$oGMap->attachStreetViewContainer("map_streetview");

$smarty = new Smarty();
$smarty->assign("title", $_voVenue->Title);
$smarty->assign("GMapScript", $oGMap->getHeaderJS() . $oGMap->getMapJS());
$smarty->assign("address",$_voVenue->Address );
$smarty->assign("city",$_voVenue->City);
$smarty->assign("state",$_voVenue->State);
$smarty->assign("zip",$_voVenue->Zip);
$smarty->assign("capacity",$_voVenue->Capacity);
$smarty->assign("imageID",$_voVenue->Image_ID);

    //var_dump($daoEvents->GetEventsByVenueID($iVenueID));
 $smarty->assign("history",$daoEvents->GetEventsByVenueID($iVenueID));


$smarty->assign("theMap", $oGMap->printOnLoad() . $oGMap->printMap() . $oGMap->printSidebar());
$smarty->display("templates/viewVenue.tpl");
?>
