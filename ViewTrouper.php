<?php
include_once($_SERVER["DOCUMENT_ROOT"] . "/Includes/Database/DAO/Troupers.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/Includes/Database/VO/Trouper.php");
require_once($_SERVER["DOCUMENT_ROOT"] .'/Includes/3rdPartyLibs/smarty/Smarty.class.php');
$smarty = new Smarty();
$iTrouperID = null;
if (isset($_GET["TrouperID"]))
{
    $iTrouperID = $_GET["TrouperID"];
}
else
{
    header("location: /index.php");
}

$oTroupers = new Troupers();
/* @var $oTrouper Trouper */
$oTrouper = $oTroupers->GetTrouperByID($iTrouperID);
$smarty->assign("title",$oTrouper->FullName());
$smarty->assign("fullName", $oTrouper->FullName());

$iAge = ($oTrouper->Birthday != null && $oTrouper->Birthday > 0) ? floor((time() - strtotime($oTrouper->Birthday)) / 31556926) : "N/A";
$cGender = $oTrouper->Gender;
$sGender = (!empty($cGender)) ? (($cGender == 'M') ? "Male" : "Female") : "N/A";
$sHairColor = (!empty($oTrouper->HairColor)) ? $oTrouper->HairColor : "N/A";
$sEyeColor = (!empty($oTrouper->EyeColor)) ? $oTrouper->EyeColor : "N/A";
$sBio = (!empty($oTrouper->Bio)) ? $oTrouper->Bio : "N/A";

$smarty->assign("age", $iAge);
$smarty->assign("gender", $sGender);
$smarty->assign("hairColor", $sHairColor);
$smarty->assign("eyeColor", $sEyeColor);
$smarty->assign("bio", $sBio);


$smarty->assign("history",$oTrouper->GetHistory()); 
$smarty->display("templates/viewtrouper.html"); 