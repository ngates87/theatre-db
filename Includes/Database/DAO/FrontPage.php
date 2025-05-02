<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FrontPage
 *
 * @author nagates
 */
class FrontPage extends DatabaseClient
{
    public $ID;
    public $Image_ID;
    public $Event_ID;
    //public $Title;
    public $Active;

    public  function GetFrontPage()
    {
        $sqlStatement = $this->m_PDOTheatre->prepare("SELECT Event_ID, Image_ID	
            FROM FrontPage");
        $sqlStatement->execute();
        return $sqlStatement->fetchObject("FrontPage");
    }
    
    public function GetFrontPages()
    {
        $sqlStatement = $this->m_PDOTheatre->prepare("SELECT * FROM FrontPage");
        $sqlStatement->execute();
        return $sqlStatement->fetchAll(PDO::FETCH_CLASS, "FrontPage");
    }

    public function UpdateFrontPage($Event_ID, $Image_ID, $Active)
    {
        $sSql = "DELETE * FROM FrontPage";
        $this->UpdateRecord($sSql, array());

        $sSql = "INSERT INTO FrontPage (Event_ID, Image_ID, Active) VALUES (?,?,?)";
        return $this->UpdateRecord($sSql, array($Event_ID, $Image_ID));
    }
    
}

?>
