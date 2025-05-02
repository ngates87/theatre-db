{extends file="master.html"}
{block name=body}
<div id="masthead">
    <span class="head">{$fullName}</span><!--<span class="subhead">this is a sub heading</span>-->
</div>
<div class="row">
    <div class="col-md-6">
        <!-- <tr>
             <td colspan="2">
                 <h1 class='center ui-widget-header' style='padding-left: 25px;' >{$fullName}</h1>
             </td>
         </tr>-->
        <p>Age: {$age}</p>
        <p>Gender: {$gender}</p>
        <p>Hair Color: {$hairColor}</p>
        <p>Eye Color: {$eyeColor}</p>
        <p>Bio: {$bio}</p>
    </div>
    <div class="col-md-6">
        {if isset($imageID) && $imageID > 0}
        <img src='Includes/Objects/ImageHandler.php?ImageID={$imageID}' alt='{$fullName}' title='{$fullName}' class="img-responsive" />
        {/if}
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Role</th>
                        <th>Production</th>
                    </tr>
                </thead>
                {foreach from=$history  item=event}
                <tr>
                    <td>{$event->Role}</td>
                    <td>
                        <a href='/ViewEvent.php?EventID={$event->EventID}'>
                            <span class='ui-icon ui-icon-link' style='float: left'></span>{$event->Title}
                        </a>
                    </td>
                </tr>
                {/foreach}
            </table>
        </div>
    </div>
</div>

{/block}

