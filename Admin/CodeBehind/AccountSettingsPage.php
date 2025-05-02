<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AccountSettingsPage
 *
 * @author nagates
 */
include_once("PHPDataPage.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/Includes/Database/DAO/Admins.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/Includes/Objects/Security.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/Includes/Objects/ApplicationHelper.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/Includes/Objects/HTML/JqueryUIHelper.php");

class AccountSettingsPage extends PHPDataPage
{

    public $m_sFirstName = null;
    public $m_sLastName = null;
    public $m_sEmail = null;
    public $m_oCurrentUser = null;
    public $m_daoAdmins = null;

    public function __construct()
    {
        parent::__construct();
        $this->m_oCurrentUser = $_SESSION["CurrentUser"];
        $this->m_daoAdmins = new Admins();
    }

    public function PageLoad()
    {
        try
        {
            if (!empty($_POST["inFirstName"]) && $_POST["inFirstName"] != $this->m_oCurrentUser->FirstName)
            {
                if ((bool) $this->m_daoAdmins->UpdateFirstName($_POST["inFirstName"], $_SESSION["CurrentUser"]->ID) === false)
                {
                    throw new Exception("Error updating first mame");
                }
            }

            if (!empty($_POST["inLastName"]) && $_POST["inLastName"] != $this->m_oCurrentUser->LastName)
            {
                if ((bool) $this->m_daoAdmins->UpdateLastName($_POST["inLastName"], $_SESSION["CurrentUser"]->ID) === false)
                {
                    throw new Exception("Error updating last name");
                }
            }

            if (!empty($_POST["inEmail"]) && $_POST["inEmail"] != $this->m_oCurrentUser->Email)
            {
                if ((bool) $this->m_daoAdmins->UpdateEmail($_POST["inEmail"], $_SESSION["CurrentUser"]->ID) === false)
                {
                    throw new Exception("Error updating email");
                }
            }

            if ((!empty($_POST["inCurrentPassword"]) && !empty($_POST["inNewPassword"]) && !empty($_POST["inConfirmNewPassword"])) && $_POST["inNewPassword"] == $_POST["inConfirmNewPassword"])
            {
                $oUserValidate = Admins::AdminLogin($this->m_oCurrentUser->UserName, $_POST["inCurrentPassword"]);

                if (!empty($oUserValidate) && $oUserValidate->ID == $this->m_oCurrentUser->ID)
                {
                    //echo ApplicationHelper::AlertScript(SecurityHelper::GenerateHash($_POST["inNewPassword"]));
                    if ((bool) $this->m_daoAdmins->UpdatePassword(SecurityHelper::GenerateHash($_POST["inNewPassword"]), $oUserValidate->ID) === false)
                    {
                        throw new Exception("Unable to change password.");
                    }
                }
            }
        }
        catch (Exception $e)
        {
            JqueryUIHelper::RenderErrorNotification("ERROR Updating - ", $e->getMessage());
        }

        JqueryUIHelper::RenderNotification("Success - ", "Account Updated");
    }

}

?>
