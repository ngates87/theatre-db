<?php
    require_once($_SERVER["DOCUMENT_ROOT"] . "/Includes/Database/DAO/DatabaseClient.php");
    require_once($_SERVER["DOCUMENT_ROOT"] . "/Includes/Database/VO/Trouper.php");
    class Troupers extends DatabaseClient
    {
    const TABLE_NAME = "Troupers";
    const IDENTITY_COLUMN = "ID";

    //Create
    public function Insert($sFirstName, $sLastName, $dtBirthDate, $sHairColor, $sEyeColor, $iHeight, $iWeight, $cGender, $sBio, $email, $phone, $iImageID, $iCreateID)
    {
        $sSqlInsert =
        "INSERT INTO Troupers (FirstName,LastName,Birthday,HairColor,EyeColor,Height,Weight,Gender,Bio,Email,Phone, Image_ID, Create_ID, Edit_ID) VALUES (?,?,STR_TO_DATE(?, '%b %d, %Y'),?,?,?,?,?,?,?,?,?,?,?)";
        return (int)$this->InsertNewRecord($sSqlInsert, 
                array($sFirstName, $sLastName, $dtBirthDate, $sHairColor, $sEyeColor, 
                    $iHeight, $iWeight, $cGender, $sBio,$email, $phone, 
                    $iImageID,$iCreateID,$iCreateID));
    }

    //Read
    public function GetTrouperByID($iID)
    {
        $sqlStatement = $this->m_PDOTheatre->prepare('SELECT * FROM ' . self::TABLE_NAME . ' WHERE ' . self::IDENTITY_COLUMN . ' = ?');
        $sqlStatement->execute(array($iID));
        $oTrouper = $sqlStatement->fetchObject("Trouper");
        return $oTrouper;
    }

    public function GetTroupers()
    {
            $sqlStatement = $this->m_PDOTheatre->prepare('SELECT * FROM Troupers Order by LastName');
            $sqlStatement->execute(array());
            return $sqlStatement->fetchAll(PDO::FETCH_CLASS,"Trouper");
    }

    public function DoesSimilarTrouperExist($sFirstName, $sLastName)
    {
        $sqlStatement = $this->m_PDOTheatre->prepare('SELECT * FROM Troupers where FirstName = ? and LastName = ?');
                    $sqlStatement->execute(array($sFirstName, $sLastName));
        return (bool)($sqlStatement->rowCount() >= 1 );
    }
    //Update
    public function Update($sFirstName, $sLastName, $dtBirthDate, $sHairColor, $sEyeColor, $iHeight, $iWeight, $cGender, $sBio,$email, $phone,$iImageID,$iEditID, $iID)
    {
        $bReturn = FALSE;
        try
        {
            $sSqlUpdate =
            "UPDATE Troupers SET FirstName = ?,LastName = ?,Birthday = STR_TO_DATE(?, '%b %d, %Y'),HairColor = ?,EyeColor = ?,Height = ?,Weight = ?,Gender = ?,Bio = ?,Email = ?,Phone = ?, Image_ID = ?, Edit_ID = ? WHERE ID = ?";
            $bReturn = $this->UpdateRecord($sSqlUpdate, 
                    array($sFirstName, $sLastName, $dtBirthDate, $sHairColor, $sEyeColor, $iHeight,
                        $iWeight, $cGender, $sBio, $email, $phone, $iImageID,$iEditID, $iID));
            
            
        }
        catch(Exception $e)
        {
            echo $e->getMessage();
        }
        //var_dump($bReturn);
        
        return $bReturn;
    }

    //Delete
    public function Delete($iTrouperID)
    {
        $sqlStatement = $this->m_PDOTheatre->prepare('DELETE FROM Troupers WHERE ID = ?');
        return $sqlStatement->execute(array($iTrouperID));
    }

}

?>