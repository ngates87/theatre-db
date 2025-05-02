<?php

include_once($_SERVER["DOCUMENT_ROOT"] . "/Includes/Database/DAO/TheatreCMSDBHelper.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/Includes/Database/DAO/Admins.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/Includes/Database/DAO/Events.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/Includes/Database/VO/Event.php");
include_once("PHPDataPage.php");

class EventPage extends PHPDataPage
{

    public $m_sTitle = null;
    public $m_sCompany = null;
    public $m_sNotes = null;
    public $m_sPrePrice = null;
    public $m_sRegPrice = null;
    public $m_bCurrentSeason = false;
    public $m_aiVenueIDs = null;
    public $m_adtEvents = null;
    public $m_aiEventTypes = null;
    public $m_aiTrouperIDs = null;
    public $m_asRoles = null;
    public $m_aiTrouperCategories = null;
    public $m_aiEventAdmins = null;
    public $m_sActionText = "Create Event";
    public $m_iEditEventID = null;
    public $m_iArtfullyID = null;
    public $m_dbTheatreCms = null;
    public $m_bCanEdit = null;
    public $m_daoEvents;

    public function __construct()
    {
        $this->m_dbTheatreCms = new TheatreCMSDBHelper();
        $this->m_daoEvents = new Events();
        parent::__construct();
    }

    public function PageLoad()
    {
        parent::PageLoad();
        if (isset($_GET["EventID"]) && $_GET["EventID"] > 0)
        {
            $this->m_iEditEventID = $_GET["EventID"];
            $this->m_sActionText = "Update Event";
            $this->m_bInEditMode = true;

            $dbTheatreCMS = new TheatreCMSDBHelper();
            /* @var $oEvent Event */
            $oEvent = $this->m_daoEvents->GetEventByID($this->m_iEditEventID);
            $aTrouperInfo = $dbTheatreCMS->LookUpTroupers($oEvent->ID);
            $aVenueInfo = $dbTheatreCMS->LookUpEventInfo($oEvent->ID);
            $aEventAdminIDs = $dbTheatreCMS->LookUpEventAdmin($oEvent->ID);

            if (!isset($_POST["inEventTitle"]))
            {
                $this->m_sTitle = $oEvent->Title;
            }
            if (!isset($_POST["inCompany"]))
            {
                $this->m_sCompany = $oEvent->Company_ID;
            }
            if (!isset($_POST["inShowNotes"]))
            {
                $this->m_sNotes = $oEvent->Notes;
            }
            if (!isset($_POST["inPreShowPrice"]))
            {
                $this->m_sPrePrice = $oEvent->EarlyTicketPrice;
            }
            if (!isset($_POST["inDoorPrice"]))
            {
                $this->m_sRegPrice = $oEvent->DoorTicketPrice; 
            }
            if (!isset($_POST["inActive"]))
            {
                $this->m_bCurrentSeason = $oEvent->CurrentSeason;
            }

            if (!isset($_POST["Troupers"], $_POST["Roles"]))
            {
                $this->m_aiTrouperIDs = $aTrouperInfo[0];
                $this->m_asRoles = $aTrouperInfo[1];
                $this->m_aiTrouperCategories = $aTrouperInfo[2];
            }

            if (!isset($_POST["Venues"], $_POST["EventDates"], $_POST["EventType"]))
            {
                $this->m_aiVenueIDs = $aVenueInfo[0];
                $this->m_adtEvents = $aVenueInfo[1];
                $this->m_aiEventTypes = $aVenueInfo[2];
            }

            if (!isset($_POST["Admin"]))
            {
                $this->m_aiEventAdmins = $aEventAdminIDs;
            }
            
            if (!isset($_POST["inArtfullyID"]))
            {
                $this->m_iArtfullyID = $oEvent->Artfully_ID;
            }
        }

        if (isset($_POST["inEventTitle"], $_POST["inCompany"]))
        {
            if ($this->m_bInEditMode && $this->CanUpdate($_SESSION["CurrentUser"]->ID, $this->m_iEditEventID))
            {
                $this->PostBack();
            }
            else if (!$this->m_bInEditMode && $this->CanCreate())
            {
                $this->PostBack();
            }
            else
            {
                JqueryUIHelper::RenderErrorNotification("Error - ", "You do not have permission to preform this action");
            }
        }
    }

