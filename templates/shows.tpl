{extends file="master.html"}
{block name=body}
    <div id = "masthead">
        <span class = "head">Show History</span>
    </div>
    <div class="content-box">
        {foreach from=$events item=event}
            <a href='ViewEvent.php?EventID={$event->ID}' title='Click for more info'>{$event->Title}</a><br/>
        {/foreach}
    </div>
{/block}