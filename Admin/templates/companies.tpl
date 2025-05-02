{extends file="templates/securemaster.tpl"}
{block name=body prepend}
        <div id = "masthead">
        <span class="head">Add Company</span>
         <button id="btnAddCompany" type="submit" class="ui-form-submit">Add</button>
    </div>
{/block}
{block name=content}
    <form id="frmAddVenue" method="post">    
        <div class="ui-form-content">
            <p class="input-section">
                <span class='required' title='Required field.'>*</span><label for="inCompanyName">Company Name</label>
                <br/>
                <input id="inCompanyName" name="inCompanyName" type="text" class="input-long" required="required"/>
            </p>
            <p class="input-section">
                <label for="inCompanyShortName">Company Short Name</label>
                <br/>
                <input id="inCompanyShortName" name="inCompanyShortName" type="text" required="required"/>
            </p>
            <p class="input-section">
                <label for="inCompanyAddress">Address</label>
                <br/>
                <input id="inCompanyAddress" name="inCompanyAddress" type="text"/>
            </p>
            <p class="input-section">
                <label for="inCompanyCity">City</label>
                <br/>
                <input id="inCompanyCity" name="inCompanyCity"/>
            </p>
            <p class="input-section">
                <label for="inCompanyState">State</label><br/>
                <select id="inCompanyState" name="inCompanyState">
                    {include file="templates/StateSelect.tpl"}
                </select>
            </p>
            <p class="input-section">
                <label for="inCompanyZip">Zip Code</label>
                <br/>
                <input id="inCompanyZip" name="inCompanyZip" type="text"/>
            </p>
            <p class="input-section">
                <label for="inCompanyWebsite">Website</label>
                <br/>
                <input id="inCompanyWebsite" name="inCompanyWebsite" type="text" class="input-url"/>
            </p>
            <p class="input-section">
                <label for="inCompanyLogo">Logo</label>
                <br/>
                <input id="inCompanyLogo" name="inCompanyLogo" type="file"/>
            </p>
        </div>
    </form>
{/block}