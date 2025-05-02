<?php 
//include_once($_SERVER["DOCUMENT_ROOT"] . "/Admin/CodeBehind/SessionHandler.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/Includes/Database/DAO/Sponsors.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/Includes/Database/DAO/Images.php");
include_once ($_SERVER["DOCUMENT_ROOT"] . "/Includes/Database/VO/Admin.php");
session_start();

$sAction = strtolower($_POST["action"]);

    
switch ($sAction) {
    case "create":
        CreateSponsor();
        break;
    
    case "read":
        ReadSponsor();
        break;

    case "delete":
        DeleteSponsor();
        break;
    
    case "update";
        UpdateSponsor();
        break;
    
    default:
        break;
}

function CreateSponsor()
{
//    var_dump($_REQUEST);
//    var_dump($_FILES);
//    var_dump($_POST); 
//    die;
    $bReturn = true;
    $sMessage = "No name or logo was provided, please correct and try again.";
    if(isset($_FILES["image"]) && isset($_POST["name"]))
    {
        // Insert($sName, $iImageID, $sWebsite, $bActive, $iUserID)
        $imageID = 0;
        $daoSponsors = new Sponsors();
        $daoImages = new Images();
        $bReturn = false;
        
        try
        {
            $daoImages->AttemptImageUpload($_FILES["image"], 100, 200, 100, 400, $imageID);
        }
        catch (Exception $e)
        {
            $bReturn = false;
            $sMessage = $e->getMessage();
        }
        
        if($bReturn == true)
        {
            $id = $daoSponsors->Insert($_POST["name"], $imageID,$_POST["website"],(bool)$_POST["active"],$_SESSION["CurrentUser"]->ID );
            $bReturn = ($id > 0);
            if($bReturn == false)
            {
                $sMessage = "Unable to create sponsor, try again later.";
            }
        }
    }
    echo (string)json_encode(array("result"=>(bool)$bReturn,"id"=>$id,"message"=>$sMessage));
    die;
}

function ReadSponsor()
{
    $id = (int)$_POST["id"];
    $daoSponsors = new Sponsors();
    //var_dump($id);
    echo (string)json_encode($daoSponsors->GetSponsorByID($id));
    //var_dump($daoSponsors->GetSponsorByID($id));
    //echo json_encode("succes");
    die;
}

function UpdateSponsor()
{
    $bReturn = false;
    //var_dump($_POST);
    //var_dump($_FILE);
    $daoSponsors = new Sponsors();
    $imageID = 0;
    
    if (isset($_POST["id"]))
    {
        $oSponsor = $daoSponsors->GetSponsorByID($_POST["id"]);
        if ($oSponsor != null)
        {
            $imageID = $oSponsor->Image_ID;
        }
        if(isset($_FILE["image"]) || $imageID > 0)
        {
            $id = (int)$_POST["id"];
            $daoImages = new Images();
            $daoImages->AttemptImageUpload($_FILES["image"], 100, 200, 100, 400, $imageID);
        }
        $bReturn = 
        $daoSponsors->Update($_POST["name"], $imageID,$_POST["website"],(bool)$_POST["active"],$_SESSION["CurrentUser"]->ID, $id );
    }
    echo json_encode(array("result"=>(bool)$bReturn));
    die;
}


function DeleteSponsor()
{
    $daoSponsors = new Sponsors();  
    echo json_encode(array("result"=> $daoSponsors->Delete($_POST["id"])));
    die;
}

