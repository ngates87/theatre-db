<?php
    include_once($_SERVER["DOCUMENT_ROOT"] . "/Includes/Objects/Security.php");
    require_once $_SERVER["DOCUMENT_ROOT"] . '/Includes/Database/VO/Admin.php';
    require_once($_SERVER["DOCUMENT_ROOT"] . "/Includes/Database/DAO/DatabaseClient.php");
    require_once ("CodeBehind/AccountSettingsPage.php");

// Crud - DAO
class Admins extends DatabaseClient
{
    
    public function Insert($fname, $lname, $uname, $email, $pwd, $iGrpLevel)
    {
        $sSqlInsert = "INSERT INTO Admins (FirstName, LastName, UserName, Email, Password, GroupLevel) VALUES (?,?,?,?,?,?)";
        return $this->InsertNewRecord($sSqlInsert, array($fname, $lname, $uname, $email, $pwd, $iGrpLevel));
    }
    
//    public function Update($fname, $lname, $uname, $email, $pwd, $iGrpLevel,$iUserID)
//    {
//        $sSqlInsert = "Update Admins  SET FirstName = ?, LastName = ?, UserName = ?, Email = ?, Password = ?, GroupLevel = ? where ID = ?";
//        return $this->UpdateRecord($sSqlInsert, array($fname, $lname, $uname, $email, $pwd, $iGrpLevel, $iUserID));
//    }
    
    public function UpdateFirstName($sFirstName,$iUserID)
    {
        $sSqlUpdate = "Update Admins  SET FirstName = ? WHERE ID = ?";
        return $this->UpdateRecord($sSqlUpdate, array($sFirstName,$iUserID));
    }
    
    public function UpdateLastName($sLastName,$iUserID)
    {
        $sSqlUpdate = "Update Admins  SET LastName = ? WHERE ID = ?";
        return $this->UpdateRecord($sSqlUpdate, array($sLastName,$iUserID));
    }
    
    public function UpdateEmail($sEmail,$iUserID)
    {
        $sSqlUpdate = "Update Admins  SET Email = ? WHERE ID = ?";
        return $this->UpdateRecord($sSqlUpdate, array($sEmail,$iUserID));
    }
    
    public function UpdatePassword($sNewPassword, $iUserID)
    {
       // echo ApplicationHelper::AlertScript($sNewPassword);
        $sSqlUpdate = "Update Admins  SET Password = ? WHERE ID = ?";
        return $this->UpdateRecord($sSqlUpdate, array($sNewPassword,$iUserID)); 
    }
    
    public function GetAdminByID($iID)
    {
        $sqlStatement = $this->m_PDOTheatre->prepare('SELECT * FROM Admins WHERE ID = ?');
        $sqlStatement->execute(array($iID));
        $oAdmin =  $sqlStatement->fetchObject("Admin");
        return $oAdmin;
    }
    
    public function GetAdmins()
    {
        $sqlStatement = $this->ParameterizedQuery('SELECT * FROM Admins');
        $sqlStatement->execute(array());
        return $sqlStatement->fetchAll(PDO::FETCH_CLASS,"Admin");        
    }

    public static function AdminLogin($sUserName, $pwd)
    {
        try
        {
            $SqlGetUser = self::GetConnection()->prepare("SELECT * FROM  Admins WHERE UserName = ?");
            $SqlGetUser -> execute( array($sUserName));
            if($SqlGetUser -> rowCount() == 1)
            {
                $voUser = $SqlGetUser ->fetchObject("Admin");
                if($voUser -> Password == SecurityHelper::GenerateHash($pwd, $voUser -> Password))
                {
                return $voUser;
                }
                else
                {
                    return null;
                }
            }
            else
            {
                return null;
            }
        }
        catch (Exception $ex)
        {
                return null;
        }
    }

}
?>