<?php
$PageTitle = "Success";
ob_start();
?>
<p>
    <span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>
    <strong>Success</strong>
    <?php
    if (isset($_GET["Message"]))
    {
        echo $_GET["Message"];
    }
    ?>
</p>
<?php 
$MainContent = ob_get_contents();
ob_end_clean();
include_once("SecureMaster.php");
?>