    private function PostBack()
    {
        $this->m_sTitle = $_POST["inEventTitle"];
        $this->m_sCompany = $_POST["inCompany"];
        $this->m_iArtfullyID = $_POST["inArtfullyID"];
        $this->m_sNotes = $_POST["inShowNotes"];
        $this->m_sPrePrice = $_POST["inPreShowPrice"];
        $this->m_sRegPrice = $_POST["inDoorPrice"];
        $this->m_bCurrentSeason = (isset($_POST["inActive"]) && $_POST["inActive"] == true) ? true : false;
        $iCreateID = $_SESSION["CurrentUser"]->ID;

        if (SecurityHelper::ContainsHtml($this->m_sTitle) || SecurityHelper::ContainsHtml($this->m_sCompany) /*|| SecurityHelper::ContainsHtml($this->m_sNotes)*/  ||SecurityHelper::ContainsHtml($this->m_sPrePrice)
                || SecurityHelper::ContainsHtml($this->m_sRegPrice))
        {
            JqueryUIHelper::RenderErrorNotification("Error - ", parent::CONTAINS_HTML_ERROR_MESSAGE);
        }
        else
        {

            $dbTheatreCMS = new TheatreCMSDBHelper();
            $dbTheatreCMS->NewTransactionScope();
            //var_dump($this->m_iEditEventID);
            if ($this->m_iEditEventID != null)
            {
                $this->m_daoEvents->DeleteEventRelatedInfo($this->m_iEditEventID);
                $this->m_daoEvents->Update($this->m_iEditEventID, $this->m_sTitle, $this->m_sCompany,
                        $iCreateID, $this->m_sNotes, $this->m_sPrePrice, 
                        $this->m_sRegPrice,$this->m_iArtfullyID, $this->m_bCurrentSeason);
            }
            else
            {
                $this->m_iEditEventID =
                        $this->m_daoEvents->Insert($this->m_sTitle, $this->m_sCompany, $iCreateID, $this->m_sNotes, $this->m_sPrePrice, $this->m_sRegPrice, $this->m_bCurrentSeason);
            }

            $bEventCreated = False;
            $bEventInfoInserted = True;
            $bEventRolesInserted = True;
            $bAdminInserted = true;

            if ($this->m_iEditEventID > 0)
            {
                $bEventCreated = True;
                if (isset($_POST["Venues"], $_POST["EventDates"]))
                {
                    $this->m_aiVenueIDs = $_POST["Venues"];
                    $this->m_adtEvents = $_POST["EventDates"];
                    $this->m_aiEventTypes = $_POST["EventTypes"];
//                    var_dump($this->m_aiVenueIDs);
//                    var_dump($this->m_adtEvents);
//                    var_dump($this->m_aiEventTypes);
                    
                    if (count($this->m_adtEvents) == count($this->m_aiVenueIDs)) // These should be the same length
                    {
                        for ($i = 0; $i < count($this->m_adtEvents); $i++)
                        {
                            $result = 
                            $dbTheatreCMS->InsertNewEventInfo($this->m_iEditEventID, 
                                    $this->m_aiVenueIDs[$i], $this->m_adtEvents[$i], 
                                    $this->m_aiEventTypes[$i]);
                            
                            $bEventInfoInserted = ((( $result != -1) ? true : false) && $bEventInfoInserted);
                        }
                    }
                }

                if (isset($_POST["Troupers"], $_POST["Roles"], $_POST["Category"]))
                {
                    $this->m_aiTrouperIDs = $_POST["Troupers"];
                    $this->m_asRoles = $_POST["Roles"];
                    $this->m_aiTrouperCategories = $_POST["Category"];
                    //var_dump($this->m_asRoles);
                   // var_dump($_POST["Roles"]);
                    //die;
                    $iCount = count($this->m_aiTrouperIDs);
                    if ($iCount == count($this->m_asRoles) && ($iCount == count($this->m_aiTrouperCategories)))
                    {
                        for ($i = 0; $i < $iCount; $i++)
                        {
                            $bEventInfoInserted = 
                            ((($dbTheatreCMS->InsertNewTroupeInfo(
                                    $this->m_iEditEventID, $this->m_aiTrouperIDs[$i], $this->m_asRoles[$i], $this->m_aiTrouperCategories[$i]) != -1) ? true : false) 
                                && $bEventCreated);
                        }
                    }
                }

                if (isset($_POST["Admin"]))
                {
                    $this->m_aiEventAdmins = $_POST["Admin"];
					//echo "dumping array";
                    for ($i = 0; $i < count($this->m_aiEventAdmins); $i++)
                    {
                    	
                    	//var_dump($this->m_aiEventAdmins);
                    
                        $bAdminInserted = ((($dbTheatreCMS->InsertNewEventAdmin($this->m_aiEventAdmins[$i], $this->m_iEditEventID) > 0) ? true : false) && $bEventCreated);
                    }
                }
            }
//            var_dump($bEventCreated);
//            var_dump($bEventInfoInserted);
//            var_dump($bEventRolesInserted);
//            var_dump($bAdminInserted);
            $bSuccess = $bEventCreated && $bEventInfoInserted && $bEventRolesInserted && $bAdminInserted;
            if ($bSuccess === True)
            {
                $dbTheatreCMS->CommitTransaction();
                echo "<script>window.location.href = '/Admin/ViewEvent.php?EventID={$this->m_iEditEventID}&Message=Event Updated';</script>";
            }
            else
            {
                /*var_dump($bEventCreated);
                var_dump($bEventInfoInserted);
                var_dump($bEventRolesInserted);
                var_dump($bAdminInserted);
                $dbTheatreCMS->Rollback();*/
                echo "<script>window.location.href = '/Admin/Event.php?LastActionMessage=ERROR';</script>";
            }
        }
    }

