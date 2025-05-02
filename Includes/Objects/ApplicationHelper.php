<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ApplicationHelper
 *
 * @author nagates
 */
class ApplicationHelper
{

    static public function IsDevelopmentServer()
    {
        /* @var $sServer string */
        $sServer = $_SERVER["HTTP_HOST"];

        if (strpos($sServer, "dev") === false)
        {
            return false;
        }
        else
        {
            return true;
        }
    }

    static public function AssertValidUpload($code)
    {
        if ($code == UPLOAD_ERR_OK)
        {
            return;
        }

        switch ($code)
        {
            case UPLOAD_ERR_INI_SIZE:
            case UPLOAD_ERR_FORM_SIZE:
                $msg = 'Image is too large';
                break;

            case UPLOAD_ERR_PARTIAL:
                $msg = 'Image was only partially uploaded';
                break;

            case UPLOAD_ERR_NO_FILE:
                $msg = 'No image was uploaded';
                break;

            case UPLOAD_ERR_NO_TMP_DIR:
                $msg = 'Upload folder not found';
                break;

            case UPLOAD_ERR_CANT_WRITE:
                $msg = 'Unable to write uploaded file';
                break;

            case UPLOAD_ERR_EXTENSION:
                $msg = 'Upload failed due to extension';
                break;

            default:
                $msg = 'Unknown error';
        }

        throw new Exception($msg);
    }
    
    static public function AlertScript($sMessage)
    {
        return "<script>alert('{$sMessage}');</script>";
    }

}

?>
