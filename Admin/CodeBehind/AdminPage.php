<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Description of AdminPage
 *
 * @author nagates
 */
include_once("PHPDataPage.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/Includes/Database/DAO/Admins.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/Includes/Objects/HTML/JqueryUIHelper.php");

class AdminPage extends PHPDataPage
{

    //put your code here
    public $m_sFirstName = null;
    public $m_sLastName = null;
    public $m_sUsername = null;
    public $m_sEmail = null;
    public $m_sPassword = null;
    public $m_sConfirmPassword = null;
    public $m_iGroupLevel = null;
    public $m_doaAdmins = null;

    public function __construct()
    {
        $this->m_daoAdmins = new Admins();
        parent::__construct();
    }

    public function PageLoad()
    {
        parent::PageLoad();
        if (isset($_POST["firstname"], $_POST['lastname'], $_POST['username'], $_POST['email'], $_POST['password']) && $_POST["password"] == $_POST["confirm_password"])
        {
            $this->PostBack();
        }
    }

    private function PostBack()
    {
        $this->m_sFirstName = $_POST["firstname"];
        $this->m_sLastName = $_POST['lastname'];
        $this->m_sUsername = $_POST['username'];
        $this->m_sEmail = $_POST['email'];
        $this->m_sPassword = $_POST['password'];
        $this->m_iGroupLevel = $_POST["inGroupLevel"];

        if (!(SecurityHelper::ContainsHtml($_POST['firstname']) || SecurityHelper::ContainsHtml($_POST['username']) || SecurityHelper::ContainsHtml($_POST['email']) ||
                SecurityHelper::ContainsHtml($_POST['password'])) && is_numeric($this->m_iGroupLevel))
        {
            $salt = "";
            try
            {
                $this->m_daoAdmins->NewTransactionScope();
                $this->m_daoAdmins->Insert($this->m_sFirstName, $this->m_sLastName, $this->m_sUsername, $this->m_sEmail, SecurityHelper::GenerateHash($this->m_sPassword), $this->m_iGroupLevel);
                $this->m_daoAdmins->CommitTransaction();

                JqueryUIHelper::RenderNotification("Succcess - ", "User {$this->m_sUsername} Successfully created");
            }
            catch (Exception $e)
            {
                $this->m_daoAdmins->Rollback();

                JqueryUIHelper::RenderErrorNotification("Internal Error", "Unable to Create User Account, Try again Later");
            }
        }
    }

    public function PopulateGroupLeveDropDown()
    {
        $sSqlStatement = $this->m_daoAdmins->ParameterizedQuery("Select * FROM AdminGroups Order By GroupLevel Desc");
        $sSqlStatement->execute(array());

        while ($oGroups = $sSqlStatement->fetch(PDO::FETCH_OBJ))
        {
            echo "<tr><td><input type='radio' name='inGroupLevel' value='{$oGroups->GroupLevel}'/></td><td>{$oGroups->Title}</td><td>{$oGroups->Description}</td></tr>";
            //echo "<option value='{$oGroups->GroupLevel}'>{$oGroups->Title}</option>";
        }
    }

    public function PopulateExistingUsersTable()
    {
        $oaAdmins = $this->m_daoAdmins->GetAdmins();

        foreach ($oaAdmins as $oAdmin)
        {
            echo "<tr><td>{$oAdmin->ID}</td><td>{$oAdmin->UserName}</td><td>{$oAdmin->Email}</td><td>{$oAdmin->GroupLevel}</td></tr>";
        }
    }

}

?>
