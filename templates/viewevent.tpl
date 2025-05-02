{extends file="master.tpl"}
{block name=css append}
    <link href="/public/css/pages/ViewEvent.css" rel="stylesheet" />
<!--<link href="../public/css/jquery.qtip.min.css" rel="stylesheet"/>
    <link href="http://media1.juggledesign.com/qtip2/css/demos.css" />-->
<style>
    .TrouperTip {
        width: 500px;
    }
</style>
{/block}
{block name=scripts append}
    <!--<script src="../public/javascript/Qtip/jquery.qtip.js"></script>-->
<script>
    { literal }
    $(function () {

        try {
            $("#buyTickets").button();
            $("#tabs").tabs();
        }
        catch (exception) {
            alert(exception);
        }

        $("#dialog").dialog(
                {
                    autoOpen: false,
                    width: 500,
                    buttons: {
                        "continue": function () {
                            window.open($("#buyTickets").attr("href"));
                            $("#dialog").dialog("close");
                        }
                    }
                });
        $("#buyTickets").click(function (e) {
            e.preventDefault();
            $("#dialog").dialog("open");
        });


    });

</script>
{/literal}
{/block}

{block name=body}
    <div id="masthead">
        <span class="head">{$company} proudly presents... </span>
    </div>
<!-- <h2 id = "companyHeader">{$company} presents... </h2><hr/> -->
<h1 class='center' id='showTitle'>{$title} </h1>
{if isset($artfullyID) && $artfullyID> 0}

        <a id="buyTickets" href='https://www.artfullyhq.com/store/events/{$artfullyID}' class="button center" style="width: 100%;">BUY TICKETS ONLINE! </a>

<div id="dialog" title="Confirm Before Continuing">
    <p>
        You are about to open a new tab / window to <strong>Artufllyhq.com (referred to as Artfully) </strong>,
                Artfully is a third party website / web service, utilized by <strong>Marshall Area Stage Company (referred to as MASC) </strong>for online ticket sales,
                MASC is in no way associated with Artfully or vice versa.
    </p>
    <p>
        By continuing to Artfully, you acknowledge that MASC provides no warranty nor assumes any liability implied or otherwise
                during the use of Artfully.
    </p>
    <p>
        You will also most likely be charged a approx <strong>$2.00 </strong>service charge by Artfully, 
                in addition to the normal ticket price.
    </p>
</div>
{/if}
    <div id='pNotes' class="infoBox-content">{$notes} </div>

{if isset($earlyTicketPrice) || isset($doorTicketprice)}
        <div class=" infoBox">
            <h3>Admission </h3>
            <div class="infoBox-content">
                Pre - Show Price: <strong>{$earlyTicketPrice} </strong>
                <br />
                Door Price: <strong>{$doorTicketPrice} </strong>
            </div>
        </div>
{/if}
  {*{foreach from=$troupers key=type item=category}
        <div class="infoBox">
            <h3 class="">{$type} </h3>
            <div class="infoBox-content">
                <table class='data-table responsive'>
                    <tbody>
                        {foreach from=$category item=person}
                            <tr>
                                <td title='Click to get trouper information'>
                                    <a class="trouper" href='http://marshallareastagecompany.org/ViewTrouper.php?TrouperID={$person["trouperID"]}' rel='http://marshallareastagecompany.org/ajaxViewTrouper.php?TrouperID={$person["trouperID"]}'>
                                        <span class='ui-icon ui-icon-link' style='float: left'></span>{$person.fullName}</a>
                                </td>
                                <td>{$person["role"]}
                                </td>
                            </tr>
                        {/foreach}
                    </tbody>
                </table>
            </div>
        </div>

    {/foreach}*}
    {if isset($eventInfo)}
        {foreach from=$eventInfo key=type item=info}
            <div class="infoBox">
            <h3>{$type} </h3>
            <div class="infoBox-content">
                <table class="data-table responsive">
                    <tbody>
                        {foreach from=$info item=itemInfo}
                            <tr>
                                <td title='Click for venue information'>
                                    <a href='ViewVenue.php?VenueID={$itemInfo["venueID"]}'>
                                        <span class='ui-icon ui-icon-link' style='float: left'></span>{$itemInfo["venueName"]}
                                    </a>
                                </td>
                                <td>{$itemInfo["when"]} </td>
                                <td>{$itemInfo["type"]} </td>
                            </tr>
                        {/foreach}
                    </tbody>
                </table>
            </div>
        </div>
    {/foreach}
{/if}

    {foreach from=$troupers key=type item=category}
        <div class="infoBox">
            <h3 class="">{$type} </h3>
            <div class="infoBox-content">
                <table class='data-table responsive'>
                    <tbody>
                        {foreach from=$category item=person}
                            <tr>
                                <td title='Click to get trouper information'>
                                    <a class="trouper" href='http://marshallareastagecompany.org/ViewTrouper.php?TrouperID={$person["trouperID"]}' rel='http://marshallareastagecompany.org/ajaxViewTrouper.php?TrouperID={$person["trouperID"]}'>
                                        <span class='ui-icon ui-icon-link' style='float: left'></span>{$person.fullName}</a>
                                </td>
                                <td>{$person["role"]}
                                </td>
                            </tr>
                        {/foreach}
                    </tbody>
                </table>
            </div>
        </div>

    {/foreach}
    <div id='fb-root'>
    </div>
<!-- <script src = 'http://connect.facebook.net/en_US/all.js#xfbml=1'></script>
<fb:comments href='{$currentUrl}' num_posts='2' width='500'></fb:comments>-->
{/block}