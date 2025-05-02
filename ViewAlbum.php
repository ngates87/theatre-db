<?php
require_once($_SERVER["DOCUMENT_ROOT"] .'/Includes/3rdPartyLibs/smarty/Smarty.class.php');
//echo "id?=" . $_POST["setid"];
$sUrl = "https://api.flickr.com/services/rest/?method=flickr.photosets.getPhotos&api_key=2923a66e1ebb376de063cf63ff24d295" . 
        "&photoset_id={$_POST["setid"]}&extras=url_o%2C+url_m&privacy_filter=1&format=json&nojsoncallback=1";

//        echo $sUrl;
$oResponse = json_decode(file_get_contents($sUrl), true);

$pictures = array();
foreach ($oResponse["photoset"]["photo"] as $key => $oSet)
{
    $sThumbnailImg = "http://farm{$oSet["farm"]}.static.flickr.com/{$oSet["server"]}/{$oSet["id"]}_{$oSet["secret"]}_s.jpg"; // thumbnail image
    if (isset($oSet["url_m"]))
    {
        $pictures[] = array("url_m" => $oSet["url_m"], 
                            "url_o" => $oSet["url_o"], 
                            "thumbnailImg" => $sThumbnailImg);
    }
}

$sThisUrl = (!empty($_SERVER['HTTPS'])) ? "https://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'] : "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];

$smarty = new Smarty();
//$smarty->assign("title", $_GET["Title"]);
$smarty->assign("thisUrl", $sThisUrl);
$smarty->assign("pictures", $pictures);
$smarty->display("templates/album.tpl");


?>
