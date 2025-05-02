{extends file="master.html"}
{block name=body}
            <div id = "masthead">
           <span class = "head">Our Troupers </span>
       </div>
    <div class="content-box">
       {foreach from=$troupers item=person}
           <a href='ViewTrouper.php?TrouperID={$person->ID}' title='Click to learn more about me!'>{$person->FirstName} {$person->LastName}</a><br/>
       {/foreach}
    </div>
{/block}
    