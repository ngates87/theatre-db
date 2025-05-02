<?php

/**
 * Description of SecurePHPPage
 *
 * @author nagates
 */
include_once($_SERVER["DOCUMENT_ROOT"] . "/Includes/Objects/PhpPage.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/Includes/Objects/ApplicationHelper.php");

abstract class PHPDataPage extends PhpPage
{

    protected $m_sKey = "M@sc";
    protected $m_sIV = null;
    public $m_oCurrentUser = null;
    protected $m_bInEditMode = false;

    public function __construct()
    {
        if (function_exists("mcrypt_create_iv") !== false)
        {
            if (!isset($_SESSION["LocalIV"]))
            {
                $_SESSION["LocalIV"] = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_3DES, MCRYPT_MODE_CBC));
            }


            $this->m_sIV = $_SESSION["LocalIV"];
        }
    }

    public function PageLoad()
    {
        if (isset($_GET["LastActionMessage"]))
        {
            JqueryUIHelper::RenderNotification("Success - ", $_GET["LastActionMessage"]);
        }

        //var_dump($_POST);
        foreach ($_POST as $key => $oPostVal)
        {
            if (gettype($_POST[$key]) == "string")
            {
                $_POST[$key] = stripcslashes(trim($oPostVal));
                //$_POST[$key] = htmlspecialchars(stripcslashes(trim($oPostVal)), ENT_QUOTES);
                //$_POST[$key] = htmlspecialchars(trim($oPostVal), ENT_QUOTES);
            }
        }
    }

    public function EncryptData($sData, $sKey)
    {
        if (!function_exists("mcrypt_encrypt") === true)
        {
            return $sData;
        }
        else
        {
            return base64_encode(mcrypt_encrypt(MCRYPT_3DES, $sKey, $sData, MCRYPT_MODE_CBC, $this->m_sIV));
        }
    }

    public function DecrpytData($sData, $sKey)
    {
        if (!function_exists("mcrypt_encrypt") === true)
        {
            return $sData;
        }
        else
        {
            return trim(mcrypt_decrypt(MCRYPT_3DES, $sKey, base64_decode($sData), MCRYPT_MODE_CBC, $this->m_sIV));
        }
    }

    public function CanUpdate()
    {
        return ($GLOBALS["GroupLevel"] == 6 || $GLOBALS["GroupLevel"] == 7 || $GLOBALS["GroupLevel"] == 5);
    }

    public function CanDelete()
    {
        return ($GLOBALS["GroupLevel"] == 6 || $GLOBALS["GroupLevel"] == 7);
    }

    public function CanCreate()
    {
        return ($GLOBALS["GroupLevel"] == 6 || $GLOBALS["GroupLevel"] == 7 );
    }

    public function CanRead()
    {
        return ($GLOBALS["GroupLevel"] == 6 || $GLOBALS["GroupLevel"] == 7 || $GLOBALS["GroupLevel"] == 5);
    }

}

?>
