<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Images
 *
 * @author nagates
 */
require_once($_SERVER["DOCUMENT_ROOT"] . "/Includes/Database/VO/Image.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/Includes/Database/DAO/DatabaseClient.php");

class Images extends DatabaseClient
{

    public function Insert($sMimeType, $oImageData, $iHeight, $iWidth, $iSize, $sFileName)
    {
        $sSql = "INSERT INTO Images (MimeType, Data,Height, Width, Size, FileName) VALUES (?,?,?,?,?,?)";
        return $this->InsertNewRecord($sSql, array($sMimeType, $oImageData, $iHeight, $iWidth, $iSize, $sFileName));
    }

    public function Update($sMimeType, $oImageData, $iHeight, $iWidth, $iSize, $sFileName, $iImageID)
    {
        $sSqlInsert = "UPDATE Images SET MimeType = ?, Data = ?, Height = ?, Width = ?, Size = ?, FileName = ? WHERE ID = ?";
        $bReturn = $this->UpdateRecord($sSqlInsert, array($sMimeType, $oImageData, $iHeight, $iWidth, $iSize, $sFileName, $iImageID));
        return $bReturn;
    }

    public function GetImage($iImageID)
    {
        $sqlStatement = $this->m_PDOTheatre->prepare('SELECT * FROM Images WHERE ID = ?');
        $sqlStatement->execute(array($iID));
        $oImage = $sqlStatement->fetchObject("Image");
        return $$oImage;
    }

    public function AttemptImageUpload($oImage, $iMinHeight, $iMaxHeight, $iMinWidth, $iMaxWidth, &$iImageID)
    {
        $bReturn = false;

        if (!empty($oImage) && $oImage['error'] != UPLOAD_ERR_NO_FILE)
        {
            ApplicationHelper::AssertValidUpload($oImage['error']);

            if (!is_uploaded_file($oImage['tmp_name']))
            {
                throw new Exception('File is not an uploaded file');
            }

            $info = getImageSize($oImage['tmp_name']);

            if ($info == null)
            {
                throw new Exception('File is not an image');
            }
            $iWidth = $info[0];
            $iHeight = $info[1];

            if ($iHeight < $iMinHeight || $iHeight > $iMaxHeight)
            {
                $sErrorMessage = "Your Image height must be between {$iMinWidth}px and {$iMaxWidth}px. The uploaded Image size was height:{$iHeight}, Width:{$iWidth}.";
                throw new Exception($sErrorMessage);
            }
            if ($iWidth < $iMinWidth || $iWidth > $iMaxWidth)
            {
                $sErrorMessage = "Your Image width must be between {$iMinWidth}px and {$iMaxWidth}px. The uploaded Image size was height:{$iHeight}, Width:{$iWidth}.";
                throw new Exception($sErrorMessage);
            }
            if ($iImageID > 0)
            {
                $bReturn = $this->Update($info['mime'], file_get_contents($oImage['tmp_name']), $iHeight, $iWidth, $oImage['size'], $oImage['name'], $iImageID);
            }
            else
            {
                $iImageID = $this->Insert($info['mime'], file_get_contents($oImage['tmp_name']), $iHeight, $iWidth, $oImage['size'], $oImage['name']);
                $bReturn = ($iImageID > 0);
            }

            if (!$bReturn)
            {
                throw new Exception("Error Adding Image");
            }
        }
        //var_dump($bReturn);
        return $bReturn;
    }

}

?>
