<?php
include_once($_SERVER["DOCUMENT_ROOT"] . "/Includes/Database/DAO/Admins.php");
require_once($_SERVER["DOCUMENT_ROOT"] .'/Includes/3rdPartyLibs/smarty/TCMSAdminSmarty.php');


if ($GLOBALS["GroupLevel"] != 7)
{
    Header("Location: /Admin/index.php");
}

$daoAdmins = new Admins();
$smarty = new TCMSAdminSmarty();
$smarty->assign("title", "MASC Admin - Admins");

$aGroupLevels = array();
$sSqlStatement = $daoAdmins->ParameterizedQuery("Select * FROM AdminGroups Order By GroupLevel Desc");
$sSqlStatement->execute(array());
while ($oGroups = $sSqlStatement->fetch(PDO::FETCH_OBJ))
{
    $aGroupLevels[] = array ("groupLevel"=>$oGroups->GroupLevel, "title"=>$oGroups->Title, "description"=>$oGroups->Description);
}
$smarty->assign("groupLevels", $aGroupLevels);    

$aAdmin = array();
$oaAdmins = $daoAdmins->GetAdmins();
if($oaAdmins)
{
    foreach ($oaAdmins as $oAdmin)
    {
        $aAdmin[] = array("id"=>$oAdmin->ID, "userName"=>$oAdmin->UserName,"email"=>$oAdmin->Email,"groupLevel"=>$oAdmin->GroupLevel);
    }
}
$smarty->assign("admins", $aAdmin);    

$smarty->display("templates/admins.html");

?>
