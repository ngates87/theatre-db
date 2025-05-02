<?php

include_once($_SERVER["DOCUMENT_ROOT"] . "/Includes/Database/DAO/DatabaseClient.php");

class TheatreCMSDBHelper extends DatabaseClient
{

    public function InsertNewEventInfo($eventID, $venueID, $eventDate, $iTypeID)
    {
        //STR_TO_DATE(?, '%m/%d/%Y %h:%i %p') 2013-02-21 03:00 AM
        return $this->InsertNewRecord("INSERT INTO EventInfo (Event_ID, Venue_ID, EventDateTime, Type_ID ) VALUES (?,?,?,?)", 
                array($eventID, $venueID, $eventDate, $iTypeID));
    }

    public function InsertNewEventAdmin($UserID, $EventID)
    {
        return $this->InsertNewRecord("INSERT INTO EventAdmin (UserID, EventID) Values (?,?)", array($UserID, $EventID));
    }

    public function InsertNewTroupeInfo($eventID, $trouperID, $role, $iCategoryID)
    {
        return $this->InsertNewRecord("INSERT INTO TroupeInfo (Event_ID, Trouper_ID, Role, Category_ID) VALUES (?,?,?,?)", array($eventID, $trouperID, $role, $iCategoryID));
    }

   /* public function InsertNewCompany($name, $shortName, $address, $city, $state, $zip, $website, $logo)
    {
        $sql = "INSERT INTO Companies (Name, ShortName,Address,City, State, Zip, Website, logo) VALUES (?,?,?,?,?,?,?,?)";

        return $this->InsertNewRecord($sql, array($name, $shortName, $address, $city, $state, $zip, $website, $logo));
    }     */

    public function LookUpTrouperCategory()
    {
        $sqlStatement = $this->m_PDOTheatre->prepare("SELECT * FROM TrouperCategory");
        $sqlStatement->execute(array($iEventID));
        $aReturn = array();

        while ($row = $sqlStatement->fetch(PDO::FETCH_OBJ))
        {
            array_push($aReturn, $row);
        }
        return $aReturn;
    }
    
    public function GetVenueName($id)
    {
        $sqlStatement = $this->m_PDOTheatre->prepare("Select Title from Venues where ID = ? ");
        $sqlStatement->execute(array($id));
        $row = $sqlStatement->fetch(PDO::FETCH_OBJ);
        return $row->Title;
    }

