{extends file="master.html"}
{block name=css append}
<style type="text/css">
    #map_streetview {
        width: 500px;
        height: 300px;
    }
</style>
{/block}
{block name=scripts}
{$GMapScript}
{/block}
{block name=body}
<div class="row">
    <div class="col-lg-12">
        <h2 class="head">{$title}</h2>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="col-lg-6">
            <p>{$address}</p>
            <p>{$city}, {$state}, {$zip}</p>
            <p>Capactiy: {$capacity}</p>
            {if isset($imageID)}
            <img src='Includes/Objects/ImageHandler.php?ImageID={$imageID}' alt='{$title}' style='max-width: 450px;' />
            {/if}
        </div>
        <div class="col-lg-6">
            <h3>Past productions at this venue.</h3>
            <ul>
                {foreach from=$history  item=event}
                <li>
                    <a href='/ViewEvent.php?EventID={$event->ID}'>
                        <span class='ui-icon ui-icon-link' style='float: left'></span>{$event->Title}
                    </a>
                </li>
                {/foreach}
            </ul>
        </div>
    </div>
    <div class="col-md-6">
        {$theMap}
        <div id="map_streetview"></div>
    </div>
</div>
<div class="row">

</div>
{/block}

