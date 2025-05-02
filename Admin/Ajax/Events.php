<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
include_once($_SERVER["DOCUMENT_ROOT"] . "/Includes/Database/DAO/TheatreCMSDBHelper.php");
//include_once($_SERVER["DOCUMENT_ROOT"] . "/Includes/Database/DAO/Admins.php");
include_once ($_SERVER["DOCUMENT_ROOT"] . "/Includes/Database/DAO/Companies.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/Includes/Database/DAO/Events.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/Includes/Database/DAO/Venues.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/Includes/Database/VO/Event.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/Includes/Database/DAO/Troupers.php");
include_once ($_SERVER["DOCUMENT_ROOT"] . "/Includes/Database/VO/Admin.php"); // for the current user session object...
include_once($_SERVER["DOCUMENT_ROOT"] . "/Includes/Objects/Security.php");

session_start();

$sAction = strtolower($_POST["action"]);

switch ($sAction)
{
	case "activate":

		$daoEvents = new Events();
		$oEvent = $daoEvents->GetEventByID($id);
		echo json_encode(array("result" => (bool)$oEvent->SetActive((string)$_POST["active"])));
		die;
	case "create":
		Update();
		break;

	case "read":
		$id = (int) $_POST["id"];
		ReadEvent($id);
		break;

	case "manageeventsview":
		manageEventsView();
		break;

	case "delete":
		$id = (int) $_POST["id"];
		delete($id);
		break;

	case "update":
		$id = (int) $_POST["id"];
		Update($id);
		break;

	//    case "dupcheck":

	default:
		break;
}

function manageEventsView()
{
	$daoEvents = new Events();
	echo json_encode($daoEvents->GetAllEvents());
	die;
}

function ReadEvent($id)
{
	//$id = (int) $_POST["id"];
	$daoEvents = new Events();
	$dbTheatreCMS = new TheatreCMSDBHelper();
	$oEvent =  $daoEvents->GetEventByID($id);
	$daoTroupers = new Troupers();
	$aoTrouperInfo= array();
	$aoEventInfo = array();


	$aoInfo = $oEvent->GetTroupeInfo();
	if(!empty($aoInfo))
	{
		foreach ($aoInfo as $oTrouperInfo) {
			$oTrouper = $daoTroupers->GetTrouperByID($oTrouperInfo->Trouper_ID);
			$aoTrouperInfo[] = array(
				"trouperID"=>$oTrouperInfo->Trouper_ID,
				"fullName" => $oTrouper->FullName(),
				"role" => $oTrouperInfo->Role,
				"catID"=>$oTrouperInfo->Category_ID,
				"catDisplay"=> $dbTheatreCMS->GetTrouperCategoryDisplay($oTrouperInfo->Category_ID)
				);
		}
	}
	$aoInfo = null;

	$daoVenues = new Venues();
	$aoInfo = $oEvent->GetEventInfoDetailed();

	if(!empty($aoInfo))
	{
		foreach ($aoInfo as $oEventInfo)
		{
			$iVenueID = $oEventInfo->Venue_ID;
			$oVenue =  $daoVenues->GetVenueByID($iVenueID);
			//$sVenueName = $dbTheatreCms->GetVenueName($iVenueID);
			$dtDate = new DateTime($oEventInfo->EventDateTime);
			$aoEventInfo[] = array(
				"venueID" => $iVenueID,
				"venueName" => $oVenue->Title,
				"when" => $dtDate->format("M d, Y H:i:s"),
				"type" => $oEventInfo->Type,
				"typeID"=> $oEventInfo->TypeID
				);
		}

	}

	echo json_encode(array(
		"event"=>$oEvent,
		"trouperInfo"=>$aoTrouperInfo,
		"eventInfo"=>$aoEventInfo,
		"adminInfo"=>$dbTheatreCMS->LookUpEventAdmin($id)
		));
	die;
}

