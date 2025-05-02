<?php
include_once("CodeBehind/SessionHandler.php");
include_once("CodeBehind/VenuePage.php");
require_once($_SERVER["DOCUMENT_ROOT"] .'/Includes/3rdPartyLibs/smarty/TCMSAdminSmarty.php');
$smarty = new TCMSAdminSmarty();
$oPage = new VenuePage();

if (isset($_POST["DeleteID"]))
{
    //$iVenueID = $oPage->DecrpytData($_POST["DeleteID"], "DeleteKey");
    $iVenueID = $_POST["DeleteID"];
    return $oPage->m_daoVenues->DeleteByID($iVenueID);
}
$smarty->assign("title", "MASC Admin - Add Venue");
$smarty->assign("groupLevel", $GLOBALS["GroupLevel"]);
//$sLink = ApplicationHelper::IsDevelopmentServer()? "/mysqlAdmin/myadmin/":"/myadmin/myadmin/"; 
//$smarty->assign("mysqlAdminLink", $sLink);
$oPage->PageLoad();
$smarty->assign("actionText", $oPage->m_sActionText);
$smarty->assign("venueTitle", $oPage->m_sTitle);
$smarty->assign("city", $oPage->m_sCity);
$smarty->assign("address", $oPage->m_sAddress);
$smarty->assign("zipCode",$oPage->m_sZipCode );
$smarty->assign("capcity", $oPage->m_iCapacity);
$smarty->assign("venues", $oPage->PopulateExistingVenues());

$smarty->display("templates/venues.html");

//$oPage->oaVenues = $this->m_daoVenues->GetVenues();
//        $sOutput = "";
//        if ($oaVenues)
//        {
//            foreach ($oaVenues as $oVenue)
//            {
//                $sReadLinkID = $this->EncryptData($oVenue->ID, "ReadKey");
//                $sDeleteLinkID = $this->EncryptData($oVenue->ID, "DeleteKey");
//                $sOutput .= "<tr><td><a href='Venues.php?VenueID={$sReadLinkID}'>{$oVenue->Title}</a></td><td>{$oVenue->Capacity}</td><td>{$oVenue->Address},{$oVenue->City},{$oVenue->State},{$oVenue->Zip}</td>";
//                $sOutput .= "<td><a title='Delete Event' href='#' onclick='RemoveVenue(\"{$sDeleteLinkID}\",this);'><span class='ui-icon ui-icon-trash'></span></a></td></tr>";
//            }
//        }
//        return $sOutput;