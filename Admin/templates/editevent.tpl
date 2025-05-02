{extends file="templates/securemaster.tpl"}

{block name=scripts append}
<script src="/public/javascript/jquery.validate.js" type="text/javascript"></script>
<script src="/public/javascript/jquery.ui.widget.js" type="text/javascript"></script>
<script src="/public/javascript/jquery.ui.core.js" type="text/javascript"></script>
<script src="/public/javascript/jquery.ui.timepicker.js" type="text/javascript"></script>
<script type="text/javascript" src="/public/javascript/jquery.tabledrag.js"></script>
<script type="text/javascript" src="/public/javascript/jquery.tableEditor.js"></script>
<script type="text/javascript" src="/public/javascript/jquery.tablesorter.js"></script>
<script type="text/javascript" src="/public/packages/jwysiwyg/jquery.wysiwyg.js"></script>
<script type="text/javascript" src="/public/javascript/admin/addEvent.js"></script>
{/block}

{block name=css append}
<link href="/public/css/jquery.ui.timepicker.css" rel="stylesheet" type="text/css"/>
<link href="/public/packages/jwysiwyg/jquery.wysiwyg.css" rel="stylesheet" type="text/css"></link>
<link href="/public/css/Admin.css" rel="stylesheet" type="text/css"/>
{/block}

{block name=content}
<form id="frmAddEvent" method="post">
    <div class="ui-widget-header ui-form-header">
        <div class="ui-form-title" >
            <!--<span class='ui-icon ui-icon-person ui-form-header-icon'></span>-->
            <strong>Add Event</strong>
            <div style="float:right;">
                
                {if $active == true}
                    <input id="inActive" name="inActive" type="checkbox" checked='checked' />
                {else}
                    <input id="inActive" name="inActive" type="checkbox" />
                {/if}
                <label for="inActive">Current Season</label>
            </div>
        </div>


    </div>
    <div class="ui-form-content">
        <p class="input-section"><span class='required' title='Required field.'>*</span><label for="inEventTitle">Event Title</label>
            <br/>
            <input id="inEventTitle" name="inEventTitle" type="text" required="required" class="input-long" value="{$eventTitle}"/>
        </p>
        <p class="input-section"><span class='required' title='Required field.'>*</span><label for="inCompany">Company (presenters)</label>
            <br/>
            <select id="inCompany" name="inCompany" required="required">
                {foreach from=$companies item=company}
                    {if $companyID == $company["id"]}
                        <option value='{$company["id"]}' selected="true" >{$company["name"]}</option>
                    {else}
                        <option value='{$company["id"]}'>{$company["name"]}</option>
                    {/if}
                {/foreach}
            </select>
        </p>
        <p class="input-section">
            <label for="inArtfullyID">Artfully Event ID</label>
            <br/>
            <input id="inArtfullyID" name="inArtfullyID" type="text"  value="{$artfullyID}"/>
        </p>
        <p class="input-section">
            <label for="inPreShowPrice">Pre-Event Price</label>
            <br/>
            <input id="inPreShowPrice" name="inPreShowPrice" type="text"  class="input-long" value="{$prePrice}"/>
        </p>
        <p class="input-section"><label for="inDoorPrice">Door Price</label>
            <br/>
            <input id="inDoorPrice" name="inDoorPrice" type="text" class="input-long" value='{$regPrice}'/>
        </p>
        <div>
            <label for="inShowNotes">Event Notes</label>
            <br/>
            <textarea name="inShowNotes" id="inShowNotes" rows="10" style="width:99%;">{$notes}</textarea>
        </div>
        <strong> Event Admin</strong>
        <table class="data-table">
            <thead>
                <tr class="ui-widget-header">
                    <th>Full Name </th>
                    <th style="width:16px;"></th>
                </tr>
            </thead>
            <tbody id="eventAdmin">
                {foreach from=$eventAdmin item=admin}
                    <tr>
                        <td>
                            <input type='hidden' name='Admin[]' value='{$admin["id"]}'/>{$admin["name"]}
                        </td>
                        <td  class='action'>
                            <a href='#' title='Delete Row.' onclick='$(this).parent().parent().remove();return false;'>
                                <span class='ui-icon ui-icon-trash'></span>
                            </a>
                        </td>
                    </tr>
                {/foreach}
                <tr>
                    <td>
                        <select name="inEvemtAdmin" id="inEventAdmin">
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
        <br/>
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
                {foreach from=$eventInfo item=info}
                    <tr>
                        <td class='ui-icon ui-icon-grip-dotted-vertical'></td>
                        <td class='venue'>
                            <input type='hidden' name='Venues[]' value='{$info["id"]}'/>{$info["venueName"]}
                        </td>
                        <td class='when'>
                            <input type='hidden' name='EventDates[]' value='{$info["when"]}'/>{$info["when"]}
                        </td>
                        <td class='type'>
                            <input type='hidden' name='EventTypes[]' value='{$info["typeID"]}'/>{$info["typeName"]}
                        </td>
                        <td class='action'>
                            <a href="#" title="Edit row" class="tsEditLink">
                                <span class="ui-icon ui-icon-pencil"></span>
                            </a>
                            <a href="#" title="Save Row" class="tsSaveLink" style="display:none">
                                <span class="ui-icon ui-icon-disk"></span>
                            </a>
                        </td>
                        <td  class='action'>
                            <a href='#' title='Delete Row.' onclick='$(this).parent().parent().remove();return false;'>
                                <span class='ui-icon ui-icon-trash'></span>
                            </a>
                        </td> 
                    </tr>
                {/foreach}
                <tr>
                    <td/>
                    <td>
                        <select id="selectVenues">
                            {foreach from=$venues item=venue}
                                {if $venue["selected"] == true}
                                    <option value='{$venue["id"]}' selected='true' >{$venue["title"]}</option>
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
                                <option value='{$type["id"]}' >{$type["name"]}</option>
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
        <br/>
        <strong>Choose Troupers (cast & crew)</strong>
        <table id="tblTroupersInfo" class="data-table">  
            <thead>
                <tr class="ui-widget-header">
                    <th class="action"></th>
                    <th style="width:50%;">Person</th>
                    <th style="width:50%;">Role</th>
                    <th>Category </th>
                    <th class="action" colspan="2"></th>
                </tr>
            </thead>
            <tbody id="trouperInfo">
                {foreach from=$trouperInfo item=info}
                    <tr>
                        <td class='ui-icon ui-icon-grip-dotted-vertical'></td>                          
                        <td class="person"><input type='hidden' name='Troupers[]' value='{$info["id"]}'/> {$info["name"]} </td>
                        <td class="role"><input type='hidden' name='Roles[]' value='{$info["role"]}'/>{$info["role"]}</td>
                        <td class="type"><input type='hidden' name='Category[]' value='{$info["catID"]}'/>{$info["catDisplay"]}</td>
                        <td class='action'>
                            <a href="#" title="Edit row" class="tsEditLink">
                                <span class="ui-icon ui-icon-pencil"></span>
                            </a>
                            <a href="#" title="Save Row" class="tsSaveLink" style="display:none">
                                <span class="ui-icon ui-icon-disk"></span>
                            </a>
                        </td>
                        <td  class='action'>
                            <a href='#' title='Delete Row' onclick='$(this).parent().parent().remove();return false;'>
                                <span class='ui-icon ui-icon-trash'></span>
                            </a>
                        </td> 
                    </tr>
                {/foreach}
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
    <button type='submit' class='ui-form-submit'>{$actionText}</button>
</form>
{/block}

