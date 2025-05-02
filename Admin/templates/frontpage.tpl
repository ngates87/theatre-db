{extends file="templates/securemaster.tpl"}
{block name=content}
<form id="frmSponsors" enctype="multipart/form-data" method="post">
    <div class="ui-widget-header ui-form-header">
        <div class="ui-form-title" >
            <span class='ui-icon ui-icon-home ui-form-header-icon'></span>
            <strong>Update Home Page</strong>
        </div>
        {*<div style="margin-top: 7px; float:left;">
            <label for="inActive">Active</label>
            {if $active == true}
                <input type="checkbox" id="inActive" name="inActive" checked='checked'/>
            {else}
                <input type="checkbox" id="inActive" name="inActive" />
            {/if}
        </div>*}
        <button id="btnAddSponsor" type="submit" class="ui-form-submit">{$actionText}</button>
    </div>
    <div class="ui-form-content">
        <span class='required' title='Required field.'>*</span><label>Select Promoted Event</label><br/>
        <table class="data-table">
            <thead>
                <tr>
                    <th style="width:16px;"></th>
                    <th style="width: 50%;">Title</th>
                    <th style="width: 50%;">Company</th>
                </tr>
            </thead>
            <tbody>
                {foreach from=$events item=event}
                    <tr>
                        <td><input type='radio' name='selected' value='{$event["id"]}' /> </td>
                        <td>{$event["title"]}</td>
                        <td>{$event["company"]}</td>
                    </tr>
                {/foreach}
            </tbody>
        </table>
        <?php
        {if $imageID > 0}
            <img src='/Includes/Objects/ImageHandler.php?ImageID={$iImageID}' style='float:right;' alt='currently uploaded image'/>
        {/if} 
        <p >
            <span class='required' title='Required field.'>*</span><label for="inImage">Event Image</label><br/>
            <input id="inImage" name="inImage" type="file"/><br/>
        </p>
        <table class="data-table">
            <thead>
                <tr class="ui-widget-header">
                    <th style="width:25px;">Active</th>
                    <th>Title</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                {foreach from=$frontPages item=item}
                    <tr>
                        <td>{$item["active"]}</td>
                        <td>{$item["title"]}</td>
                        <td>
                            <img src='/Includes/Objects/ImageHandler.php?ImageID={$item["imageID"]}' alt='{$item["title"]}' style='max-height:135px;'>
                        </td>
                    </tr>
                {/foreach}
            </tbody>    
        </table>
    </div>
</form>
{/block}