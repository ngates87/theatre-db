<?php /* Smarty version Smarty-3.1.12, created on 2014-03-24 07:29:45
         compiled from "templates/ajaxViewTrouper.tpl" */ ?>
<?php /*%%SmartyHeaderCode:144759754253302539c9fc85-79377077%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '43eb0cbb1b75deb5092bc4f1cf8bd610c1f59ce8' => 
    array (
      0 => 'templates/ajaxViewTrouper.tpl',
      1 => 1390786663,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '144759754253302539c9fc85-79377077',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'fullName' => 0,
    'age' => 0,
    'gender' => 0,
    'hairColor' => 0,
    'eyeColor' => 0,
    'bio' => 0,
    'imageID' => 0,
    'history' => 0,
    'event' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_53302539e194f8_99225133',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53302539e194f8_99225133')) {function content_53302539e194f8_99225133($_smarty_tpl) {?>
<table style="width:100%; height:100%;">
    <tr>
        <td colspan="2">
            <h1 class='center ui-widget-header' style='padding-left: 25px;' ><?php echo $_smarty_tpl->tpl_vars['fullName']->value;?>
</h1>
        </td>
    </tr>
    <tr>
        <td style="vertical-align: top;">
            <p>Age: <?php echo $_smarty_tpl->tpl_vars['age']->value;?>
</p>
            <p>Gender: <?php echo $_smarty_tpl->tpl_vars['gender']->value;?>
</p>
            <p>Hair Color: <?php echo $_smarty_tpl->tpl_vars['hairColor']->value;?>
</p>
            <p>Eye Color: <?php echo $_smarty_tpl->tpl_vars['eyeColor']->value;?>
</p>
            <p>Bio: <?php echo $_smarty_tpl->tpl_vars['bio']->value;?>
</p>
        </td>
        <td>
            <?php if (isset($_smarty_tpl->tpl_vars['imageID']->value)&&$_smarty_tpl->tpl_vars['imageID']->value>0){?>
                <img src='Includes/Objects/ImageHandler.php?ImageID=<?php echo $_smarty_tpl->tpl_vars['imageID']->value;?>
' alt='<?php echo $_smarty_tpl->tpl_vars['fullName']->value;?>
' title='<?php echo $_smarty_tpl->tpl_vars['fullName']->value;?>
' 
                     style='max-width:375px; max-height:400px; float:right;'/>
            <?php }?>
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <table class="data-table">
                <thead>
                    <tr class="ui-widget-header">
                        <th>Role</th>
                        <th>Production</th>
                    </tr>
                </thead>
                <?php  $_smarty_tpl->tpl_vars['event'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['event']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['history']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['event']->key => $_smarty_tpl->tpl_vars['event']->value){
$_smarty_tpl->tpl_vars['event']->_loop = true;
?>
                    <tr>
                        <td><?php echo $_smarty_tpl->tpl_vars['event']->value->Role;?>
</td>
                        <td>
                            <a href='/ViewEvent.php?EventID=<?php echo $_smarty_tpl->tpl_vars['event']->value->EventID;?>
'>
                                <span class='ui-icon ui-icon-link' style='float:left'></span><?php echo $_smarty_tpl->tpl_vars['event']->value->Title;?>

                            </a>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </td>
    </tr>
</table>



<?php }} ?>