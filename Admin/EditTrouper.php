<?php
// put your code here
include_once("CodeBehind/SessionHandler.php");
include_once("CodeBehind/TroupersPage.php");
require_once($_SERVER["DOCUMENT_ROOT"] .'/Includes/3rdPartyLibs/smarty/Smarty.class.php');
$oPage = new TroupersPage();
$oPage->PageLoad();
require_once($_SERVER["DOCUMENT_ROOT"] .'/Includes/3rdPartyLibs/smarty/TCMSAdminSmarty.php');
$smarty = new TCMSAdminSmarty();
$smarty->assign("actionText", $oPage->m_sActionText);
$smarty->assign("firstName", $oPage->m_sFirstName);
$smarty->assign("lastName", $oPage->m_sLastName);
$smarty->assign("birthday", $oPage->m_dtBirthday);
$smarty->assign("phone", $oPage->m_sPhone);
$smarty->assign("email", $oPage->m_sEmail);
$smarty->assign("gender", $oPage->m_cGender);
$smarty->assign("eyeColor", $oPage->m_sEyeColor);
$smarty->assign("hairColor", $oPage->m_sHairColor);
$smarty->assign("height", $oPage->m_iHeight);
$smarty->assign("weight", $oPage->m_iWeight);
$smarty->assign("bio", $oPage->m_sBio);
$smarty->display("templates/edittrouper.tpl");

?>
