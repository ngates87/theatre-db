<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Sponsors
 *
 * @author nagates
 */
require_once($_SERVER["DOCUMENT_ROOT"] . "/Includes/Database/DAO/DatabaseClient.php");
include_once ($_SERVER["DOCUMENT_ROOT"] . "/Includes/Constants.php");

class Sponsor
{
//    public function __construct($sName, $iImageID, $sWebsite, $bActive)
//    {
//        $this->Name = $sName;
//        $this->Image_ID = $iImageID;
//        $this->Website = $sWebsite;
//        $this->Active = $bActive;
//    }
    public $ID; //int
    public $Name; // string
    public $Image_ID; // int
    public $Website; // string
    public $Active; // boolean
}

class Sponsors extends DatabaseClient
{

    // create 
    public function Insert($sName, $iImageID, $sWebsite, $bActive, $iUserID)
    {
        $sSql = "INSERT INTO Sponsors (Name, Image_ID, Website, Active, Create_ID, Edit_ID) VALUES (?,?,?,?,?,?)";
        return $this->InsertNewRecord($sSql, array($sName, $iImageID, $sWebsite, $bActive, $iUserID, $iUserID));
    }
    
    //public function Insert($sName, $iImageID, $sWebsite, $bActive, $iUserID)
//    public function Insert(Sponsor $new, $iUserID)
//    {
//        $sSql = sDatabaseClient
//        return $this->InsertNewRecord($sSql, array($new->Name, $new->Image_ID, $new->Website, $new->Active, $iUserID, $iUserID));
//    }

    // Read
    public function GetSponsorByID($iSponsorID)
    {
        $sqlStatement = $this->m_PDOTheatre->prepare('SELECT * FROM Sponsors WHERE ID = ?');
        $sqlStatement->execute(array($iSponsorID));
        $oSponsor = $sqlStatement->fetchObject("Sponsor");
        return $oSponsor;
    }

    public function GetSponsors()
    {
        $sqlStatement = $this->m_PDOTheatre->prepare('SELECT * FROM Sponsors');
        $sqlStatement->execute(array());
        return $sqlStatement->fetchAll(PDO::FETCH_CLASS, "Sponsor");
    }

    public function GetActiveSponsors()
    {
        $sqlStatement = $this->m_PDOTheatre->prepare('SELECT * FROM Sponsors Where Active = true');
        $sqlStatement->execute(array());
        return $sqlStatement->fetchAll(PDO::FETCH_CLASS, "Sponsor");
    }

    public function GetActiveSponsorsRandomOrder()
    {
        $sqlStatement = $this->m_PDOTheatre->prepare('SELECT * FROM Sponsors WHERE Active = true ORDER BY RAND()');
        $sqlStatement->execute(array());
        return $sqlStatement->fetchAll(PDO::FETCH_CLASS, "Sponsor");
    }

    // --
    // Update
    public function Update($sName, $iImageID, $sWebsite, $bActive,$iUserID, $iSponsorID)
    {
        $sSqlInsert = "UPDATE Sponsors SET Name = ?, Image_ID = ?, Website = ?, Active = ?, Edit_ID = ? WHERE ID = ?";
        try
        {
            $bReturn = $this->UpdateRecord($sSqlInsert, array($sName, $iImageID, $sWebsite, $bActive, $iUserID, $iSponsorID));
            return $bReturn;
        }
        catch (Exception $e)
        {
            return false;
        }
    }

    // Delete 
    public function Delete($iSponsorID)
    {
        $sqlStatement = $this->m_PDOTheatre->prepare('DELETE FROM Sponsors WHERE ID = ?');
        return $sqlStatement->execute(array($iSponsorID));
    }

}

?>
