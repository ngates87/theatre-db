<?php
/**
 * Created by JetBrains PhpStorm.
 * User: nagates
 * Date: 1/6/12
 * Time: 6:44 PM
 * To change this template use File | Settings | File Templates.
 */
include_once($_SERVER["DOCUMENT_ROOT"] . "/Includes/Database/DAO/Images.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/Includes/Objects/Security.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/Includes/Objects/HTML/JqueryUIHelper.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/Includes/Database/DAO/Events.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/Includes/Database/VO/Event.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/Includes/Database/DAO/FrontPage.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/Includes/Database/DAO/FrontPage.php");
include_once("PHPDataPage.php");

class FrontPagePage extends PHPDataPage
{
    public $m_iEventID = null;
    public $m_iImageID = null;
    public $m_daoImages = null;
    public $m_daoEvents = null;
    public $m_daoFrontPage = null;
    public $m_sActionText = "Update";

    function __construct()
    {
        $this->m_daoImages = new Images();
        $this->m_daoFrontPage = new FrontPage();
        $this->m_daoEvents = new Events();
        parent::__construct();
    }

    public function PageLoad()
    {
        if(isset($_POST["selected"]) && isset($_FILES["inImage"]))
        {
            $this->PostBack();
        }
    }
    
    public function  PopulateFrontPageRows()
    {
        $sRows = "";
        
        $aoFrontPages = $this->m_daoFrontPage->GetFrontPages();
        $aReturn = array();
        foreach ($aoFrontPages as $item)
        {
            $oEvent = $this->m_daoEvents->GetEventByID($item->Event_ID);
            $sActive = ($item->Active == 1)? "yes" : "no";
            $aReturn[] = array("active"=>$sActive, "title"=>$oEvent->Title, "imageID"=>$item->Image_ID);
            //$sRows .= "<tr><td>{$sActive}</td><td>{$oEvent->Title}</td>
            //<td><img src='/Includes/Objects/ImageHandler.php?ImageID={$item->Image_ID}' alt='{$oEvent->Title}' style='max-height:135px;'></td></tr>";
        }
        //echo "<img src='Includes/Objects/ImageHandler.php?ImageID={$voSponsor->Image_ID}' alt='{$voSponsor->Name}'  style='max-height:135px;'>";
        return $aReturn;
    }

    private function PostBack()
    {
        try
        {
            $this->m_iEventID = $_POST["selected"];
            $this->m_daoImages->AttemptImageUpload($_FILES["inImage"], 420, 450, 700, 800, $this->m_iImageID);
            if ( $this->m_iImageID <= 0)
            {
                throw new Exception("Unable to upload image, try again later or contact support");
            }
            if($this->m_daoFrontPage->UpdateFrontPage($this->m_iEventID, $this->m_iImageID, true))
            {
                echo "<script>window.location.href = '/Admin/FrontPage.php?LastActionMessage=Front Page Updated';</script>";
            }

        }
        catch(Exception $e)
        {
            JqueryUIHelper::RenderErrorNotification("Error Title", "Error Message -" . " " . $e->getMessage() . " " . $e->getLine());
        }
    }
}
