{extends file="../../templates/master.html"}

{block name=css append}
<link href="/public/css/Admin.css" rel="stylesheet" type="text/css" />
<link type="text/css" rel="Stylesheet" href="/public/css/blackbirdjs/blackbird.css" />
{/block}
{block name=scripts append}
<script type="text/javascript" src="/public/javascript/blackbirdjs/blackbird.js"></script>
<script src="/public/javascript/jquery.validate.js"></script>
<script src="http://malsup.github.com/jquery.form.js"></script>
{/block}
{block name=body}
<div class="row">
    <div class="col-lg-12">
        <div id="admin-links">
            <strong>Control Panel</strong>
            <ul>
                {if (isset($groupLevel) && $groupLevel == 7)}
                <li>
                    <span class='ui-icon ui-icon-key' style='float: left; margin-right: .3em;'></span>
                    <a href='Admins.php'>Admins</a>
                </li>
                {/if}

                {if ($groupLevel == 7 || $groupLevel == 6) }
                <li>
                    <span class='ui-icon ui-icon-note' style='float: left; margin-right: .3em;'></span>
                    <a href='SliderItems.php'>Front Page - SliderItems</a>
                </li>
                {/if}
                <li>
                    <span class='ui-icon ui-icon-contact' style="float: left; margin-right: .3em;"></span><a href="Companies.php">Companies</a>
                </li>
                <li>
                    <span class='ui-icon ui-icon-calendar' style="float: left; margin-right: .3em;"></span>
                    <a href="ManageEvents.php">Manage Events</a>
                </li>
                <!--<li><span class='ui-icon ui-icon-calendar' style="float: left; margin-right: .3em;"></span>
                    <a href="Event.php">Create Event</a>
                </li>-->
                <li>
                    <span class='ui-icon ui-icon-person' style="float: left; margin-right: .3em;"></span>
                    <a href="Troupers.php">Troupers</a>
                </li>
                <li>
                    <span class='ui-icon ui-icon-home' style="float: left; margin-right: .3em;"></span>
                    <a href="Venues.php">Venues</a>
                </li>
                <li>
                    <span class='ui-icon ui-icon-image' style="float: left; margin-right: .3em;"></span>
                    <a href="Sponsors.php">Sponsors</a>
                </li>
                <li>
                    <span class="ui-icon ui-icon-key" style="float: left; margin-right: .3em;"></span>
                    <a href="AccountSettings.php">Account Settings</a>
                </li>
                {if (isset($groupLevel) && $groupLevel == 7)}
                <li>
                    <span class='ui-icon ui-icon-key' style='float: left; margin-right: .3em;'></span>
                    <a href='{$mysqlAdminLink}' target="_blank">MySql Admin</a>
                </li>
                {/if}
                {if (isset($groupLevel) && $groupLevel == 7)}
                <li>
                    <span class="ui-icon ui-icon-key" style="float: left; margin-right: .3em;"></span><a href="info.php" target="_blank">Info</a>
                </li>
                {/if}
                <li>
                    <span class='ui-icon ui-icon-clock' style="float: left; margin-right: .3em;"></span>
                    <a href="Logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</div>
            {block name=content}
            {/block}

{/block}