{block name=body}
<table style="width:100%; height:100%;">
    <tr>
        <td colspan="2">
            <h1 class='center ui-widget-header' style='padding-left: 25px;' >{$fullName}</h1>
        </td>
    </tr>
    <tr>
        <td style="vertical-align: top;">
            <p>Age: {$age}</p>
            <p>Gender: {$gender}</p>
            <p>Hair Color: {$hairColor}</p>
            <p>Eye Color: {$eyeColor}</p>
            <p>Bio: {$bio}</p>
        </td>
        <td>
            {if isset($imageID) && $imageID > 0}
                <img src='Includes/Objects/ImageHandler.php?ImageID={$imageID}' alt='{$fullName}' title='{$fullName}' 
                     style='max-width:375px; max-height:400px; float:right;'/>
            {/if}
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <table class="data-table">
                <thead>
                    <tr class="ui-widget-header">
                        <th>Role</th>
                        <th>Production</th>
                    </tr>
                </thead>
                {foreach from=$history  item=event}
                    <tr>
                        <td>{$event->Role}</td>
                        <td>
                            <a href='/ViewEvent.php?EventID={$event->EventID}'>
                                <span class='ui-icon ui-icon-link' style='float:left'></span>{$event->Title}
                            </a>
                        </td>
                    </tr>
                {/foreach}
            </table>
        </td>
    </tr>
</table>

{/block}

