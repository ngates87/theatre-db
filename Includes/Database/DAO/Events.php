<?php

require_once($_SERVER["DOCUMENT_ROOT"] . "/Includes/Database/DAO/DatabaseClient.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/Includes/Database/VO/Event.php");
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Events
 *
 * @author nagates
 */
class Events extends DatabaseClient
{

    public function Insert($title,$sSlug, $company, $createID, $notes, $preTicket, $regTicket,$nArtufllyID, $bCurrentSeason)
    {
        $sSql = 
        "INSERT INTO Events (Title, Slug, Company_ID, Notes, EarlyTicketPrice, DoorTicketPrice, CreatedBy_ID, EditedBy_ID, Artfully_ID, CurrentSeason ) VALUES (?,?,?,?,?,?,?,?,?,?)";
        return $this->InsertNewRecord($sSql, array($title,$sSlug, $company, $notes, $preTicket, $regTicket, $createID, $createID,$nArtufllyID, $bCurrentSeason));
    }

    public function Update($iEventID, $title, $slug, $company, $iEditID, $notes, $preTicket, $regTicket, $iArtfullyID, $bCurrentSeason)
    {
        //var_dump($title);
        //var_dump($slug);
        $sSQL =
            "UPDATE Events SET Title = ?, Slug = ?, Company_ID = ?, Notes = ?, EarlyTicketPrice = ?, DoorTicketPrice = ?, EditedBy_ID = ?, Artfully_ID = ?, CurrentSeason = ? WHERE ID = ? ";
        return parent::UpdateRecordExpected($sSQL,
            array($title,$slug, $company, $notes, $preTicket, $regTicket, $iEditID,$iArtfullyID, $bCurrentSeason, $iEventID),1);
    }

    public function GetAllEvents()
    {
        $sqlStatement = 
			$this->m_PDOTheatre->prepare("SELECT A.ID AS ID,A.Slug as Slug, IF(A.CurrentSeason = '1',TRUE, FALSE) as Active, A.Title AS Title, B.Name AS Company, MAX( C.EventDateTime ) AS EventWhen
                                     FROM Events AS A JOIN Companies AS B ON A.Company_ID = B.ID LEFT JOIN EventInfo AS C ON A.ID = C.Event_ID
                                     GROUP BY Title, Name ORDER BY EventWhen");
        $sqlStatement->execute();
        return $sqlStatement->fetchAll(PDO::FETCH_CLASS, "Event");
    }

    public function GetActiveEvents()
    {
        $sqlStatement = $this->m_PDOTheatre->prepare("SELECT A.ID AS ID, A.CurrentSeason as Active, A.Title AS Title, B.Name AS Company, MAX( C.EventDateTime ) AS EventWhen
                                     FROM Events AS A JOIN Companies AS B ON A.Company_ID = B.ID LEFT JOIN EventInfo AS C ON A.ID = C.Event_ID
                                     WHERE A.CurrentSeason = true GROUP BY Title, Name ORDER BY EventWhen");

        $sqlStatement->execute();
        return $sqlStatement->fetchAll(PDO::FETCH_CLASS, "Event");
    }

   /* public function GetEventCompanyByID($id)
    {
        $sqlStatement = $this->m_PDOTheatre->prepare("SELECT B.Name AS Company, MAX( C.EventDateTime ) AS EventWhen
                                     FROM Events AS A JOIN Companies AS B ON A.Company_ID = B.ID LEFT JOIN EventInfo AS C ON A.ID = C.Event_ID
                                     WHERE A.CurrentSeason = true GROUP BY Title, Name ORDER BY EventWhen");

        $sqlStatement->execute();
        return $sqlStatement->fetchAll(PDO::FETCH_CLASS, "Event");
    }   */

    public function GetEventByID($iEventID)
    {
        $sSql = "SELECT * FROM Events WHERE ID = ?";
        $sqlStatement = $this->m_PDOTheatre->prepare($sSql);
        $sqlStatement->execute(array($iEventID));
        return $sqlStatement->fetchObject("Event");
    }

    public function GetEventBySlug($sSlug)
    {
        $sSql = "SELECT * FROM Events WHERE Slug = ?";
        $sqlStatement = $this->m_PDOTheatre->prepare($sSql);
        $sqlStatement->execute(array($sSlug));
        return $sqlStatement->fetchObject("Event");
    }

    public function GetEventBySlugOrID($sSlug = null, $iEventID = null)
    {
        $sSql = "SELECT * FROM Events WHERE Slug = ? or ID = ?";
        $sqlStatement = $this->m_PDOTheatre->prepare($sSql);
        $sqlStatement->execute(array($sSlug, $iEventID));
        return $sqlStatement->fetchObject("Event");
    }
    
    public function GetEventsByVenueID($iVenueID)
    {
        $sSql = "SELECT B.* FROM EventInfo A, Events B where A.Venue_ID = ? AND A.Event_ID = B.ID Group By A.Event_ID";
        
        $sqlStatement = $this->m_PDOTheatre->prepare($sSql);
        $sqlStatement->execute(array($iVenueID));
        return $sqlStatement->fetchAll(PDO::FETCH_CLASS, "Event");
    }

    public function DeleteEventRelatedInfo($iEventID)
    {
        $sqlStatement = $this->m_PDOTheatre->prepare('DELETE From EventInfo WHERE Event_ID = ?');
        $sqlStatement->execute(array($iEventID));
        $sqlStatement = $this->m_PDOTheatre->prepare('DELETE From TroupeInfo WHERE Event_ID = ?');
        $sqlStatement->execute(array($iEventID));
        $sqlStatement = $this->m_PDOTheatre->prepare('DELETE From EventAdmin WHERE EventID = ?');
        $sqlStatement->execute(array($iEventID));
    }

    public function Delete($iEventID)
    {
        $sqlStatement = $this->ParameterizedQuery("DELETE FROM Events where ID=?");
        return $sqlStatement->execute(array($iEventID));

    }

}

?>
