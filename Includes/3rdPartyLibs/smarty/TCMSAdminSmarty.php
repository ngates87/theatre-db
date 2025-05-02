<?php
/**
 * Description of TCMSAdminSmarty
 *
 * @author nagates
 */

require_once ($_SERVER["DOCUMENT_ROOT"] . "/Admin/CodeBehind/SessionHandler.php");
require_once "Smarty.class.php";

class TCMSAdminSmarty extends Smarty
{
    //put your code here
    
    function __construct()
    {
        parent::__construct();
        $this->setTemplateDir(array(
            'one' => $_SERVER["DOCUMENT_ROOT"] . "/templates",
        ));
        
        $this->assign("groupLevel", $GLOBALS["GroupLevel"]);
        $this->assign("mysqlAdminLink", "/Admin/mysql/");
        $this->assign("isDevServer",ApplicationHelper::IsDevelopmentServer());
    }
}

?>
