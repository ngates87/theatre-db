<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 *
 * the VO object 
  class SliderItem
{
    public $ID;
    public $Image_ID;
    public $Hyperlink;
    public $Caption;
    public $Enabled;
}
 */
require_once($_SERVER["DOCUMENT_ROOT"] . "/Includes/Database/DAO/DatabaseClient.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/Includes/Database/VO/SliderItem.php");

class SliderItems extends DatabaseClient
{
    public function Create($iImageID, $sHyperLink, $sCaption, $bEnabled, $iCreateID)
    {
        $sSql = "INSERT INTO SliderItems (Image_ID, Hyperlink, Caption, Enabled, Edit_ID, Create_ID) VALUES (?,?,?,?,?,?)";
        return $this->InsertNewRecord($sSql, array($iImageID, $sHyperLink, $sCaption, $bEnabled, $iCreatedID, $iCreateID));
    }
    
    public Function Read($id)
    {
        $sqlStatement = $this->m_PDOTheatre->prepare('SELECT * FROM SliderItems WHERE ID = ?');
        $sqlStatement->execute(array($id));
        $oSponsor = $sqlStatement->fetchObject("SliderItem");
        return $oSponsor;
    }
    
    public function ReadAll()
    {
        $sqlStatement = $this->m_PDOTheatre->prepare('SELECT * FROM SliderItems');
        $sqlStatement->execute(array());
        return $sqlStatement->fetchAll(PDO::FETCH_CLASS, "SliderItem");
    }

     public function ReadAllEnabled()
    {
        $sqlStatement = $this->m_PDOTheatre->prepare('SELECT * FROM SliderItems where Enabled = true');
        $sqlStatement->execute(array());
        return $sqlStatement->fetchAll(PDO::FETCH_CLASS, "SliderItem");
    }
    
    public function Update($id,$iImageID, $sHyperLink, $sCaption,$bEnabled, $iEditID)
    {
        //$sSqlInsert = "UPDATE Sponsors SET Name = ?, Image_ID = ?, Website = ?, Active = ?, Edit_ID = ? WHERE ID = ?";
        $sSqlInsert = "UPDATE SliderItems SET Image_ID = ?, Hyperlink = ?, Caption = ?, Enabled = ?, Edit_ID = ? WHERE ID = ?";
        try
        {
            $bReturn = $this->UpdateRecord($sSqlInsert, array($iImageID, $sHyperLink, $sCaption,(bool)$bEnabled, $iEditID,$id));
            return $bReturn;
        }
        catch (Exception $e)
        {
            return false;
        }
    }
    
    
    public function Delete($id)
    {
        $sqlStatement = $this->m_PDOTheatre->prepare('DELETE FROM SliderItems WHERE ID = ?');
        return $sqlStatement->execute(array($id));
    }
    
}
?>
