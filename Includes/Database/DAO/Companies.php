<?php
/**
 * Created by JetBrains PhpStorm.
 * User: nagates
 * Date: 11/14/12
 * Time: 9:15 PM
 * To change this template use File | Settings | File Templates.
 */
require_once($_SERVER["DOCUMENT_ROOT"] . "/Includes/Database/DAO/DatabaseClient.php");
class Company
{
    public $ID;
    public $Name;
    public $ShortName;
    public $Address;
    public $City;
    public $State;
    public $Zip;
    public $Website;
    public $Logo;
    public $Create_ID;
    public $Edit_ID;
}
class Companies extends DatabaseClient
{
    // create
    public function Insert($sName, $sShortName,$sAddress, $sCity, $sState, $sZip, $sWebsite, $iCreate_ID, $iEdit_ID)
    {
        $sSql = "INSERT INTO Companies (Name, ShortName,Address, City, State, Zip, Website, Create_ID, Edit_ID) VALUES (?,?,?,?,?,?,?,?,?)";
        return $this->InsertNewRecord($sSql, array($sName, $sShortName,$sAddress, $sCity, $sState, $sZip, $sWebsite, $iCreate_ID, $iEdit_ID));
    }

    //public function Insert($sName, $iImageID, $sWebsite, $bActive, $iUserID)
//    public function Insert(Sponsor $new, $iUserID)
//    {
//        $sSql = sDatabaseClient
//        return $this->InsertNewRecord($sSql, array($new->Name, $new->Image_ID, $new->Website, $new->Active, $iUserID, $iUserID));
//    }

    // Read
    // Generic
    public function GetCompanies()
    {
        $sqlStatement = $this->m_PDOTheatre->prepare('SELECT * FROM Sponsors');
        $sqlStatement->execute(array());
        return $sqlStatement->fetchAll(PDO::FETCH_CLASS, "Company");
    }

    // More specefic
    public function GetCompnayByID($iSponsorID)
    {
        $sqlStatement = $this->m_PDOTheatre->prepare('SELECT * FROM Companies WHERE ID = ?');
        $sqlStatement->execute(array($iSponsorID));
        $oSponsor = $sqlStatement->fetchObject("Company");
        return $oSponsor;
    }

    // --
    // Update
    public function Update($sName, $sShortName,$sAddress, $sCity, $sState, $sZip, $sWebsite, $iEdit_ID, $ICompanyID)
    {
        //$sSqlInsert = "UPDATE Sponsors SET Name = ?, Image_ID = ?, Website = ?, Active = ?, Edit_ID = ? WHERE ID = ?";
        $sSqlUpdate = "UPDATE Companies SET Name = ?, ShortName = ?, Address = ?, City = ?, State = ?, Zip = ?, Website = ?,Edit_ID = ?  WHERE ID = ?";

        try
        {
            $bReturn = $this->UpdateRecord($sSqlUpdate, array($sName, $sShortName,$sAddress, $sCity, $sState, $sZip, $sWebsite, $iEdit_ID, $ICompanyID));
            return $bReturn;
        }
        catch (Exception $e)
        {
            return false;
        }
    }

    // Delete
    public function Delete($iCompanyID)
    {
        $sqlStatement = $this->m_PDOTheatre->prepare('DELETE FROM Company WHERE ID = ?');
        return $sqlStatement->execute(array($iCompanyID));
    }
}