    public function ShowHideUpdateButton()
    {
        if ($this->m_bInEditMode && $this->CanUpdate($_SESSION["CurrentUser"]->ID, $this->m_iEditEventID))
        {
            echo "<button type='submit' class='ui-form-submit'>{$this->m_sActionText}</button>";
        }
        else if (!$this->m_bInEditMode && $this->CanCreate())
        {
            echo "<button type='submit' class='ui-form-submit'>{$this->m_sActionText}</button>";
        }
    }

    public function PopulateCompaniesDropDown()
    {
        $sOutput = "";
        $id = (isset($_GET["CompanyID"]) ? $_GET["CompanyID"] : null);
        $SqlCompanies = $this->m_dbTheatreCms->m_PDOTheatre->prepare("SELECT * FROM Companies");
        // no point in going further if we have no results
        $SqlCompanies->execute();
        //return $SqlCompanies->fetch(PDO::FETCH_OBJ);
        
        $aReturn = array();
        
        if ($SqlCompanies->rowCount() > 0)
        {
            while ($row = $SqlCompanies->fetch(PDO::FETCH_OBJ))
            {
                $aReturn[] = array("id" => $row->ID, "name"=>$row->Name);
                //$sSelected = (($row->ID == $id) ? "selected='true'" : "");
                //$sOutput .= "<option value='{$row->ID}'{$sSelected} >{$row->Name}</option>";
            }
        }
        return $aReturn;
    }

    public function PopulateVenuesDropDown()
    {
        //$sOutput = "";
        $aVenues = array();
        $id = (isset($_GET["VenuesID"]) ? $_GET["VenueID"] : null);
        $SqlCompanies = $this->m_dbTheatreCms->m_PDOTheatre->prepare("SELECT * FROM Venues Order by Title ASC");
        // no point in going further if we have no results
        $SqlCompanies->execute();
        if ($SqlCompanies->rowCount() > 0)
        {
            while ($row = $SqlCompanies->fetch(PDO::FETCH_OBJ))
            {
                //$sSelected = (($row->ID == $id) ? "selected='true'" : "");
                //$sOutput .= "<option value='{$row->ID }' {$sSelected } >{$row->Title}</option>";
                
                $aVenues[] = array("id"=> $row->ID, "title" => $row->Title, "selected" =>($row->ID == $id) );
            }
        }
        return $aVenues;
    }

    public function PopulateEventTypeDropDown()
    {
        $aTypes = array();
        $aReturn = $this->m_dbTheatreCms->GetEventTypes();

        if ($aReturn)
        {
            foreach ($aReturn as $row)
            {
                //$sOutput .= "<option value='{$row->ID}' >{$row->Name}</option>";
                $aTypes[] = array("id"=> $row->ID, "name"=> $row->Name);
            }
        }
        return $aTypes;
    }

    public function PopulateTroupersDropDown()
    {
        $sOutput = "";
        $aReturn = $this->m_dbTheatreCms->GetTroupers();
        $aTroupers = array();

        if ($aReturn)
        {
            foreach ($aReturn as $drTrouper)
            {
                if($drTrouper != null)
                {
                    //$sOutput .= "<option value='{$drTrouper->ID }'>{$drTrouper->FirstName} {$drTrouper->LastName}</option>";
                    $aTroupers[] = array ("id"=> $drTrouper->ID, "name"=>($drTrouper->FirstName ." " . $drTrouper->LastName));
                }
            }
        }
        return $aTroupers;
    }

