<?php
/**
 * Description of Venues
 *
 * @author nagates
 */
// Value Object 
require_once $_SERVER["DOCUMENT_ROOT"] . '/Includes/Database/VO/Venue.php';
include_once($_SERVER["DOCUMENT_ROOT"] . "/Includes/Database/DAO/DatabaseClient.php");

// Data Access Object - implaments CRUD
class Venues extends DatabaseClient
{

    public function Insert($title, $capacity, $city, $state, $address, $zip,$iImageID)
    {
        $sSqlInsert = "INSERT INTO Venues (Title, Capacity, City, State, Address, Zip, Image_ID) VALUES (?,?,?,?,?,?,?)";
        return (int) $this->InsertNewRecord($sSqlInsert, array($title, $capacity, $city, $state, $address, $zip, $iImageID));
    }

    public function GetVenueByID($iVenueID)
    {
        $sqlStatement = $this->m_PDOTheatre->prepare('SELECT * FROM Venues WHERE ID = ?');
        $sqlStatement->execute(array($iVenueID));
        return $sqlStatement->fetchObject("Venue");
    }

    public function GetVenues()
    {
        $sqlStatement = $this->m_PDOTheatre->prepare('SELECT * FROM Venues');
        $sqlStatement->execute(array());
        return $sqlStatement->fetchAll(PDO::FETCH_CLASS, "Venue");
    }

    public function Update($sTitle, $iCapcity, $sCity, $sState, $sAddress, $sZip, $iImageID, $iVenueID)
    {
        $sSqlUpdate = "Update Venues SET Title = ?, Capacity = ?, City = ?, State = ?, Address = ?, Zip = ?, Image_ID = ? WHERE ID = ?";
        try
        {
            return (bool) $this->UpdateRecord($sSqlUpdate, array($sTitle, $iCapcity, $sCity, $sState, $sAddress, $sZip, $iImageID, $iVenueID));
        }
        catch (Exception $e)
        {
            return false;
        }
    }
    
    public function DeleteByID($iID)
    {
        $sqlStatement = $this->ParameterizedQuery("Delete FROM Venues Where ID = ?");
        return $sqlStatement->execute(array($iID));
    }

}

?>
