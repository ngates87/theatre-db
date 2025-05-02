<?php
include_once("CodeBehind/SessionHandler.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/Includes/Database/DAO/SliderItems.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/Includes/Database/VO/SliderItem.php");

require_once($_SERVER["DOCUMENT_ROOT"] .'/Includes/3rdPartyLibs/smarty/TCMSAdminSmarty.php');
$smarty = new TCMSAdminSmarty();
$smarty->assign("title","MASC Admin - Slider Config");
$smarty->assign("groupLevel", $GLOBALS["GroupLevel"]);
//$sLink = ApplicationHelper::IsDevelopmentServer()? "/mysqlAdmin/myadmin/":"/myadmin/myadmin/"; 
//$smarty->assign("mysqlAdminLink", $sLink);


$daoSliderItems = new SliderItems();

$items = array();

$oSliderItems = $daoSliderItems->ReadAll();

if ($oSliderItems)
{
//Image_ID, Hyperlink, Caption, Enabled, Edit_ID, Create_ID
    foreach ($oSliderItems as $oSliderItem)
    {
        $items[] = array("id"=>$oSliderItem->ID,
                            "imageID" => $oSliderItem->Image_ID, 
                            "hyperlink"=>$oSliderItem->Hyperlink,
                            "caption"=>$oSliderItem->Caption,
                            "enabled"=>$oSliderItem->Enabled);
    }
}

$smarty->assign("sliderItems", $items);

$smarty->display("templates/SliderItems.tpl");

?>