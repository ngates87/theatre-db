<?php

include_once($_SERVER["DOCUMENT_ROOT"] . "/Includes/Database/DAO/Troupers.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/Includes/Database/DAO/Images.php");
include_once ($_SERVER["DOCUMENT_ROOT"] . "/Includes/Database/VO/Admin.php");
session_start();

$sAction = strtolower($_POST["action"]);

switch ($sAction)
{
    case "create":
        CreateTrouper();
        break;

    case "read":
        ReadTroupers();
        break;

    case "delete":
        DeleteTrouper();
        break;

    case "update":
        UpdateTrouper();
        break;

    case "dupcheck":
        DuplicateCheck();
        break;

    default:
        break;
}

function DuplicateCheck()
{
    $daoTroupers = new Troupers();
    $bReturn = $daoTroupers->DoesSimilarTrouperExist($_POST["firstName"], $_POST["lastName"]);
    echo json_encode(array("result" => $bReturn));
    die;
}

function CreateTrouper()
{
    if (!isset($_POST["firstName"], $_POST["lastName"]))
    {
        $sMessage = "Unable to add trouper, please be sure to provide a first and last name, and try again.";
        echo (string) json_encode(array("result" => (bool)false, "id" => null, "message" => $sMessage));
        die;
    }

    $imageID = null;
    $daoTroupers = new Troupers();

    if (isset($_FILES["image"]))
    {
        try
        {
            $daoImages = new Images();
            $daoImages->AttemptImageUpload($_FILES["image"], 100, 200, 100, 400, $imageID);
        } catch (Exception $e)
        {
            $bResult = false;
            $sMessage = $e->getMessage();
            echo json_encode(array("result" => (bool) false, "message" => $e->getMessage()));
            die;
        }
    }

    try
    {
        //Insert($sFirstName, $sLastName, $dtBirthDate, $sHairColor, $sEyeColor, $iHeight, $iWeight, $cGender, $sBio, $picture, $email, $phone, $iImageID, $iCreateID)
        $id = $daoTroupers->Insert($_POST["firstName"], $_POST["lastName"], $_POST["birthday"], $_POST["hairColor"], $_POST["eyeColor"],
            $_POST["height"], $_POST["weight"], $_POST["gender"], $_POST["bio"], $_POST["email"], $_POST["phone"], $imageID, $_SESSION["CurrentUser"]->ID);

        if ($id > 0)
        {
            echo json_encode(array("result" => (bool) true, "trouper" => $daoTroupers->GetTrouperByID($id)));
            die;
        }
        echo json_encode(array("result" => (bool) false, "message" => "Unable to add trouper."));
        die;
    } catch (Exception $e)
    {
        $bResult = false;
        $sMessage = $e->getMessage();
        echo json_encode(array("result" => (bool) false, "message" => $e->getMessage()));
        die;
    }
}

function ReadTroupers()
{
    $id = (int) $_POST["id"];
    $daoTroupers = new Troupers();

    echo json_encode($daoTroupers->GetTrouperByID($id));
    die;
}

//public function Update($sFirstName, $sLastName, $dtBirthDate, $sHairColor,
// $sEyeColor, $iHeight, $iWeight, $cGender, $sBio,
// $email, $phone,$iImageID,$iEditID, $iID)
function UpdateTrouper()
{
    if (!isset($_POST["id"]))
    {
        echo json_encode(array("result" => (bool) false, "message" => "Unable to find trouper to edit."));
        die;
    }

    $id = (int) $_POST["id"];
    $imageID = 0;

    $bResult = true;
    $sMessage = "Unable to create trouper, try again later.";

    $daoTroupers = new Troupers();
    $oTrouper = $daoTroupers->GetTrouperByID($id);

    if ($oTrouper != null)
    {
        $imageID = $oTrouper->Image_ID;

        if (isset($_FILES["image"]))
        {
            try
            {
                $daoImages = new Images();
                $daoImages->AttemptImageUpload($_FILES["image"], 100, 200, 100, 400, $imageID);
            } 
            catch (Exception $e)
            {
                echo json_encode(array("result" => (bool) false, "message" => $e->getMessage()));
                die;
            }
        }

        try
        {
            $bResult = $daoTroupers->Update($_POST["firstName"], $_POST["lastName"],
                    $_POST["birthday"], $_POST["hairColor"], $_POST["eyeColor"], 
                    $_POST["height"], $_POST["weight"], $_POST["gender"], $_POST["bio"], 
                    $_POST["email"], $_POST["phone"], $imageID, $_SESSION["CurrentUser"]->ID, $id);

            if ($bResult == true)
            {
                echo json_encode(array("result" => (bool) true, "trouper" => $daoTroupers->GetTrouperByID($id)));
                die;
            }         
        } 
        catch (Exception $e)
        {
            echo json_encode(array("result" => (bool) false, "message" => $e->getMessage()));
            die;
        }
    }
    echo json_encode(array("result" => (bool) false, "message" => "Unable to edit trouper."));
    die;
}

function DeleteTrouper()
{
    $id = (int) $_POST["id"];
    $daoTroupers = new Troupers();
    echo json_encode(array("result" => (bool) $daoTroupers->Delete($id)));
    die;
}

?>
