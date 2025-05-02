<?php

/**
 * Description of VenuePage
 *
 * @author nagates
 */
include_once($_SERVER["DOCUMENT_ROOT"] . "/Includes/Database/DAO/Images.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/Includes/Database/DAO/Venues.php");
include_once("PHPDataPage.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/Includes/Objects/Security.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/Includes/Objects/HTML/JqueryUIHelper.php");

class VenuePage extends PHPDataPage
{

    public $m_iVenueID = null;
    public $m_sTitle = null;
    public $m_sCity = null;
    public $m_sState = null;
    public $m_sAddress = null;
    public $m_sZipCode = null;
    public $m_iCapacity = null;
    public $m_iImageID = null;
    public $m_daoVenues = null;
    /* @var $m_daoImages Images */
    public $m_daoImages = null;
    public $m_sActionText = "Add Venue";
    public $m_bInEditMode = false;

    function __construct()
    {
        $this->m_daoVenues = new Venues();
        $this->m_daoImages = new Images();

        parent::__construct();
    }

    public function PageLoad()
    {
        parent::PageLoad();
        if (isset($_GET["VenueID"]))
        {
            //$this->m_iVenueID = $this->DecrpytData($_GET["VenueID"], "ReadKey");
            $this->m_iVenueID = $_GET["VenueID"];
            /* @var $oVenue Venue */
            $oVenue = $this->m_daoVenues->GetVenueByID($this->m_iVenueID);

            if (!isset($_POST["inVenueTitle"]))
            {
                $this->m_sTitle = $oVenue->Title;
            }

            if (!isset($_POST["inVenueCity"]))
            {
                $this->m_sCity = $oVenue->City;
            }

            if (!isset($_POST["inVenueState"]))
            {
                $this->m_sState = $oVenue->State;
            }

            if (!isset($_POST["inVenueAddress"]))
            {
                $this->m_sAddress = $oVenue->Address;
            }

            if (!isset($_POST["inVenueZip"]))
            {
                $this->m_sZipCode = $oVenue->Zip;
            }
            if (!isset($_POST["inVenueCapacity"]))
            {
                $this->m_iCapacity = $oVenue->Capacity;
            }

            if ($oVenue->Image_ID > 0)
            {
                $this->m_iImageID = $oVenue->Image_ID;
            }
            $this->m_sActionText = "Update Venue";
            $this->m_bInEditMode = true;
        }

        if (isset($_POST["inVenueTitle"]))
        {
            $this->PostBack();
        }
    }

