{extends file="../../templates/master.tpl"}

{block name=body}
    <div class="ui-widget-header ui-form-header">
        <div class="ui-form-title">
            <span class="ui-icon ui-icon-person ui-form-header-icon" style="float: left; margin-right: .3em;"></span>
            <strong>Logged Out</strong>
        </div>
    </div>
    <p>
        <a href="/Admin/index.php">Login</a>
    </p>
{/block}