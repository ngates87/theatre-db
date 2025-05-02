<?php
require_once($_SERVER["DOCUMENT_ROOT"] .'/Includes/3rdPartyLibs/smarty/Smarty.class.php');
require_once ($_SERVER["DOCUMENT_ROOT"] . "/Includes/Database/DAO/Admins.php");
require_once ($_SERVER["DOCUMENT_ROOT"] . "/Includes/Objects/HTML/JqueryUIHelper.php");

ini_set("session.cookie_lifetime", "10800");
session_start();

$smarty = new Smarty();
//$smarty->testInstall();
$smarty->assign("title","Masc - Admin Login");

if (isset($_POST['username'], $_POST['password']) && !isset($_SESSION["CurrentUser"]))
{
    $CurUser = Admins::AdminLogin($_POST['username'], $_POST['password']);
    if ($CurUser != null)
    {
        $_SESSION["CurrentUser"] = $CurUser;
        $_SESSION["SessionStart"] = time();
        //HTTP_Session2::set("CurrentUser", $CurUser);
        //HTTP_Session2::set("SessionStart", time());
        Header("Location: ManageEvents.php");
        //Header("Location: test.php");
        //echo '<script type="text/javascript">window.location.href = "/Admin/ManageEvents.php"; </script>';

    }
    else
    {
        $smarty->assign("message", JqueryUIHelper::RenderErrorNotification("Alert - ", "There was a problem processing your login, please try again."));
    }
}
else if (isset($_SESSION["CurrentUser"]))
{
    Header("Location: ManageEvents.php");
    //Header("Location: test.php");
    //echo '<script type="text/javascript">window.location.href = "/Admin/ManageEvents.php"; </script>';
}
$smarty->display("templates/index.html");
?>
