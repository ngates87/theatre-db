<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

include_once($_SERVER["DOCUMENT_ROOT"] . "/Includes/Database/DAO/DatabaseClient.php");
class SliderItem extends DatabaseClient
{
    public $ID;
    public $Image_ID;
    public $Hyperlink;
    public $Caption;
    public $Enabled;
        
    public function Enable($bEnabled)
    {
        $val = false;        // do i not need to declare this in the outer scope?
        if(strcasecmp($bEnabled, 'true') == 0)
        {
            $val = true;
        }
        else if(strcasecmp($bEnabled, 'false') == 0)
        {
            $val = false;
        }
        else
        {
            return false;
        }
        
        return $this->UpdateRecordExpected("UPDATE SliderItems SET Enabled = ? WHERE ID = ? ", array((bool)$val, $this->ID), 1);
        
    }
}
?>