function Update($id = null)
{
	try{
		$daoEvents = new Events();

		$sTitle = $_POST["inEventTitle"];
		$sSlug = $_POST["inEventSlug"];
		$sCompany = $_POST["inCompany"];
		$iArtfullyID = $_POST["inArtfullyID"];
		$sNotes = $_POST["inShowNotes"];
		$sPrePrice = $_POST["inPreShowPrice"];
		$sRegPrice = $_POST["inDoorPrice"];
		$bCurrentSeason = (isset($_POST["inActive"]) && $_POST["inActive"] == true) ? true : false;
		$iCreateID = $_SESSION["CurrentUser"]->ID;
		$sMessage = "Unable to add event, you have html tags where they should not belong, please edit and try again.";
		//echo (string) json_encode(array("result" => (bool)false, "message" => "Create ID is " . iCreateID));
		//die;

        var_dump($_POST);

		if(empty(trim($sTitle)))
        {
            $sMessage = "Unable to add event, title cannot be blank ";
			echo (string) json_encode(array("result" => (bool)false, "id" => null, "message" => $sMessage));
			die;
        }


		if (SecurityHelper::ContainsHtml($sTitle) || SecurityHelper::ContainsHtml($sCompany) /*|| SecurityHelper::ContainsHtml($this->m_sNotes)*/
			||SecurityHelper::ContainsHtml($sPrePrice) || SecurityHelper::ContainsHtml($sRegPrice))
		{
			$sMessage = "Unable to add event, you have html tags where they should not belong, please edit and try again.";
			echo (string) json_encode(array("result" => (bool)false, "id" => null, "message" => $sMessage));
			die;
		}

		$dbTheatreCMS = new TheatreCMSDBHelper();
		$dbTheatreCMS->NewTransactionScope();
		//var_dump($this->m_iEditEventID);
		if ($id != null)
		{
			//var_dump($sTitle);
			//var_dump($sSlug);

			$daoEvents->DeleteEventRelatedInfo($id);
			$daoEvents->Update($id, $sTitle,$sSlug, $sCompany,$iCreateID, $sNotes, $sPrePrice, $sRegPrice,$iArtfullyID, $bCurrentSeason);
		}
		else
		{
			$id = $daoEvents->Insert($sTitle,$sSlug, $sCompany, $iCreateID, $sNotes, $sPrePrice, $sRegPrice,$iArtfullyID, $bCurrentSeason);
		}

		$bEventCreated = False;
		$bEventInfoInserted = True;
		$bEventRolesInserted = True;
		$bAdminInserted = true;

		//echo "test";
		if ($id > 0)
		{
			$bEventCreated = True;
			if (isset($_POST["Venues"], $_POST["EventDates"]))
			{
				$aiVenueIDs = $_POST["Venues"];
				$adtEvents = $_POST["EventDates"];
				$aiEventTypes = $_POST["EventTypes"];
				var_dump($_POST["EventDates"]);
				//var_dump($this->m_aiVenueIDs);
				//var_dump($this->m_adtEvents);
				//var_dump($this->m_aiEventTypes);

				if (count($adtEvents) == count($aiVenueIDs)) // These should be the same length
				{
					for ($i = 0; $i < count($adtEvents); $i++)
					{
						$result = $dbTheatreCMS->InsertNewEventInfo($id,$aiVenueIDs[$i], $adtEvents[$i], $aiEventTypes[$i]);
						//echo "result - " . $result;
						$bEventInfoInserted = ((( $result != -1) ? true : false) && $bEventInfoInserted);
					}
				}
			}

			if (isset($_POST["Troupers"], $_POST["Roles"], $_POST["Category"]))
			{
				$aiTrouperIDs = $_POST["Troupers"];
				$asRoles = $_POST["Roles"];
				$aiTrouperCategories = $_POST["Category"];
				//var_dump($this->m_asRoles);
				// var_dump($_POST["Roles"]);
				//die;
				$iCount = count($aiTrouperIDs);
				if ($iCount == count($asRoles) && ($iCount == count($aiTrouperCategories)))
				{
					for ($i = 0; $i < $iCount; $i++)
					{
						$bEventInfoInserted = ((($dbTheatreCMS->InsertNewTroupeInfo($id, $aiTrouperIDs[$i], $asRoles[$i],
							$aiTrouperCategories[$i]) != -1) ? true : false) && $bEventCreated);
					}
				}
			}

			if (isset($_POST["Admin"]))
			{
				$aiEventAdmins = $_POST["Admin"];
				//echo "dumping array";
				for ($i = 0; $i < count($aiEventAdmins); $i++)
				{
					//var_dump($this->m_aiEventAdmins);
					$bAdminInserted = ((($dbTheatreCMS->InsertNewEventAdmin($aiEventAdmins[$i], $id) > 0) ? true : false) && $bEventCreated);
				}
			}
		}
		//            var_dump($bEventCreated);
		//           var_dump($bEventInfoInserted);
		//            var_dump($bEventRolesInserted);
		//            var_dump($bAdminInserted);
		$bSuccess = $bEventCreated && $bEventInfoInserted && $bEventRolesInserted && $bAdminInserted;
		if ($bSuccess === True)
		{
			$dbTheatreCMS->CommitTransaction();
			$oEvent = $daoEvents->GetEventByID($id);
			$dbCompany = new Companies();
			$companyName = $dbCompany->GetCompnayByID($oEvent->Company_ID)->Name;
			echo json_encode(array("result" => (bool) true, "event" => array("id"=>$id, "title"=>$oEvent->Title, "company"=> $companyName, "slug"=>$oEvent->Slug)));
			die;
		}
		else
		{
			var_dump($bEventCreated);
			var_dump($bEventInfoInserted);
			var_dump($bEventRolesInserted);
			var_dump($bAdminInserted);
			/* $dbTheatreCMS->Rollback();*/
			$sMessage = "Unable to add event, for unknown reason please try again later.";
			echo (string) json_encode(array("result" => (bool)false, "id" => null, "message" => $sMessage));
			die;
		}
	}
	catch(Exception $e)
	{
		echo (string) json_encode(array("result" => (bool)false, "id" => null, "message" => $e->getMessage()));
		die;
	}
}

function delete($id)
{
	$daoEvents = new Events();
	echo json_encode(array("result" => $daoEvents->Delete($id)));
	die;
}
?>