    public function PopulateTrouperCatogeriesDropDown()
    {
        $sOutput = "";
        $aReturn = $this->m_dbTheatreCms->GetTrouperCategories();
        $aCategories = array();

        if ($aReturn)
        {
            foreach ($aReturn as $drTrouper)
            {
                //$sOutput .= "<option value='{$drTrouper->ID }'>{$drTrouper->Display}</option>";
                $aCategories[] = array("id" => $drTrouper->ID, "display" => $drTrouper->Display);
            }
        }
        return $aCategories;
    }

    const DELETE_FUNCTION = "";
    const DELETE_ROW = "<td  class='action'><a href='#' title='Delete Row.' onclick='$(this).parent().parent().remove();return false;'><span class='ui-icon ui-icon-trash'></span></a></td>";

    public function RePopulateEventAdmin()
    {
        $daoAdmins = new Admins();
        $admins = array();
        
        if ($this->m_aiEventAdmins != null)
        {
            foreach ($this->m_aiEventAdmins as $oEventAdmin)
            {
                $voAdmin = $daoAdmins->GetAdminByID($oEventAdmin->UserID);
                //echo "<tr><td><input type='hidden' name='Admin[]' value='{$oEventAdmin->UserID}'/>{$voAdmin->FirstName} {$voAdmin->LastName}</td>" . self::DELETE_ROW . "</tr>";
                $admins[] = array("id"=> $oEventAdmin->UserID, "name" => $voAdmin->FirstName . " " . $voAdmin->LastName);
            }
        }
        return $admins;
    }

    public function RePopulateEventInfo()
    {
        $sOutput = "";
        $aInfo = array();
        //var_dump($this->m_aiEventTypes);
        if (count($this->m_adtEvents) == count($this->m_aiVenueIDs)) // These should be the same length
        {
            $dbTheatreCMS = new TheatreCMSDBHelper();
            for ($i = 0; $i < count($this->m_adtEvents); $i++)
            {
                $id = $this->m_aiVenueIDs[$i];
                $when = new DateTime($this->m_adtEvents[$i]);
                //$when = date("M d, Y g:i A", $when->getTimestamp());
                $iTypeID = $this->m_aiEventTypes[$i];
                $sEventTypeName = ($iTypeID > 0) ? $dbTheatreCMS->GetEventTypeName($iTypeID) : "";
                $aInfo[] = array("id"=>$id, "venueName"=>$dbTheatreCMS->GetVenueName($id), "when"=>$when->format("m/d/Y g:i A"),
                    "typeID"=>$iTypeID, "typeName"=>$sEventTypeName);
            }
        }
        return $aInfo;
    }

    public function RePopulateSetupTrouperRoles()
    {
        $sOutput = "";
        $aReturn = array();
        if (count($this->m_aiTrouperIDs) == count($this->m_asRoles)) // These should be the same length
        {
            $dbTheatreCMS = new TheatreCMSDBHelper();
            for ($i = 0; $i < count($this->m_aiTrouperIDs); $i++)
            {
                $id = $this->m_aiTrouperIDs[$i];
                $sRole = $this->m_asRoles[$i];
                $iCategoryID = $this->m_aiTrouperCategories[$i];
                
                $aReturn[] = array("id"=>$id, "name"=>$dbTheatreCMS->GetTrouperName($id), "role" => $sRole, 
                    "catID"=>$iCategoryID, "catDisplay" => $dbTheatreCMS->GetTrouperCategoryDisplay($iCategoryID));
            }
        }
        return $aReturn;
    }

    public function CanUpdate($UserID, $EventID)
    {
        //if ($this->m_bCanEdit == null)
        //{
        $this->m_bCanEdit = false;

        if ($GLOBALS["GroupLevel"] == 6 || $GLOBALS["GroupLevel"] == 7)
        {
            $this->m_bCanEdit = true;
        }
        else
        {
            //echo "<script> alert('UserID={$UserID} EventID={$EventID}');</script>";
            $sSqlSelect = "Select COUNT(*) FROM EventAdmin WHERE UserID = ? And EventID = ?";
            $oSqlStatement = $this->m_dbTheatreCms->m_PDOTheatre->prepare($sSqlSelect);
            $oSqlStatement->execute(array($UserID, $EventID));
            if ($oSqlStatement->fetchColumn() == 1)
            {
                $this->m_bCanEdit = true;
            }
        }
        //}
        // echo "<script>alert('update {$this->m_bCanEdit}');</script>";
        return $this->m_bCanEdit;
    }

}

?>