<?php
require_once($_SERVER["DOCUMENT_ROOT"] .'/Includes/3rdPartyLibs/smarty/Smarty.class.php');

//$sUrl = "http://api.flickr.com/services/rest/?method=flickr.photosets.getList&api_key=2923a66e1ebb376de063cf63ff24d295&user_id=46632713%40N02&format=json&nojsoncallback=1
$sUrl = "https://api.flickr.com/services/rest/?method=flickr.photosets.getList&api_key=2923a66e1ebb376de063cf63ff24d295&user_id=46632713%40N02&format=json&nojsoncallback=1";
$sResponse = file_get_contents($sUrl);
$oResults = json_decode($sResponse, true);

$albums = array();
foreach ($oResults["photosets"]["photoset"] as $oSet)
{
    //$sAlbumInfo = (empty($oSet["description"]["_content"]) ? $oSet["title"]["_content"] : $oSet["description"]["_content"]);

    $sThumbnailImg = "http://farm{$oSet["farm"]}.static.flickr.com/{$oSet["server"]}/{$oSet["primary"]}_{$oSet["secret"]}_s.jpg"; // thumbnail image

    $albums[] = array(
        "title" => $oSet["title"]["_content"],
        "setID" => $oSet["id"], "thumbnailImg" => $sThumbnailImg,
        "photoCount" => $oSet['photos'], "description" => $oSet["description"]["_content"]
    );
}
$sThisUrl = (!empty($_SERVER['HTTPS'])) ? "https://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'] : "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];

$smarty = new Smarty();
$smarty->assign("thisUrl", $sThisUrl);
$smarty->assign("albums", $albums);
$smarty->display("templates/albums.tpl");


?>