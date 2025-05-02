<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

include_once($_SERVER["DOCUMENT_ROOT"] . "/Includes/Database/DAO/Events.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/Includes/Database/VO/Event.php");
function smarty_function_GetCurrentSeason(array $params, Smarty_Internal_Template $template)
{
    $daoEvents = new Events();
    $aoCurrentSeason = $daoEvents->GetActiveEvents();
    if ($aoCurrentSeason)
    {
        foreach ($aoCurrentSeason as $oEvent)
        {
            echo "<li>";
            echo "<a href='/ViewEvent.php?EventID={$oEvent->ID}'>{$oEvent->Title}</a>";
            echo "</li>";
        }
    }

}
?>
