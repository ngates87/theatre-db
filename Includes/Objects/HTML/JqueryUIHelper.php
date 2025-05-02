<?php
/**
 * Created by JetBrains PhpStorm.
 * User: nagates
 * Date: 6/30/11
 * Time: 3:47 PM
 * To change this template use File | Settings | File Templates.
 */

class JqueryUIHelper
{

    static private function NotificationCloseScript()
    {
        $sScript = '<script type="text/javascript">
                    $(document).ready(function()
                    {
                        //$(".success").fadeOut(3000);

                        $(".close-notification").click(function(e)
                        {
                            //alert("hello");
                            e.preventDefault();
                            $(this).parents(".closeable-notification").remove();
                        });
                    });
            </script>';
        return $sScript;
    }
    static public function RenderErrorNotification($sTitle, $sText)
    {
         
         $sReturn = JqueryUIHelper::NotificationCloseScript() .
          '<div class="ui-widget closeable-notification">
                <div class="ui-state-error" style="width:97%; padding: 0 .7em;">
                    <p>
                        <span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span>
                        <strong>' . $sTitle . '</strong>' . $sText .
                        '<a class="ui-dialog-titlebar-close ui-corner-all" style="float:right;" href="#" role="button">
                            <span class="ui-icon ui-icon-closethick close-notification">close</span>
                        </a>
                    </p>
                </div>
            </div>';
         return $sReturn;
    }

    static public function RenderNotification($sTitle, $sText)
    {

        $sReturn = JqueryUIHelper::NotificationCloseScript() .

        '<div class="ui-widget closeable-notification">
                <div class="ui-state-highlight" style="width:97%;padding: 0 .7em;">
                    <p>
                        <span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>
                        <strong>' . $sTitle . '</strong>' . $sText .
                        '<a class="ui-dialog-titlebar-close ui-corner-all" style="float:right;" href="#" role="button">
                            <span class="ui-icon ui-icon-closethick close-notification">close</span>
                        </a>
                    </p>
                </div>
            </div>';
        
        return $sReturn;
    }

}