    public function GetTrouperName($id)
    {
        $sqlStatement = $this->m_PDOTheatre->prepare('Select CONCAT(FirstName, " ", LastName) as FullName  from Troupers where
		ID = ?');
        $sqlStatement->execute(array($id));
        $row = $sqlStatement->fetch(PDO::FETCH_OBJ);
        return $row->FullName;
    }

    public function GetEventTypeName($id)
    {
        $sqlStatement = $this->m_PDOTheatre->prepare('Select * FROM EventType WHERE ID = ?');
        $sqlStatement->execute(array($id));
        $row = $sqlStatement->fetch(PDO::FETCH_OBJ);
        return $row->Name;
    }
    
    public function GetTrouperCategoryDisplay($id)
    {
         $sqlStatement = $this->m_PDOTheatre->prepare('Select * FROM TrouperCategory WHERE ID = ?');
        $sqlStatement->execute(array($id));
        $row = $sqlStatement->fetch(PDO::FETCH_OBJ);
        if($row)
        {
            return $row->Display;
        }
        
        return "";
    }

    public function LookUpCompany($iCompanyID)
    {
        $sqlStatement = $this->m_PDOTheatre->prepare('Select *  from Companies where ID = ?');
        $sqlStatement->execute(array($iCompanyID));
        $row = $sqlStatement->fetch(PDO::FETCH_OBJ);
        return $row;
    }

    public function LookUpEventAdmin($iEventID)
    {
        $sqlStatement = $this->m_PDOTheatre->prepare("Select * from EventAdmin where EventID = ?");
        $sqlStatement->execute(array($iEventID));
        $aReturn = array();

        while ($row = $sqlStatement->fetch(PDO::FETCH_OBJ))
        {
            array_push($aReturn, $row);
        }
        return $aReturn;
    }

    public function LookUpTroupers($iEventID)
    {
        $sqlStatement = $this->m_PDOTheatre->prepare('Select * From TroupeInfo where Event_ID = ?');
        $sqlStatement->execute(array($iEventID));
        $aTroupers = array();
        $aRoles = array();
        $aCategory = array();

        if ($sqlStatement->rowCount() > 0)
        {
            while ($drEvent = $sqlStatement->fetch(PDO::FETCH_OBJ))
            {
                array_push($aTroupers, $drEvent->Trouper_ID);
                array_push($aRoles, $drEvent->Role);
                array_push($aCategory, $drEvent->Category_ID);
            }
        }

        $aReturn = array($aTroupers, $aRoles, $aCategory);
        return $aReturn;
    }

    public function LookUpEventInfo($iEventID)
    {
        $sqlStatement = $this->m_PDOTheatre->prepare('Select * From EventInfo where Event_ID = ?');
        $sqlStatement->execute(array($iEventID));
        $aiVenues = array();
        $adtEvents = array();
        $aiTypes = array();

        if ($sqlStatement->rowCount() > 0)
        {
            while ($drInfo = $sqlStatement->fetch(PDO::FETCH_OBJ))
            {
                array_push($aiVenues, $drInfo->Venue_ID);
                array_push($adtEvents, $drInfo->EventDateTime);
                array_push($aiTypes, $drInfo->Type_ID);
            }
        }

        $aReturn = array($aiVenues, $adtEvents, $aiTypes);
        return $aReturn;
    }

    public function LookUpTroupeInfo($iEventID)
    {
        $sqlStatement = $this->m_PDOTheatre->prepare('Select * From TroupeInfo where Event_ID = ?');
        $sqlStatement->execute(array($iEventID));
        $aiTrouper = array();
        $asRole = array();

        if ($sqlStatement->rowCount() > 0)
        {
            while ($drInfo = $sqlStatement->fetch(PDO::FETCH_OBJ))
            {
                array_push($aiTrouper, $drInfo->Trouper_ID);
                array_push($asRole, $drInfo->Role);
            }
        }

        $aReturn = array($aiTrouper, $asRole);
        return $aReturn;
    }

    public function GetEventTypes()
    {
        $sqlStatement = $this->m_PDOTheatre->prepare("SELECT * FROM EventSubTypes");
        $sqlStatement->execute();
        $aReturn = array();
        if ($sqlStatement->rowCount() > 0)
        {
            while ($drType = $sqlStatement->fetch(PDO::FETCH_OBJ))
            {
                array_push($aReturn, $drType);
            }
        }
        return $aReturn;
    }

    public function GetTroupers()
    {
        $sqlStatement = $this->m_PDOTheatre->prepare("SELECT * FROM Troupers order by LastName Asc, FirstName Asc");
        $sqlStatement->execute();
        $aReturn = array();
        if ($sqlStatement->rowCount() > 0)
        {
            while ($drInfo = $sqlStatement->fetch(PDO::FETCH_OBJ))
            {
                array_push($aReturn, $drInfo);
            }
        }
        return $aReturn;
    }

    public function GetTrouperCategories()
    {
        $sqlStatement = $this->m_PDOTheatre->prepare("SELECT * FROM TrouperCategory");
        $sqlStatement->execute();
        $aReturn = array();
        if ($sqlStatement->rowCount() > 0)
        {
            while ($drInfo = $sqlStatement->fetch(PDO::FETCH_OBJ))
            {
                array_push($aReturn, $drInfo);
            }
        }
        return $aReturn;
    }

    public function GetImage($iID)
    {
        $sqlStatement = $this->m_PDOTheatre->prepare('SELECT * FROM Images WHERE ID = ?');
        $sqlStatement->execute(array($iID));
        $row = $sqlStatement->fetch(PDO::FETCH_OBJ);
        return $row;
    }

    public function DeleteEvent($id)
    {
        $sqlStatement = $this->m_PDOTheatre->prepare("Delete FROM Events WHERE ID=?");
        return $sqlStatement->execute(array($id));
    }

}

?>