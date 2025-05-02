<?php

include_once($_SERVER["DOCUMENT_ROOT"] . "/Includes/Database/DAO/DatabaseClient.php");
//include_once($_SERVER["DOCUMENT_ROOT"] . "/Includes/Database/VO/Event.php");
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Events
 *
 * @author nagates
 */
class TroupeInfo
{
    public $Event_ID;
    public $Trouper_ID;
    public $Role;
    public $Category_ID;
}

class EventInfo
{
    public $Event_ID;
    public $Venue_ID;
    public $EventDateTime;
    public $Type_ID;

}

class Event extends DatabaseClient
{
    public $ID;
    public $Slug;
    public $Title;
    public $EarlyTicketPrice;
    public $DoorTicketPrice;
    public $Notes;
    public $Company_ID;
    public $CreatedBy_ID;
    public $EditedBy_ID;
    public $Artfully_ID;
    public $CurrentSeason;
    public $PublishCast;
    
    public function SetActive($bCurrentSeason)
    {
        $val = false;        // do i not need to declare this in the outer scope?
        if(strcasecmp($bCurrentSeason, 'true') == 0)
        {
            $val = true;
        }
        else if(strcasecmp($bCurrentSeason, 'false') == 0)
        {
            $val = false;
        }
        else
        {
            return false;
        }
        
        return $this->UpdateRecordExpected("UPDATE Events SET CurrentSeason = ? WHERE ID = ? ", array((bool)$val, $this->ID), 1);
        
    }

    public function GetEventInfo()
    {
        $sqlStatement = $this->m_PDOTheatre->prepare('SELECT * FROM EventInfo WHERE Event_ID = ? ORDER BY EventDateTime');
        $sqlStatement->execute(array($this->ID));
        $aoReturn = null;

        if ($sqlStatement->rowCount() > 0)
        {
            $aoReturn = $sqlStatement->fetchAll(PDO::FETCH_CLASS, 'EventInfo');
        }
        return $aoReturn;
    }

    public function GetTroupeInfo()
    {
        $sqlStatement = $this->m_PDOTheatre->prepare('SELECT * FROM TroupeInfo WHERE Event_ID = ?');
        $sqlStatement->execute(array($this->ID));
        $aoReturn = null;

        if ($sqlStatement->rowCount() > 0)
        {
            $aoReturn = $sqlStatement->fetchAll(PDO::FETCH_CLASS, 'TroupeInfo');
        }
        return $aoReturn;
    }
    
    public function GetEventInfoDetailed()
    {

        $sqlStatement = $this->m_PDOTheatre->prepare(
            'SELECT A.Venue_ID, A.EventDateTime, B.Name as Type, B.ID as TypeID, C.Name as MasterType
            FROM EventInfo A, EventSubTypes B, EventMasterTypes C
            WHERE A.Type_ID = B.ID AND B.MasterType = C.ID AND A.Event_ID = ? ORDER BY C.Order ASC , A.EventDateTime');
        $sqlStatement->execute(array($this->ID));
        $aoReturn = null;

        if ($sqlStatement->rowCount() > 0)
        {
            $aoReturn = $sqlStatement->fetchAll(PDO::FETCH_OBJ);
        }
        return $aoReturn;
    }

    public function GetTroupeInfoDetailed()
    {
        $sqlStatement = $this->m_PDOTheatre->prepare('SELECT * FROM TroupeInfo WHERE Event_ID = ?');
        $sqlStatement->execute(array($this->ID));
        $aoReturn = null;

        if ($sqlStatement->rowCount() > 0)
        {
            $aoReturn = $sqlStatement->fetchAll(PDO::FETCH_CLASS, 'TrouperInfo');
        }
        return $aoReturn;
    }

    public function GetTroupeInfoByCategoryID($id)
    {
        $sqlStatement = $this->m_PDOTheatre->prepare('SELECT * FROM TroupeInfo WHERE Event_ID = ? and Category_ID = ?');
        $sqlStatement->execute(array($this->ID, $id));
        $aoReturn = null;

        if ($sqlStatement->rowCount() > 0)
        {
            $aoReturn = $sqlStatement->fetchAll(PDO::FETCH_CLASS, 'TroupeInfo');
        }
        return $aoReturn;
    }

}