<?php
include_once("CodeBehind/SessionHandler.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/Includes/Database/DAO/Troupers.php");
require_once($_SERVER["DOCUMENT_ROOT"] .'/Includes/3rdPartyLibs/smarty/TCMSAdminSmarty.php');
$smarty = new TCMSAdminSmarty();
$daoTroupers = new Troupers();


$troupers = array();
$_aoTroupers = $daoTroupers->GetTroupers();
if ($_aoTroupers)
{
    foreach ($_aoTroupers as $oTrouper)
    {
        $dtBirthday = $oTrouper->Birthday;
        $troupers[] = array(
            "id" => $oTrouper->ID,
            "fullName" => $oTrouper->FirstName . " " . $oTrouper->LastName,
            "birthday" =>  $oTrouper->Birthday,
            "age" => ($dtBirthday != null && $dtBirthday > 0) ? floor((time() - strtotime($dtBirthday)) / 31556926) : "",
            "hairColor" => $oTrouper->HairColor,
            "eyeColor" => $oTrouper->EyeColor,
            "email" => $oTrouper->Email,
            "phone" => $oTrouper->Phone,
            "gender" => $oTrouper->Gender
        );
    }
}

$smarty->assign("title", "MASC Admin - Troupers");
$smarty->assign("groupLevel", $GLOBALS["GroupLevel"]);
//$sLink = ApplicationHelper::IsDevelopmentServer()? "/mysqlAdmin/myadmin/":"/myadmin/myadmin/"; 
//$smarty->assign("mysqlAdminLink", $sLink);
//$smarty->assign("actionText", $oPage->m_sActionText);
$smarty->assign("actionText", "Add");

$smarty->assign("troupers", $troupers);

$smarty->display("templates/troupers.html");
?>