<?php

//include_once($_SERVER["DOCUMENT_ROOT"] . "/Admin/CodeBehind/SessionHandler.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/Includes/Database/DAO/Images.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/Includes/Database/DAO/SliderItems.php");
include_once ($_SERVER["DOCUMENT_ROOT"] . "/Includes/Database/VO/SliderItem.php");

session_start();

$sAction = strtolower($_POST["action"]);


switch ($sAction)
{
    case "create":
        CreateSliderItem();
        break;

    case "read":
        $id = (int) $_POST["id"];
        ReadSliderItem($id);
        break;
    
    case "readall":
        ReadAll();
        break;
    
    case "delete":
        DeleteSliderItem();
        break;

    case "update"; 
        UpdateSliderItem();
        break;

    case "enable"; 
        $id = (int) $_POST["id"];
        $daoSliderItems = new SliderItems();
        $oItem = $daoSliderItems->Read($id);
        echo json_encode(array("result" => (bool)$oItem->Enable((string)$_POST["enable"])));
        die;
        break;
    default:
        break;
}

function CreateSliderItem()
{
    $bReturn = true;
    $sMessage = "No image was provided, please correct and try again.";
    if (isset($_FILES["image"]))
    {
        // Insert($sName, $iImageID, $sWebsite, $bActive, $iUserID)
        $imageID = 0;
        $daoSliderItems = new SliderItems();
        $daoImages = new Images();
        $bReturn = false;

        try
        {
        //AttemptImageUpload($oImage, $iMinHeight, $iMaxHeight, $iMinWidth, $iMaxWidth, &$iImageID)
            $daoImages->AttemptImageUpload($_FILES["image"],  420, 460, 840, 860, $imageID);
        } 
        catch (Exception $e)
        {
            echo (string) json_encode(array("result" => (bool) false, "message" => $e->getMessage()));
            die;
        }

        //n Create($iImageID, $sHyperLink, $sCaption, $bEnabled, $iCreateID)
        try
        {
            $id = $daoSliderItems->Create($imageID, $_POST["hyperlink"], $_POST["caption"], (bool) $_POST["enabled"], $_SESSION["CurrentUser"]->ID);
            if ($id > 0)
            {
                echo (string) json_encode(array("result" => (bool) true,"rec"=>$daoSliderItems->Read($id)));
                die;
            }
        } 
        catch (Exception $e)
        {
            echo (string) json_encode(array("result" => (bool) false, "message" => $e->getMessage()));
            die;
        }
    }
    echo (string) json_encode(array("result" => (bool) $bReturn, "id" => $id, "message" => $sMessage));
    die;
}

function ReadSliderItem($id)
{
    $daoSliderItems = new SliderItems();
    echo (string) json_encode($daoSliderItems->Read($id));
    die;
}

function ReadAll()
{
    $daoSliderItems = new SliderItems();
    echo (string) json_encode($daoSliderItems->ReadAll());
    die;
}

function UpdateSliderItem()
{
    $imageID = 0;
    $bReturn = false;
    if (isset($_POST["id"]))
    {
	$daoSliderItems = new SliderItems();
	$id = (int) $_POST["id"];
        
	$oItem = $daoSliderItems->Read($id);
        if ($oItem != null)
        {
            $imageID = $oItem->Image_ID;
        }
        if (!empty($_FILES["image"]))
        {
            $daoImages = new Images();
            try
            {
                $bReturn = $daoImages->AttemptImageUpload($_FILES["image"],  420, 460, 840, 860, $imageID);
                var_dump($bReturn);
            } 
            catch (Exception $e)
            {
                echo (string) json_encode(array("result" => (bool) false, "message" => $e->getMessage()));
                die;
            }
        }
        try
        {
            //Update($id,$iImageID, $sHyperLink, $sCaption,$bEnabled, $iEditID)
            $bReturn =($bReturn &&
            $daoSliderItems->Update($id,$imageID, $_POST["hyperlink"], $_POST["caption"], (bool) $_POST["enabled"], $_SESSION["CurrentUser"]->ID));
        }
        catch(Exception $e)
        {
            echo (string) json_encode(array("result" => (bool) false, "message" => $e->getMessage()));
            die;
        }

        if($bReturn == true)
        {
            echo (string) json_encode(array("result" => (bool) true,"rec"=>$daoSliderItems->Read($id)));
            die;
        }
    }
    else
    {
        echo json_encode(array("result" => (bool) false, "message"=>"Could not find item to update, please try again later"));
        die;
    }
    echo json_encode(array("result" => (bool) false, "message"=>"Unknown Error, Please try again later or contact your local support."));
    die;
}

function DeleteSliderItem()
{
    $daoSliderItems = new SliderItems();
    echo json_encode(array("result" => $daoSliderItems->Delete($_POST["id"])));
    die;
}

