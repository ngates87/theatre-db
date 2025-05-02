<?php
include_once($_SERVER["DOCUMENT_ROOT"] . "/Includes/Database/DAO/Sponsors.php");
include_once("CodeBehind/SessionHandler.php");
require_once($_SERVER["DOCUMENT_ROOT"] .'/Includes/3rdPartyLibs/smarty/TCMSAdminSmarty.php');
$smarty = new TCMSAdminSmarty();
$daoSponsors = new Sponsors();

$smarty->assign("title","MASC Admin - Sponsors");
$smarty->assign("groupLevel", $GLOBALS["GroupLevel"]);
//$sLink = ApplicationHelper::IsDevelopmentServer()? "/mysqlAdmin/myadmin/":"/myadmin/myadmin/"; 
//$smarty->assign("mysqlAdminLink", $sLink);

$sponsors = array();

$oSponsors = $daoSponsors->GetSponsors();

if ($oSponsors)
{
    foreach ($oSponsors as $oSponsor)
    {
        $sponsors[] = array("id" => $oSponsor->ID, 
                            "name"=>$oSponsor->Name,
                            "website"=>$oSponsor->Website,
                            "active"=>($oSponsor->Active == true)?"Yes":"No",
                            "deleteID"=>$oSponsor->ID);
    }
}

$smarty->assign("sponsors",$sponsors);

$smarty->display("templates/sponsors.html");

?>