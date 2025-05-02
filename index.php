<?php

// includes
include_once($_SERVER["DOCUMENT_ROOT"] . "/Includes/Database/DAO/Sponsors.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/Includes/Database/DAO/FrontPage.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/Includes/Database/DAO/Events.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/Includes/Database/VO/Event.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/Includes/Database/DAO/SliderItems.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/Includes/Database/VO/SliderItem.php");

// needed vars
$daoFrontPage = new FrontPage();
$voFrontPage = $daoFrontPage->GetFrontPage();
$daoEvents = new Events();
$voEvent = $daoEvents->GetEventByID($voFrontPage->Event_ID);

// NOTE: Smarty has a capital 'S'
//define('SMARTY_DIR', $_SERVER["DOCUMENT_ROOT"] .'/libs');
require_once($_SERVER["DOCUMENT_ROOT"] . '/Includes/3rdPartyLibs/smarty/Smarty.class.php');
//require_once('Smarty.class.php');
$smarty = new Smarty();

try
{
    $daoEvents = new Events();
    $aoCurrentSeason = $daoEvents->GetActiveEvents();
    if ($aoCurrentSeason)
    {
        $smarty->assign("curSeason", $aoCurrentSeason);
    }
} catch (Exception $e)
{
    
}

$daoSponsors = new Sponsors();
$avoSponsors = $daoSponsors->GetActiveSponsorsRandomOrder();

$daoSliderItems = new SliderItems();

$items = array();

$oSliderItems = $daoSliderItems->ReadAllEnabled();

if ($oSliderItems)
{
//Image_ID, Hyperlink, Caption, Enabled, Edit_ID, Create_ID
    foreach ($oSliderItems as $oSliderItem)
    {
        $items[] = array("id" => $oSliderItem->ID,
            "imageID" => $oSliderItem->Image_ID,
            "hyperlink" => $oSliderItem->Hyperlink,
            "caption" => $oSliderItem->Caption);
    }
}
$daoEvents = new Events();
$smarty->assign("events",$aoCurrentSeason = $daoEvents->GetActiveEvents());

$smarty->assign("sliderItems", $items);

$smarty->assign("title", "Home");
$smarty->assign("sponsors", $avoSponsors);

$smarty->display("templates/index.html");
?>