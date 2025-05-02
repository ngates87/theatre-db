{extends file="master.html"}
{block name=body}
    <div class="row">
        <div class="col-lg-12">
            <h2>Venues</h2><!--<span class="subhead">this is a sub heading</span>-->
        </div>
    </div>
<div class="content-box">

    {foreach from=$venues item=venue}
        <a href='ViewVenue.php?VenueID={$venue->ID}' title='Click for more info'>{$venue->Title}</a><br/>
    {/foreach}
</div>
{/block}