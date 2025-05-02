<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/Includes/Database/DAO/DatabaseClient.php");
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Trouper
 *
 * @author nagates
 */
class TrouperHistory
{
    public $FirstName;
    public $LastName;
    public $Role;
    public $Title;
    public $EventID;
}

class Trouper extends DatabaseClient
{
    //put your code here
    public $ID;
    public $FirstName;
    public $LastName;
    public $Birthday;
    public $HairColor;
    public $EyeColor;
    public $Height;
    public $Weight;
    public $Gender;
    public $Bio;
    public $Picture;
    public $Email;
    public $Phone;
    public $Image_ID;
    //private 
    public function FullName()
    {
        return $this->FirstName . " " . $this->LastName;
    }

    public function GetHistory()
    {
        $sGetShowHistory = "SELECT B.FirstName as FirstName , B.LastName as LastName, A.Role as Role, C.Title As Title, A.Event_ID as EventID FROM TroupeInfo A, Troupers B, Events C 
                                WHERE B.ID = A.Trouper_ID AND A.Event_ID = C.ID AND A.Trouper_ID = ?";

        $sqlStatement = $this->m_PDOTheatre->prepare($sGetShowHistory);
        $sqlStatement->execute(array($this->ID));
        return $sqlStatement->fetchAll(PDO::FETCH_CLASS, "TrouperHistory");
    }

}

?>
