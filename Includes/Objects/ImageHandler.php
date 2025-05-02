<?php
    require_once("../Database/DAO/TheatreCMSDBHelper.php");
    try
    {
        if (!isset($_GET['ImageID']))
        {
            throw new Exception('ID not specified');
        }
        $iImageID = (int) $_GET['ImageID'];
        if ($iImageID <= 0)
        {
            throw new Exception('Invalid ID specified');
        }
		$dbTheatreCms = new TheatreCMSDBHelper();
	    $drImage = $dbTheatreCms->GetImage($iImageID);

        if (empty($drImage))
        {
            throw new Exception('Image with specified ID not found');
        }
    }
    catch (Exception $ex)
    {
        header('HTTP/1.0 404 Not Found');
        exit;
    }

	header("Content-type:{$drImage->MimeType}");
    header("Content-length:{$drImage->Size}");
	echo $drImage->Data;
?>
 
