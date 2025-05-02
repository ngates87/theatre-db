{extends file="templates/securemaster.tpl"}
{block name=body prepend}
	<div id="masthead">
        <span class="head">Account Settings</span>
	      <!--  <button id="btnCreateEvent" style="float:right; margin:20px;">New Event</button>  -->
    </div>
{/block}
{block name=content}

	<form id="FrmAcctSettings" method="post">
	    
	    <!--<div class="ui-widget-header ui-form-header">
	        <div class="ui-form-title" >
	            <span class='ui-icon ui-icon-person ui-form-header-icon'></span>
	            <span class='ui-icon ui-icon-key ui-form-header-icon' ></span>
	            <strong>Account Settings</strong>
	        </div>
	        <button type="submit" class="ui-form-submit">Update</button>
	    </div>   -->
	    <div class="ui-form-content">
	        <p class="input-section">
	            <span class='required' title='Required field.'>*</span><label for="firstname"><strong>First Name: </strong></label><br />
	            <input id="firstname" name="inFirstName" type="text" class="input-long" value="{$firstName}"/>
	        </p>
	        <p class="input-section">
	            <span class='required' title='Required field.'>*</span><label for="lastname"><strong>Last Name: </strong></label><br />
	            <input id="lastname" name="inLastName" type="text" class="input-long" value="{$lastName}" />
	        </p>
	        <p class="input-section">
	            <span class='required' title='Required field.'>*</span><label for="email"><strong>Email: </strong></label><br />
	            <input id="email" name="inEmail" type="text" class="input-long" value="{$email}"/>
	        </p>
	        <p>
	            <span class='required' title='Required field.'>*</span><label for="password"><strong>Current Password: </strong></label><br />
	            <input id="password" name="inCurrentPassword" type="password"  class="input-long"/>
	        </p>
	        <p>
	            <span class='required' title='Required field.'>*</span><label for="password"><strong>New Password: </strong></label><br />
	            <input id="password" name="inNewPassword" type="password"  class="input-long"/>
	        </p>
	        <p>
	            <span class='required' title='Required field.'>*</span><label for="confirm_password"><strong>Confirm New Password: </strong></label><br />
	            <input id="confirm_password" name="inConfirmNewPassword" type="password"  class="input-long"/>
	        </p>
	    </div>
	</form>

{/block}