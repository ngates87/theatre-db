{extends file="templates/securemaster.tpl"}

{block name=scripts append}
    {literal}
        <!--  <script src="/public/javascript/jquery.validate.js" type="text/javascript"></script>
          <script src="/public/javascript/jquery.ui.widget.js" type="text/javascript"></script>
          <script src="/public/javascript/jquery.ui.core.js" type="text/javascript"></script>-->
        <script src="/public/javascript/jquery.ui.timepicker.js" type="text/javascript"></script>
        <script type="text/javascript" src="/public/javascript/jquery.tabledrag.js"></script>
        <script type="text/javascript" src="/public/javascript/jquery.tableEditor.js"></script>
        <script type="text/javascript" src="/public/javascript/jquery.tablesorter.js"></script>
        <script type="text/javascript" src="/public/packages/jwysiwyg/jquery.wysiwyg.js"></script>
        <!--<script type="text/javascript" src="/public/javascript/admin/addEvent.js"></script>-->
        <script type="text/javascript" src="/public/javascript/date.js"></script>
        <!-- <script type="text/javascript" src="/public/javascript/jquery.form.wizard.js"></script>-->
        <script type="text/javascript" src="/public/javascript/jquery.smartWizard.js"></script>
        <script type="text/javascript" src="/public/javascript/admin/manageEvent.ts"></script>

        <script type="text/javascript">
            $(function() {
                // 
                $('#wizard').smartWizard({
                    enableAllSteps: true,
                    transitionEffect: "slideleft",
               });
// // $("#frmEvent").formwizard(
                //);
            });
        </script>
    {/literal}
{/block}
{block name=css append}
    <link href="/public/css/jquery.ui.timepicker.css" rel="stylesheet" type="text/css"/>
    <link href="/public/packages/jwysiwyg/jquery.wysiwyg.css" rel="stylesheet" type="text/css"/>
    <!--<link href="/public/css/Admin.css" rel="stylesheet" type="text/css"/>-->
    <link href="/public/css/smart_wizard.css" rel="stylesheet" type="text/css"/>
{/block}
{block name=body prepend}
    <div id = "masthead">
        <span class="head">Manage Events</span>
        <button id="btnCreateEvent" style="float:right; margin:20px;">New Event</button>  
    </div>
    {/block}
{block name=content}

    <div id="dialog" title="Create Event" style="display:none;">
        <div class="ui-widget" id="errorMsg">
            <div class="ui-state-error ui-corner-all" style="padding: 0 .7em;display:none;">
                <p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span>
                    <strong>Error:</strong> <span id="errorText"></span></p>
            </div>
        </div>
        <div id="wizard" class="swMain">
             <ul>
                    <li><a href="#step-1">
                            <label class="stepNumber">1</label>
                            <span class="stepDesc">
                                Event Info<!--<br />
                                <small>Event Info</small>-->
                            </span>
                        </a></li>
                    <li><a href="#step-2">
                            <label class="stepNumber">2</label>
                            <span class="stepDesc">
                                Prices<!--<br />
                                <small>Prices</small>-->
                            </span>
                        </a></li>
                    <li><a href="#step-3">
                            <label class="stepNumber">3</label>
                            <span class="stepDesc">
                                Show Notes<!--<br />
                                <small>Show Notes</small>-->
                            </span>                   
                        </a></li>
                    <li><a href="#step-4">
                            <label class="stepNumber">4</label>
                            <span class="stepDesc">
                                Event Admins<!--<br />
                                <small>Event Admin</small>-->
                            </span>                   
                        </a>
                    </li>
                    <li><a href="#step-5">
                            <label class="stepNumber">5</label>
                            <span class="stepDesc">
                                Venue<!--<br />
                                <small>Location, Location!</small>-->
                            </span>                   
                        </a>
                    </li>    
                    <li><a href="#step-6">
                            <label class="stepNumber">6</label>
                            <span class="stepDesc">
                                Cast & Crew<!--<br />-->
                            </span>                   
                        </a>
                    </li>
                </ul>
            <form id="frmEvent" action="Ajax/Events.php" method="post" style="clear:both;">
               
                <div id="step-1">
                    <input type="hidden" id="inEventID"/>
                    <p class="input-section"><span class='required' title='Required field.'>*</span><label for="inEventTitle">Event
                            Title</label>
                        <br/>
                        <input id="inEventTitle" name="inEventTitle" type="text" required="required" class="input-long" value=""/>
                    </p>

                    <p class="input-section"><span class='required' title='Required field.'>*</span><label for="inEventSlug">Event
                            Slug</label>
                        <br/>
                        <input id="inEventSlug" name="inEventSlug" type="text" required="required" class="input-long" value=""/>
                    </p>
                    <p class="input-section">
                        <input id="inActive" name="inActive" type="checkbox" /><label for="inActive">Active</label>
                    </p>
                    <p class="input-section"><span class='required' title='Required field.'>*</span><label for="inCompany">Company
                            (presenters)</label>
                        <br/>
                        <select id="inCompany" name="inCompany" required="required">
                            {foreach from=$companies item=company}
                                <option value='{$company["id"]}'>{$company["name"]}</option>
                            {/foreach}
                        </select>
                    </p>
                    <p class="input-section">
                        <label for="inArtfullyID">Artfully Event ID</label>
                        <br/>
                        <input id="inArtfullyID" name="inArtfullyID" type="text" value=""/>
                    </p>
                </div>
                <div id="step-2">
                    <p class="input-section">
                        <label for="inPreShowPrice">Pre-Event Price</label>
                        <br/>
                        <input id="inPreShowPrice" name="inPreShowPrice" type="text" class="input-long" value=""/>
                    </p>

                    <p class="input-section"><label for="inDoorPrice">Door Price</label>
                        <br/>
                        <input id="inDoorPrice" name="inDoorPrice" type="text" class="input-long" value=''/>
                    </p>
                </div>
                <div id="step-3">
                    <div>
                        <label for="inShowNotes">Event Notes</label>
                        <br/>
                        <textarea name="inShowNotes" id="inShowNotes" rows="10" cols="90" style="width:100%;"></textarea>
                    </div>
                </div>
                <div id="step-4">
                    <strong> Event Admin</strong>
                    <table class="data-table">
                        <thead>
                            <tr class="ui-widget-header">
                                <th>Full Name</th>
                                <th style="width:16px;"></th>
                            </tr>
                        </thead>
                        <tbody id="eventAdmin">
                            <tr>
                                <td>
                                    <select name="inEventAdmin" id="inEventAdmin">
                                        <option value=""></option>
                                        {foreach from=$admins item=admin}
                                            <option value='{$admin["id"]}'>{$admin["name"]}</option>
                                        {/foreach}
                                    </select>
                                </td>
                                <td>
                                    <a href='#' title='Add Row' id="btnAddAdmin">
                                        <span class='ui-icon ui-icon-plusthick'></span>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div id="step-5">
                    <strong>Setup Event</strong>
                    <table id="tblEventInfo" class="data-table">
                        <thead>
                            <tr class="ui-widget-header">
                                <th></th>
                                <th style="width:50%;">Venue</th>
                                <th style="width:25%;">Date/Time</th>
                                <th style="width:25%;">Type</th>
                                <th colspan="2" class="action"></th>
                            </tr>
                        </thead>
                        <tbody id="eventInfo">
                            <tr>
                                <td/>
                                <!-- place holder -->
                                <td>
                                    <select id="selectVenues">
                                        {foreach from=$venues item=venue}
                                            {if $venue["selected"] == true}
                                                <option value='{$venue["id"]}' selected='true'>{$venue["title"]}</option>
                                            {else}
                                                <option value='{$venue["id"]}'>{$venue["title"]}</option>
                                            {/if}
                                        {/foreach}
                                    </select>
                                </td>
                                <td>
                                    <input id="inEventDateTime" class="dateTime" type="text"/>
                                </td>
                                <td>
                                    <select id="inEventCategory" name="inEventCategory">
                                        <option value=""></option>
                                        {foreach from=$itemTypes item=type}
                                            <option value='{$type["id"]}'>{$type["name"]}</option>
                                        {/foreach}
                                    </select>
                                </td>
                                <td/>
                                <td>
                                    <a href='#' title='Add Row' id="btnAddEventInfo">
                                        <span class='ui-icon ui-icon-plusthick'></span>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div id="step-6">
                    <strong>Choose Troupers (cast & crew)</strong>
                    <table id="tblTroupersInfo" class="data-table">
                        <thead>
                            <tr class="ui-widget-header">
                                <th class="action"></th>
                                <th style="width:50%;">Person</th>
                                <th style="width:50%;">Role</th>
                                <th>Category</th>
                                <th class="action" colspan="2"></th>
                            </tr>
                        </thead>
                        <tbody id="trouperInfo">
                            <tr>
                                <td>
                                </td>
                                <td>
                                    <select id="selectTrouper">
                                        {foreach from=$troupers item=trouper}
                                            <option value='{$trouper["id"]}'>{$trouper["name"]}</option>
                                        {/foreach}
                                    </select>
                                </td>
                                <td>
                                    <input id="inRole" type="text" class="input-long"/>
                                </td>
                                <td>
                                    <select id="selectTrouperCategory">
                                        {foreach from=$trouperCategories item=cat}
                                            <option value='{$cat["id"]}'>{$cat["display"]}</option>
                                        {/foreach}
                                    </select>
                                </td>
                                <td>
                                </td>
                                <td>
                                    <a href='#' title='Add Row' id="btnAddTrouperInfo">
                                        <span class='ui-icon ui-icon-plusthick'></span>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </form>
        </div>

        <div id="loading" style="display:none;">
            <!-- ui-dialog -->
            <div class="ui-overlay">
                <div class="ui-widget-overlay"></div>
                <div class="ui-widget-shadow ui-corner-all"
                     style="width: 122px; height: 122px; position: absolute; left: 35%; top: 35%;"></div>
            </div>
            <div style="position: absolute; width: 100px; height: 100px;left: 35%; top: 35%; padding: 10px;"
                 class="ui-widget ui-widget-content ui-corner-all">
                <img src="/public/images/ajax-loader.gif" alt="loading"/>
            </div>
        </div>
    </div>

    <div class="content-box">
  
       <!--  <div class="ui-form-header">
           <div class="ui-form-title">
                <span class="ui-icon ui-icon-info ui-form-header-icon" ></span>-->
                <!--<h1 class="content-box-heading">Manage Events
                    <button id="btnCreateEvent" style="float:right;">New Event</button>    
                    <h1>

                        </div>
                        </div>
                        <br/>-->
                        <table class="data-table" style="margin-bottom: 20px;">
                            <thead>
                                <tr >
                                    <th></th>
                                    <th style="width: 33%;">Title</th>
                                    <th style="width:33%;">Company</th>
                                    <th style="width:34%;">Url Slug</th>
                                    <!--<th style="width:16px;"></th>-->
                                    <th style="width:16px;"></th>
                                    <th style="width:16px;"></th>
                                </tr>
                            </thead>
                            <tbody id="tblEvents">
                                {foreach from=$events item=event}
                                    <tr>
                                        <td>
                                            {if $event["canUpdate"] == true}
                                                {if $event["active"] == true}
                                                    <input title='make part of the current season' type='checkbox' class='activeEvent'
                                                           value='{$event["id"]}' checked="checked"/>
                                                {else}
                                                    <input title='make part of the current season' type='checkbox' class='activeEvent'
                                                           value='{$event["id"]}'/>
                                                {/if}
                                            {/if}
                                        </td>
                                        <td><a title='Preview Event' href='/Admin/ViewEvent.php?EventID={$event["id"]}'>{$event["title"]}</a></td>
                                        <td>{$event["company"]}</td>
                                        <td>{$event["slug"]}</td>
                                        {* <td>
                                        <a title='Preview Event' href='/Admin/ViewEvent.php?EventID={$event["id"]}'>
                                        <span class='ui-icon ui-icon-link'></span>
                                        </a>
                                        </td>   *}
                                        <td>
                                            {if $event["canUpdate"] == true}
                                                <a title='Edit Event' href='/Admin/Event.php?EventID={$event["id"]}' data-id="{$event["id"]}"
                                                   class="read">
                                                    <span class='ui-icon ui-icon-pencil'></span>
                                                </a>
                                            {/if}
                                        </td>
                                        <td>
                                            {if $event["canDelete"] == true}
                                                <a title='Delete Event' href='#' onclick='RemoveEvent({$event["id"]});'>
                                                    <span class='ui-icon ui-icon-trash'></span>
                                                </a>
                                            {/if}
                                        </td>
                                    </tr>
                                {/foreach}
                            </tbody>
                        </table>
                        </div>
                    {/block}