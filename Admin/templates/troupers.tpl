{extends file="templates/securemaster.tpl"}

{block name=scripts append}
{literal}
    <script src="http://malsup.github.com/jquery.form.js"></script>
    <script type="text/javascript" src="/public/javascript/admin/troupers.js"></script>
{/literal}
{/block}
{block name=body prepend}
        <div id = "masthead">
        <span class="head">Troupers</span>
        <button id="btnAddTrouper" type="submit" style="float:right;margin:20px;">
            Add Trouper
        </button>
    </div>
{/block}
{block name=content}
<!--<div class="ui-widget-header ui-form-header">
    <div class="ui-form-title" >
        <span class='ui-icon ui-icon-person ui-form-header-icon'></span>
        <h3>Troupers</h3>
        <button id="btnAddTrouper" type="submit" style="float:right;">
            Add Trouper
        </button>
    </div>

</div>-->
<div id="dialog" title="Add trouper" style="overflow:hidden;display:none;">
    <div class="ui-widget" id="errorMsg">
        <div class="ui-state-error ui-corner-all" style="padding: 0 .7em;display:none;"> 
            <p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span> 
                <strong>Error:</strong> <span id="errorText"></span></p>
        </div>
    </div>
    <form id="frmTrouper" method="post" action="Ajax/Troupers.php" enctype="multipart/form-data">
        <input type="hidden" id="inTrouperID" name="id" />
        <p class="input-section">
            <span class='required' title='Required field.'>*</span><label for="inFirstName">First Name</label><br/>
            <input id="inFirstName" name="firstName" type="text" required="required" class="input-long required" />
        </p>
        <p class="input-section">
            <span class='required' title='Required field.'>*</span><label for="inLastName">Last Name</label><br/>
            <input id="inLastName" name="lastName" type="text" required="required" class='input-long required' />
        </p>
        <p class="input-section">
            <label for="inBirthday">Date Of Birth</label><br/>
            <input id="inBirthday" name="birthday" type="date"/>
        </p>
        <p class="input-section">
            <label for="inPhone">Phone</label><br/>
            <input id="inPhone" name="phone" type="digits"/>
        </p>
        <p class="input-section">
            <label for="inEmail">Email</label> <br/>
            <input id="inEmail" name="email" type="email"  class='input-long'/>
        </p>
        <div class="input-section">
            <label for="inGender">Gender</label><br/>
            <select id="inGender" name="gender">
                <option value="">select</option>
                <option value="M">M</option>
                <option value="F">F</option>
            </select>
        </div>
        <div class="input-section">
            <label for="inEyeColor">Eye Color</label><br/>
            <select id="inEyeColor" name="eyeColor">
                <option value="">select</option>
                <option value="Amber">Amber</option>
                <option value="Blue">Blue</option>
                <option value="Brown">Brown</option>
                <option value="Gray">Gray</option>
                <option value="Green">Green</option>
                <option value="Hazel">Hazel</option>
                <option value="Red">Red</option>
                <option value="Violet">Violet</option>
            </select>
        </div>
        <div class="input-section">
            <label for="inHairColor">Hair Color</label><br/>
            <select id="inHairColor" name="hairColor">
                <option value="">select</option>
                <option value="Brown">Brown</option>
                <option value="Black">Black</option>
                <option value="Auburn">Auburn</option>
                <option value="Chestnut">Chestnut</option>
                <option value="Red">Red</option>
                <option value="Grey">Grey</option>
                <option value="White">White</option>
                <option value="Green">Green</option>
                <option value="Blue">Blue</option>
                <option value="Yellow">Yellow</option>
                <option value="Orange">Orange</option>
            </select>
        </div>
        <div class="input-section">
            <label for="inHeight">Height (inches)</label><br/>
            <input id="inHeight" name="height" type="number" style="width:100px;" />
        </div>
        <div class="input-section">
            <label for="inWeight">Weight (pounds)</label><br/>
            <input id="inWeight" name="weight" type="number"  style="width:100px;"/>
        </div>
        <p>
            <label for="inTrouperImage">Pic</label><br/>
            <input id="inTrouperImage" name="image" type="file"/>
        </p>
        <p>
            <label>Bio</label><br/>
            <textarea id="inBio" name="bio" rows="15" style="width:99%;">
            </textarea>
        </p>
    </form>
    <div id="loading" style="display:none;">
        <!-- ui-dialog -->
        <div class="ui-overlay">
            <div class="ui-widget-overlay"></div>
            <div class="ui-widget-shadow ui-corner-all" style="width: 122px; height: 122px; position: absolute; left: 35%; top: 35%;"></div>
        </div>
        <div style="position: absolute; width: 100px; height: 100px;left: 35%; top: 35%; padding: 10px;" class="ui-widget ui-widget-content ui-corner-all">
            <img src="/public/images/ajax-loader.gif" alt="loading"/>
        </div>
    </div>
</div>
<table id="tblTroupers" class="data-table" style="margin-top:20px;">
    <thead>
        <tr>
            <th></th>
            <th>Name</th>
            <th>Age</th>
            <th>Hair Color</th>
            <th>Eye Color</th>
            <th>Email</th>
            <th>Phone</th>
            <th></th>
        </tr>
    </thead>
    {foreach from=$troupers item=trouper}
        <tr>
            <td class="gender">{$trouper["gender"]}</td>
            <td class="name">
                <a class="read" href='#' data-id="{$trouper["id"]}" class="edit">{$trouper["fullName"]}</a>
            </td>
            <td class="age">
                {$trouper["age"]}
            </td>
            <td class="hairColor">
                {$trouper["hairColor"]}
            </td>
            <td class="eyeColor">
                {$trouper["eyeColor"]}
            </td>
            <td class="email">
                {$trouper["email"]}
            </td>
            <td class="phone">
                {$trouper["phone"]}
            </td>
            <td>
                <a  class="delete" title="Delete trouper" href="#" data-id="{$trouper["id"]}" >
                    <span class='ui-icon ui-icon-trash'></span>
                </a>
            </td>
        </tr>
    {/foreach}
</table>
{/block}