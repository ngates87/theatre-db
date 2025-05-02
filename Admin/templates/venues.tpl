{extends file="templates/securemaster.tpl"}

{block name=scripts append}
<script type="text/javascript">
    function RemoveVenue(id,oThis)
    {
        if(confirm("Are you sure you want to delete this Venue?"))
        {
                $.ajax(
            {
                url:"/Admin/Venues.php",
                type:"POST",
                data:"DeleteID=" + id,
                success: function (msg)
                {
                    //alert(msg);
                    $(oThis).parent().parent().remove();
                    window.location.href = "Venues.php";
                }
            }
        );
        }
        return false;
    }
</script>
{/block}
{block name=body prepend}
    <div id = "masthead">
        <span class="head">{$actionText}</span>
        <button id="btnAddVenue" type="submit" class="ui-form-submit">{$actionText}</button>
	</div>
{/block}
{block name=content}
<form id="frmAddVenue" enctype="multipart/form-data" method="post">
    <div class="ui-form-content">
        <p class="input-section">
            <span class='required' title='Required field.'>*</span><label for="inVenueTitle">Venue Title</label>
            <br/>
            <input id="inVenueTitle" class="input-long" name="inVenueTitle" type="text" required="required" value="{$venueTitle}"/>
        </p>

        <p class="input-section">
            <label for="inVenueCity">City</label>
            <br/>
            <input id="inVenueCity" name="inVenueCity" value="{$city}" />
        </p>
        <p class="input-section">
            <label for="inVenueState">State</label><br/>
            <select id="inVenueState" name="inVenueState">
                {include file="templates/StateSelect.tpl"}
            </select>
        </p>
        <p  class="input-section">
            <label for="inVenueAddress">Address</label>
            <br/>
            <input id="inVenueAddress" name="inVenueAddress" type="text" value="{$address}"/>
        </p>

        <p  class="input-section">
            <label for="inVenueZip">Zip Code</label>
            <br/>
            <input id="inVenueZip" name="inVenueZip" type="text" value="{$zipCode}"/>
        </p>

        <p  class="input-section">
            <label for="inVenueCapacity">Capacity</label>
            <br/>
            <input id="inVenueCapacity" name="inVenueCapacity" type="number" value="{$capcity}"/>
        </p>
        <p>
            <label for='inVenueImage'>Venue Image </label><br/>
            <input id="inVenueImage" name="inVenueImage" type="file" />
        </p>
        <br/>
        <table class="data-table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Capacity</th>
                    <th>Address</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                {foreach from=$venues item=venue}
                    <tr>
                        <td>
                            <a href='Venues.php?VenueID={$venue["id"]}'>{$venue["name"]}</a>
                        </td>
                        <td>
                            {$venue["capcity"]}
                        </td>
                        <td>
                            {$venue["address"]},{$venue["city"]},{$venue["state"]},{$venue["zip"]}
                        </td>
                        <td>
                            <a title='Delete Event' href='#' onclick='RemoveVenue("{$venue["id"]}",this);'>
                                <span class='ui-icon ui-icon-trash'></span>
                            </a>
                        </td>
                    </tr>
                {/foreach}
            </tbody>    
        </table>
    </div>
</form>
{/block}