    private function PostBack()
    {
        /* @var $oVenue Venue */
        $oVenue = $this->m_daoVenues->GetVenueByID($this->m_iVenueID);
        if ($oVenue != null && $oVenue->Image_ID)
        {
            $this->m_iImageID = $oVenue->Image_ID;
        }
        $this->m_sTitle = $_POST["inVenueTitle"];
        $this->m_sCity = isset($_POST["inVenueCity"]) ? $_POST["inVenueCity"] : null;
        $this->m_sState = isset($_POST["inVenueState"]) ? $_POST["inVenueState"] : null;
        $this->m_sAddress = isset($_POST["inVenueAddress"]) ? $_POST["inVenueAddress"] : null;
        $this->m_sZipCode = isset($_POST["inVenueZip"]) ? $_POST["inVenueZip"] : null;
        $this->m_iCapacity = isset($_POST["inVenueCapacity"]) ? $_POST["inVenueCapacity"] : null;
        $sErrorTitle = null;
        $sErrorMessage = self::CONTAINS_HTML_ERROR_MESSAGE;

        try
        {
            if (!SecurityHelper::ContainsHtml($this->m_sTitle) && !SecurityHelper::ContainsHtml($this->m_sCity) && !SecurityHelper::ContainsHtml($this->m_sState) && !SecurityHelper::ContainsHtml($this->m_sAddress)
                    && !SecurityHelper::ContainsHtml($this->m_sZipCode) && !SecurityHelper::ContainsHtml($this->m_iCapacity))
            {
                //$this->m_daoImages->NewTransactionScope();
                {
                    if (!empty($_FILES["inVenueImage"]) && $_FILES["inVenueImage"]['error'] != UPLOAD_ERR_NO_FILE)
                    {
                        $oImage = $_FILES["inVenueImage"];
                        ApplicationHelper::AssertValidUpload($oImage['error']);

                        if (!is_uploaded_file($oImage['tmp_name']))
                        {
                            throw new Exception('File is not an uploaded file');
                        }

                        $info = getImageSize($oImage['tmp_name']);

                        if ($info == null)
                        {
                            throw new Exception('File is not an image');
                        }
                        $iWidth = $info[0];
                        $iHeight = $info[1];
                        $bReturn = false;
                        if ($this->m_iImageID > 0)
                        {
                            $bReturn = $this->m_daoImages->Update($info['mime'], file_get_contents($oImage['tmp_name']), $iHeight, $iWidth, $oImage['size'], $oImage['name'], $this->m_iImageID);
                        }
                        else
                        {
                            $this->m_iImageID = (int) $this->m_daoImages->Insert($info['mime'], file_get_contents($oImage['tmp_name']), $iHeight, $iWidth, $oImage['size'], $oImage['name']);
                            $bReturn = ($this->m_iImageID > 0);
                        }

                        if (!$bReturn)
                        {
                            $this->m_daoImages->Rollback();
                            throw new Exception("Error Adding Image");
                        }
                    }
                    //$this->m_daoVenues->NewTransactionScope();
                    {
                        if ($this->m_iVenueID == null)
                        {
                            $this->m_iVenueID = $this->m_daoVenues->Insert($this->m_sTitle, $this->m_iCapacity, $this->m_sCity, $this->m_sState, $this->m_sAddress, $this->m_sZipCode, $this->m_iImageID);

                            if ($this->m_iVenueID > 0)
                            {
                                $this->m_daoVenues->CommitTransaction();
                                JqueryUIHelper::RenderNotification("Success", "Venue Created");
                            }
                            else
                            {
                                $sErrorTitle = "Internal error inserting the venue";
                                throw new Exception("Internal Error creating the venue");
                            }
                        }
                        else
                        {
                            $bReturn = (bool) $this->m_daoVenues->Update($this->m_sTitle, $this->m_iCapacity, $this->m_sCity, $this->m_sState, $this->m_sAddress, $this->m_sZipCode, $this->m_iImageID, $this->m_iVenueID);
                            if ($bReturn === true)
                            {
                                //$this->m_daoImages->CommitTransaction();
                                //$this->m_daoVenues->CommitTransaction();
                                JqueryUIHelper::RenderNotification("Success ", "Venue Updated");
                            }
                            else
                            {
                                $sErrorTitle = "Internal error updating the venue({$this->m_iImageID})";
                                throw new Exception("Internal error updating the venue");
                            }
                        }
                    }
                }
            }
            else
            {
                $sErrorTitle = "Error Input Contains Html  - ";
                throw new Exception("Input Contains HTML");
            }
        }
        catch (Exception $e)
        {
//            $this->m_daoVenues->Rollback();
//            $this->m_daoImages->Rollback();
            JqueryUIHelper::RenderErrorNotification($sErrorTitle, self::CONTAINS_HTML_ERROR_MESSAGE . " -- " . $e->getMessage());
        }
    }

    public function PopulateExistingVenues()
    {
        $venues = array();
        $oaVenues = $this->m_daoVenues->GetVenues();
        if ($oaVenues)
        {
            foreach ($oaVenues as $oVenue)
            {
                $venues[] = array(
                    "id" => $oVenue->ID,
                    "name" => $oVenue->Title,
                    "capcity" => $oVenue->Capacity,
                    "address" =>$oVenue->Address,
                    "city" => $oVenue->City,
                    "state" => $oVenue->State,
                    "zip" => $oVenue->Zip
                );
//                $sReadLinkID = $this->EncryptData($oVenue->ID, "ReadKey");
//                $sDeleteLinkID = $this->EncryptData($oVenue->ID, "DeleteKey");
//                $sOutput .= "<tr><td><a href='Venues.php?VenueID={$sReadLinkID}'>{$oVenue->Title}</a></td><td>{$oVenue->Capacity}</td><td>{$oVenue->Address},{$oVenue->City},{$oVenue->State},{$oVenue->Zip}</td>";
//                $sOutput .= "<td><a title='Delete Event' href='#' onclick='RemoveVenue(\"{$sDeleteLinkID}\",this);'><span class='ui-icon ui-icon-trash'></span></a></td></tr>";
            }
        }
        return $venues;
    }

}

?>
